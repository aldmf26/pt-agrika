<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Vendors -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Styles and Script -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            {{-- <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"> --}}
            <h5 class="mt-10 text-sm text-center text-2xl/9 font-bold tracking-tight text-gray-900">PT Agrika Gatya Arum
            </h5>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            {{ $slot }}

            {{-- <p class="mt-10 text-center text-sm/6 text-gray-500">
                Daftar ?
                <a href="{{ route('register') }}"
                    class="font-semibold text-indigo-600 hover:text-indigo-500">Register</a>
            </p> --}}
        </div>
    </div>
</body>

</html>
