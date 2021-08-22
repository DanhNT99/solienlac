<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\NienKhoa;
use App\Models\HocKY;
class NienKhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data['nienkhoa'] = NienKhoa::orderBy('id', 'desc')->paginate(5);
        $data['stt'] =   $data['nienkhoa']->firstItem();
        return view ('admin.nienkhoa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $year = date('Y');
        $data['text_id'] = 'NK' . $year;
        $data['yearCurrent'] = $year;
        $data['yearAfter'] = $year + 1;
        return view ('admin.nienkhoa.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //VALIDATE INPUT ADN NOTIFINCATION
        $validate = Validator::make($request->all(),
            ['NamBatDau' => 'required|integer', 'NamKetThuc' => 'required|integer',
            'TrangThai' => 'required'],
            ['required' => ":attribute không được để trống",
            'integer' => ":attribute phải là số"],
            ['NamBatDau' => 'Năm bất đầu','NamKetThuc' =>'Năm kết thúc',
            'TrangThai' => 'Trạng thái']);
    
        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
    //END

    //CHECK YEAR NEW YEAR?
        $year = NienKhoa::where('MaNK', $request->MaNK)->get();
        if(count($year)) {
            return redirect()->back()->with('noti', 'Niên khóa này đã tồn tại');
        }
        if($request->TrangThai) {
            $data = NienKhoa::where('TrangThai', 1)->update(['TrangThai' => 0]);
        }
        $data = new NienKhoa();
        $data->MaNK = $request->MaNK;
        $data->NamBatDau = $request->NamBatDau;
        $data->NamKetThuc = $request->NamKetThuc;
        $data->TrangThai = $request->TrangThai;
        $check = $data->save();
        
        if($check) {
            
            return redirect('admin/nienkhoa')->with('noti', 'Thêm niên khóa thành công');
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
        $data['nienkhoa'] = NienKhoa::find($id);
        return view('admin.nienkhoa.detail', $data);
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
        $data['nienkhoa'] = NienKhoa::find($id);
        $data['hocky'] = HocKy::where('id_nienkhoa',  $data['nienkhoa']->id)->get();
        return view('admin.nienkhoa.edit', $data);
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
    //VALIDATE INPUT ADN NOTIFINCATION
         $validate = Validator::make($request->all(),
         ['NamBatDau' => 'required|integer', 'NamKetThuc' => 'required|integer'],
         ['required' => ":attribute không được để trống",
         'integer' => ":attribute phải là số"],
         ['NamBatDau' => 'Năm bất đầu','NamKetThuc' =>'Năm kết thúc']);
 
        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
    //END
        if($request->trangthai) {
            $data = NienKhoa::where('TrangThai', 1)->update(['TrangThai' => 0]);
        }

        if(($request->NamBatDau > $request->NamKetThuc) || $request->NamBatDau == $request->NamKetThuc) {
            return redirect()->back()->with('noti', 'Năm bắt đầu không thể lớn hơn hoặc bằng năm kết thúc');
        }
        
        $updateNienKhoa = NienKhoa::where('id', $id)->update(['NamBatDau' => $request->NamBatDau, 'NamKetThuc' => $request->NamKetThuc,
                                                        'TrangThai' => $request->trangthai]);
        if($updateNienKhoa)
            return redirect('admin/nienkhoa')->with('noti', 'Chỉnh sửa  thành công');
        else 
            return redirect('admin/nienkhoa')->with('noti', 'Chỉnh sửa thất bại');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function delete($id) {
        $data['nienkhoa'] = NienKhoa::find($id);
        return view('admin.nienkhoa.delete', $data);
    }

    public function destroy($id)
    {
        //

        $checkDelete = NienKhoa::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/nienkhoa')->with('noti', 'Xóa niên khóa thành công');
        }
        else {
            return redirect('admin/nienkhoa')->with('noti', 'Xóa niên khóa  thất bại');
        }
    }
}
