@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @include('layouts.template.head')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- <script src="{{asset('assets')}}/static/js/initTheme.js"></script> --}}
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('layouts.template.header')

            <div class="content-wrapper container">

                <div class="page-heading" style="margin-top: -30px">
                    <h4>{{ $title }}</h4>
                </div>
                <div class="page-content" style="margin-top: -30px">
                    {{ $slot }}
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
            </footer>
        </div>
    </div>

    @include('layouts.template.scripts')
</body>

</html>
