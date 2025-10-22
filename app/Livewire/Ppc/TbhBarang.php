<?php

namespace App\Livewire\Ppc;

use App\Models\Barang;
use App\Models\KodeBahanBaku;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanKemasanHeader;
use App\Models\Suplier;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TbhBarang extends Component
{
    use WithAlert;

    public $nama_barang = "";
    public $supplierId = "";
    public $satuan = "PCS";
    public $spek = "";
    public $kategori;
    public $pesan = "";
    public $cari;
    public $lot = [];

    public function store()
    {
        $lastBarang = Barang::orderBy('kode_barang', 'DESC')->first();
        $kodeBarang = $lastBarang ? $lastBarang->kode_barang + 1 : 1;
        // $lot = $this->lot;
        // $no_lot = "{$lot['tgl']} {$lot['bulanDanTahun']} {$lot['bulanExpired']} {$lot['tahunExpired']}";
        // $lastBarang = Barang::orderBy('kode_barang', 'DESC')->first();
        // $this->kodeBarang = $lastBarang->kode_barang ?? '';
        Barang::create([
            'nama_barang' => $this->nama_barang,
            'kode_barang' => $kodeBarang,
            'supplier_id' => $this->supplierId,
            'satuan' => $this->satuan,
            'spek' => $this->spek,
            'kategori' => $this->kategori,
            'admin' => auth()->user()->name,
        ]);

        $this->reset(['nama_barang', 'satuan', 'spek']);
        $this->alert('sukses', 'Berhasil menambahkan barang baru');
    }

    public function updateSpek($id, $value)
    {
        $barang = Barang::find($id);
        $barang->spek = $value;
        $barang->save();
        $this->pesan = "berhasil update spek";
        $this->alert('sukses', $this->pesan);
    }

    public function updateBarang($id, $value)
    {
        $barang = Barang::find($id);
        $barang->nama_barang = $value;
        $barang->save();
        $this->pesan = "berhasil update nama barang";
        $this->alert('sukses', $this->pesan);
    }

    public function hapus($id)
    {
        try {
            DB::beginTransaction();
            $barang = Barang::find($id);
            if ($barang && !$barang->penerimaanHeader && !$barang->penerimaanKemasanHeader) {
                $barang->delete();
                $this->alert('sukses', 'Data berhasil dihapus');
            } else {
                $this->pesan = "Data tidak dapat dihapus karena memiliki relasi dengan penerimaan";
                $this->alert('error', $this->pesan);
            }
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            $this->pesan = $th->getMessage();
        }


    }

    public function render()
    {
        $produks = Barang::with('supplier')
            ->where('kategori', $this->kategori)
            ->when($this->cari, function ($query) {
                $query->where('nama_barang', 'like', '%' . $this->cari . '%');
            })
            ->orderBy('kode_barang', 'ASC')
            ->get();

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
