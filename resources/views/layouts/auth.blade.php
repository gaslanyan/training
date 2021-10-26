<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ազգային Բժշկական Պալատ') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #login{
            width: 10%;
        }
        .btn-shmz{
            background: -webkit-linear-gradient(
                45deg, #5f1b80, #b233c5);
            border-radius: 360px;
            color: #fff;
            font-size: 20px;
            padding: 0 20px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div id="app">

        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>
</html>
