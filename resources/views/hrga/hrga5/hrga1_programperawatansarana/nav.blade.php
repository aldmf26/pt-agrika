<ul class="nav nav-pills float-start">

    <li class="nav-item">
        <a class="nav-link  {{ $kategori == 'ruangan' ? 'active' : '' }}" aria-current="page"
            href="{{ route($url, ['kategori' => 'ruangan']) }}">Ruangan</a>

    </li>
    <li class="nav-item">
        <a class="nav-link  {{ $kategori == 'ac' ? 'active' : '' }}" aria-current="page"
            href="{{ route($url, ['kategori' => 'ac']) }}">AC</a>

    </li>

</ul>
