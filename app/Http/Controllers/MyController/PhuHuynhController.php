<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phuhuynh;
use App\Models\ChiTietGiaDinh;
use App\Models\HocSinh;
use App\Models\NienKhoa;
use App\Models\HocKy;
use App\Models\PhamChatNangLuc;

use Auth, Redirect;

class PhuHuynhController extends Controller
{
    //
    public function index() {
        $idPhuhuynh = Auth::guard('phu_huynh')->user()->id;
        $data['ctgd'] = ChiTietGiaDinh::where('id_phuhuynh',  $idPhuhuynh)->get();
        $data['hocsinh'] = ChiTietGiaDinh::where('id_phuhuynh',  $idPhuhuynh)->first()->HocSinh;
        return view('admin.phuhuynh.index', $data);
    }

    public function ketquahoctap($id) {
        $data['nienkhoa'] = NienKhoa::where('TrangThai', true)->first();
        $data['hocky'] = HocKy::where('TrangThai', true)->first();
        $data['SoLienLac'] = HocSinh::find($id)->SoLienLac;
        $data['hocsinh'] =  HocSinh::find($id);
        $data['listPCNL'] = PhamChatNangLuc::get();
        $data['countNL'] = PhamChatNangLuc::where('LoaiPCNL', 1)->count();
        $data['countPC'] = PhamChatNangLuc::where('LoaiPCNL', 2)->count();
        return view('admin.phuhuynh.kqht', $data);
    }
}
