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
use App\Models\QuyDinhDiem;
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
        $data['hocsinh'] = array();
        $listStudy= Hoc::where('id_lop', '=', $request->id)->get();
            foreach( $listStudy as $item) {
                $listStudent = $item->HocSinh;
                array_push($data['hocsinh'], $listStudent);
            }
        return response()->json($data);
    }

    public function filterScore(Request $request) {

    //GET SCORE BY SUBJETC AND ID LOAI SEMESTER
        $where = [['id_monhoc', '=', $request->idSubject],['id_loaihocky', '=', $request->idSemester]];
        $data['kqht'] = KetQuaHocTap::where($where)->get();
    //END

    //MÔN TOÁN VÀ TIẾNG VIỆT CỦA KHỐI 4 VÀ 5 ĐƯỢC PHÉP NHẬP GIỮA HỌC KỲ
        $listSuject = MonHoc::where('TenMH', 'like', 'toan%')->orwhere('TenMH', 'like', 'tieng%viet%')->get()->toArray();
        $nameSubject = MonHoc::where('id', $request->idSubject)->value('TenMH');
        $khoi = Khoi::where('id', $request->idGrade)->value('DuocPhep');
        $loaihkg = LoaiHocKy::where([['id', '=', $request->idSemester], ['TenLoaiHK', 'like', 'giữa%' ]])->get();
    
        $data['nhapdiem1'] = 0;
        foreach($listSuject as $item) {
            if( $nameSubject == $item['TenMH'] && $khoi) {
                $data['nhapdiem1'] = $khoi;
                break;
            }
        }
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

}
