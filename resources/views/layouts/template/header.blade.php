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
                use App\Models\Menu;
                $getRouteName = Route::currentRouteName();

                // Ambil menu utama (tanpa parent_id)
                $menus = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
            @endphp

            <ul>

                <li class="menu-item {{ $getRouteName == 'dashboard.index' ? 'active' : '' }}">
                    <a wire:navigate href="{{ route('dashboard.index') }}" class='menu-link'>
                        <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                    </a>
                </li>

                @foreach ($menus as $menu)
                    <li class="menu-item has-sub">
                        <a href="#" class="menu-link">
                            <span><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</span>
                        </a>

                        <div class="submenu" style="font-size: 13px">
                            <div class="submenu-group-wrapper">
                                <ul class="submenu-group">
                                    @foreach ($menu->children as $submenu)
                                        @php
                                            $adaSub = $submenu->children->isEmpty();
                                        @endphp
                                        {{-- jika li ini dihapus tidak ada jarak jauh itu --}}
                                        <li class="submenu-item {{ $adaSub ? '' : 'has-sub' }}">
                                            <a wire:navigate
                                                href="{{ $adaSub ? ($submenu->link == 'tidak' ? route($submenu->link, ['q' => $submenu->title]) : route($submenu->link)) : '#' }}"
                                                class="submenu-link">{{ ucwords(strtolower($submenu->title)) }}
                                            </a>

                                            @if (!$adaSub)
                                                <ul class="subsubmenu">
                                                    @foreach ($submenu->children as $subsubmenu)
                                                        <li class="submenu-item">
                                                            <a wire:navigate
                                                                href="{{ $subsubmenu->link == 'tidak' ? route($subsubmenu->link, ['q' => $submenu->title]) : route($subsubmenu->link) }}"
                                                                class="subsubmenu-link">{{ ucwords(strtolower($subsubmenu->title)) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

</header>
