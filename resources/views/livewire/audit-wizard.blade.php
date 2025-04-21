<div>

    <button type="button" class="btn btn-sm btn-info">
        Halaman : <span class="text-dark badge bg-transparent">{{ $h }}</span>
    </button>
    <div wire:loading class="spinner-border spinner-border-sm text-info" role="status">
    </div>
    <h4>Audit Wizard</h4>

    @if ($h > 1)
        <a href="#" class="btn btn-sm btn-primary" wire:click="step('kembali')">Kembali</a>
    @endif
    <a href="#" class="btn btn-sm btn-primary" wire:click="step('lanjut')">Lanjut</a>
</div>
