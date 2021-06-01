<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Khoi;
use App\Models\Lop;
use App\Models\MonHoc;
use App\Models\NienKhoa;
use App\Models\HocSinh;
use App\Models\KetQuaHocTap;
use App\Models\GiaoVien;
use App\Models\LoaiHocKy;



class KQHTConTroller extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['ketquahoctap'] = KetQuaHocTap::orderBy('id_monhoc','desc')->get();
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['stt'] = 1;
        return view('admin.ketquahoctap.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['nienkhoa'] = NienKhoa::where('TrangThai', 1)->get()->first();
        $data['stt'] = 1;
        return view('admin.ketquahoctap.create',$data);
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
        ['monhoc' => 'required', 'LoaiHK' => 'required'],[
           'required' => ":attribute không được để trống",
       ],[
           'monhoc' =>'Môn học', 'LoaiHK' => 'Loại học kỳ'
       ]);

       if($validate->fails()) {
           return redirect()->back()->withErrors($validate);
       }
       $choPhepNhapDiem = MonHoc::where('id', $request->monhoc)->value('ChoPhepNhapDiem');
       $lhkc = count(LoaiHocKy::where('id', $request->LoaiHK)
                                ->where('TenLoaiHK', 'like', 'cuoi%')->get());
       if(count($request->SoLienLac) > 0) {
           foreach($request->SoLienLac as $key => $item) {
                 $where = array(
                       ['id_sll', '=', $item],
                       ['id_monhoc', '=', $request->monhoc],
                       ['id_loaihocky', '=', $request->LoaiHK]
                   );
               if($request->MucDatDuoc[$key]) {
                   if( $choPhepNhapDiem  && $lhkc)
                        if(!$request->Diem[$key])
                            return redirect()->back()->withInput()->with('noti', 'Bạn chưa điền mức đạt được hay điểm');

                   $checkKQHT =  KetQuaHocTap::where($where)->get()->toArray();
                   if(count($checkKQHT) > 0) 
                       $data =  KetQuaHocTap::where($where)->update(['MucDatDuoc' => $request->MucDatDuoc[$key], 'Diem' => $request->Diem[$key]]);
                   else {
                        $data = new KetQuaHocTap;
                       $data->id_sll = $item;
                       $data->id_monhoc = $request->monhoc;
                       $data->id_loaihocky = $request->LoaiHK;
                       $data->MucDatDuoc = $request->MucDatDuoc[$key];
                       $data->Diem = $request->Diem[$key];
                       $checkAdd = $data->save();
                   }
               }
           }
        }
        return redirect('admin/ketquahoctap')->with('Lưu điểm thành công');
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
