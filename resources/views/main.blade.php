<!doctype html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <!-- Bootstrap CSS CDN -->
    <title>Javra System Monitoring Tool</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
    <title>Javra monitoring</title>
</head>
<body>
<!-- For loading spinner -->
<!-- <div class="loadingWrapper">
    <div class="load-spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div> -->
<div class="app-wrapper" id="app">
    <!-- Header panel starts -->
    @include('partials._header')
    <!-- Left side bar -->
    @include('partials._left_sidebar')
    <!-- Left panel content starts -->
    <div class="main-panel">

       <div class="content">
         @yield('content')
       </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<div class="cs-overLay"></div>
@yield('scripts')

</body>
</html>