<?php

namespace App\Livewire\Dashboard;

use App\Models\DaftarIndukDokumenInternal;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function updatedSearch()
    {
        // $this->dokumen = DaftarIndukDokumenInternal::where('judul', 'like', '%' . $this->search . '%')
        //     ->orWhere('no_dokumen', 'like', '%' . $this->search . '%')
        //     ->orWhere('pic', 'like', '%' . $this->search . '%')
        //     ->orWhere('tags', 'like', '%' . $this->search . '%')
        //     ->get();
    }

    public function render()
    {
        $dokumen = DaftarIndukDokumenInternal::all();
        if ($this->search) {
            $dokumen = DaftarIndukDokumenInternal::where('judul', 'like', '%' . $this->search . '%')
                ->orWhere('no_dokumen', 'like', '%' . $this->search . '%')
                ->orWhere('pic', 'like', '%' . $this->search . '%')
                ->orWhere('tags', 'like', '%' . $this->search . '%')
                ->get();
        }
        return view('livewire.dashboard.search', [
            'dokumen' => $dokumen,
        ]);
    }
}
