<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HocSinhController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('AuthCheck');
    }

    public function index() {
        return view('admin.hocsinh.danhsach');
    }
    public function indexThem() {
        return view('admin.hocsinh.them');
    }
}
