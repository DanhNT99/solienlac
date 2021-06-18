<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiHocKy;
use App\Models\NienKhoa;
use App\Models\HocKy;
use Validator;

class LoaiHocKyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['loaihk'] = LoaiHocKy::paginate(5);
        $data['stt'] =  $data['loaihk']->firstItem();
        return view('admin.loaihocky.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data['nienkhoa'] = NienKhoa::get();

        $MaNK = NienKhoa::where('TrangThai', 1)->get()->toArray()[0]['MaNK'];
        $MaNK = explode('K',$MaNK);

        $count = LoaiHocKy::count();

        if($count == 0) $idHSArray = 'LHK' . $MaNK[1] . '01';
        else{
            $idCurrent =  LoaiHocKy::max('MaLoaiHK');
            $idHSArray = explode('K',$idCurrent);
            $idHSArray[0] .= "K";
            $idHSArray[1] = intval($idHSArray[1]) + 1;
            $idHSArray = implode('', $idHSArray);
        }
        $data['text_id'] = $idHSArray;
        return view('admin.loaihocky.create', $data);
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
        ['nienkhoa' => 'required', 'MaLoaiHK' => 'required',
        'hocky' => 'required', 'TenLoaiHK' => 'required'],
        ['required' => ":attribute không được để trống"],
        ['nienkhoa' =>'Niên khóa', 'TenLoaiHK' =>'Tên loại học kỳ',
        'MaLoaiHK' => 'Mã loại học kỳ', 'hocky' =>'Học kỳ']);

        if($validate->fails()) {
        return redirect()->back()->withInput()->withErrors($validate);
        }
    //END
        $data = new LoaiHocKy ();
        $data->MaLoaiHK = $request->MaLoaiHK;
        $data->TenLoaiHK = ucfirst($request->TenLoaiHK);
        $data->id_hocky = $request->hocky;
        $check = $data->save();

        if($check) {
            return redirect('admin/loaihocky')->with('noti', 'Thêm thành công');
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
        $data['nienkhoa'] = NienKhoa::orderBy('NamBatDau', 'asc')->get();
        $data['loaihocky'] = LoaiHocKy::find($id);
        return view('admin.loaihocky.edit', $data);
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
        ['TenLoaiHK' => 'required'],
        ['required' => ":attribute không được để trống"],
        ['TenLoaiHK' =>'Tên loại học kỳ']);

        if($validate->fails()) {
        return redirect()->back()->withInput()->withErrors($validate);
        }
    //END
    
    //UPATE TYPE SEMESTER
        $updateTypeSemester = LoaiHocKy::where('id', $id)
                            ->update(['id_hocky' => $request->hocky, 'MaLoaiHK' => $request->MaLoaiHK,
                                        'TenLoaiHK' => $request->TenLoaiHK]);
        if($updateTypeSemester)
            return redirect('admin/loaihocky')->with('noti', 'Chỉnh sửa thành công');
        else 
            return redirect('admin/loaihocky')->with('noti', 'Chỉnh sửa thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        
        $data['loaihocky'] = LoaiHocKy::find($id);
        return view('admin.loaihocky.delete', $data);
    }

    public function destroy($id)
    {
        //

        $checkDelete = LoaiHocKy::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/loaihocky')->with('noti', 'Xóa thành công');
        }
        else {
            return redirect('admin/loaihocky')->with('noti', 'Xóa thất bại');
        }
    }
}
