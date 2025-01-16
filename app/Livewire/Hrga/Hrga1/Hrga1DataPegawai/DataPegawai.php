<?php

namespace App\Livewire\Hrga\Hrga1\Hrga1DataPegawai;

use App\Services\DataPegawaiService;
use Livewire\Component;

class DataPegawai extends Component
{
    public function mount(DataPegawaiService $dataPegawaiService)
    {
        try {
            $dataPegawaiService->download('https://sarang.ptagafood.com/api/data-pegawai');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.hrga.hrga1.hrga1-data-pegawai.data-pegawai');
    }
}
