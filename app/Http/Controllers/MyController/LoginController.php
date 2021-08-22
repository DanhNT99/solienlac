<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhuHuynh;
use App\Models\GiaoVien;
use Illuminate\Support\Facades\Hash;
use Auth, Redirect, Validator;
class LoginController extends Controller
{
    //
    public function index() {
        return view('login.index');
    }
    
    public function handleLogin(Request $request) {

        $validate = Validator::make($request->all(),
            ['TaiKhoan' => 'bail|required|regex:/^[0-9]*$/|min:10|max:11',
            'MatKhau' => 'required|regex:/^[a-zA-Z0-9]*$/|min:8'],
            ['required' => ":attribute không được để trống",
            'min' => ':attribute tổi thiểu phải từ :min ký tự',
            'max' => ':attribute phải tối đa :max ký tự',
            'regex' =>':attribute là ký tự số',
            'MatKhau.regex' => ':attribute không được chứa ký tự đặc biệt'],
            ['TaiKhoan' => 'Số điện thoại ','MatKhau' => 'Mật khẩu']);

        if($validate->fails()) return redirect()->back()->withInput()->withErrors($validate);

        if(Auth::guard('giao_vien')->attempt(array('SoDT'=>$request->TaiKhoan,'password'=>$request->MatKhau)))
            return  Redirect::to('admin/index')->with("noti","Đăng nhập thành công");

        if(Auth::guard('phu_huynh')->attempt(array('SoDT'=>$request->TaiKhoan,'password'=>$request->MatKhau)))
            return  Redirect::to('phuhuynh/index')->with("noti","Đăng nhập thành công");

        return Redirect::to('/login')->withInput()->with("error","Tài khoản hoặc mật khẩu không đúng");
    }

    public function handleLogout(Request $request) {
      if(Auth::guard('giao_vien')) {
        Auth::guard('giao_vien')->logout();
      }
        Auth::guard('phu_huynh')->logout();
        return redirect('login');
    }
}
