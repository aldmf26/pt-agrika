<?php

namespace App\Livewire\Hrga\Hrga1\Hrga1DataPegawai;

use App\Models\DataPegawai as ModelsDataPegawai;
use App\Services\DataPegawaiService;
use Livewire\Component;
use Livewire\WithPagination;

class DataPegawai extends Component
{

    use WithPagination;
    
    public 
        $search = '',
        $paginate = 10;

    public function mount(DataPegawaiService $dataPegawaiService)
    {
        $link ='sarang';
        try {
            $dataPegawaiService->download("https://{$link}.ptagafood.com/api/data-pegawai");
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        $datas = ModelsDataPegawai::with('divisi')
            ->whereAny(['nama', 'nik', 'posisi'],'LIKE', "%{$this->search}%")
            ->paginate($this->paginate);

        $data = [
            'datas' => $datas
        ];
        return view('livewire.hrga.hrga1.hrga1-data-pegawai.data-pegawai',$data);
    }
}
