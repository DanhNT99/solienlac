<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Auth, DB;
use App\Models\Khoi;
use App\Models\Lop;
use App\Models\Phuong;
use App\Models\Tinh;
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
        $data['tinh'] = Tinh::get();
        $data['hocsinh'] = HocSinh::orderBy('TenHS', 'asc')->paginate(20);
        $data['stt'] =  $data['hocsinh']->firstItem();
        
        $roleUser  = Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm');
        if($roleUser) {
            $data['hocsinh'] = Array();
            $idGiaoVien = Auth::guard('giao_vien')->user()->id;
            $namhoc = NienKhoa::where('TrangThai' ,1)->get()->first()->toArray()['id'];
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
        $data['tinh'] = Tinh::get();
        $data['nienkhoa'] = NienKhoa::get();

        $MaNK = NienKhoa::where('TrangThai', 1)->get()->toArray()[0]['MaNK'];
        $MaNK = explode('K',$MaNK);
        $count = HocSinh::count();

        if($count == 0) $idCurrent = 'HS' . $MaNK[1] . '01';
        else{
            $idCurrent =  HocSinh::max('MaHS');
            $idHSArray = explode('S',$idCurrent);
            $idHSArray[0] .= "S";
            $idHSArray[1] = intval($idHSArray[1]) + 1;
            $idHSArray = implode('', $idHSArray);
        }
        $data['idHocSinh'] = $idHSArray;
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
        [
            'HoHS' => 'required',
        // 'Lop' => 'required', 'Phuong' => 'required',
        // 'GioiTinh' => 'required', 'NgaySinh' => 'required', 
        // 'Hinh' => 'required|image' ,, 'TenHS' => 'required', 
        // 'DiaChi' => 'required',
            'HoTen.cha' => 'required','HoTen.me' => 'required',
            'NgheNghiep.cha' => 'required',  'NgheNghiep.me' => 'required',
            'NoiLamViec.cha' => 'required',  'NoiLamViec.me' => 'required', 
            'SoDT.cha' => 'required|min:10|max:11|unique:phuhuynh,SoDT', 
            'SoDT.me' => 'required|min:10|max:11|unique:phuhuynh,SoDT', 
            'MatKhau.cha' => 'required|min:8', 'MatKhau.me' => 'required|min:8'

      ],[
        'required' => ":attribute không được để trống",
        'file' => "Bạn chưa chọn file",
        'image' => 'File tải lên phải là file hình',
        'min' => ':attribute tối thiểu phải từ :min chữ số',
        'max' => ':attribute phải tối đa :max',
        'integer' =>'là số',
        'unique' => ':attribute đã tồn tại'
      ],[
        //   'Khoi' =>'Khối', 'Lop' =>'Lớp', 'Phuong' =>'Phường', 
        //   'Tinh' =>'Tỉnh', 'GioiTinh' =>'Giới tính', 'NgaySinh' =>'Ngày sinh',  
            'HoHS' => 'Họ','TenHS' => 'Tên', 'Hinh' => 'Hình ảnh', 'DiaChi' => 'Địa chỉ',
            'HoTen.cha' => 'Họ tên cha', 'HoTen.me' => 'Họ tên mẹ',
            'NgheNghiep.cha' => 'Nghề nghiệp cha', 'NgheNghiep.me' => 'Nghề nghiệp me',
            'SoDT.cha' => 'Số điện thoại cha', 'SoDT.me' => 'Số điện thoại me',
            'NoiLamViec.cha' => 'Nơi làm việc cha', 'NoiLamViec.me' => 'Nơi làm việc me', 
            'MatKhau.cha' => 'Mật khẩu cha', 'MatKhau.me' => 'Mật khẩu me', 
          
      ]);
    //   dd($request->HoTen);


        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }



    //uplload file image up folder
        $file = $request->file('Hinh');
        $nameImg = $file->getClientOriginalName('Hinh');
        $file->move(
            'assets/images', // thưc mục cần lưu
            $nameImg // ten cần lưu
        );
    //end
        // dd($request->all());
        foreach($request->HoTen as $key => $item) {

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
            $dataPH->TaiKhoan = $request->SoDT[$key];
            $dataPH->password = bcrypt($request->MatKhau[$key]);
            $dataPH->save();
        }

    
    //add student for database
        $data = new HocSinh();
        $data->MaHS = $request->MaHS; $data->HoHS = ucwords($request->HoHS);
        $data->TenHS = ucwords($request->TenHS);  $data->GioiTinh = $request->GioiTinhHS; 
        $data->NgaySinh = $request->NgaySinh; $data->DiaChi = ucwords($request->DiaChi); 
        $data->Hinh = $nameImg;
        $data->id_phuong = $request->Phuong;
        $chekAdd = $data->save();
    //end

    //get id student
        $idStudent = HocSinh::where('MaHS', $request->MaHS)->value('id');

    //create detail family
        foreach($request->SoDT as $item) {
            $idPhuhuynh = PhuHuynh::where('SoDT', '=', $item)->value('id');
            $data = new ChiTietGiaDinh();
            $data->id_hocsinh = $idStudent;
            $data->id_phuhuynh = $idPhuhuynh;
            $data->save();
        }      

    //end 

    //create contact book for new student
        //create new code for contact book
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
        $data->MaSLL =  $idHSArray;
        $data->id_hocsinh = $idStudent;
        $data->id_nienkhoa = NienKhoa::where('TrangThai', 1)->get()->toArray()[0]['id'];
        $data->save();
    //end
    
    //check see added và notification
        if($chekAdd) {
            return redirect('admin/hocsinh')->with('noti','Thêm thành công học sinh');
        }
        else {
            return redirect()->back()->withInput()->with('noti','Thêm không thành công');
        }
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
            'GioiTinh' => 'required', 'NgaySinh' => 'required', 
           'DiaChi' => 'required', 'Phuong' => 'required',
            'HoTen.cha' => 'required','HoTen.me' => 'required',
            'NgheNghiep.cha' => 'required',  'NgheNghiep.me' => 'required',
            'NoiLamViec.cha' => 'required',  'NoiLamViec.me' => 'required', 
            'SoDT.cha' => 'required|min:10|max:11', 
            'SoDT.me' => 'required|min:10|max:11'

      ],[
        'required' => ":attribute không được để trống",
        'file' => "Bạn chưa chọn file",
        'min' => ':attribute tối thiểu phải từ :min chữ số',
        'max' => ':attribute phải tối đa :max',
        'integer' =>'là số',
        'unique' => ':attribute đã tồn tại'
      ],[
            'HoHS' => 'Họ','TenHS' => 'Tên', 'DiaChi' => 'Địa chỉ',
            'HoTen.cha' => 'Họ tên cha', 'HoTen.me' => 'Họ tên mẹ',
            'NgheNghiep.cha' => 'Nghề nghiệp cha', 'NgheNghiep.me' => 'Nghề nghiệp mẹ',
            'SoDT.cha' => 'Số điện thoại cha', 'SoDT.me' => 'Số điện thoại mẹ',
            'NoiLamViec.cha' => 'Nơi làm việc cha', 'NoiLamViec.me' => 'Nơi làm việc mẹ'
          
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
                                    'SoDT' => $request->SoDT[$key],
            ]);
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

        //IF USER DON'T SELECT DATA GET ALL GRADE ELSE GET GRAD USER SELECTA
           $data['khoi'] = Khoi::get();
           $data['idKhoi'] = Khoi::where('id', $request->Khoi)->value('id');
       //END

        //IF USER DON'T SELECT DATA GET ALL CLASS ELSE GET CLASS USER SELECTA
           $data['lop'] = Lop::get();
           $data['idLop'] = Lop::where('id', $request->Lop)->value('id');
        //END

        //IF USER DON'T SELECT DATA GET ALL PHUONG ELSE GET PHUONG USER SELECTED
            $data['phuong'] = Phuong::get();
            $data['idPhuong'] = Phuong::where('id', $request->Phuong)->value('id');

        //GET DATA INPUT CODE TEACHER
            $data['MaHS'] = $request->MaHS ?  $request->MaHS : '';
            $data['TenHS'] = $request->TenHS ?  $request->TenHS : '';

        //GET GENDER USER SELECTED
            $data['gioitinh'] = $request->GioiTinh;

            // CHECK INPUT HAVE DATA AND NOTIFINCATION IF INPUT DON'T HAVE DATA
                if( isset($request->Khoi) ||  isset($request->Lop) ||   isset($request->Phuong) ||  
                isset($request->GioiTinh) ||   isset($request->TenHS) || isset($request->MaHS)) {
                    //HANDLE CODE TEACHER WHEN USER ENTER IS ZERO
                        $MaHS = $request->MaHS || $request->MaHS == '0' ? '%'. $request->MaHS .'%' : ' ';

                    //GET INFOR USER ENTERED AND CHECK IF INPUT DON'T HAVE DATA => ' '
                    $where = array(
                        $request->Khoi ? ['khoi.id', '=', $request->Khoi] : '',
                        $request->Lop ? ['khoi.id', '=', $request->Lop] : '',
                        $request->Phuong ? ['phuong.id', '=', $request->Phuong] : '',
                        $request->GioiTinh ? ['GioiTinh', '=', $request->GioiTinh] : '',
                        $request->TenHS ? ['TenHS', 'like', '%'. $request->TenHS .'%'] : '',
                        $request->MaHS ? ['MaHS', 'like', $MaHS] : '',
                    );

                    $roleUser  = Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm');
                    if( $roleUser) {
                        $idGiaoVien = Auth::guard('giao_vien')->user()->id;
                        $idLop = Lop::where('id_giaovien', $idGiaoVien)->first()->toArray()['id'];
                        $where = array(
                            $request->Khoi ? ['khoi.id', '=', $request->Khoi] : '',
                            ['Lop.id', '=', $idLop],
                            $request->Phuong ? ['phuong.id', '=', $request->Phuong] : '',
                            $request->GioiTinh ? ['GioiTinh', '=', $request->GioiTinh] : '',
                            $request->TenHS ? ['TenHS', 'like', '%'. $request->TenHS .'%'] : '',
                            $request->MaHS ? ['MaHS', 'like', $MaHS] : '',
                        );

                    }


                    //DELETE ' ' IN ARRAY
                    foreach($where as $key => $value) {
                        if($value == NULL) unset($where[$key]);
                    }

                $data['hocsinh'] = DB::table('khoi')->join('lop', 'khoi.id', '=','lop.id_khoi')
                                ->join('hoc', 'hoc.id_lop', '=', 'lop.id')->join('hocsinh', 'hoc.id_hocsinh' , '=', 'hocsinh.id')
                                ->join('phuong', 'phuong.id' , '=', 'hocsinh.id_phuong')->where($where)->get();
            }
            else {
                return redirect()->back()->with('noti', 'Yêu cầu bạn nhập dữ liệu');
            }
            
            return view('admin.hocsinh.search', $data);
    }

}
