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


    {{-- ttd     --}}
    {{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
 --}}

    <script type="text/javascript" src="{{ asset('assets') }}/tamu/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/tamu/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/tamu/jquery.signature.js"></script>
    <link rel="stylesheet" href="{{ asset('assets') }}/tamu/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/tamu/jquery.signature.css">



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

        @layer components {
            .form-control {
                @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5;
            }

            .form-check {
                @apply w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600;
            }

            .btn {
                @apply px-2 py-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800;
            }

            .btn-submit {
                @apply w-full mt-5 px-3 py-2 text-xs font-medium text-center text-white bg-green-300 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800;
            }

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
