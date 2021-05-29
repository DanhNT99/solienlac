<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PhanMonHoc;
use App\Models\Monhoc;
use App\Models\Khoi;

class PhanMonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['phanmonhoc'] = PhanMonHoc::orderBy('id_khoi', 'asc')->paginate(10);
        $data['stt'] =  $data['phanmonhoc']->firstItem();
        return view('admin.phanmonhoc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['monhoc'] = Monhoc::get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        return view('admin.phanmonhoc.create', $data);
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
        // $validate = Validator::make($request->all(),
        // ['monhoc' => 'required'],
        // ['required' => ":attribute không được để trống"],
        // ['monhoc' =>'Môn học']);

        // if($validate->fails()) return redirect()->back()->withErrors($validate);
        $listGradeString = '';
        // dd($request->khoi);
        if(!isset($request->khoi) && !isset($request->monhoc)) {
            return redirect()->back()->with('noti', 'Bạn chưa chọn môn học hoặc khối');
        }
        else {
            foreach($request->khoi as $keyKhoi => $khoi) {
                foreach($request->monhoc as $keyMH => $mh) {
                    $checkPhanMonHoc = PhanMonHoc::where([['id_monhoc', '=', $mh], ['id_khoi', '=', $khoi]])->get();
                    if(!count($checkPhanMonHoc)) {
                        $data = new PhanMonHoc;
                        $data->id_monhoc = $mh;
                        $data->id_khoi = $khoi;
                        $check = $data->save();
                    }
                }
                
            }
        }
        return redirect('admin/phanmonhoc')->with('noti', 'Phân môn học thành công');

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
        $data['phanmonhoc'] = PhanMonHoc::find($id);
        $data['monhoc'] = MonHoc::orderBy('TenMH', 'asc')->get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        return view('admin.phanmonhoc.edit', $data);
        
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
        $data = PhanMonHoc::where([['id_monhoc', '=', $request->monhoc], ['id_khoi', '=', $request->khoi]])->get();
        if(count($data)) {
            $khoi = Khoi::where('id', $request->khoi)->value('TenKhoi');
            return redirect()->back()->with('noti', 'Môn này đã phân cho ' . $khoi . ' rồi');
        }
        else {
            $updatePhanMonHoc = PhanMonHoc::where('id', $id)->update(['id_monhoc' => $request->monhoc, 'id_khoi' => $request->khoi]);
            if($updatePhanMonHoc)
                return redirect('admin/phanmonhoc')->with('noti', 'Chỉnh sửa thành công');
            else 
                return redirect('admin/phanmonhoc')->with('noti', 'Chỉnh sửa thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $data['phanmonhoc'] = PhanMonHoc::find($id);
        $data['monhoc'] = MonHoc::orderBy('TenMH', 'asc')->get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        return view('admin.phanmonhoc.delete', $data);
    }

    public function destroy($id)
    {
        //

        $checkDelete = PhanMonHoc::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/phanmonhoc')->with('noti', 'Xóa thành công');
        }
        else {
            return redirect('admin/phanmonhoc')->with('noti', 'Xóa thất bại');
        }

    }
}
