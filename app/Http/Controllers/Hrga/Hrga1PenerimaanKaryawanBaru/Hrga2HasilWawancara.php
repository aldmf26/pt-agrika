<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\HasilWawancara;
use App\Models\PenilaianKaryawan;
use App\Services\DataPegawaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga2HasilWawancara extends Controller
{
    public function singkron(DataPegawaiService $dataPegawaiService)
    {
        $dataPegawaiService->download();
        return redirect()->route('hrga1.2.index')->with('sukses', 'Data Berhasil disinkronkan');
    }
    public function index()
    {
        $datas = DataPegawai::with('divisi')->latest()->get();
        $data = [
            'title' => 'Hrga 1.2 hasil wawancara',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga2_hasil_wawancara.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Hasil Wawancara',
            'divisi' => Divisi::all(),
            'cth_wawancara' => DB::table('cth_wawancara')->where('id_cth_wawancara', '1')->first(),
            'cth2' => DB::table('cth_penialain_karyawan')->where('id', '1')->first(),
        ];
        return view('hrga.hrga1.hrga2_hasil_wawancara.create', $data);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction();
            $pegawai = DataPegawai::create([
                'nik' => $r->nik,
                'nama' => $r->nama_lengkap,
                'status' => $r->status,
                'jenis_kelamin' => $r->jenis_kelamin,
                'tgl_lahir' => $r->tgl_lahir,
                'tgl_masuk' => $r->tgl_masuk,
                'divisi_id' => $r->id_divisi,
                'posisi' => $r->posisi,
                'status' => $r->status,
                'gaji' => 0,
                'pendidikan' => $r->pendidikan,
                'sumber_data' => 'hccp',
                'karyawan_id_dari_api' => 0,
                'keterangan' => '',
                'admin' => auth()->user()->name,
            ]);

            HasilWawancara::create([
                'id_anak' => $pegawai->id,
                'nama' => $r->nama_lengkap,
                'nik' => $r->nik,
                'tgl_lahir' => $r->tgl_lahir,
                'jenis_kelamin' => $r->jenis_kelamin,
                'id_divisi' => $r->id_divisi,
                'kesimpulan' => $r->kesimpulan,
                'keputusan' => 'dilanjutkan',
                'tgl_masuk' => $r->tgl_masuk,
            ]);

            PenilaianKaryawan::create([
                'id_anak' => $pegawai->id,
                'periode' => $r->periode,
                'pendidikan_standar' => $r->pendidikan_standar,
                'pendidikan_hasil' => $r->pendidikan_hasil,
                'pengalaman_standar' => $r->pengalaman_standar,
                'pengalaman_hasil' => $r->pengalaman_hasil,
                'pelatihan_standar' => $r->pelatihan_standar,
                'pelatihan_hasil' => $r->pelatihan_hasil,
                'keterampilan_standar' => $r->keterampilan_standar,
                'keterampilan_hasil' => $r->keterampilan_hasil,
                'kompetensi_inti_standar' => $r->kompetensi_inti_standar,
                'kompetensi_inti_hasil' => $r->kompetensi_inti_hasil
            ]);


            DB::commit();
            return redirect()->route('hrga1.2.index')->with('sukses', 'Data berhasil disimpan');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }

        return redirect()->route('hrga1.2.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function edit(DataPegawai $pegawai)
    {

        $data = [
            'title' => 'Edit Hasil Wawancara',
            'pegawai' => $pegawai,
            'divisi' => Divisi::all(),
            'cth_wawancara' => DB::table('cth_wawancara')->where('id_cth_wawancara', '1')->first(),
            'cth2' => DB::table('cth_penialain_karyawan')->where('id', '1')->first(),
        ];
        return view('hrga.hrga1.hrga2_hasil_wawancara.edit', $data);
    }

    public function update(Request $r, DataPegawai $pegawai)
    {
        try {
            DB::beginTransaction();
            $pegawai->update([
                'nik' => $r->nik,
                'nama' => $r->nama_lengkap,
                'status' => $r->status,
                'jenis_kelamin' => $r->jenis_kelamin,
                'tgl_lahir' => $r->tgl_lahir,
                'tgl_masuk' => $r->tgl_masuk,
                'divisi_id' => $r->id_divisi,
                'posisi' => $r->posisi,
                'status' => $r->status,
                'gaji' => 0,
                'pendidikan' => $r->pendidikan,
                'sumber_data' => 'hccp',
                'karyawan_id_dari_api' => 0,
                'keterangan' => '',
                'admin' => auth()->user()->name,
            ]);

            $pegawai->hasilWawancara()->update([
                'nama' => $r->nama_lengkap,
                'nik' => $r->nik,
                'tgl_lahir' => $r->tgl_lahir,
                'jenis_kelamin' => $r->jenis_kelamin,
                'id_divisi' => $r->id_divisi,
                'kesimpulan' => $r->kesimpulan,
                'keputusan' => 'dilanjutkan',
                'tgl_masuk' => $r->tgl_masuk,
            ]);

            $pegawai->penilaianKaryawan()->update([
                'periode' => $r->periode,
                'pendidikan_standar' => $r->pendidikan_standar,
                'pendidikan_hasil' => $r->pendidikan_hasil,
                'pengalaman_standar' => $r->pengalaman_standar,
                'pengalaman_hasil' => $r->pengalaman_hasil,
                'pelatihan_standar' => $r->pelatihan_standar,
                'pelatihan_hasil' => $r->pelatihan_hasil,
                'keterampilan_standar' => $r->keterampilan_standar,
                'keterampilan_hasil' => $r->keterampilan_hasil,
                'kompetensi_inti_standar' => $r->kompetensi_inti_standar,
                'kompetensi_inti_hasil' => $r->kompetensi_inti_hasil
            ]);

            DB::commit();
            return redirect()->route('hrga1.2.index')->with('sukses', 'Data berhasil disimpan');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }

        return redirect()->route('hrga1.2.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $checkedValues = explode(',', $r->checked);
        $datas = DataPegawai::with('divisi')->whereIn('id', $checkedValues)->get();

        $data = [
            'title' => 'HASIL WAWANCARA KARYAWAN',
            'dok' => 'Dok.No.: FRM.HRGA.01.02, Rev.00',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga2_hasil_wawancara.print', $data);
    }
}
