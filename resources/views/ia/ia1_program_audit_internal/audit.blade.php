<x-app-layout :title="$title">
    <div x-data="{ showLivewire: false }">
        <div class="d-flex flex-column align-items-center">

            {{-- <img x-show="!showLivewire" width="250" src="{{ asset('assets/img/audit.jpg') }}" alt=""> --}}
            <div x-show="!showLivewire">
            </div>
        </div>
        @livewire('audit-wizard')
    </div>
</x-app-layout>
