@props(['title'])
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
