<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="{{asset('assets/css/changePass.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <title>Đổi mật khẩu</title>
</head>
<body>

    @include('admin/layouts/header')
    <section class="adminList">
        <div class = "container">
            <div class="changePass_Box">
                <div class="adminBoxTitle py-1 px-2">
                    <h6 class = "m-0">   <i class="fas fa-address-card adminBoxTitleIcon"></i> Thông tin tài khoản</h6>
                    <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
                 </div>
                <form action="{{route('handleChangePass')}}" class="changePass_form" method="post">
                    @csrf
                    <h3 class="changePass_title mb-0">Đổi mật khẩu</h3>
                    <table class="changePass_Table">
                        <tr>
                            <td><p class="changePass_tableText">Tên tài khoản</p></td>
                            <td><input type="text" name="TenTaiKhoan" class = "formInput formInputMa" value ="{{$TaiKhoan}}"></td>
                        </tr>
                        <tr>
                            <td><p class="changePass_tableText">Mật khẩu củ</p></td>
                            <td>
                                <input type="password" class="formInput" name = "matKhauCu"  placeholder="Nhập mật khẩu hiện tại">
                                @if (Session::has('failPass'))
                                     <div class="notiFail" role="alert"> {{Session('failPass')}}</div>
                                @endif
                                @if ($errors->has('matKhauCu')) 
                                    <div class="notiFail" role="alert">{{$errors->first('matKhauCu')}}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><p class="changePass_tableText">Mật khẩu mới</p></td>
                            <td>
                                <input type="password" class="formInput newPass" name = "matKhauMoi" placeholder="Nhập mật khẩu mới">              
                                @if ($errors->has('matKhauMoi')) 
                                    <div class="notiFail" role="alert">{{$errors->first('matKhauMoi')}}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><p class="changePass_tableText">Xác nhận mật khẩu</p></td>
                            <td>
                                <input type="password" class="formInput confirmPass" name = "xacNhanMatKhauMoi" placeholder="Xác nhận mật khẩu mới">
                                 @if ($errors->has('xacNhanMatKhauMoi')) 
                                    <div class="notiFail" role="alert">{{$errors->first('xacNhanMatKhauMoi')}}</div>
                                @endif
                                <span><i class="fas fa-check-circle iconConfirmTrue"></i></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class = "text-center">
                                <button type="submit" class="changPass_btn">Xác nhận</button>
                                @if (Auth::guard('giao_vien')->user())
                                    <a href="admin/index" class = "changePass_Link">Quay lại</a>
                                @endif
                                @if (Auth::guard('phu_huynh')->user())
                                    <a href="phuhuynh/index" class="changePass_Link">Quay lại</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                </form>
        </div>
    </section>


    @if (Session::has('changePassSuccess'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('changePassSuccess')}}!</p>
        </div>
    @endif
    <script src = "{{asset('assets/js/jquery.js')}}"></script>
    <script src = "{{asset('assets/js/admin.js')}}"></script>
</body>
</html>