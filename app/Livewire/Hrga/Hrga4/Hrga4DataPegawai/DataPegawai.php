<?php

namespace App\Livewire\Hrga\Hrga4\Hrga4DataPegawai;

use App\Models\DataPegawai as ModelsDataPegawai;
use App\Services\DataPegawaiService;
use Livewire\Component;
use Livewire\WithPagination;

class DataPegawai extends Component
{

    use WithPagination;

    public
        $selectAll = false,
        $cekPegawai = [],
        $search = '',
        $sort = 'id',
        $sortDirection = 'desc',
        $paginate = 10;

    public function mount(DataPegawaiService $dataPegawaiService)
    {
        try {
            $dataPegawaiService->download();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->cekPegawai = ModelsDataPegawai::pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->cekPegawai = [];
        }
    }

    public function sortBy($field)
    {
        $this->sort = $field;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    public function print()
    {
        $query = ModelsDataPegawai::with('divisi')
            ->orderBy('tgl_masuk', 'asc');

        if (!empty($this->cekPegawai)) {
            $query->whereIn('id', $this->cekPegawai);
        }

        $dataToPrint = $query->get();
        session()->put('dataToPrint', $dataToPrint);
        return redirect()->route('hrga1.4.print');
    }

    public function render()
    {
        $query = ModelsDataPegawai::with('divisi')
            ->whereAny(['nama', 'nik', 'posisi', 'tgl_masuk'], 'LIKE', "%{$this->search}%");

        // Add sorting
        if ($this->sort && $this->sortDirection) {
            $query->orderBy($this->sort, $this->sortDirection);
        }

        $datas = $query->paginate($this->paginate);
        $data = [
            'datas' => $datas
        ];
        return view('livewire.hrga.hrga4.hrga4-data-pegawai.data-pegawai', $data);
    }
}
