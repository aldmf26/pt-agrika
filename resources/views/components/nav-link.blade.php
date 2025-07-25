@php
    $k = request()->get('kategori') ?? 'barang';
@endphp
@props(['route' => 'ppc.gudang-rm.5.index'])
<ul class="nav nav-pills float-start">
    @foreach (jenisProduk() as $key => $value)
        <li class="nav-item">
            <a wire:navigate class="nav-link  {{ $k == $key ? 'active' : '' }}" aria-current="page"
                href="{{ route($route, ['kategori' => $key]) }}">{{ $value }}</a>
        </li>
    @endforeach

</ul>
