<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoc;
use App\Models\NienKhoa;
use App\Models\Lop;
use App\Models\HocSinh;
use Validator;

class PCHTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pcht'] = Hoc::get();
        $data['stt'] = 1;
        return view('admin.hoc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['nienkhoa']  = NienKhoa::get();
        $data['hocsinh']  = HocSinh::get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        return view('admin.hoc.create' ,$data);
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
        ['nienkhoa' => 'required', 'hocsinh' => 'required', 'lop' => 'required'],
        ['required' => ":attribute không được để trống"],
        ['nienkhoa' =>'Niên khóa', 'hocsinh' => 'Học sinh', 'lop' =>'Lớp ']);
    
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $data = new Hoc();
        $data->id_nienkhoa = $request->nienkhoa;
        $data->id_lop = $request->lop;
        $data->id_hocsinh = $request->hocsinh;
        $check = $data->save();
        if($check) {
            return redirect('admin/hoc')->with('noti', 'Phân công thành công');
        }
        else {
            return redirect()->back()->with('noti', 'Phân công thành công');
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
        $data['hoc'] = Hoc::find($id);
        $data['nienkhoa']  = NienKhoa::get();
        $data['lop']  = Lop::orderBY('TenLop', 'asc')->get();
        $data['hocsinh']  = HocSinh::get();
        return view('admin.hoc.edit', $data);
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
        $updateStudy = Hoc::where('id', $id)->update(['id_hocsinh' => $request->hocsinh,
                                                        'id_nienkhoa' => $request->nienkhoa,
                                                        'id_lop' => $request->lop]);
        if($updateStudy)
            return redirect('admin/hoc')->with('noti', 'Chỉnh sửa học tập thành công');
        else 
            return redirect('admin/hoc')->with('noti', 'Chỉnh sửa học tập thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $data['hoc'] = Hoc::find($id);
        return view('admin.hoc.delete', $data);
    }

    public function destroy($id)
    {
        //
        $checkDelete = Hoc::find($id)->toArray();
        if($checkDelete) {
            return redirect('admin/hoc')->with('noti', 'Xóa  thành công');
        }
        else {
            return redirect('admin/hoc')->with('noti', 'Xóa thất bại');
        }
    }
}
