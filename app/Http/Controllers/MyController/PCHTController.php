<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoc;
use App\Models\NienKhoa;
use App\Models\Lop;
use App\Models\Khoi;
use App\Models\HocSinh;
use Validator;

class PCHTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['khoi'] = Khoi::get();
        $data['lop'] = Lop::get();
        $data['nienkhoa'] = NienKhoa::get();
        $data['pcht'] = Hoc::join('hocsinh', 'hoc.id_hocsinh', 'hocsinh.id')
                        ->where([['hoc.id_lop','=',$request->Lop],
                        ['hoc.id_nienkhoa','=', $request->nienkhoa]])
                        ->orderBy('hocsinh.TenHS', 'asc')->select('hoc.*')->get();
        // dd($data['pcht']);
        $data['stt'] = 1;
        return view('admin.hoc.index', $data);
    }

    public function selected() {
        $data['nienkhoa'] = NienKhoa::get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        return view('admin.hoc.selected', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data['nienkhoa']  = NienKhoa::where('TrangThai', 1)->first();
        $data['hocsinh']  = HocSinh::get();
        $data['stt'] = 1;
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
        ['nienkhoa' => 'required', 'lop' => 'required'],
        ['required' => ":attribute không được để trống"],
        ['nienkhoa' =>'Niên khóa', 'lop' =>'Lớp ']);
    
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
    //CHECK USER HAVA SELECT STUDENT
        $lop = Lop::where('id', $request->lop)->first();
        $path = 'admin/hoc?nienkhoa=' . $request->nienkhoa .'Khoi=' .$lop->Khoi->id . '&Lop='.$lop->id;
        if($request->TrangThai) {
            foreach($request->TrangThai as $key => $value) {
                $data = new Hoc();
                $data->id_nienkhoa = $request->nienkhoa;
                $data->id_lop = $request->lop;
                $data->id_hocsinh = $value;
                $check = $data->save();
            }

            switch($check) {
                case true: return redirect($path)->with('noti', 'Phân công thành công'); break;
                default :  return redirect()->back()->with('noti', 'Phân công không thành công'); break;

            }
        }
        else {
            return redirect()->back()->with('noti', 'Vui lòng chọn học sinh');
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
        $data['hocsinh'] = HocSinh::find($data['hoc']->id_hocsinh);
        $data['nienkhoa']  = NienKhoa::where('TrangThai', 1)->first();
        $data['lop']  = Lop::orderBY('TenLop', 'asc')->get();
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
        $updateStudy = Hoc::where('id', $id)->update(['id_nienkhoa' => $request->nienkhoa,
                                                        'id_lop' => $request->lop]);
        $lop = Lop::where('id', $request->lop)->first();
        $path = 'admin/hoc?nienkhoa=' . $request->nienkhoa . '&Khoi=' . $lop->id_khoi . '&Lop=' .$request->lop;
        if($updateStudy)
            return redirect($path)->with('noti', 'Chỉnh sửa học tập thành công');
        else 
            return redirect($path)->with('noti', 'Chỉnh sửa học tập thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $reuqest,$id)
    {
        //
        $lop = Hoc::where('id', $id)->first()->Lop;
        $path =  url()->previous();
        $checkDelete = Hoc::find($id)->delete();
        if($checkDelete) {
            return redirect($path)->with('noti', 'Xóa  thành công');
        }
        else {
            return redirect($path)->with('noti', 'Xóa thất bại');
        }
    }

    public function search(Request $request) {
        $data['khoi'] = Khoi::get();
        $data['lop'] = Lop::get();

        $MaHS = $request->MaHS || $request->MaHS == '0' ? '%'. $request->MaHS .'%' : ' ';
        $idClass = $request->Lop != 'NULL' ? $request->Lop : NULL;
        $idGrade = $request->Khoi != 'NULL' ? $request->Khoi : NULL;
        $where = array(
            $request->nienkhoa ? ['hoc.id_nienkhoa', '=', $request->nienkhoa ] : "",
            $idGrade ? ['id_khoi', $idGrade] : "",
            $idClass ? ['hoc.id_lop', '=', $idClass] : "",
            $request->TenHS ? ['TenHS', 'like', '%'. $request->TenHS .'%'] : '',
            $request->MaHS ? ['MaHS', 'like', $MaHS] : '',
        );
        //DELETE ' ' IN ARRAY
        foreach($where as $key => $value) {
            if($value == NULL) unset($where[$key]);
        }
        $data['stt'] = 1;
        // $data['pcht'] = Hoc::join('hocsinh', 'hocsinh.id', '=','hoc.id_hocsinh')
        //                     ->where($where)->get();
        $data['nienkhoa'] = NienKhoa::get();
        $data['pcht'] = Khoi::join('lop', 'lop.id_khoi', '=','khoi.id')
                            ->join('hoc', 'hoc.id_lop', '=','lop.id')
                            ->join('hocsinh', 'hocsinh.id', '=','hoc.id_hocsinh')
                            ->where($where)->orderBy('hocsinh.TenHS', 'asc')
                            ->select('*', 'hoc.id as idPCHT')->get();
        return view('admin.hoc.search', $data);
    }
}
