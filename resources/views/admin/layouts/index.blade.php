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
    <script src = "{{asset('assets/js/script.js')}}"></script>
    <script src = "{{asset('assets/js/admin.js')}}"></script>
</body>
</html>