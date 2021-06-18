<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/parents.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <title>@yield('title')</title>
</head>
<body class="body">
    @include('admin/layouts/header')
    <div class="adminContent">
        @yield('adminContent')
    </div>
        <div class="boxLoad">
        <div id="spinner"></div>
    </div>

    @if (Session::has('noti'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
    
    <script src = "{{asset('assets/js/main.js')}}"></script>
    <script src = "{{asset('assets/js/admin.js')}}"></script>
    <script src = "{{asset('assets/js/api.js')}}"></script>

</body>
</html>