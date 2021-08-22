<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoLienLac;
use App\Models\GiaoVien;
use App\Models\HocSinh;
use App\Models\NienKhoa;
use App\Models\HocKy;
use App\Models\PhamChatNangLuc;
use App\Models\KetQuaHocTap;
use App\Models\KetQuaRenLuyen;
use App\Models\Hoc;
use App\Models\NhanXet;
use App\Models\Khoi;
use App\Models\MonHoc;
use App\Models\Lop;
use Auth;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        $data['nienkhoa']  = NienKhoa::get();
        $data['hocky'] = HocKy::where('TrangThai', 1)->get()->first();
        $data['stt'] = 1;

        $data['solienlac'] = SoLienLac::join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                        ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                        ->where([['hoc.id_lop','=',$request->Lop],
                                        ['hoc.id_nienkhoa','=', $request->nienkhoa], 
                                        ['solienlac.id_nienkhoa','=', $request->nienkhoa]])
                                        ->orderBy('TenHS', 'asc')->select('solienlac.*')->get();
                              
        //thống kê sổ liên lạc đã được nhận xét có học lực là xuất sắc
            // + lấy được danh sách sổ liên lạc theo yêu cầu tìm kiếm
            //+ gọi tới bảng nhận xét xem học lực để đếm


        $data['DemXuatSac'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where([['hoc.id_lop','=',$request->Lop],['hoc.id_nienkhoa','=', $request->nienkhoa], 
        ['solienlac.id_nienkhoa','=', $request->nienkhoa],
        ['nhanxet.HocLuc', 'like', 'Hoàn thành xuất sắc']])->get());

        $data['DemHTT'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where([['hoc.id_lop','=',$request->Lop],['hoc.id_nienkhoa','=', $request->nienkhoa],
        ['solienlac.id_nienkhoa','=', $request->nienkhoa],
        ['nhanxet.HocLuc', 'like', 'Hoàn thành tốt']])->get());

        $data['DemHT'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where([['hoc.id_lop','=',$request->Lop],['hoc.id_nienkhoa','=', $request->nienkhoa],
        ['solienlac.id_nienkhoa','=', $request->nienkhoa],
        ['nhanxet.HocLuc', 'like', 'Hoàn thành']])->get());

        $data['DemCHT'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where([['hoc.id_lop','=',$request->Lop],['hoc.id_nienkhoa','=', $request->nienkhoa],
        ['solienlac.id_nienkhoa','=', $request->nienkhoa],
        ['nhanxet.HocLuc', 'like', 'Chưa hoàn thành']])->get());
        return view('admin.thongke.index', $data);
    }

    public function selected() {
        $data['nienkhoa'] = NienKhoa::get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        return view('admin.thongke.selected', $data);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
        $data['nienkhoa'] = NienKhoa::where('id', $request->nienkhoa)->first();
        $data['hocsinh'] = HocSinh::find($id);
        $data['khoi'] = Khoi::join('lop', 'lop.id_khoi', 'khoi.id')
                        ->join('hoc', 'hoc.id_lop', 'lop.id')
                        ->where([['hoc.id_hocsinh','=',$id],['hoc.id_nienkhoa','=', $request->nienkhoa]])->get()->first();

        $data['monhoc'] = Monhoc::select('monhoc.*')->join('phanmonhoc', 'phanmonhoc.id_monhoc', 'monhoc.id')
                                ->join('khoi', 'khoi.id', 'phanmonhoc.id_khoi')
                                ->where('khoi.id', $data['khoi']->id_khoi)->orderBy('ChoPhepNhapDiem', 'desc')->get();

        $data['solienlac'] = SoLienLac::where([['id_hocsinh', $id],['id_nienkhoa',$request->nienkhoa]])->get()->first();
        $data['listPCNL'] = PhamChatNangLuc::get();
        $data['countNL'] = PhamChatNangLuc::where('LoaiPCNL', 1)->count();
        $data['countPC'] = PhamChatNangLuc::where('LoaiPCNL', 2)->count();
        return view('admin.thongke.detail', $data);
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

    public function search(Request $request) {
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        $data['nienkhoa']  = NienKhoa::get();
        $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $request->nienkhoa)->get()->first();
        $data['stt'] = 1;


        $idClass = $request->Lop != 'NULL' ? $request->Lop : NULL;
        $idGrade = $request->Khoi != 'NULL' ? $request->Khoi : NULL;
        
        $where = array(
            $request->nienkhoa ? ['hoc.id_nienkhoa', '=', $request->nienkhoa ] : "",
            $request->nienkhoa ? ['solienlac.id_nienkhoa','=', $request->nienkhoa] : "",
            $idClass ? ['hoc.id_lop', '=', $idClass] : "",
            $idGrade ? ['lop.id_khoi', '=', $idGrade] : "",
        );
        
       $where = deleteValueNullOfArray($where);
        $data['solienlac'] = SoLienLac::join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                            ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                            ->join('lop', 'lop.id', 'hoc.id_lop')
                            ->where($where)->select('solienlac.*')->orderBy('lop.TenLop', 'asc')
                            ->orderBy('hocsinh.TenHS', 'asc')->get();
        //THÔNG KÊ
        $data['DemXuatSac'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where($where)->where('nhanxet.HocLuc', 'like', 'Hoàn thành xuât sắc')->get());

        $data['DemHTT'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where($where)->where('nhanxet.HocLuc', 'like', 'Hoàn thành tốt')->get());

        $data['DemHT'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where($where)->where('nhanxet.HocLuc', 'like', 'Hoàn thành')->get());

        $data['DemCHT'] = count(Lop::join('hoc', 'hoc.id_lop', 'lop.id')
        ->join('hocsinh', 'hocsinh.id', 'hoc.id_hocsinh')
        ->join('solienlac', 'solienlac.id_hocsinh', 'hocsinh.id')
        ->join('nhanxet', 'nhanxet.id_sll', 'solienlac.id')
        ->where($where)->where('nhanxet.HocLuc', 'like', 'Chưa hoàn thành')->get());

        return view('admin.thongke.search', $data);
    }
}
