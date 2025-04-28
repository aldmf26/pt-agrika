<x-app-layout :title="$title">
    <div x-data="{ showLivewire: false }">
        <div class="d-flex flex-column align-items-center">
            <h5 class="fw-bold text-success">Audit : {{ strtoupper(request()->departemen) }} {{ $bulan->nm_bulan }}
                {{ request()->tahun }}</h5>
            {{-- <img x-show="!showLivewire" width="250" src="{{ asset('assets/img/audit.jpg') }}" alt=""> --}}
            <div x-show="!showLivewire">
            </div>
        </div>
        @livewire('audit-wizard')
    </div>
</x-app-layout>
