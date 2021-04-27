<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiaoVienController extends Controller
{
    //


    public function index() {
        return view('admin.giaovien.danhsach');
    }
    public function indexThem() {
        return view('admin.giaovien.them');
    }
}
