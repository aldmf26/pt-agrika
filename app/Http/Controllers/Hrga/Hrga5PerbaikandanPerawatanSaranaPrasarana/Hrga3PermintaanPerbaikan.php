<?php

namespace App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana;

use App\Http\Controllers\Controller;
use App\Models\ItemPerawatan;
use App\Models\LokasiModel;
use App\Models\PermintaanPerbaikanSaranaPrasana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PgSql\Lob;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class Hrga3PermintaanPerbaikan extends Controller
{
    public function index(Request $r)
    {
        $kategori = empty($r->kategori) ? 'ruangan' : $r->kategori;
        $data = [
            'title' => 'Permintaan Perbaikan Sarana dan Prasarana Umum',
            'permintaan' => PermintaanPerbaikanSaranaPrasana::whereHas('item', function ($query) use ($kategori) {
                $query->where('jenis_item', $kategori);
            })->orderBy('invoice_pengajuan', 'desc')->get(),
            'kategori' => $kategori,
        ];
        return view('hrga.hrga5.hrga3_permintaanperbaikan.index', $data);
    }

    public function formPermintaanperbaikan(Request $r)
    {
        $data = [
            'title' => 'Form Permintaan Perbaikan Sarana dan Prasarana Umum',
            'lokasi' => LokasiModel::all(),
            'item' => ItemPerawatan::where('jenis_item', $r->kategori)->get(),
            'kategori' => $r->kategori
        ];
        return view('hrga.hrga5.hrga3_permintaanperbaikan.form_permintaanperbaikan', $data);
    }

    public function store(Request $r)
    {

        $max_invoice = PermintaanPerbaikanSaranaPrasana::max('invoice_pengajuan');
        if (empty($max_invoice)) {
            $no_invoice = 10001;
        } else {
            $no_invoice = (int)$max_invoice + 1;
        }

        $data = [
            'item_id' => $r->item_id,
            'invoice_pengajuan' => $no_invoice,
            'diajukan_oleh' => $r->diajukan_oleh,
            'deskripsi_masalah' => $r->deskripsi_masalah,
            'rincian_id' => $r->rincian_id ?? null, // Tambahkan rincian_id jika ada
            'tanggal' => now(),
            'waktu' => now(),
        ];
        PermintaanPerbaikanSaranaPrasana::create($data);

        $item = ItemPerawatan::find($r->item_id);
        $lokasi = $item->lokasi->lokasi . " Lantai (" . $item->lokasi->lantai . ")";
        $rincian = DB::table('rincian_ruangan')
            ->where('id', $r->rincian_id)
            ->first();



        if ($r->hasFile('image')) {
            $image = $r->file('image');
            $imageName = $no_invoice . '.' . $image->getClientOriginalExtension();
            $image->storeAs('perbaikan_sarana', $imageName, 'public'); // Simpan di storage public
        }

        if ($r->kategori == 'ruangan') {

            $response = Http::withHeaders([
                'Authorization' => 'CP4KiwRsHdyskjdbamnn', // Pastikan token ini valid
            ])->post('https://api.fonnte.com/send', [
                'target'  => '628115015154-1613433640@g.us', // Gunakan group_id dari form
                'message' => "Diajukan Oleh : $r->diajukan_oleh\nItem : $rincian->nama_rincian \nLokasi : $lokasi  \nDeskripsi Masalah : $r->deskripsi_masalah\nFoto/Vidio: \nhttps://ptagrikagatyaarum.com/storage/perbaikan_sarana/$imageName",
            ]);
        } else {

            $response = Http::withHeaders([
                'Authorization' => 'CP4KiwRsHdyskjdbamnn', // Pastikan token ini valid
            ])->post('https://api.fonnte.com/send', [
                'target'  => '628115015154-1613433640@g.us', // Gunakan group_id dari form
                'message' => "Diajukan Oleh : $r->diajukan_oleh\nItem : $item->nama_item $item->merek $item->no_identifikasi \nLokasi : $lokasi  \nDeskripsi Masalah : $r->deskripsi_masalah\nFoto/Vidio: \nhttps://ptagrikagatyaarum.com/storage/perbaikan_sarana/$imageName",
            ]);
        }



        return redirect()->route('hrga5.3.index')->with('sukses', 'Permintaan perbaikan berhasil diajukan');
    }
    public function sukses(Request $r)
    {
        $data = [
            'title' => 'Form Permintaan Perbaikan Sarana dan Prasarana Umum',
            'invoice_pengajuan' => $r->invoice_pengajuan,
        ];
        return view('hrga.hrga5.hrga3_permintaanperbaikan.sukses', $data);
    }

    public function print(Request $r)
    {

        $data = [
            'title' => 'PERMINTAAN PERBAIKAN SARANA & PRASARANA UMUM',
            'dok' => 'Dok.No.:FRM.HRGA.05.03, Rev.00',
            'permintaan' => PermintaanPerbaikanSaranaPrasana::where('invoice_pengajuan', $r->invoice_pengajuan)->first(),
        ];
        return view('hrga.hrga5.hrga3_permintaanperbaikan.print', $data);
    }

    public function save_tindakan(Request $r)
    {
        $data = [
            'detail_perbaikan' => $r->detail_perbaikan,
            'verifikasi_user' => $r->verifikasi_user
        ];
        PermintaanPerbaikanSaranaPrasana::where('invoice_pengajuan', $r->invoice_pengajuan)->update($data);
        return redirect()->back()->with('sukses', 'Data berhasil disimpan');
    }

    public function get_rincian(Request $r)
    {
        $item = DB::table('rincian_ruangan')
            ->where('item_id', $r->id)
            ->get();
        echo '<option value="">Pilih Rincian</option>';
        foreach ($item as $key => $value) {
            $nama =  $value->nama_rincian;
            echo '<option value="' . $value->id . '">' . $nama . '</option>';
        }
    }
}
