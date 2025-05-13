<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\KodeBahanBaku;
use App\Models\Suplier;
use Livewire\Component;

class Select2Barang extends Component
{
    public $kategori;
    public $barangBaru = [
        'nama_barang' => '',
        'kode_barang' => '',
        'satuan' => '',
        'supplier_id' => '',
    ];

    public function tambah()
    {
        \App\Models\Barang::create([
            'nama_barang' => $this->barangBaru['nama_barang'],
            'kode_barang' => $this->barangBaru['kode_barang'],
            'supplier_id' => $this->barangBaru['supplier_id'],
            'satuan' => $this->barangBaru['satuan'],
            'kategori' => $this->kategori,
        ]);

        $this->reset('barangBaru');
        session()->flash('message', 'Barang berhasil ditambahkan.');
        $this->dispatch('closeModal');
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

        return view('livewire.select2-barang', $data);
    }
}
