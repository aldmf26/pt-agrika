<x-app-layout :title="$title">
    <div class="mt-3" style="width: 50%">
        <h6 class="text-sm text-mute">1 tahun sekali audit dilaksanakan </h6>
    </div>
    <div x-data="{ showLivewire: false }">
        <div class="d-flex flex-column align-items-center">

            {{-- <img x-show="!showLivewire" width="250" src="{{ asset('assets/img/audit.jpg') }}" alt=""> --}}
            <div x-show="!showLivewire">
            </div>
        </div>
        @livewire('audit-wizard')
    </div>
</x-app-layout>
