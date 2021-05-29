<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use Illuminate\Support\Facades\Hash;
use Auth, Redirect;
class LoginController extends Controller
{
    //
    public function index() {
        return view('login.index');
    }
    
    public function handleLogin(Request $request) {
        $request->validate([
            'TaiKhoan' => 'required|min:10|max:11',
            'MatKhau' => 'required|min:8',
          ],[
              'TaiKhoan.required' => "Bạn chưa nhập số điện thoại",
              'TaiKhoan.min' => "Số điện thoại phải từ 10 đến 11 chữ số",
              'TaiKhoan.max' => "Số điện thoại phải từ 10 đến 11 chữ số",
              'MatKhau.required' => "Bạn chưa nhập mật khẩu",
              'MatKhau.min' => 'Mật khẩu tối thiểu 8 ký tự'
          ]);

        if(Auth::guard('giao_vien')->attempt(array('TaiKhoan'=>$request->TaiKhoan,'password'=>$request->MatKhau)))
            return  Redirect::to('admin/index')->with("noti","Đăng nhập thành công");

        if(Auth::guard('phu_huynh')->attempt(array('TaiKhoan'=>$request->TaiKhoan,'password'=>$request->MatKhau)))
            return  Redirect::to('phuhuynh/index')->with("noti","Đăng nhập thành công");

        return Redirect::to('/login')->withInput()->with("error","Tài khoản hoặc mật khẩu không đúng !");
    }

    public function handleLogout(Request $request) {
      if(Auth::guard('giao_vien')) {
        Auth::guard('giao_vien')->logout();
      }
        Auth::guard('phu_huynh')->logout();
        return redirect('login');
    }
}
