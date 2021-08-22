<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhuHuynh;
use Nexmo\Laravel\Facade\Nexmo;

class ResetPassController extends Controller
{
    //
    public function index() {
        $data['arrayCode'] = array(
            ['ma' => 'JQKNF', 'path' => 'resetPassword.jpg'],
            ['ma' => 'AVCTL', 'path' => 'resetPassword1.jpg'],
            ['ma' => 'HESGD', 'path' => 'resetPassword2.jpg'],
            ['ma' => 'ZRKJS', 'path' => 'resetPassword3.jpg'],
            ['ma' => 'TGNU', 'path' => 'resetPassword4.jpg'],
            ['ma' => 'EHLAB', 'path' => 'resetPassword5.jpg'],
            ['ma' => 'IOFXM', 'path' => 'resetPassword6.jpg']
        );
        $data['code'] = $data['arrayCode'][array_rand($data['arrayCode'], 1)];
        return view('resetPass.index', $data);
    }

    public function resetPass(Request $request) {
        $request->validate([
            'SoDT' => 'required|min:10|max:11',
          ],[
              'SoDT.required' => "Bạn chưa nhập số điện thoại",
              'SoDT.min' => "Số điện thoại phải từ 10 đến 11 chữ số",
              'SoDT.max' => "Số điện thoại phải từ 10 đến 11 chữ số",
          ]);
        $phuhuynh = PhuHuynh::where('SoDT', $request->SoDT)->get();
        if(count($phuhuynh)) {
            $data['update'] = PhuHuynh::where('SoDT',$request->SoDT)->update(["password" => bcrypt('12345678')]);
            $SoDT = substr($phuhuynh->first()->SoDT,1);
            $SoDT = "+84" . $SoDT;
            Nexmo::message()->send([
                'to' => $SoDT,
                'from' => '+84374167657',
                'text' => 'Nội dung tin nhắn: mật khẩu của bạn là 12345678'
            ]);
            return redirect('resetPass')->with('error', 'Hệ thống sẽ gửi tin nhắn cho bạn. Vui lòng chờ trong giây lát');
        }
        else {
            return redirect('resetPass')->with('error', 'Số điện thoại không tồn tại trong hệ thống');
        }

    }
}
