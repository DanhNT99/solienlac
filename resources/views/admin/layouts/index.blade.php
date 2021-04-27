<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <title>Document</title>
</head>
<body>
    @include('admin/layouts/header')
    @include('admin/layouts/tab')
    <div class="adminContent">
        @yield('adminContent')
    </div>
    @if (Session::has('noti'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif

    <script src = "{{asset('assets/js/script.js')}}"></script>
    <script src = "{{asset('assets/js/admin.js')}}"></script>
</body>
</html>