<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use App\Models\ItemMesin;
use App\Models\PermintaanPerbaikanMesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Hrga3PermintaanPerbaikanMesin extends Controller
{
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'mesin';
        $title = $kategori == 'mesin' ? 'Permintaan Perbaikan Mesin dan Peralatan' : 'Permintaan Perbaikan Software dan Hardware';
        $data = [
            'title' => $title,
            'permintaan' => PermintaanPerbaikanMesin::whereHas('item_mesin', function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            })->orderBy('id', 'desc')->get(),
            'kategori' => $kategori,
        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.index', $data);
    }

    public function formpengajuan(Request $r)
    {
        $kategori = $r->kategori ?? 'mesin';
        $title = $kategori == 'mesin' ? 'Form Permintaan Perbaikan Mesin' : 'Form Permintaan Perbaikan Software dan Hardware';
        $data = [
            'title' => $title,
            'mesin' => ItemMesin::where('kategori', $kategori)->get(),
            'kategori' => $kategori,
        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.pengajuan', $data);
    }

    public function store(Request $r)
    {
        $max_invoice = PermintaanPerbaikanMesin::max('invoice_pengajuan');


        if (empty($max_invoice)) {
            $no_invoice = 10001;
        } else {
            $no_invoice = (int)$max_invoice + 1;
        }

        $data = [
            'item_mesins_id' => $r->item_id,
            'invoice_pengajuan' => $no_invoice,
            'diajukan_oleh' => $r->diajukan_oleh,
            'deskripsi_masalah' => $r->deskripsi_masalah,
            'deadline' => $r->deadline,
            'tanggal' => now(),
            'waktu' => now(),
        ];
        PermintaanPerbaikanMesin::create($data);

        $item = ItemMesin::find($r->item_id);
        $lokasi = empty($item->lokasi->lokasi) ? '-' : $item->lokasi->lokasi . " Lantai (" . $item->lokasi->lantai . ")";

        if ($r->hasFile('image')) {
            $image = $r->file('image');
            $imageName = $no_invoice . '.' . $image->getClientOriginalExtension();
            $image->storeAs('perbaikan_mesin', $imageName, 'public'); // Simpan di storage public
        }

        $response = Http::withHeaders([
            'Authorization' => 'CP4KiwRsHdyskjdbamnn', // Pastikan token ini valid
        ])->post('https://api.fonnte.com/send', [
            'target'  => '6282351837448-1536203517@g.us', // Gunakan group_id dari form
            'message' => "Pelapor : $r->diajukan_oleh\nNama Item : $item->nama_mesin $item->merek $item->no_identifikasi \nLokasi : $lokasi  \nDeskripsi Masalah : $r->deskripsi_masalah\nFoto/Vidio: \nhttps://ptagrikagatyaarum.com/storage/perbaikan_mesin/$imageName",
        ]);
        return redirect()->route('hrga8.3.sukses', ['invoice_pengajuan' => $no_invoice, 'kategori' => $r->kategori])->with('sukses', 'Pengajuan Berhasil dikirim');
    }
    public function sukses(Request $r)
    {
        $data = [
            'title' => 'Form Permintaan Perbaikan Sarana dan Prasarana Umum',
            'invoice_pengajuan' => $r->invoice_pengajuan,
            'kategori' => $r->kategori ?? 'mesin',

        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.sukses', $data);
    }

    public function print(Request $r)
    {
        $kategori = $r->kategori ?? 'mesin';
        $title = $kategori == 'mesin' ? 'PERMINTAAN PERBAIKAN MESIN & PERALATAN' : 'PERMINTAAN PERBAIKAN SOFTWARE & HARDWARE PROSES PRODUKSI';
        $dokumen = $kategori == 'mesin' ? 'Dok.No.: FRM.HRGA.08.04, Rev.00' : 'Dok.No.: FRM.IT.01.03, Rev.00';
        $data = [
            'title' => $title,
            'dok' => $dokumen,
            'permintaan' => PermintaanPerbaikanMesin::where('invoice_pengajuan', $r->invoice_pengajuan)->first(),
            'kategori' => $r->kategori ?? 'mesin',
        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.print', $data);
    }

    public function save_tindakan(Request $r)
    {
        $data = [
            'detail_perbaikan' => $r->detail_perbaikan,
            'verifikasi_user' => $r->verifikasi_user
        ];
        PermintaanPerbaikanMesin::where('invoice_pengajuan', $r->invoice_pengajuan)->update($data);
        return redirect()->back()->with('sukses', 'Data berhasil disimpan');
    }
}
