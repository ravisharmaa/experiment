<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Javra System Monitoring Tool</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body>
<div id="app">
    <div id="wrapper">
        <!-- Navigation -->
        @include('partials.nav')
        <!-- Navigation -->
        <div id="page-wrapper">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{mix('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
