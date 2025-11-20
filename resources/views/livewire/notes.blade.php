<div class="ms-2">
    <a data-bs-toggle="modal" href="#notes" class="btn btn-outline-primary btn-sm">Cari Menu</a>
    <x-modal id="notes" title="Note's" btnSave="T" size="modal-lg" wire:ignore.self>
        @livewire('dashboard.search')

        {{-- Tambah Catatan --}}
        {{-- <div class="mb-3 d-flex ">
            <input type="text" wire:model.defer="newNote" class="form-control" placeholder="Tulis catatan baru...">
            <button wire:click="saveNote" class="btn btn-sm btn-primary ms-2 float-end">Tambah</button>
        </div>
        <div wire:loading class="mt-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div> --}}


        {{-- List Notes --}}
        {{-- <table class="table table-striped table-bordered table-dark">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td style="text-align:left">
                            @if ($editNoteId === $note['id'])
                                <input type="text" wire:model.defer="editNoteText" class="form-control">
                            @else
                                {{ $note['text'] }}
                            @endif
                        </td>
                        <td>
                            @if ($editNoteId === $note['id'])
                                <button wire:click="updateNote" class="btn btn-sm btn-primary me-1">Simpan</button>
                                <button wire:click="$set('editNoteId', null)"
                                    class="btn btn-sm btn-secondary">Batal</button>
                            @else
                                <button wire:click="edit({{ $note['id'] }})"
                                    class="btn btn-sm btn-info me-1">Edit</button>
                                <button wire:click="deleteNote({{ $note['id'] }})"
                                    class="btn btn-sm btn-danger">Hapus</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </x-modal>
</div>
