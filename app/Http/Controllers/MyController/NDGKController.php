<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Khoi;
use App\Models\MonHoc;
use App\Models\NhapDiemGiuaKy;
use Validator;


class NDGKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['cpnd'] = NhapDiemGiuaKy::orderBy('id_khoi', 'asc')->get();
        $data['khoi'] = Khoi::get();
        $data['monhoc'] = MonHoc::get();
        $data['stt'] = 1;
        return view('admin.chophepnhapdiem.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $count = NhapDiemGiuaKy::count();
        if($count == 0) $idCurrent = 'ND00';
    
        else $idCurrent =  NhapDiemGiuaKy::max('MaND'); 
        $array_id = explode('D',$idCurrent);
        $array_id[0] .= "D";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['monhoc'] = MonHoc::orderBy('TenMH', 'asc')->get();
        return view('admin.chophepnhapdiem.create', $data);
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

        $validate = Validator::make($request->all(),
            ['khoi' => 'required', 'monhoc' => 'required'],
            ['required' => ":attribute không được để trống"],
            ['khoi' =>'Tên khôi', 'monhoc' => 'Tên môn học']);
    
        if($validate->fails())
            return redirect()->back()->withInput()->withErrors($validate);
        
        $checkData = NhapDiemGiuaKy::where([['id_khoi','=' , $request->khoi], ['id_monhoc','=' , $request->monhoc]])->get();
        if(count($checkData) > 0)
            return redirect()->back()->withInput()->with('noti', 'Dữ liệu này đã tồn tại');
            
        $data = new NhapDiemGiuaKy;
        $data->MaND = $request->MaND;
        $data->id_khoi = $request->khoi;
        $data->id_monhoc = $request->monhoc;
        $check = $data->save();
        if($check) {
            return redirect('admin/chophepnhapdiem')->with('noti', 'Cho phép thành công');
        }
        else {
            return redirect()->back()->with('noti', 'Cho phép thành công');
        }
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
        $data['cpnd'] = NhapDiemGiuaKy::find($id);
        $data['khoi'] = Khoi::get();
        $data['monhoc'] = MonHoc::get();
        return view('admin.chophepnhapdiem.edit', $data);
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

        $checkUpdate = NhapDiemGiuaKy::where([['id_khoi','=' , $request->khoi], ['id_monhoc','=' , $request->monhoc]])->get();
        if(count($checkUpdate) > 0)
            return redirect()->back()->with('noti', 'Dữ liệu này đã tồn tại');
        $update = NhapDiemGiuaKy::where('id',$id)->update(['id_khoi' => $request->khoi, 'id_monhoc' => $request->monhoc]);
        if($update)
            return redirect('admin/chophepnhapdiem')->with('noti', 'Chỉnh sửa  thành công');
        else 
            return redirect('admin/chophepnhapdiem')->with('noti', 'Chỉnh sửa thất bại');
            
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
        $delete = NhapDiemGiuaKy::find($id)->delete();
        if($delete) {
            return redirect('admin/chophepnhapdiem')->with('noti', 'Xóa  thành công');
        }
        else {
            return redirect('admin/chophepnhapdiem')->with('noti', 'Xóa thất bại');
        }
    }
}
