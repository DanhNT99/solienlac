<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use Illuminate\Support\Facades\Hash;
use Auth;
class LoginController extends Controller
{
    //
    public function index() {
        return view('login.index');
    }
    
    public function handleLogin(Request $request) {
        $request->validate([
            'tenTaiKhoan' => 'required|min:10|max:11',
            'matKhau' => 'required',
          ],[
              'tenTaiKhoan.required' => "Bạn chưa nhập số điện thoại",
              'tenTaiKhoan.min' => "Số điện thoại phải từ 10 đến 11 ký tự",
              'tenTaiKhoan.max' => "Số điện thoại phải từ 10 đến 11 ký tự",
              'matKhau.required' => "Bạn chưa nhập mật khẩu",
          ]);
          $data = GiaoVien::where('TaiKhoan', $request->tenTaiKhoan)->get();
          $flag = Hash::check($request->matKhau, $data[0]->MatKhau);
          if($flag) {
              $request->session()->put('LoginUser', $request->tenTaiKhoan);
              return redirect('admin/index')->with('noti','Đăng nhập thành công');
          }
          else {
              return redirect()->back()->with('error','Tài khoan hoặc mật khẩu không đúng');
          }
    }

    public function handleLogout(Request $request) {
        $request->session()->forget('LoginUser');
        return redirect('login/index');
    }
}
