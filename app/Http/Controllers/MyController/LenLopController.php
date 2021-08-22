<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NienKhoa;
use App\Models\Khoi;
use App\Models\Lop;
use App\Models\Hoc;
use App\Models\HocKy;
use App\Models\SoLienLac;
use Validator;



class LenLopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['nienkhoa'] = NienKhoa::get();
        $data['nienkhoaHT'] = NienKhoa::find($request->nienkhoa)->NamBatDau;
        $data['classCurrent'] = Lop::find($request->Lop);
        $data['lop'] = Lop::orderBy('TenLop','asc')->get();
        $hocky = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $request->nienkhoa)->get()->first();
        $data['hocsinhlenlop'] = Hoc::join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
                            ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
                            ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
                            ->where([['hoc.id_lop',$request->Lop], ['hoc.id_nienkhoa', $request->nienkhoa]
                            ,['nhanxet.id_hocky', $hocky->id], ['LenLop', null]])
                            ->where('nhanxet.hocluc','not like', 'Chưa hoàn thành')->get();

        $data['hocsinhkhonglenlop'] = Hoc::join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
                                    ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
                                    ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
                                    ->where([['hoc.id_lop',$request->Lop], ['hoc.id_nienkhoa', $request->nienkhoa]
                                    ,['nhanxet.id_hocky', $hocky->id], ['LenLop', null]])
                                    ->where('nhanxet.hocluc','like', 'Chưa hoàn thành')->get();
        $data['stt'] = 1;
        return view('admin.lenlop.index', $data);
    }

    public function select() {
        $data['nienkhoa'] = NienKhoa::get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        return view('admin.lenlop.select', $data);
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
        $validate = Validator::make($request->all(),
        ['NienKhoa' => 'required', 'Lop' => 'required'],
        ['required' => ":attribute không được để trống"],
        ['NienKhoa' =>'Niên khóa', 'Lop' =>'Lớp ']);
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $idYearCurrent = NienKhoa::where('TrangThai',1)->get()->first()->id;
        if($request->has('LenLop')) {
            if($request->idStudent) {
                foreach($request->idStudent as $key => $value) {
                    $data = new Hoc();
                    $data->id_nienkhoa = $request->NienKhoa;
                    $data->id_lop = $request->Lop;
                    $data->id_hocsinh = $value;
                    $check = $data->save();
                    $hoc = Hoc::where([['id_hocsinh', $value], ['id_nienkhoa', $idYearCurrent]])->update(['LenLop' => 1]);

                    $MaNK = NienKhoa::where('id', $request->NienKhoa)->get()->first()->MaNK;
                    $MaNK = explode('K',$MaNK)[1];
                    $strMaSLL = 'SLL' . $MaNK;
                    $idCurrent =  SoLienLac::max('MaSLL');
                    $idCurrent = intval(substr($idCurrent, 7)) + 1;
                    $idSLLNew = $strMaSLL . $idCurrent;
                    $data = new SoLienLac;
                    $data->MaSLL = $idSLLNew;
                    $data->id_hocsinh = $value;
                    $data->id_nienkhoa = $request->NienKhoa;
                    $data->save();
                }
                $path = url()->previous();
                switch($check) {
                    case true: return redirect($path)->with('noti', 'Lên lớp thành thành công'); break;
                    default :  return redirect()->back()->with('noti', 'Lên lớp không thành công'); break;
                }
            }
            else {
                return redirect()->back()->with('noti', 'Vui lòng chọn học sinh');
            }
        }
        if($request->has('KhongLenLop')) {
            if($request->idStudent) {
                foreach($request->idStudent as $key => $value) {
                    $data = new Hoc();
                    $data->id_nienkhoa = $request->NienKhoa;
                    $data->id_lop = $request->Lop;
                    $data->id_hocsinh = $value;
                    $check = $data->save();
                    $hoc = Hoc::where([['id_hocsinh', $value], ['id_nienkhoa', $idYearCurrent]])->update(['LenLop' => 0]);
                    
                    $MaNK = NienKhoa::where('id', $request->NienKhoa)->get()->first()->MaNK;
                    $MaNK = explode('K',$MaNK)[1];
                    $strMaSLL = 'SLL' . $MaNK;
                    $idCurrent =  SoLienLac::max('MaSLL');
                    $idCurrent = intval(substr($idCurrent, 7)) + 1;
                    $idSLLNew = $strMaSLL . $idCurrent;
                    $data = new SoLienLac;
                    $data->MaSLL = $idSLLNew;
                    $data->id_hocsinh = $value;
                    $data->id_nienkhoa = $request->NienKhoa;
                    $data->save();
                }
                $path = url()->previous();
                switch($check) {
                    case true: return redirect($path)->with('noti', 'Ở lại lớp thành thành công'); break;
                    default :  return redirect()->back()->with('noti', 'Lên lớp không thành công'); break;
                }
            }
            else {
                return redirect()->back()->with('noti', 'Vui lòng chọn học sinh');
            }

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
