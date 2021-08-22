<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}"/>
    <title>Lấy lại mật khẩu</title>
</head>
<body>

    <section class="wrapLogin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="wrapLoginTitle mt-2 mb-3">Sổ liên lạc</h1>
                    <div class="wrapLogin_ContainsForm">
                        <form action="{{route('resetPass')}}" class="wrapLogin_Form" method  = "post">
                            @csrf
                            <div class="wrapLogin_formContainsImg">
                                <img src="{{asset('assets/images/logo.png')}}" class="wrapLogin_img" alt="">
                                <h3 class="wrapLogin_formTitle">Khôi phục mật khẩu</h3>
                            </div>
                           <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Số điện thoại</p>
                                <input type="text" name="SoDT" placeholder="Nhập vào số điện thoại" class="wrapLogin_formInput">
                                @if ($errors->has('SoDT')) 
                                    <div class="notiFail" role="alert"> {{$errors->first('SoDT')}} </div>
                                @endif
                           </div>
                           <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Nhập mã</p>
                                <div class="warapLogin_reset">
                                    <i class="fas fa-retweet iconRefresh"></i>
                                    <img src="{{asset('assets/images/resetPassword.jpg')}}" class="imgCode" alt="">
                                    <div class = "rapLogin_formGroup">
                                        <input type="text" name="btnLogin"  class="wrapLogin_formInputRest">
                                        <div class="notiFail notiReset hide" role="alert">ấds</div>
                                    </div>
                                </div>
                           </div>
                            <div class="wrapLogin__ContainsBtn">
                                <button type="submit" name="btnRestPass" class="wrapLogin_formBtn">Khôi phục</button>
                                <a href="login" class="wrapLogin__ContainsBtnLink" title="Quay lại">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    @if (Session::has('error'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('error')}}!</p>
        </div>
     @endif
    </section>
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/login.js')}}"></script>
    <script>
        $(document).ready(function () {
            let arrayCode = {!! json_encode($code)!!}
            let pathImg = 'assets/images/' + arrayCode.path;
            $('.imgCode').attr('src', pathImg).attr('alt', arrayCode.ma);
            $('.wrapLogin_formBtn').click(function (e) { 
                e.preventDefault();
                let inputValueMa = $('.wrapLogin_formInputRest').val();
                let codeImg =  $('.imgCode').attr('alt');
                if(inputValueMa != "") {
                    switch (inputValueMa == codeImg) {
                        case true:
                            $('.wrapLogin_Form').submit();
                            break;
                    
                        case false:
                            $('.notiReset').text('Vui lòng nhập đúng mã').removeClass('hide');
                            break;
                    }
                }
                else {
                     $('.notiReset').text('Vui lòng nhập mã').removeClass('hide');
                }

            });

        //HANDLE CLICK BTN REFRESH IMG CODE 
        let listCode = {!! json_encode($arrayCode)!!}
        $('.iconRefresh').click(function (e) { 
            e.preventDefault();
            let code = listCode[Math.floor(Math.random() * listCode.length)];
            $('.imgCode').attr('src', 'assets/images/' + code.path );
            $('.imgCode').attr('alt', code.ma);
        });
        //END
        });
    </script>
</body>
</html>