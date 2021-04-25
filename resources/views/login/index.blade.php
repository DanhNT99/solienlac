<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <title>Document</title>
</head>
<body>

    <section class="wrapLogin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="wrapLoginTitle">Sổ liên lạc</h1>
                    <p class="wrapLoginSub">Kết nối nhà trường và gia đình học sinh</p>
                    <div class="wrapLogin_ContainsForm">

                        <form action="" method="" class="wrapLogin_Form" id="formLogin">
                            <div class="wrapLogin_formContainsImg">
                                <img src="{{asset('assets/images/logo.png')}}" class="wrapLogin_img" alt="">
                                <h3 class="wrapLogin_formTitle">Đăng nhập hệ thống</h3>
                            </div>
                           <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Số điện thoại</p>
                                <input type="text" name="" placeholder="Nhập vào số điện thoại..." class="wrapLogin_formInput">
                           </div>
                            <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Mật khẩu</p>
                                <input type="text" name="" placeholder="Nhập vào mật khẩu..." class="wrapLogin_formInput">
                            </div>
                            <div class="wrapLogin__formGroup">
                                <a href="#" class="wrapLogin__formLink" title="Quên mật khẩu">Quên mật khẩu?</a>
                            </div>
                            <div class="wrapLogin__ContainsBtn">
                                <button type="submit" class="wrapLogin_formBtn">Đăng nhập</button>
                            </div>
                        </form>


                        <form action="" class="wrapLogin_Form" id="formRestPass">

                            <div class="wrapLogin_formContainsImg">
                                <img src="{{asset('assets/images/logo.png')}}" class="wrapLogin_img" alt="">
                                <h3 class="wrapLogin_formTitle">Khôi phục mật khẩu</h3>
                            </div>
                           <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Số điện thoại</p>
                                <input type="text" name="" placeholder="Nhập vào số điện thoại..." class="wrapLogin_formInput">
                           </div>
                           <div class="wrapLogin__formGroup">
                                <p class="wrapLogin_formTitleInput">Nhập mã</p>
                                <div class="warapLogin_reset">
                                    <img src="{{asset('assets/images/resetPassword.jpg')}}" alt="">
                                    <input type="text" name="btnLogin"  class="wrapLogin_formInputRest">
                                    <p class="wrapLogin_formRestText">Hệ thống sẽ cấp lại mật khẩu cho phụ huynh qua số điện thoại</p>
                                </div>
                           </div>
                            <div class="wrapLogin__ContainsBtn">
                                <button type="submit" name="btnRestPass" class="wrapLogin_formBtn">Khôi phục</button>
                                <a href="#" class="wrapLogin__ContainsBtnLink" title="Quay lại">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/login.js')}}"></script>
</body>
</html>