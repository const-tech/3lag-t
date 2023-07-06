<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title',setting()->site_name)</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.rtl.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/all.min.css') }}" />
    <!-- Main Faile Css  -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/main.css') }}" />
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
