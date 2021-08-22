<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Khoi;
use App\Models\NienKhoa;
use App\Models\HocKy;
use App\Models\HocSinh;
use App\Models\Hoc;
use App\Models\KetQuaHocTap;
use App\Models\KetQuaRenLuyen;
use App\Models\MonHoc;
use App\Models\LoaiHocKy;
use App\Models\NhapDiemGiuaKy;
use App\Models\PhuHuynh;
use DB;
class FilterController extends Controller
{
    //
    public function filterClass(Request $request) {
        $data['Class'] = Khoi::find($request->id)->Lop;
        return response()->json($data);
    }
    public function filterHocKy(Request $request) {
        $data['nienkhoa'] = NienKhoa::find($request->id);

        //CHECK 
        $data['count'] = HocKy::where('id_nienkhoa', $request->id)->count();

        //IF YEAR OF COURSE HAVE ONE SEMESTER
        $data['hocky'] = HocKy::where('id_nienkhoa', $request->id)->first();
        return response()->json($data);
    }
    
    public function filterStudent(Request $request) {
        // $data['hocsinh'] = array();
        // $listStudy= Hoc::where('id_lop', '=', $request->id)->get();
        //     foreach( $listStudy as $item) {
        //         $listStudent = $item->HocSinh;
        //         array_push($data['hocsinh'], $listStudent);
        //     }
        $data['nienkhoa']  = NienKhoa::where('TrangThai', 1)->first();
        $data['hs'] = HocSinh::join('hoc', 'hoc.id_hocsinh', 'hocsinh.id')
                            ->join('lop', 'lop.id', 'hoc.id_lop')
                            ->where([['hoc.id_lop','=',$request->id],['hoc.id_nienkhoa','=', $data['nienkhoa']->id]])
                            ->get();
        return response()->json($data);
    }

    public function filterScore(Request $request) {

    //GET SCORE BY SUBJETC AND ID LOAI SEMESTER
        $where = [['id_monhoc', '=', $request->idSubject],['id_loaihocky', '=', $request->idSemester]];
        $data['kqht'] = KetQuaHocTap::where($where)->get();
    //END

    //MÔN TOÁN VÀ TIẾNG VIỆT CỦA KHỐI 4 VÀ 5 ĐƯỢC PHÉP NHẬP GIỮA HỌC KỲ
        $loaihkg = LoaiHocKy::where([['id', '=', $request->idSemester], ['TenLoaiHK', 'like', 'giữa%' ]])->get();
        $idSubject = MonHoc::where('id', $request->idSubject)->value('id');
        $idGrade = Khoi::where('id', $request->idGrade)->value('id');
        $choPhepNhapDiem = NhapDiemGiuaKy::where([['id_khoi','=' , $idGrade], ['id_monhoc','=' , $idSubject]])->get();
        if(count($choPhepNhapDiem) > 0)   $data['nhapdiem1'] = 1;
        else  $data['nhapdiem1'] = 0;
        // NẾU KHÔNG TỒN TẠI GIƯA HỌC KỲ VÀ KHÔNG PHẢI LÀ MÔN TIẾNG VIỆT HAY TOÁN
        if(!count($loaihkg) || !$data['nhapdiem1']) {
            $data['nhapdiem1'] = 0;
        }
    //END

    //CÁC MÔN HỌC ĐƯỢC PHÉP NHẬP ĐIỂM THÌ ĐƯỢC NHẬP VÀI CUÔI KỲ
        $loaihkc = LoaiHocKy::where([['id', '=', $request->idSemester], ['TenLoaiHK', 'like', 'cuối%' ]])->get();
        $data['nhapdiem2'] = MonHoc::where('id', $request->idSubject)->value('ChoPhepNhapDiem');
        if(!count($loaihkc)) {
            $data['nhapdiem2'] = 0;
        }
    //END
        return response()->json($data);
    }

    public function filterRating(Request $request) {
        $where = [['id_pcnl', '=', $request->idPCNL],['id_loaihocky', '=', $request->idSemester]];
        $kqrl = KetQuaRenLuyen::where($where)->get();
        return response()->json($kqrl);
    }
    
    public function filterRatingByScore(Request $request) {
        $data = QuyDinhDiem::where('DiemKTDK','=', $request->diem)->value('MucDanhGia');
        return response()->json($data);
    }

    public function filterSemester(Request $request) {
        
        $data['semester'] = NienKhoa::find($request->idYearOfCourse)->HocKy;

        $maNK = NienKhoa::find($request->idYearOfCourse)->toArray()['MaNK'];
        $year = explode('K',$maNK)[1];
        $count = LoaiHocKy::count();

        if($count == 0) $data['codeTypeSemester'] = 'LHK' . $year . '01';
        else{
            $idCurrent = LoaiHocKy::max('MaLoaiHK');
            $idHSArray = substr($idCurrent, strlen($idCurrent) - 1) + 1;
            if($idHSArray < 10) {
                $idHSArray =  0 .  $idHSArray;
            }
            $data['codeTypeSemester'] = 'LHK' . $year . $idHSArray;
        }
        
        return response()->json($data);
    }

    public function filterScoreBySubject(Request $request) {
        // $data = KetQuaHocTap::where('id_monhoc', $request->idSubject)->get();
        $where = [['id_monhoc','=',$request->idSubject], ['id_lop','=',$request->idClass]];
        $data['loaihocky'] = HocKy::where('TrangThai', 1)->first()->LoaiHocKy;
        $data['kqht'] = DB::table('ketquahoctap')->join('solienlac', 'ketquahoctap.id_sll', 'solienlac.id')
                    ->join('hocsinh', 'hocsinh.id', 'solienlac.id_hocsinh')
                    ->join('hoc', 'hocsinh.id', 'hoc.id_hocsinh')
                    ->join('lop', 'lop.id', 'hoc.id_lop')->where($where)->orderBy('TenHS', 'asc')->get();
        return response()->json($data);
    }

    public function removeAll(Request $request) {
        foreach ($request->array as $key => $value) {
            $checkDelete = Hoc::find($value)->delete();
        }
    }

    public function resetPass(Request $request) {
      
        $data['phuhuynh'] = PhuHuynh::find($request->id);
        return response()->json($data);
    }

}
