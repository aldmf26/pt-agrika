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
            $this->cekPegawai = array_unique(array_merge($this->cekPegawai, $this->currentPageIds));
        } else {
            $this->cekPegawai = array_diff($this->cekPegawai, $this->currentPageIds);
        }
    }


    public function updatingPage()
    {
        $this->selectAll = false;
    }

    public function getPageName()
    {
        return $this->pageName ?? 'page';
    }





    public function sortBy($field)
    {
        $this->sort = $field;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    public function print()
    {
        $query = ModelsDataPegawai::with('divisi')
            ->orderBy('divisi_id', 'asc')
            ->orderBy('tgl_masuk', 'asc');

        if (!empty($this->cekPegawai)) {
            $query->whereIn('id', $this->cekPegawai);
        }

        $dataToPrint = $query->get();
        session()->forget('dataToPrint');
        session()->put('dataToPrint', $dataToPrint);
        return redirect()->route('hrga1.4.print');
    }

    public function render()
    {
        $tanggalBatas = now()->subYears(17)->format('Y-m-d');

        $query = ModelsDataPegawai::with('divisi')
            ->whereAny(['nama', 'nik', 'posisi', 'tgl_masuk'], 'LIKE', "%{$this->search}%")
            ->whereDate('tgl_lahir', '<=', $tanggalBatas)
            ->where('berhenti', 'T'); // hanya yg sudah 17 tahun ke atas

        if ($this->sort && $this->sortDirection) {
            $query->orderBy($this->sort, $this->sortDirection);
        }

        $datas = $query->paginate($this->paginate);

        $this->currentPageIds = $datas->getCollection()->pluck('id')->map(fn($id) => (string)$id)->toArray();

        return view('livewire.hrga.hrga4.hrga4-data-pegawai.data-pegawai', [
            'datas' => $datas
        ]);
    }
}
