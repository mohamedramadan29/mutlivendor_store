<!DOCTYPE html>
<html lang="ar">
<head>
    <title>  @yield('title') </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="{{asset('assets/website/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/js/fancybox/source/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/jquery.scrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/mobile-menu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/fonts/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('css')
</head>
<body class="home">
