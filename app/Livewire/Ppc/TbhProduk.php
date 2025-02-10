<?php

namespace App\Livewire\Ppc;
use App\Models\Produk;

use Livewire\Component;

class TbhProduk extends Component
{
    public $forms = [];


    public function store()
    {
        Produk::create([
            'nama_produk' => $this->forms['nm_produk'],
            'satuan' => $this->forms['satuan'],
            'kode_produk' => $this->forms['kode']
        ]);

        $this->forms = [];

        $this->dispatch('refreshDatatable');
    }


    public function render()
    {
        $produks = Produk::latest()->get();
        $data = [
            'produks' => $produks
        ];
        return view('livewire.ppc.tbh-produk',$data);
    }
}
