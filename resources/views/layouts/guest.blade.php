<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SUPER ADMIN DINKES') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- ❗ OPSI 2: TANPA VITE -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fallback STYLE (biar aman kalau css kosong) -->
    <style>
        body {
            font-family: Figtree, sans-serif;
            background: #e8f5e9;
            margin: 0;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .bg-gray-100 {
            background: #e8f5e9;
        }

        .bg-white {
            background: #ffffff;
        }

        .shadow-md {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .rounded-lg {
            border-radius: 12px;
        }

        .w-full {
            width: 100%;
        }

        .sm\:max-w-md {
            max-width: 420px;
        }

        .px-6 {
            padding-left: 24px;
            padding-right: 24px;
        }

        .py-4 {
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .mt-6 {
            margin-top: 24px;
        }

        .pt-6 {
            padding-top: 24px;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <!-- LOGO -->
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <!-- CONTAINER FORM -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            {{ $slot }}

        </div>

    </div>

</body>
</html>