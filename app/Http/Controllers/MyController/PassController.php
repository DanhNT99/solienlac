<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use App\Models\PhuHuynh;
use Illuminate\Support\Facades\Hash;
use Auth;

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

        // $request->validate([
        //     'matKhauCu' => 'required',
        //     'matKhauMoi' => 'required',
        //     'xacNhanMatKhauMoi' => 'required',

        //   ],[
        //       'matKhauCu.required' => "Bạn chưa nhập mật khẩu",
        //       'matKhauMoi.required' => "Bạn chưa nhập mật khẩu mới",
        //       'xacNhanMatKhauMoi.required' => "Bạn chưa nhập xác nhận mật khẩu",
        //   ]);
        $tenTaiKhoan = $request->TenTaiKhoan;
        $data = GiaoVien::where('TaiKhoan',  $tenTaiKhoan)->get();
        $user = GiaoVien::where('TaiKhoan',  $tenTaiKhoan);
        if(!count($data) > 0) {
            $data = PhuHuynh::where('TaiKhoan',  $tenTaiKhoan)->get();
            $user =  PhuHuynh::where('TaiKhoan',  $tenTaiKhoan);
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
