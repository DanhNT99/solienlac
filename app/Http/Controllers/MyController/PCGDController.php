<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\GiangDay;
use App\Models\GiaoVien;
use App\Models\MonHoc;
use App\Models\Lop;

class PCGDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['giangday'] = GiangDay::get();
        $data['stt'] = 1;
        return view ('admin.phanconggiangday.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $dem = Khoi::count();
        // if($dem == 0) {
        //     $currentMaGV = 'PCGD00';
        // }
        // else {
        //     $currentMaGV =  Khoi::max('MaKhoi');
        // }
        // $array_id = explode('D',$currentMaGV);
        // $array_id[0] .="D";
        // $array_id[1] = intval($array_id[1]) + 1;
        // if($array_id[1] < 10) {
        //     $array_id[1] = "0" . $array_id[1];
        // }
        // $data['text_id'] = implode('', $array_id);

        $data['giaovien'] = GiaoVien::get();
        $data['monhoc'] = MonHoc::get();
        $data['lop'] = Lop::get();
        return view ('admin.phanconggiangday.create', $data);
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
            [
                'giaovien' => 'required', 'monhoc' => 'required', 
                'lop' => 'required', 
            
            ],[
                'required' => ":attribute không được để trống",
            ],[
                'giaovien' =>'Tên giáo viên', 'lop' =>'Tên lớp', 
                'monhoc' =>'Tên môn học', 
        ]);
    
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $data = new GiangDay();
        $data->id_giaovien = $request->giaovien;
        $data->id_lop= $request->lop;
        $data->id_monhoc= $request->monhoc;
        $check = $data->save();
        if($check) {
            return redirect('admin/phanconggiangday')->with('noti', 'Phân công giảng dạy thành công');
        }
        else {
            return redirect()->back()->with('noti', 'Phân công giảng dạy không thành công');
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
