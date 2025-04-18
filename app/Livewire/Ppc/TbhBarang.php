<?php

namespace App\Livewire\Ppc;

use App\Models\Barang;
use App\Models\KodeBahanBaku;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanKemasanHeader;
use App\Models\Suplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TbhBarang extends Component
{
    public $nama_barang = "";
    public $kodeBarang = "";
    public $supplierId = "";
    public $satuan = "";
    public $kategori;
    public $pesan = "";
    public $lot = [];

    public function store()
    {

        // $lot = $this->lot;
        // $no_lot = "{$lot['tgl']} {$lot['bulanDanTahun']} {$lot['bulanExpired']} {$lot['tahunExpired']}";

        Barang::create([
            'nama_barang' => $this->nama_barang,
            'kode_barang' => $this->kodeBarang,
            'supplier_id' => $this->supplierId,
            'satuan' => $this->satuan,
            'kategori' => $this->kategori,
        ]);

        $this->reset();
    }

    public function hapus($id)
    {
        try {
            DB::beginTransaction();
            $barang = Barang::find($id);
            if ($barang && !$barang->penerimaanHeader && !$barang->penerimaanKemasanHeader) {
                $barang->delete();
            } else {
                $this->pesan = "Data tidak dapat dihapus karena memiliki relasi dengan penerimaan";
            }
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            $this->pesan = $th->getMessage();
        }
    }

    public function render()
    {
        $produks = Barang::where('kategori', $this->kategori)->latest()->get();
        $suplier = Suplier::where('kategori', $this->kategori)->latest()->get();
        $kodes = KodeBahanBaku::latest()->get();
        
        $data = [
            'barangs' => $produks,
            'kodes' => $kodes,
            'supliers' => $suplier
        ];
        return view('livewire.ppc.tbh-barang', $data);
    }
}
