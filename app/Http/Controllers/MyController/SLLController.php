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
use Auth, DB;

class SLLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['solienlac'] = SoLienLac::get();
        $data['stt'] = 1;
        return view('admin.solienlac.index', $data);
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
        $data['monhoc'] = DB::table('hocsinh')->join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                        ->join('lop', 'lop.id', 'hoc.id_Lop')->join('khoi', 'khoi.id', 'lop.id_khoi')
                        ->join('phanmonhoc', 'phanmonhoc.id_khoi', 'khoi.id')->join('monhoc', 'monhoc.id', 'phanmonhoc.id_monhoc')
                        ->where('hocsinh.id', $id)->select('monhoc.*')->orderBy('ChoPhepNhapDiem', 'desc')->get();
                        
        $data['hocsinh'] = HocSinh::find($id);
        $daata['solienlac'] =  HocSinh::find($id)->SoLienLac;
        $data['nienkhoa'] = NienKhoa::where('TrangThai', true)->first();
        $data['hocky'] = HocKy::where('TrangThai', true)->first();
        $data['listPCNL'] = PhamChatNangLuc::get();
        $data['countNL'] = PhamChatNangLuc::where('LoaiPCNL', 1)->count();
        $data['countPC'] = PhamChatNangLuc::where('LoaiPCNL', 2)->count();

        //GET AVALUATE
        $data['text'] = '';
        $idGrade = Hocsinh::find($id)->Hoc->Lop->Khoi->toArray()['id'];
        $listIDSubject = DB::table('khoi')->join('phanmonhoc', 'phanmonhoc.id_khoi', 'khoi.id')
                ->join('monhoc', 'monhoc.id', 'phanmonhoc.id_monhoc')
                ->where('khoi.id', $idGrade)->select('monhoc.id')->get();
        $listTypeSemester = HocKy::where('TrangThai', true)->first()->LoaiHocKy;
        $idContactBook = HocSinh::find($id)->SoLienLac->toArray()['id'];
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
                            ->where([['TrangThai', '=', 1], ['TenLoaiHK', 'like', 'cuoi%']])->get()->toArray();
        if(in_array(null, $arrayKqht) || in_array(null, $arrayKqrl)) {
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
        
        $idSLL= HocSinh::find($id)->SoLienLac->toArray()['id'];
        $data = SoLienLac::where('id',$idSLL)->update(['NhanXet' => $request->NhanXet, 'HocLuc' => $request->HocLuc]);
        if($data) {
            return redirect()->back();
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
}
