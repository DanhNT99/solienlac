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
use App\Models\Lop;
use Auth, DB;

class SLLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 
        $data['stt'] = 1;
        $roleUser  = Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm');
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
       
        if( $roleUser) {
            $data['nienkhoa']  = NienKhoa::where('TrangThai', 1)->first();
            $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $data['nienkhoa']->id)->get()->first();
            $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
            $data['solienlac'] = SoLienLac::join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                        ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                        ->join('lop', 'lop.id', 'hoc.id_lop')
                                        ->where([['hoc.id_nienkhoa',  $data['nienkhoa']->id],
                                                ['solienlac.id_nienkhoa', $data['nienkhoa']->id]])
                                        ->where('lop.id_giaovien',  $data['giaovien']->id)
                                        ->orderBy('hocsinh.TenHS', 'asc')->select('solienlac.*')->get();
            $where = [
                ['hoc.id_nienkhoa',  $data['nienkhoa']->id],
                ['solienlac.id_nienkhoa', $data['nienkhoa']->id],
                ['lop.id_giaovien',  $data['giaovien']->id],
                ['nhanxet.id_hocky', $data['hocky']->id]
            ];

            $data['DemXuatSac'] = count(NhanXet::join('solienlac', 'solienlac.id', 'nhanxet.id_sll')
                                    ->join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                    ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                    ->join('lop', 'lop.id', 'hoc.id_lop')
                                    ->where($where)->where('nhanxet.HocLuc', 'like', 'Hoàn thành xuất sắc')
                                    ->select('solienlac.*')->get()); 
            $data['DemHTT'] = count(NhanXet::join('solienlac', 'solienlac.id', 'nhanxet.id_sll')
                                    ->join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                    ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                    ->join('lop', 'lop.id', 'hoc.id_lop')
                                    ->where($where)->where('nhanxet.HocLuc', 'like', 'Hoàn thành tốt')
                                    ->select('solienlac.*')->get()); 
            $data['DemHT'] = count(NhanXet::join('solienlac', 'solienlac.id', 'nhanxet.id_sll')
                                    ->join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                    ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                    ->join('lop', 'lop.id', 'hoc.id_lop')
                                    ->where($where)->where('nhanxet.HocLuc', 'like', 'Hoàn thành')
                                    ->select('solienlac.*')->get()); 
            $data['DemCHT'] = count(NhanXet::join('solienlac', 'solienlac.id', 'nhanxet.id_sll')
                                    ->join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                    ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                    ->join('lop', 'lop.id', 'hoc.id_lop')
                                    ->where($where)->where('nhanxet.HocLuc', 'like', 'Chưa hoàn thành')
                                    ->select('solienlac.*')->get()); 
        }
        else {
            $data['nienkhoa']  = NienKhoa::where('id', $request->nienkhoa)->first();
            $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $data['nienkhoa']->id)->first();
            $data['solienlac'] = SoLienLac::join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                        ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                        ->join('lop', 'lop.id', 'hoc.id_lop')
                                        ->where([['lop.id', $request->Lop],['lop.id_khoi', $request->Khoi]])
                                        ->where([['hoc.id_nienkhoa',  $request->nienkhoa],
                                        ['solienlac.id_nienkhoa',   $request->nienkhoa]])
                                        ->orderBy('hocsinh.TenHS', 'asc')->select('solienlac.*')->get();
        }
        return view('admin.solienlac.index', $data);
    }

    public function selected() {
        $data['nienkhoa'] = NienKhoa::get();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        return view('admin.solienlac.selected', $data);
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
    public function show($id)
    {
        //
        $data['nienkhoa'] = NienKhoa::where('TrangThai', true)->first();
        $whereSubject = [['hocsinh.id', '=', $id], ['hoc.id_nienkhoa', '=', $data['nienkhoa']->id]];
        $data['hocsinh'] = HocSinh::find($id);
        $data['khoi'] = Khoi::join('lop', 'lop.id_khoi', 'khoi.id')
                        ->join('hoc', 'hoc.id_lop', 'lop.id')
                        ->where([['hoc.id_hocsinh','=',$id],['hoc.id_nienkhoa','=', $data['nienkhoa']->id]])->get();
        $data['listPCNL'] = PhamChatNangLuc::get();
        $data['countNL'] = PhamChatNangLuc::where('LoaiPCNL', 1)->count();
        $data['countPC'] = PhamChatNangLuc::where('LoaiPCNL', 2)->count();
        return view('admin.solienlac.detail', $data);
       
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
        $data['nienkhoa'] = NienKhoa::where('TrangThai', true)->first();
        $data['hocky'] = HocKy::where('TrangThai', true)->first();
        $whereSubject = [['hocsinh.id', '=', $id], ['hoc.id_nienkhoa', '=', $data['nienkhoa']->id]];
        $data['monhoc'] = DB::table('hocsinh')->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                        ->join('lop', 'lop.id', 'hoc.id_Lop')->join('khoi', 'khoi.id', 'lop.id_khoi')
                        ->join('phanmonhoc', 'phanmonhoc.id_khoi', 'khoi.id')->join('monhoc', 'monhoc.id', 'phanmonhoc.id_monhoc')
                        ->where($whereSubject)->orderBy('ChoPhepNhapDiem', 'desc')->select('monhoc.*')->get();
        $data['hocsinh'] = HocSinh::find($id);

        // $daata['solienlac'] =  HocSinh::find($id)->SoLienLac;
        $data['listPCNL'] = PhamChatNangLuc::get();
        $data['countNL'] = PhamChatNangLuc::where('LoaiPCNL', 1)->count();
        $data['countPC'] = PhamChatNangLuc::where('LoaiPCNL', 2)->count();

        // //GET AVALUATE
        $data['text'] = '';
        //GET ID GRADE
        $idGrade = Hocsinh::find($id)->Hoc->where('id_nienkhoa',  $data['nienkhoa']->id)->first()->Lop->Khoi->id;
            //GET LIST ID SUBJECT
        $listIDSubject = DB::table('khoi')->join('phanmonhoc', 'phanmonhoc.id_khoi', 'khoi.id')
                ->join('monhoc', 'monhoc.id', 'phanmonhoc.id_monhoc')
                ->where('khoi.id', $idGrade)->select('monhoc.id')->get();
            //GET LIST TYPE SEMESTER OF SEMESTER CURRENT       
        $listTypeSemester = HocKy::where('TrangThai', true)->first()->LoaiHocKy;

        $idContactBook = HocSinh::find($id)->SoLienLac->where('id_nienkhoa',  $data['nienkhoa']->id)->first()->id;
        $listPCNL = DB::table('phamchatnangluc')->select('id')->get();
        $arrayKqrl = Array();
        $arrayKqht = Array();
        foreach($listTypeSemester as $typeSemester) {
            foreach ($listIDSubject as $key => $mh) {
                $where = [
                    ['id_sll', '=', $idContactBook],
                    ['id_monhoc', '=', $mh->id],
                    ['id_loaihocky', '=', $typeSemester->id]
                ];
                $kqht = KetQuaHocTap::where($where)->get();
                if(count($kqht))
                    $kqht =  $kqht->first()->toArray();
                else 
                    $kqht = null;
                Array_push($arrayKqht, $kqht);
            }
            
            foreach ($listPCNL as $key => $pcnl) {
                $where = [
                    ['id_sll', '=', $idContactBook],
                    ['id_pcnl', '=', $pcnl->id],
                    ['id_loaihocky', '=', $typeSemester->id]
                ];
                $kqrl = KetQuaRenLuyen::where($where)->get();
                if(count($kqrl))
                    $kqrl =  $kqrl->first()->toArray();
                else 
                    $kqrl = null;
                Array_push($arrayKqrl, $kqrl);
            }
        }
        //CASE STUDENT HAVE ENOUGH SCORE
        $idlastSemester = DB::table('loaihocky')->join('hocky', 'hocky.id', 'loaihocky.id_hocky')
                            ->where([['TrangThai', '=', 1], ['TenLoaiHK', 'like', 'cuoi%']])->select('loaihocky.*')->get();

        if(count($idlastSemester)) {
            $idlastSemester =  $idlastSemester->first()->id;
            if(!in_array(null, $arrayKqht) && !in_array(null, $arrayKqrl)) {
                if(!(inMultiArray('C', $arrayKqht) || inMultiArray('H', $arrayKqht) || inMultiArray('Đ', $arrayKqrl))) {
                    if(!inNumberArray(9, $arrayKqht, $idlastSemester)) 
                        $data['text'] =  'Hoàn thành xuất sắc';
                    else 
                        if(!inNumberArray(7, $arrayKqht, $idlastSemester)) 
                            $data['text'] =  'Hoàn thành tốt';
                }
                else {
                    if(!inMultiArray('C', $arrayKqht) && !inNumberArray(5, $arrayKqht, $idlastSemester) && !inMultiArray('C', $arrayKqrl))
                        $data['text'] =  'Hoàn thành';
                    else 
                        $data['text'] = ' Chưa hoàn thành';
                }
            }
        }

        return view('admin.solienlac.assess', $data);
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
        $data['nienkhoa'] = NienKhoa::where('TrangThai', true)->first();
        $idSLL= HocSinh::find($id)->SoLienLac->where('id_nienkhoa',  $data['nienkhoa']->id)->first()->id;
        $idSemester = HocKy::where('TrangThai' ,1)->first()->id;
        $checkNhanXet = NhanXet::where([['id_sll', $idSLL], ['id_hocky', $idSemester]])->get();
        if(count($checkNhanXet) > 0) {
            $update = NhanXet::where([['id_sll', $idSLL], ['id_hocky', $idSemester]])->update(['NoiDungNhanXet' => $request->NhanXet, 'HocLuc' => $request->HocLuc]);
        }
        else {
            $data = new NhanXet();
            $data->id_sll = $idSLL;
            $data->id_hocky =  $idSemester;
            $data->NoiDungNhanXet = $request->NhanXet;
            $data->HocLuc = $request->HocLuc;
            $data->save();
        }
        if($data || $update) {
            return redirect('admin/solienlac');
        }
        
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

    public function getSeacrh(Request $request) {
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['yearCurrent'] = NienKhoa::where('TrangThai', 1)->first();
        $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $data['yearCurrent']->id)->get()->first();
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        $data['stt'] = 1;
        
        $MaHS = $request->MaHS || $request->MaHS == '0' ? '%'. $request->MaHS .'%' : ' ';
         $where = array(
            $request->Lop ? ['lop.id', $request->Lop] :'',
            $request->TenHS ? ['TenHS', 'like', $request->TenHS] : '',
            $request->MaHS ? ['MaHS', 'like', $MaHS] : '',
            ['solienlac.id_nienkhoa',   $data['yearCurrent']->id],
            ['hoc.id_nienkhoa', $data['yearCurrent']->id],
            ['lop.id_giaovien', $data['giaovien']->id]
        );
        $where = deleteValueNullOfArray($where);
        $data['solienlac'] = SoLienLac::join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                            ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                            ->join('lop', 'lop.id', 'hoc.id_lop')
                            ->where($where)->orderBy('hocsinh.TenHS', 'asc')
                            ->select('solienlac.*')->get();

        $roleUser  = Auth::guard('giao_vien')->user()->hasrole('Quản trị viên');
        if($roleUser) {
            $data['nienkhoa'] = NienKhoa::get();
            $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
            $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
            $idClass = $request->Lop != 'NULL' ? $request->Lop : NULL;
            $idGrade = $request->Khoi != 'NULL' ? $request->Khoi : NULL;
            $where = array(
                $idGrade ? ['lop.id_khoi', $idGrade] :'',
                $idClass ? ['lop.id', $idClass] :'',
                $request->TenHS ? ['TenHS', 'like', $request->TenHS] : '',
                $request->MaHS ? ['MaHS', 'like', $MaHS] : '',
                ['solienlac.id_nienkhoa',   $request->nienkhoa],
                ['hoc.id_nienkhoa', $request->nienkhoa]
            );
            $where = deleteValueNullOfArray($where);
            // dd( $where);
            $data['solienlac'] = SoLienLac::join('hocsinh', 'hocsinh.id','solienlac.id_hocsinh')
                                            ->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                                            ->join('lop', 'lop.id', 'hoc.id_lop')
                                            ->where($where)->orderBy('hocsinh.TenHS', 'asc')
                                            ->select('solienlac.*')->get();
        }
        

        return view('admin.solienlac.search', $data);
    }
}
