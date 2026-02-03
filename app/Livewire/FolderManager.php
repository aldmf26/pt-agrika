<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FolderManager extends Component
{
    public $kategori;
    public $folders = [];
    public $selectedFolder = '';
    public $newFolderName = '';
    public $showCreateForm = false;

    public function mount($kategori)
    {
        $this->kategori = $kategori;
        $this->loadFolders();
    }

    public function loadFolders()
    {
        $files = DB::table('excel_files')
            ->where('kategori', $this->kategori)
            ->whereNotNull('folder')
            ->distinct()
            ->pluck('folder')
            ->sort()
            ->values()
            ->toArray();

        $this->folders = $files;
    }

    public function toggleCreateForm()
    {
        $this->showCreateForm = !$this->showCreateForm;
        if ($this->showCreateForm) {
            $this->newFolderName = '';
        }
    }

    public function createFolder()
    {
        $this->validate([
            'newFolderName' => 'required|string|min:1|max:50'
        ], [
            'newFolderName.required' => 'Nama folder tidak boleh kosong',
            'newFolderName.max' => 'Nama folder maksimal 50 karakter'
        ]);

        // Check if folder already exists in the list
        if (in_array($this->newFolderName, $this->folders)) {
            $this->addError('newFolderName', 'Folder sudah ada');
            return;
        }

        // Add to folders array immediately (tidak perlu tunggu file diupload)
        $this->folders[] = $this->newFolderName;
        sort($this->folders);

        // Auto-select the newly created folder
        $this->selectedFolder = $this->newFolderName;
        $this->newFolderName = '';
        $this->showCreateForm = false;

        session()->flash('success', '✅ Folder "' . $this->selectedFolder . '" berhasil dibuat!');
    }

    public function render()
    {
        return view('livewire.folder-manager');
    }
}
