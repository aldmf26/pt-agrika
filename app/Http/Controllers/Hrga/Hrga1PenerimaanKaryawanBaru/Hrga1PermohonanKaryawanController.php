<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\PermohonanKaryawan;
use App\Services\DataPegawaiService;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1PermohonanKaryawanController extends Controller
{

    public function singkron(DataPegawaiService $dataPegawaiService)
    {
        $dataPegawaiService->download();
        $datas = PermohonanKaryawan::dapatkan();
        PermohonanKaryawan::where('admin', 'import')->delete();
        foreach ($datas as $d) {
            PermohonanKaryawan::create([
                'status_posisi' => $d->status_posisi ?? 'Kontrak',
                'jabatan' => '-',
                'id_divisi' => $d->id_divisi,
                'jumlah' => $d->jumlah,
                'alasan_penambahan' => "Adanya penambahan kapasitas aktivitas $d->jabatan",
                'umur' => $d->umur,
                'jenis_kelamin' => $d->jenis_kelamin,
                'pendidikan' => $d->pendidikan ?? 'open seluruh pendidikan',
                'pengalaman' => $d->pengalaman ?? 'tidak perlu',
                'pelatihan' => $d->pelatihan ?? 'tidak perlu',
                'mental' => $d->mental ?? 'tidak perlu',
                'uraian_kerja' => $d->uraian_kerja,
                'tgl_dibutuhkan' => $d->tgl_masuk,
                'diajukan_oleh' => $d->diajukan_oleh ?? '',
                'tgl_input' => $d->tgl_input,
                'admin' => "import",
            ]);
        }

        return redirect()->route('hrga1.1.index')->with('sukses', 'Data Berhasil disinkronkan');
    }
    public function index()
    {
        $dataBaru = PermohonanKaryawan::with('divisi')->orderByDesc('tgl_input')->get();

        $data = [
            'title' => 'Hrga 1.1 permohonan karyawan',
            'dataBaru' => $dataBaru,
        ];
        return view('hrga.hrga1.hrga1_permohonan_karyawan.index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Permohonan Karyawan Baru',
            'divisis' => Divisi::all(),
        ];
        return view('hrga.hrga1.hrga1_permohonan_karyawan.create', $data);
    }

    public function edit(PermohonanKaryawan $permohonan)
    {
        $data = [
            'title' => 'Edit Permohonan Karyawan Baru',
            'divisis' => Divisi::all(),
            'permohonan' => $permohonan,
        ];
        return view('hrga.hrga1.hrga1_permohonan_karyawan.edit', $data);
    }

    public function update(Request $r, PermohonanKaryawan $permohonan)
    {
        $permohonan->update([
            'status_posisi' => $r->status_posisi,
            'jabatan' => '-',
            'id_divisi' => $r->divisi,
            'jumlah' => $r->jumlah,
            'alasan_penambahan' => $r->alasan_penambahan,
            'umur' => $r->umur,
            'jenis_kelamin' => $r->jenis_kelamin,
            'pendidikan' => $r->pendidikan,
            'pengalaman' => $r->pengalaman,
            'pelatihan' => $r->pelatihan,
            'mental' => $r->mental,
            'uraian_kerja' => $r->uraian_kerja,
            'tgl_dibutuhkan' => $r->tgl_dibutuhkan,
            'diajukan_oleh' => $r->diajukan_oleh,
            'admin' => auth()->user()->name,
        ]);
        return redirect()->route('hrga1.1.index')->with('sukses', 'Data Berhasil diperbarui');
    }


    public function store(Request $r)
    {
        PermohonanKaryawan::create([
            'status_posisi' => $r->status_posisi,
            'jabatan' => '-',
            'id_divisi' => $r->divisi,
            'jumlah' => $r->jumlah,
            'alasan_penambahan' => $r->alasan_penambahan,
            'umur' => $r->umur,
            'jenis_kelamin' => $r->jenis_kelamin,
            'pendidikan' => $r->pendidikan,
            'pengalaman' => $r->pengalaman,
            'pelatihan' => $r->pelatihan,
            'mental' => $r->mental,
            'uraian_kerja' => $r->uraian_kerja,
            'tgl_dibutuhkan' => $r->tgl_dibutuhkan,
            'diajukan_oleh' => $r->diajukan_oleh,
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => auth()->user()->name,
        ]);
        return redirect()->route('hrga1.1.index')->with('sukses', 'Data Berhasil ditambahkan');
    }

    public function print(PermohonanKaryawan $permohonan)
    {
        $data = [
            'title' => 'PERMOHONAN KARYAWAN BARU',
            'dok' => 'Dok.No.: FRM.HRGA.01.01, Rev.00',
            'datas' => $permohonan,
        ];

        return view('hrga.hrga1.hrga1_permohonan_karyawan.print', $data);
    }
}
