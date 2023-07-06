<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', setting()->site_name)</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}" /> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <!-- Main File Css  -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    @if (app()->getLocale() == 'en')
        <!-- Main File Css LTR  -->
        <link rel="stylesheet" href="{{ asset('css/main-ltr.css') }}" />
    @endif

    @livewireStyles
    @stack('css')
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
        rel="stylesheet" />
</head>
