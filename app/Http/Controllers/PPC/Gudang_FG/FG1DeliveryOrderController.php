<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use App\Models\DetailSuratJalan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FG1DeliveryOrderController extends Controller
{
    public function index()
    {
        // $suratJalans = SuratJalan::with(['pelanggan', 'detailSuratJalan'])->latest()->get();

        $delivery = Http::get("https://sarang.ptagafood.com/api/apihasap/delivery");
        $delivery = json_decode($delivery, TRUE);
        $data = [
            'title' => 'Delivery Order',
            'delivery' => $delivery['data']
        ];

        return view('ppc.gudang_fg.delivery_order.index', $data);
    }

    // public function create()
    // {
    //     $profil = DB::table('profil_perusahaan')->first();
    //     $produks = Produk::latest()->get();
    //     $pelanggans = Pelanggan::latest()->get();
    //     $no_order = SuratJalan::max('nomor_order') + 1;
    //     $data = [
    //         'title' => 'Tambah Delivery Order',
    //         'profil' => $profil,
    //         'produks' => $produks,
    //         'no_order' => $no_order,
    //         'pelanggans' => $pelanggans,
    //     ];

    //     return view('ppc.gudang_fg.delivery_order.create', $data);
    // }

    // public function store(Request $r)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $surat_jalan = SuratJalan::create([
    //             'nomor_order' => $r->no_order,
    //             'tanggal_order' => $r->tgl,
    //             'id_pelanggan' => $r->id_pelanggan,
    //             'nomor_kendaraan' => $r->no_kendaraan,
    //             'nama_supir' => $r->supir,
    //             'dibuat_oleh' => auth()->user()->name,
    //             'disetujui_oleh' => $r->disetujui_oleh,
    //             'pengirim' => $r->pengirim,
    //             'keterangan' => $r->keterangan,
    //         ]);
    //         for ($i=0; $i < count($r->produk); $i++) { 
    //             DetailSuratJalan::create([
    //                 'id_surat_jalan' => $surat_jalan->id,
    //                 'id_produk' => $r->produk[$i],
    //                 'jumlah' => $r->jumlah[$i],
    //                 'perlu_coa' => $r->perlu_coa[$i],
    //                 'catatan' => $r->catatan[$i],
    //             ]);
    //         }
    //         DB::commit();
    //         return redirect()->route('ppc.gudang-fg.1.index')->with('sukses', 'Delivery Order Berhasil Ditambahkan');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('ppc.gudang-fg.1.create')->with('error', $e->getMessage());
    //     }

    // }

    public function print(Request $r)
    {
        $profil = DB::table('profil_perusahaan')->first();
        // $datas = SuratJalan::with(['pelanggan', 'detailSuratJalan.produk'])->where('nomor_order', $no_order)->first();
        $delivery = Http::get("https://sarang.ptagafood.com/api/apihasap/delivery_detail?no_nota=$r->no_nota");
        $delivery = json_decode($delivery, TRUE);
        $data = [
            'title' => 'Delivery Order',
            'dok' => 'Dok.No.: FRM.WHS.03.03, Rev.00',
            // 'datas' => $datas,
            'profil' => $profil,
            'tgl' => $r->tgl,
            'delivery' => $delivery['data'],
            'no_nota' => $r->no_nota,

        ];

        return view('ppc.gudang_fg.delivery_order.print', $data);
    }
}
