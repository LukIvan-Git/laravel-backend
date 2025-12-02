<!doctype html>
<html id="body-text">
<head>
    <meta charset="UTF-8" lang="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <meta name="keywords" content="Resume CV Portfolio">
    <meta name="description" content="Resume CV Portfolio">
    <title>My Page</title>
    <!-- css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">

    <!-- js -->
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@300;500;700&family=Noto+Sans+TC:wght@100..900&family=Noto+Serif+TC:wght@200&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_RECAPTCHA_SITE_KEY')}}"></script>

    @stack('js-header')
</head>
<body id="body">
@include('common.header')

@yield('content')

{{-- @include('common.footer') --}}
<script>


</script>
