<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <title>Trang chủ</title>
    <style>
        .adminTab {
            padding: 10px;
        }
    </style>
</head>
<body>
    @include('admin/layouts/header')
    <div class="container pt-2">
        <div class="adminBoxTitle py-1 px-2" style="width: fit-content;">
            <div>
                <span>Năm học : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</span>
                <span class="mx-2">|</span>
                <span>

                    @foreach ($nienkhoa->HocKy as $item)
                        @if ($item->TrangThai) {{$item->TenHK}}@endif
                     @endforeach
                </span>
                @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                <span class="mx-2">|</span>
                <span>
                    Lớp: {{Auth::guard('giao_vien')->user()->Lop->TenLop}}
                </span>
                @endif
            </div>
        </div>
    </div>
    @include ('admin/layouts/tab')
    @if (Session::has('noti'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
    {{-- @include('admin/layouts/footer') --}}

    
    <script src = "{{asset('assets/js/jquery.js')}}"></script>
    <script src = "{{asset('assets/js/admin.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.adminMainTab').slideDown(0);
        });
    </script>
</body>
</html>