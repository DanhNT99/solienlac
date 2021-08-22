<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Auth, DB;
use App\Models\Khoi;
use App\Models\Lop;
use App\Models\Phuong;
use App\Models\HocSinh;
use App\Models\PhuHuynh;
use App\Models\Nienkhoa;
use App\Models\SoLienLac;
use App\Models\Hoc;
use App\Models\ChiTietGiaDinh;

class HocSinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    // public function __construct()
    // {
    //     $this->middleware('AuthCheck');
    // }

    public function index()
    {   
        $data['nienkhoa'] = NienKhoa::where('TrangThai' ,1)->first();
        $data['khoi'] = Khoi::get();
        $data['lop'] = Lop::get();
        $data['phuong'] = Phuong::orderBy('TenPhuong', 'asc')->get();
        $data['hocsinh'] = HocSinh::orderBy('MaHS', 'asc')->get();
        $data['stt'] =  1;
        
        $roleUser  = Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm');
        if($roleUser) {
            $data['hocsinh'] = Array();
            $idGiaoVien = Auth::guard('giao_vien')->user()->id;
            $namhoc = NienKhoa::where('TrangThai' ,1)->first()->id;
            $lopByTeach = Lop::where('id_giaovien', $idGiaoVien)->first();
            $hoc = $lopByTeach->Hoc->where('id_nienkhoa',$namhoc);
            foreach($hoc as $item) {
                $hocsinh = HocSinh::find($item['id_hocsinh']);
                Array_push($data['hocsinh'], $hocsinh);
            }
        }
        return view('admin.hocsinh.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idGiaoVien = Auth::guard('giao_vien')->user()->id;
        $data['lop'] = Lop::where('id_giaovien', $idGiaoVien)->first();
        $data['phuong'] = Phuong::orderBy('TenPhuong', 'asc')->get();
        $data['nienkhoa'] = NienKhoa::get();

        $MaNK = NienKhoa::where('TrangThai', 1)->first()->MaNK;
        // $MaNK = explode('K',$MaNK);
        // $count = HocSinh::count();

        // if($count == 0) $MaHS = 'HS' . $MaNK[1] . '01';
        // else{
        //     $idCurrent =  HocSinh::max('MaHS');
        //     $idHSArray = explode('S',$idCurrent);
        //     $idHSArray[0] .= "S";
        //     $idHSArray[1] = intval($idHSArray[1]) + 1;
        //     $MaHS = implode('', $idHSArray);
        // }

        $MaNK = explode('K',$MaNK)[1];
        $strMaSLL = 'HS' . $MaNK;
        $idCurrent =  SoLienLac::max('MaSLL');
        $idCurrent = intval(substr($idCurrent, 7)) + 1;
        $idSLLNew = $strMaSLL . $idCurrent;
        $data['MaHS'] = $idSLLNew;
        return view('admin.hocsinh.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
        ['HoHS' => 'required','TenHS' => 'required',
        'GioiTinhHS' => 'required', 'NgaySinh' => 'required', 
        'Hinh' => 'image','DiaChi' => 'required', 'Phuong' => 'required',
        'SoDT.cha' => 'bail|nullable|regex:/^[0-9]*$/|min:10|max:11', 
        'SoDT.me' => 'bail|nullable|regex:/^[0-9]*$/|min:10|max:11',
        'MatKhau.cha' => 'bail|nullable|regex:/^[a-zA-Z0-9]*$/|min:8',
        'MatKhau.me' => 'bail|nullable|regex:/^[a-zA-Z0-9]*$/|min:8'],

        ['required' => ":attribute không được để trống",
        'image' => 'File tải lên phải là file hình',
        'min' => ':attribute tổi thiểu phải từ :min chữ số',
        'max' => ':attribute phải tối đa :max chữ số',
        'regex' =>':attribute phải là ký tự số',
        'MatKhau.cha.regex' => ':attribute không được chưa ký tự đặc biệt',
        'MatKhau.me.regex' => ':attribute không được chưa ký tự đặc biệt'],

        ['Phuong' =>'Phường', 'GioiTinhHS' =>'Giới tính', 'NgaySinh' =>'Ngày sinh',  
        'HoHS' => 'Họ','TenHS' => 'Tên', 'Hinh' => 'Hình ảnh', 'DiaChi' => 'Địa chỉ', 
        'SoDT.cha' => 'Số điện thoại', 'SoDT.me' => 'Số điện thoại',
        'MatKhau.cha' => 'Mật khẩu', 'MatKhau.me' => 'Mật khẩu'
        ]);

        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

    //UPLOAD FILE IMAGES UP FOLDER
        $file = $request->file('Hinh');
        switch($file) {
            case null:  $nameImg = null; break;
            default: 
                $nameImg = $file->getClientOriginalName('Hinh');
                $file->move( 'assets/images', $nameImg );
        }
    //END

    //ADD STUDENT IN DATABASE
        $data = new HocSinh();
        $data->MaHS = $request->MaHS; $data->HoHS = ucwords($request->HoHS);
        $data->TenHS = ucwords($request->TenHS);  $data->GioiTinh = $request->GioiTinhHS; 
        $data->NgaySinh = $request->NgaySinh; $data->DiaChi = ucwords($request->DiaChi); 
        $data->Hinh = $nameImg;
        $data->id_phuong = $request->Phuong;
        $chekAdd = $data->save();
        $idStudent = HocSinh::where('MaHS', $request->MaHS)->value('id'); //GET IDSTUDENT
    //END
    //CHECK PARENT? 
        $inforFather = PhuHuynh::where([['soDT', $request->SoDT['cha']],['GioiTinh', 'Nam']])->get();
        $inforMother = PhuHuynh::where([['soDT', $request->SoDT['me']],['GioiTinh', 'Nu']])->get();
        if(count($inforFather) || count($inforMother)) {
            if(count($inforFather)) {
                $data = new ChiTietGiaDinh();
                $data->id_hocsinh = $idStudent;
                $data->id_phuhuynh = $inforFather->first()->id;
                $data->save();
            }
            if(count($inforMother)) {
                $data = new ChiTietGiaDinh();
                $data->id_hocsinh = $idStudent;
                $data->id_phuhuynh = $inforMother->first()->id;
                $data->save();
            }
        }   
        else {
        //ADD PARENT IN DATABASE
            foreach($request->HoTen as $key => $item) {
                if($item != Null) {
                    $count = PhuHuynh::count();
                    if($count == 0) $idCurrent = 'PH00';
                    else $idCurrent =  PhuHuynh::max('MaPH');
                
                    $idCurrent = explode('H',$idCurrent);
                    $idCurrent[0] .= "H";
                    $idCurrent[1] = intval($idCurrent[1]) + 1;
                    if($idCurrent[1] < 10) {
                        $idCurrent[1] = "0" . $idCurrent[1];
                    }
                    $idCurrent = implode('', $idCurrent);
    
                    $dataPH = new PhuHuynh();
                    $dataPH->MaPH =  $idCurrent;
                    $dataPH->HoTenPH = ucwords($item);
                    $dataPH->GioiTinh = $request->GioiTinh[$key];
                    $dataPH->NgheNghiep = $request->NgheNghiep[$key];
                    $dataPH->NoiLamViec = $request->NoiLamViec[$key];
                    $dataPH->SoDT = $request->SoDT[$key];
                    $dataPH->password = bcrypt($request->MatKhau[$key]);
                    $dataPH->save();

                    $data = new ChiTietGiaDinh();
                    $data->id_hocsinh = $idStudent;
                    $data->id_phuhuynh = $dataPH->id;
                    $data->save();
                }
            }
        }
    //CREATE CONTACT BOOK FOR SUTDENT
        $MaNK = NienKhoa::where('TrangThai', 1)->get()->toArray()[0]['MaNK'];
        $MaNK = explode('K',$MaNK)[1];
        $count = SoLienLac::count();

        if($count == 0) $idHSArray = 'SLL' . $MaNK . '01';
        else{
            $idCurrent =  SoLienLac::max('MaSLL');
            $idHSArray = explode('L',$idCurrent);
            $idHSArray[0] .= "LL";
            $idHSArray[2] = intval($idHSArray[2]) + 1;
            $idHSArray = implode('', $idHSArray);
            echo $idHSArray;
        }

        $data = new SoLienLac;
        $data->MaSLL = $idHSArray;
        $data->id_hocsinh = $idStudent;
        $data->id_nienkhoa = NienKhoa::where('TrangThai', 1)->get()->toArray()[0]['id'];
        $data->save();
    //END
    
    //check see added và notification
        if($chekAdd)  return redirect('admin/hocsinh')->with('noti','Thêm thành công học sinh');
        else  return redirect()->back()->withInput()->with('noti','Thêm không thành công'); 
    //end
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
        $data['hocsinh'] = HocSinh::find($id);
        return view('admin.hocsinh.detail', $data);
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
        $data['khoi'] = Khoi::get();
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->get();
        $data['phuong'] = Phuong::get();
        $data['hocsinh'] = HocSinh::find($id);
        return view('admin.hocsinh.edit', $data);

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

    //VALIDATE INPUT
    $validate = Validator::make($request->all(),
        [
            'HoHS' => 'required','TenHS' => 'required' ,
            'GioiTinh' => 'required', 'DiaChi' => 'required',
            'SoDT.me' => 'bail|nullable|regex:/^[0-9]*$/|min:10|max:11',
            'SoDT.cha' => 'bail|nullable|regex:/^[0-9]*$/|min:10|max:11'
      ],[
        'required' => ":attribute không được để trống",
        'min' => ':attribute tối thiểu phải từ :min chữ số',
        'max' => ':attribute phải tối đa :max',
        'regex' =>':attribute phải là ký tự số'
      ],[
            'HoHS' => 'Họ','TenHS' => 'Tên', 'DiaChi' => 'Địa chỉ',
            'SoDT.me' => 'Số điên thoại', 'SoDT.cha' =>'Số điên thoại'
      ]);
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

    //UPDATE INFOR STUDENT

         //GET NAME IMAGE AND UPLOAD UP FOLDER
         $file = $request->file('Hinh');
         if($file) {
             $nameImg = $file->getClientOriginalName('Hinh');
             $file->move(
                 'assets/images', // FOLDER NEED SAVE
                 $nameImg // NAME NEED SAVE
             );
         }
         else {
             $nameImg = HocSinh::find($id)->toArray()['Hinh'];
         }
        //END
        $updateStudent  = HocSinh::where('id', $id)
                                    ->update(['HoHS' => ucwords($request->HoHS),'TenHS' => ucwords($request->TenHS),
                                            'GioiTinh' => $request->GioiTinh, 'NgaySinh' => $request->NgaySinh,
                                            'DiaChi' => ucwords($request->DiaChi),'id_phuong' => $request->Phuong,
                                            'Hinh' => $nameImg]);

    //UPDATE INFOR TO PARENT OF STUDENT
        foreach($request->MaPH as $key => $value) {
            $updateStudent = PhuHuynh::where('MaPH', $value)
                            ->update(['HoTenPH' => ucwords($request->HoTen[$key]),
                                    'GioiTinh' => $request->GioiTinhPH[$key],
                                    'NgheNghiep' => $request->NgheNghiep[$key],
                                    'NoiLamViec' => $request->NoiLamViec[$key],
                                    'SoDT' => $request->SoDT[$key]]);
        }    
    //END                                  
        if($updateStudent)
            return redirect('admin/hocsinh/' . $id)->with('noti', 'Chỉnh sửa thành công');
        else 
            return redirect('admin/hocsinh')->back()->with('noti', 'Chỉnh sửa thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id) {
        
     $data['hocsinh'] = HocSinh::find($id);
        return view('admin.hocsinh.delete', $data);
     }
    public function destroy($id)
    {
        //
        $data = ChiTietGiaDinh::where('id_hocsinh', $id)->get();
        if(count($data)) {
            foreach($data as $key =>$item) {
                $phuhuynh = PhuHuynh::find($item->id_phuhuynh)->delete();
            }
        }
        $checkDelete = HocSinh::find($id)->delete();
        if( $checkDelete ) {
            return redirect('admin/hocsinh')->with('noti', 'Xóa học sinh thành công');
        }
        else {
            return redirect('admin/hocsinh')->with('noti', 'Xóa học sinh thất bại');
        }
        
    }

    public function getSearch(Request $request) { 
        $data['stt'] = 1;
        $data['phuong'] = Phuong::get();

    //HANDLE CODE TEACHER WHEN USER ENTER IS ZERO
        $MaHS = $request->MaHS || $request->MaHS == '0' ? '%'. $request->MaHS .'%' : ' ';

    //GET DATA USER ENTERED AND CHECK IF INPUT DON'T HAVE DATA => ' '
        $where = array(
            $request->Phuong ? ['id_phuong', $request->Phuong] : '',
            $request->GioiTinh ? ['GioiTinh', $request->GioiTinh] : '',
            $request->TenHS ? ['TenHS', 'like', '%'. $request->TenHS .'%'] : '',
            $request->MaHS ? ['MaHS', 'like', $MaHS] : '',
        );
        $where = deleteValueNullOfArray($where);
            $data['hocsinh'] = HocSinh::where($where)->get();
        return view('admin.hocsinh.search', $data);
    }

}
