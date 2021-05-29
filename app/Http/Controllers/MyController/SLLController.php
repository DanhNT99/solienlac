<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoLienLac;
use App\Models\GiaoVien;
use App\Models\HocSinh;
use App\Models\NienKhoa;
use App\Models\HocKy;
use App\Models\PhamChatNangLuc;
use Auth;

class SLLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['solienlac'] = SoLienLac::get();
        $data['stt'] = 1;
        return view('admin.solienlac.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['hocsinh'] = HocSinh::find($id);
        $daata['solienlac'] =  HocSinh::find($id)->SoLienLac;
        $data['nienkhoa'] = NienKhoa::where('TrangThai', true)->first();
        $data['hocky'] = HocKy::where('TrangThai', true)->first();
        $data['listPCNL'] = PhamChatNangLuc::get();
        $data['countNL'] = PhamChatNangLuc::where('LoaiPCNL', 1)->count();
        $data['countPC'] = PhamChatNangLuc::where('LoaiPCNL', 2)->count();
        return view('admin.solienlac.detail', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $idSLL= HocSinh::find($id)->SoLienLac->toArray()['id'];
        $data = SoLienLac::where('id',$idSLL)->update(['NhanXet' => $request->NhanXet, 'HocLuc' => $request->HocLuc]);
        if($data) {
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
