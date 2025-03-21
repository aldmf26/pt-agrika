<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    {{-- ttd     --}}
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">



    <style>
        * {
            font-family: Arial, sans-serif;
        }

        .kbw-signature {
            width: 100%;
            height: 100px;
        }

        [data-signature] canvas {
            width: 100% !important;
            height: auto;
        }
    </style>
    <style type="text/tailwindcss">
        @theme {
            --color-primary: #D9D9D9;
            --color-secondary: #BFBFBF;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans text-gray-900 antialiased p-5">
    <headerWeb class="sm:block hidden">
        <div class=" flex justify-between items-center">
            <img width="100" src="{{ asset('img/logo.jpeg') }}" alt="">
            <div class="text-center">
                <h6 class="lg:text-3xl sm:text-sm font-bold">VISITOR HEALTH MONITORING FORM </h6>
                <h6 class="lg:text-2xl sm:text-sm text-secondary font-bold">FORMULIR PEMANTAUAN KESEHATAN PENGUNJUNG
                </h6>
            </div>
            <div class="text-end font-bold">
                <h6 class="lg:text-xl sm:text-md">FORM</h6>
                <h6 class="lg:text-sm sm:text-xs">VISITOR HEALTH MONITORING</h6>
                <h6 class="lg:text-sm sm:text-xs">FRM.HRGA.10.01</h6>
            </div>
        </div>
    </headerWeb>

    <headerMobile class="sm:hidden block">
        <img class="mx-auto" width="100" src="{{ asset('img/logo.jpeg') }}" alt="">
        <div class="text-center">
            <h6 class="text-sm font-bold">VISITOR HEALTH MONITORING FORM </h6>
            <h6 class="text-sm text-secondary font-bold">FORMULIR PEMANTAUAN KESEHATAN PENGUNJUNG</h6>
        </div>
    </headerMobile>


    <div>
        <img width="150" class="mt-2 float-end" src="{{ asset('img/dilarang.jpeg') }}" alt="">
    </div>
    <br><br>

    <div>
        {{ $slot }}
    </div>

    @include('layouts.template.signatureJS')
    @livewireScripts

</body>

</html>
