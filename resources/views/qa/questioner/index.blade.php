<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <ul class="nav nav-pills float-start">

                    @php
                        $url = 'qa.questioner.index';
                    @endphp
                    <li class="nav-item">
                        <a wire:navigate class="nav-link  {{ $kategori == 'questioner' ? 'active' : '' }}"
                            aria-current="page" href="{{ route($url, ['kategori' => 'questioner']) }}">Questioner</a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate class="nav-link {{ $kategori == 'survey' ? 'active' : '' }}" aria-current="page"
                            href="{{ route($url, ['kategori' => 'survey']) }}">Survey</a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate class="nav-link {{ $kategori == 'final' ? 'active' : '' }}" aria-current="page"
                            href="{{ route($url, ['kategori' => 'final']) }}">Final
                            Report</a>
                    </li>

                </ul>
           
            </div>
        </div>
        <div class="card-body">
            @php
                $sheet = [
                    'questioner' => '1',
                    'survey' => '2',
                    'final' => '3',
                ];
                $no_sheet = $sheet[$kategori] ?? '1';
            @endphp
            @include('qa.questioner.' . $no_sheet)
        </div>

    </div>
</x-app-layout>
