<div class="mb-3">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <label class="form-label">Pilih Folder</label>
    <div class="input-group">
        <select class="form-control" wire:model.live="selectedFolder" id="folderSelect">
            <option value="">📁 Root / Tidak ada folder</option>
            @foreach ($folders as $folder)
                @if (!empty(trim($folder)))
                    <option value="{{ $folder }}">📁 {{ $folder }}</option>
                @endif
            @endforeach
        </select>
        <button class="btn btn-outline-success" type="button" wire:click="toggleCreateForm" title="Buat folder baru">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    {{-- Create Folder Form --}}
    @if ($showCreateForm)
        <div class="mt-2" style="display: flex; gap: 8px; align-items: flex-start;">
            <input type="text" class="form-control" wire:model="newFolderName"
                placeholder="Nama folder (SOP, Laporan, dll)" wire:keydown.enter="createFolder"
                wire:keydown.escape="toggleCreateForm" autofocus>
            <button class="btn btn-success btn-sm" type="button" wire:click="createFolder"
                style="white-space: nowrap;">
                <i class="fas fa-check"></i> Buat
            </button>
            <button class="btn btn-secondary btn-sm" type="button" wire:click="toggleCreateForm"
                style="white-space: nowrap;">
                <i class="fas fa-times"></i> Batal
            </button>
        </div>
        @error('newFolderName')
            <small class="text-danger d-block mt-2">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
            </small>
        @enderror
    @endif
</div>

<script>
    document.addEventListener('livewire:updated', function() {
        // Update hidden input dengan selected folder dari Livewire
        let folderSelect = document.getElementById('folderSelect');
        if (folderSelect) {
            document.getElementById('selectedFolder').value = folderSelect.value;
        }
    });

    // Also update on initial load
    document.addEventListener('DOMContentLoaded', function() {
        let folderSelect = document.getElementById('folderSelect');
        if (folderSelect) {
            document.getElementById('selectedFolder').value = folderSelect.value;
        }
    });
</script>
