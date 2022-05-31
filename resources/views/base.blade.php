<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    {{-- <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet"> --}}
    <link href='https://fonts.googleapis.com/css?family=Material+Icons' rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div id="app">
        {{-- <router-view /> --}}
        <app></app>
    </div>
    @routes
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
