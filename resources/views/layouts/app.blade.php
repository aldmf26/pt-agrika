@props(['title', 'size' => 'col-lg-12', 'container' => 'container', 'kategori' => ''])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - AgrikaPOS</title>

    @include('layouts.template.head')
    @livewireStyles
</head>

<body>
    {{-- <script src="{{asset('assets')}}/static/js/initTheme.js"></script> --}}
    <div id="app">
        <div id="main" class="layout-horizontal">
            @if (!Auth::check())
                {{ redirect()->intended(route('login'))->send() }}
            @endif
            @include('layouts.template.header')

            <div class="content-wrapper {{ $container }}">

                <div class="page-heading" style="margin-top: -30px">
                    <i class="fas fa-info float-end " style="cursor: pointer" data-bs-toggle="modal"
                        data-bs-target="#contoh"></i>

                    @if (count(request()->segments()) != 1)
                        <nav aria-label="breadcrumb " style="margin-top: -25px; font-size: 15px;">
                            <ol class="breadcrumb">
                                @foreach (request()->segments() as $i => $d)
                                    @php
                                        $urlSegments = array_slice(request()->segments(), 0, $i + 1);
                                        $url = implode('/', $urlSegments);
                                    @endphp
                                    <li class="breadcrumb-item"><a
                                            href="/{{ $url }}">{{ ucwords(str_replace('_', ' ', $d)) }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    <h5>{{ ucwords(strtolower($title)) }} </h5>

                </div>
                <div class="page-content" style="margin-top: -30px">

                    <x-alert />
                    <div class="row">
                        <div class="{{ $size }}">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <style>
                .modal-xlplus {
                    max-width: 90% !important;
                }
            </style>
            <div class="modal fade" id="contoh" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Contoh Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        @php

                            if (empty($kategori)) {
                                $menu_contoh = DB::table('contoh_image')
                                    ->join('menus', 'menus.id', '=', 'contoh_image.id_menu')
                                    ->where('link', request()->route()->getName())
                                    ->select('contoh_image.*')
                                    ->get();
                            } else {
                                $menu_contoh = DB::table('contoh_image')
                                    ->join('menus', 'menus.id', '=', 'contoh_image.id_menu')
                                    ->where('link', request()->route()->getName())
                                    ->where('judul', $kategori)
                                    ->select('contoh_image.*')
                                    ->get();
                            }

                        @endphp
                        <div class="modal-body">

                            @if (empty($menu_contoh))
                            @else
                                <div class="row">
                                    @foreach ($menu_contoh as $item)
                                        <div class="col-lg-12">
                                            <img src="{{ asset('contoh/' . $item->contoh) }}" alt="Gambar"
                                                class="img-fluid" style="width: 100%;">
                                            <hr style="border: 1px solid black">
                                        </div>
                                    @endforeach
                                </div>


                            @endif

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2025 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="https://ptagrikagatyaarum.com/">Agrika Gatya Arum</a></p>
                        </div>
                    </div>
                </div>
                <!-- Back to Top Button -->
                <button id="backToTopBtn" class="btn btn-primary btn-sm"
                    style="position: fixed; bottom: 30px; right: 30px; display: none; z-index: 99;">
                    <i class="bi bi-arrow-up"></i>
                </button>
            </footer>

            <script>
                // Back to Top Button Functionality
                const backToTopBtn = document.getElementById('backToTopBtn');

                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTopBtn.style.display = 'block';
                    } else {
                        backToTopBtn.style.display = 'none';
                    }
                });

                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            </script>
        </div>
    </div>

    @include('layouts.template.scripts')
    @include('layouts.template.signatureJS')
</body>

</html>
