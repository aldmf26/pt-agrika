@php
    $rot = request()->route()->getName();
    $k = request()->get('k');
@endphp
<ul class="nav nav-pills float-start">
    <li class="nav-item">
        <a class="nav-link  {{ !$k ? 'active' : '' }}" aria-current="page"
            href="{{ route('ppc.gudang-rm.5.index') }}">Barang & Kemasan</a>
    </li>

    <li class="nav-item">
        <a class="nav-link  {{ $k == 'sbw' ? 'active' : '' }}" aria-current="page"
            href="{{ route('ppc.gudang-rm.5.index', ['k' => 'sbw']) }}">SBW</a>
    </li>

</ul>
