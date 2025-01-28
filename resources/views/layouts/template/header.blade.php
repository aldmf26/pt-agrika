<header class="mb-5">
    <div class="header-top">
        <div class="container ">
            <div class="logo">
                <a href="index.html">
                    {{-- <img src="" alt="Logo"
                        style="height: 80px !important;"> --}}
                    PT AGRIKA GATYA ARUM
                </a>
            </div>
            <div class="header-top-right">
                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{ asset('assets/compiled/png/icons8-user-48.png') }}" alt="Avatar">
                        </div>
                        <div class="text">
                            <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                            <p class="mb-0 text-sm text-success">{{ ucwords(auth()->user()->roles[0]->name) }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        <li><a class="dropdown-item" href="#">{{ Auth::user()->name }}</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar bg-secondary">
        <div class="container">

            @php
                $getRouteName = Route::currentRouteName();

                $listMenu = collect([
                    [
                        'name' => 'Dashboard',
                        'icon' => 'grid-fill',
                        'route' => 'dashboard',
                    ],
                ]);
            @endphp

            <ul>
                @foreach ($listMenu as $menu)
                    <li class="menu-item {{ $getRouteName == $menu['route'] ? 'active' : '' }}">
                        <a href="{{ route($menu['route']) }}" class='menu-link'>
                            <span><i class="bi bi-{{ $menu['icon'] }}"></i> {{ $menu['name'] }}</span>
                        </a>
                    </li>
                @endforeach

                @php
                    use App\Models\Menu;

                    // Ambil menu utama (tanpa parent_id)
                    $menus = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
                @endphp
                @foreach ($menus as $menu)
                    <li class="menu-item has-sub">
                        <a href="#" class="menu-link">
                            <span><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</span>
                        </a>
                        @if ($menu->children->isNotEmpty())
                            <div class="submenu" style="font-size: 13px">
                                <ul class="submenu-group">
                                    @foreach ($menu->children as $submenu)
                                        <li class="submenu-item has-sub">
                                            <a href="#"
                                                class="submenu-link">{{ ucwords(strtolower($submenu->title)) }}</a>
                                            @if ($submenu->children->isNotEmpty())
                                                <ul class="subsubmenu">
                                                    @foreach ($submenu->children as $subsubmenu)
                                                        <li class="subsubmenu-item">
                                                            <a href="{{ route($subsubmenu->link) }}"
                                                                class="subsubmenu-link">{{ ucwords(strtolower($subsubmenu->title)) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach

                <li
                    class="menu-item {{ in_array($getRouteName, ['user.index', 'role.index']) ? 'active' : '' }} has-sub">
                    <a href="#" class='menu-link'>
                        <span><i class="bi bi-people"></i> Administrator</span>
                    </a>
                    <div class="submenu ">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="{{ route('user.index') }}" class='submenu-link'>Daftar
                                        User</a>
                                    <a href="{{ route('role.index') }}" class='submenu-link'>Role &
                                        Permission</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

</header>
