<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <title>Đăng nhập</title>
</head>
<body>

    <section class="wrapLogin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="wrapLoginTitle mt-2 mb-3">Sổ liên lạc</h1>
                    <div class="wrapLogin_ContainsForm">

                        <form action="{{route('handleLogin')}}" method="post" class="wrapLogin_Form" id="formLogin">
                            @csrf
                            <div class="wrapLogin_formContainsImg">
                                <img src="{{asset('assets/images/logo.png')}}" class="wrapLogin_img" alt="">
                                <h3 class="wrapLogin_formTitle">Đăng nhập hệ thống</h3>
                            </div>
                           <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Số điện thoại</p>
                                <input type="text" name="TaiKhoan" value = "{{old('TaiKhoan')}}" placeholder="Nhập vào số điện thoại..." class="wrapLogin_formInput">
                                @if ($errors->has('TaiKhoan')) 
                                    <div class="notiFail" role="alert">
                                       {{$errors->first('TaiKhoan')}}
                                    </div>
                                @endif
                           </div>
                            <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Mật khẩu</p>
                                <input type="password" name="MatKhau" valuevalue = "{{old('MatKhau')}}" placeholder="Nhập vào mật khẩu..." class="wrapLogin_formInput">
                                <span class="showPass">
                                    <i class="far fa-eye showEyes"></i>
                                    <i class="fas fa-eye-slash hideEyes"></i>
                                </span>
                                @if ($errors->has('MatKhau')) 
                                <div class="notiFail" role="alert">
                                   {{$errors->first('MatKhau')}}
                                </div>
                            @endif
                            </div>
                            <div class="wrapLogin__formGroup">
                                <a href="resetPass" class="wrapLogin__formLink" title="Quên mật khẩu">Quên mật khẩu?</a>
                            </div>
                            <div class="wrapLogin__ContainsBtn">
                                <button type="submit" class="wrapLogin_formBtn">Đăng nhập</button>
                            </div>
                        </form>
                        @if (Session::has('error'))
                              <div class="notiBox">
                                <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
                                <p class="notiBoxContent"> {{Session('error')}}!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/login.js')}}"></script>
</body>
</html>