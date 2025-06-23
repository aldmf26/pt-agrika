@php
    $k = request()->get('k');
@endphp
@props(['route' => 'ppc.gudang-rm.5.index'])
<ul class="nav nav-pills float-start">
    <li class="nav-item">
        <a class="nav-link  {{ !$k ? 'active' : '' }}" aria-current="page" href="{{ route($route) }}">Barang & Kemasan</a>
    </li>

    <li class="nav-item">
        <a class="nav-link  {{ $k == 'sbw' ? 'active' : '' }}" aria-current="page"
            href="{{ route($route, ['k' => 'sbw']) }}">SBW</a>
    </li>

</ul>
