<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ Vite::asset('resources/js/assets/logo/logo.png') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ Vite::asset('resources/js/assets/logo/logo.png') }}" type="image/x-icon">

        <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Recursive:wght@400;500;600;700;800;900&display=swap"
            rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/font-awesome.css') }}">

        <!--Slick slider css-->
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/slick-theme.css') }}">

        <!-- Animate icon -->
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/animate.css') }}">

        <!-- Themify icon -->
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/themify-icons.css') }}">

        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/bootstrap.css') }}">

        <!-- Theme css -->
        <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/style.css') }}">

        @vite('resources/css/override-style.scss')
    </head>
    <body>
        @include('components.header')
    </body>
</html>
