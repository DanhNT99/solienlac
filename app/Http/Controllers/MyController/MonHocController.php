<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\MonHoc;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['monhoc'] = MonHoc::orderBy('TenMH', 'asc')->paginate(5);
        $data['stt'] = $data['monhoc']->firstItem();
        return view ('admin.monhoc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dem = MonHoc::count();
        if($dem == 0) {
            $currentMaGV = 'MH00';
        }
        else {
            $currentMaGV =  MonHoc::max('MaMH');
        }
        $array_id = explode('MH',$currentMaGV);
        $array_id[0] .="MH";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
        return view ('admin.monhoc.create', $data);
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
        ['TenMH' => 'required|unique:monhoc',
        'ChoPhepNhapDiem' => 'required'],
        ['required' => ':attribute không được để trống',
        'unique' => ':attribute này đã tồn tại '],
        ['TenMH' =>'Tên môn học',
        'ChoPhepNhapDiem' => 'Cho phép nhập điểm']);
    
    if($validate->fails()) {
        return redirect()->back()->withInput()->withErrors($validate);
    }

    $data = new MonHoc();
    $data->MaMH = $request->MaMH;
    $data->TenMH = ucfirst($request->TenMH);
    $data->ChoPhepNhapDiem = $request->ChoPhepNhapDiem;
    $check = $data->save();
    if($check) {
        return redirect('admin/monhoc')->with('noti', 'Thêm môn học thành công');
    }
    else {
        return redirect()->back()->with('noti', 'Thêm không thành công');
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
        $data['monhoc'] = MonHoc::find($id);
        return view('admin.monhoc.detail', $data);
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
        $data['monhoc'] = MonHoc::find($id);
        return view('admin.monhoc.edit', $data);
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
        $updateSubject = MonHoc::where('id', $id)->update(['TenMH' => ucfirst($request->TenMH)]);
        if($updateSubject)
            return redirect('admin/monhoc')->with('noti', 'Chỉnh sửa môn học thành công');
        else 
            return redirect('admin/monhoc')->with('noti', 'Chỉnh sửa môn học thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $data['monhoc'] = MonHoc::find($id);
        return view('admin.monhoc.delete', $data);
    }

    public function destroy($id)
    {
        //

        $checkDelete = MonHoc::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/monhoc')->with('noti', 'Xóa môn học thành công');
        }
        else {
            return redirect('admin/monhoc')->with('noti', 'Xóa môn học  thất bại');
        }
    }
}
