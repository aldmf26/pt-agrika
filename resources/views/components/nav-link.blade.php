@php
    $k = request()->get('kategori');
    $jenisProduks = jenisProduk();
    $jenisProduks = array_filter(
        $jenisProduks,
        function ($value, $key) use ($k) {
            return $k == $key;
        },
        ARRAY_FILTER_USE_BOTH,
    );
@endphp
@props(['route' => 'ppc.gudang-rm.5.index'])
<ul class="nav nav-pills float-start">
    @foreach ($jenisProduks as $key => $value)
        <li class="nav-item">
            <a wire:navigate class="nav-link  {{ $k == $key ? 'active' : '' }}" aria-current="page"
                href="{{ route($route, ['kategori' => $key]) }}">{{ $value }}</a>
        </li>
    @endforeach

</ul>
