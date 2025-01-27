<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a target="_blank" class="btn btn-sm btn-primary float-end" href="{{ route('hrga7.3.print') }}"><i class="fas fa-print"></i> Cetak</a>
        </div>
        <div class="col-12">
            @livewire('hrga7.identifikasi-limbah')
        </div>
    </div>
</x-app-layout>