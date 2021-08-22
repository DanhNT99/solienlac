<?php

namespace App\Http\Controllers\MySmsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SMSController extends Controller
{
    //
    public function sendMessage() {
        // Nexmo::message()->send([
        //     'to' => '+84 98 921 05 23',
        //     'from' => '+84374167657',
        //     'text' => 'Tin nhắn được gửi từ NTD'
        // ]);
        // echo "yes";
    }
}
