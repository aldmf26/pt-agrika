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
        $data = [
            'title' => 'Form Permintaan Perbaikan Mesin',
            'permintaan' => PermintaanPerbaikanMesin::orderBy('id', 'desc')->get(),
        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.index', $data);
    }

    public function formpengajuan(Request $r)
    {
        $data = [
            'title' => 'Form Permintaan Perbaikan Sarana dan Prasarana Umum',
            'mesin' => ItemMesin::all(),
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
        $lokasi = $item->lokasi->lokasi . " Lantai (" . $item->lokasi->lantai . ")";

        if ($r->hasFile('image')) {
            $image = $r->file('image');
            $imageName = $no_invoice . '.' . $image->getClientOriginalExtension();
            $image->storeAs('perbaikan_mesin', $imageName, 'public'); // Simpan di storage public
        }

        $response = Http::withHeaders([
            'Authorization' => 'CP4KiwRsHdyskjdbamnn', // Pastikan token ini valid
        ])->post('https://api.fonnte.com/send', [
            'target'  => '628115015154-1613433640@g.us', // Gunakan group_id dari form
            'message' => "Pelapor : $r->diajukan_oleh\nNama Mesin : $item->nama_mesin $item->merek $item->no_identifikasi \nLokasi : $lokasi  \nDeskripsi Masalah : $r->deskripsi_masalah\nFoto/Vidio: \nhttps://ptagrikagatyaarum.com/storage/perbaikan_mesin/$imageName",
        ]);
        return redirect()->route('hrga8.3.sukses', ['invoice_pengajuan' => $no_invoice]);
    }
    public function sukses(Request $r)
    {
        $data = [
            'title' => 'Form Permintaan Perbaikan Sarana dan Prasarana Umum',
            'invoice_pengajuan' => $r->invoice_pengajuan,
        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.sukses', $data);
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Form Permintaan Perbaikan Sarana dan Prasarana Umum',
            'permintaan' => PermintaanPerbaikanMesin::where('invoice_pengajuan', $r->invoice_pengajuan)->first(),
        ];
        return view('hrga.hrga8.hrga3_permintaan_perbaikan_mesin.print', $data);
    }
}
