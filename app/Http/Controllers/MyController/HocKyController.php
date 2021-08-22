<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\HocKy;
use App\Models\NienKhoa;

class HocKyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['hocky'] = HocKy::paginate(10);
        $data['stt'] = $data['hocky']->firstItem();
        return view ('admin.hocky.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //create new code for contact book
        $data['nienkhoa'] = NienKhoa::get();
        return view ('admin.hocky.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //VALIDATE INPUT AND NOTIFICATION
        $validate = Validator::make($request->all(),
            ['nienkhoa' => 'required', 'TenHK' => 'required',
            'TrangThai' => 'required', 'MaHK' => 'required'],
            ['required' => ":attribute không được để trống"],
            ['nienkhoa' =>'Niên khóa', 'TenHK' =>'Tên học kỳ',
            'TrangThai' => 'Trạng thái', 'MaHK' => 'Mã học kỳ']);

        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
    //END
    //CREATE NEW SEMESTER AND NOTIFICATION
        if($request->TrangThai) {
            $data = HocKy::where('TrangThai', 1)->update(['TrangThai' => 0]);
        }
        $data = new HocKy ();
        $data->MaHK = $request->MaHK;
        $data->TenHK = ucfirst($request->TenHK);
        $data->id_nienkhoa = $request->nienkhoa;
        $data->TrangThai = $request->TrangThai;
        $check = $data->save();
        if($check) {
            return redirect('admin/hocky')->with('noti', 'Thêm khối thành công');
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
        $data['hocky'] = HocKy::find($id);
        $data['nienkhoa'] = NienKhoa::get();
        return view('admin.hocky.edit', $data);
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
        //VALIDATE INPUT AND NOTIFICATION
        $validate = Validator::make($request->all(),
            ['TenHK' => 'required'],
            ['required' => ":attribute không được để trống"],
            ['TenHK' =>'Tên học kỳ']);

        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
    //END
        if($request->TrangThai) {
            $data = Hocky::where('TrangThai', 1)->update(['TrangThai' => 0]);
        }
        
        $updateSemester= HocKy::where('id', $id)->update(['TenHK' => ucfirst($request->TenHK), 'TrangThai' => $request->TrangThai,
                                                        'id_nienkhoa' => $request->nienkhoa]);
        if($updateSemester)
            return redirect('admin/hocky')->with('noti', 'Chỉnh sửa  thành công');
        else 
            return redirect('admin/hocky')->with('noti', 'Chỉnh sửa thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $data['hocky'] = HocKy::find($id);
        $data['nienkhoa'] = NienKhoa::get();
        return view('admin.hocky.delete', $data);
    }

    public function destroy($id)
    {
        //
        $checkDelete = HocKY::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/hocky')->with('noti', 'Xóa học kỳ thành công');
        }
        else {
            return redirect('admin/hocky')->with('noti', 'Xóa học kỳ  thất bại');
        }
    }

}
