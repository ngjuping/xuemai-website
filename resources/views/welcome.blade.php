<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>学脉BLOG</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap, tailwind, font awesome -->
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app2.css') }}">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body class="antialiased">
<!-- Mount point for vue -->
<div id="app" class="p-4">
    <app></app>
</div>

<!-- Mounting code -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
