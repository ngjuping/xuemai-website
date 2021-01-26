<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '管理员后台') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Bootstrap, tailwind, font awesome -->
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app2.css') }}">

        <!-- font awesome for markdown editor -->
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css" rel="stylesheet">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Mount point for vue -->
            <div id="app">
                <admin></admin>
            </div>
        </div>

        <!-- Mounting code -->
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
