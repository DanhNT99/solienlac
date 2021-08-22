<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use App\Models\PhuHuynh;
use Illuminate\Support\Facades\Hash;
use Auth, Validator;

class PassController extends Controller
{
    //

    public function index() {
        if(Auth::guard('giao_vien')->user())
            $data['TaiKhoan'] = Auth::guard('giao_vien')->user()->SoDT;
        else 
            $data['TaiKhoan'] = Auth::guard('phu_huynh')->user()->SoDT;
       return view('changePass.index', $data);
    }

    public function handleChangePass(Request $request) {

          $validate = Validator::make($request->all(),
          ['matKhauMoi' => 'bail|required|regex:/^[a-zA-Z0-9]*$/|min:8'],
          ['required' => ":attribute không được để trống",
          'min' => ':attribute tổi thiểu phải từ :min chữ số',
          'regex' =>':attribute không được chưa ký tự đặc biệt'],
          ['matKhauMoi' => 'Mật khẩu mới']);

      if($validate->fails()) return redirect()->back()->withInput()->withErrors($validate);

        $tenTaiKhoan = $request->TenTaiKhoan;
        $data = GiaoVien::where('SoDT',  $tenTaiKhoan)->get();
        $user = GiaoVien::where('SoDT',  $tenTaiKhoan);
        if(!count($data) > 0) {
            $data = PhuHuynh::where('SoDT',  $tenTaiKhoan)->get();
            $user =  PhuHuynh::where('SoDT',  $tenTaiKhoan);
        }

        //check password user enter with pass before? 
        $check = Hash::check($request->matKhauCu, $data[0]->password);
        
        if($check) {
            if($request->matKhauMoi == $request->xacNhanMatKhauMoi) {
                $newPass = bcrypt($request->matKhauMoi);
                $checkUpdate = $user->update(['password' => $newPass]);
               if($checkUpdate && Auth::guard('giao_vien')->user()) 
                    return redirect('admin/index')->with('noti', 'Đổi mật khẩu thành công');
                else 
                return redirect('phuhuynh/index')->with('noti', 'Đổi mật khẩu thành công');
                
            }
            else 
                return redirect()->back()->withInput()->with('failConfirmPass', 'Xác nhận mật khẩu không đúng');
        }
        else 
            return redirect()->back()->withInput()->with('failPass', 'Mật khẩu củ không đúng');
        
    }
}
