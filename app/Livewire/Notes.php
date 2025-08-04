<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Notes extends Component
{
    public $notes = [];
    public $newNote = '';
    public $editNoteId = null;
    public $editNoteText = '';
    public $file = 'notes/notes.json';
    public function mount()
    {
        $this->loadNotes();
    }

    public function loadNotes()
    {
        $this->notes = Storage::exists($this->file) ? json_decode(Storage::get($this->file), true) : [];
    }

    public function saveNote()
    {
        if (trim($this->newNote) === '') return;

        $notes = $this->notes;

        $notes[] = [
            'id' => now()->timestamp, // Unique ID
            'text' => $this->newNote,
        ];

        Storage::put($this->file, json_encode($notes, JSON_PRETTY_PRINT));
        $this->newNote = '';
        $this->loadNotes();
    }

    public function edit($id)
    {
        $note = collect($this->notes)->firstWhere('id', $id);
        $this->editNoteId = $id;
        $this->editNoteText = $note['text'] ?? '';
    }

    public function updateNote()
    {
        $notes = collect($this->notes)->map(function ($note) {
            if ($note['id'] == $this->editNoteId) {
                $note['text'] = $this->editNoteText;
            }
            return $note;
        })->toArray();

        Storage::put($this->file, json_encode($notes, JSON_PRETTY_PRINT));
        $this->editNoteId = null;
        $this->editNoteText = '';
        $this->loadNotes();
    }

    public function deleteNote($id)
    {
        $notes = collect($this->notes)->reject(fn($note) => $note['id'] == $id)->values()->all();

        Storage::put($this->file, json_encode($notes, JSON_PRETTY_PRINT));
        $this->loadNotes();
    }

    public function render()
    {
        return view('livewire.notes');
    }
}
