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
                <div x-data="{ open: false }" @click.outside="open = false">
                    <a @click="open = ! open" href="#" id="topbarUserDropdown"
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
                    <style>
                        .dropdownAldi {
                            position: absolute;
                            z-index: 1000;
                            background-color: #ffffff;
                            border: 1px solid #e0e0e0;
                            border-radius: 8px;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                            min-width: 200px;
                            padding: 10px 0;
                            list-style-type: none;
                            margin: 0;
                        }

                        .dropdownAldi li {
                            padding: 10px 10px;
                        }

                        .dropdownAldi li:hover {
                            background-color: #f5f5f5;
                            cursor: pointer;
                        }

                        .dropdownAldi li a,
                        .dropdownAldi li button {
                            color: #333;
                            text-decoration: none;
                            background: none;
                            border: none;
                            width: 100%;
                            text-align: left;
                            cursor: pointer;
                            font-size: 14px;
                        }

                        .dropdownAldi li a:hover,
                        .dropdownAldi li button:hover {
                            color: #007bff;
                            cursor: pointer;

                        }

                        .dropdownAldi li hr {
                            margin: 2px 0;
                            border: none;
                            border-top: 1px solid #e0e0e0;
                        }
                    </style>
                    <div x-show="open" class="position-absolute">
                        <ul class="dropdownAldi" aria-labelledby="topbarUserDropdown">
                            <a class="" href="#">
                                <li>
                                    {{ Auth::user()->name }}
                                </li>
                            </a>
                            <hr class="">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
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
                        <a wire:navigate href="{{ route($menu['route']) }}" class='menu-link'>
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
                                            <a href="#" class="submenu-link">{{ ucwords(strtolower($submenu->title)) }}</a>
                                            @if ($submenu->children->isNotEmpty())
                                                <ul class="subsubmenu">
                                                    @foreach ($submenu->children as $subsubmenu)
                                                        <li class="subsubmenu-item">
                                                            <a wire:navigate href="{{ route($subsubmenu->link) }}"
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
                                    <a wire:navigate href="{{ route('user.index') }}" class='submenu-link'>Daftar
                                        User</a>
                                    <a wire:navigate href="{{ route('role.index') }}" class='submenu-link'>Role &
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
