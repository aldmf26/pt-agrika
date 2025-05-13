<?php

namespace App\Livewire;

use Livewire\Component;

class Select2Rumahwalet extends Component
{
    public $rumahWaletBaru = [
        'nama' => '',
        'alamat' => '',
        'no_reg' => '',
    ];

    public function tambah()
    {

        \App\Models\RumahWalet::create($this->rumahWaletBaru);

        $this->reset('rumahWaletBaru');
        session()->flash('message', 'Rumah Walet berhasil ditambahkan.');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        $data = [
            'rumahWalet' => \App\Models\RumahWalet::all(),
        ];
        return view('livewire.select2-rumahwalet', $data);
    }
}
