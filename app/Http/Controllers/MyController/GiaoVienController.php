<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DB, Excel;
use App\Models\GiaoVien;
use App\Models\Lop;
use App\Models\Phuong;
use App\Models\HocSinh;
use App\Models\PhuHuynh;
use App\Imports\ImportTeach;
class GiaoVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data['phuong'] = Phuong::get();
        $data['lop'] = Lop::orderBy('TenLop','asc')->get();
        $data['giaovien'] = GiaoVien::orderBy('MAGV','asc')->paginate(20);
        $data['stt'] = $data['giaovien']->firstItem();
        return view('admin.giaovien.index', $data);
    }
    
    public function importExcel(Request $request) {
        $validate = Validator::make($request->all(),
            ['fileExcel' => 'mimes:xlsx,csv, xls'],
            ['mimes' => "Bạn chưa chọn file excel"],
            ['fileExcel' => '']);
       
        if($validate->fails()) {
        return redirect()->back()->with('noti', 'Vui lòng chọn file Excel ');
        }
        Excel::import(new ImportTeach, $request->fileExcel);
        return redirect('admin/giaovien')->with('noti', 'Thêm giao viên thành công');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dem = GiaoVien::count();
        if($dem == 0) $currentMaGV = 'GV00';
        else $currentMaGV =  GiaoVien::max('MaGV');
        $array_id = explode('V',$currentMaGV);
        $array_id[0] .= "V";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) $array_id[1] = "0" . $array_id[1];
        $data['text_id'] = implode('', $array_id);
        $data['phuong'] = Phuong::orderBy('TenPhuong', 'asc')->get();
        return view('admin.giaovien.create', $data);
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
            [
                'Phuong' => 'required', 
                'HoGV' => 'required', 'TenGV' => 'required',  
                'NgaySinh' => 'required', 'GioiTinh' => 'required',
                'Hinh' => 'image', 'DiaChi' => 'required',
                'SoDT' => 'bail|required|regex:/^[0-9]*$/|min:10|max:11|unique:giaovien',
                'MatKhau' => 'bail|required|regex:/^[a-zA-Z0-9]*$/|min:8'
            ],[
                'required' => ":attribute không được để trống",
                'file' => "Bạn chưa chọn file",
                'image' => 'File tải lên phải là file hình',
                'min' => ':attribute tổi thiểu phải từ :min chữ số',
                'max' => ':attribute phải tối đa :max',
                'regex' =>':attribute phải là ký tự số',
                'unique' => ':attribute đã tồn tại',
                'MatKhau.regex' => ':attribute không được chưa ký tự đặc biệt'
            ],[
                'Phuong' =>'Phường', 'GioiTinh' =>'Giới tính', 'NgaySinh' =>'Ngày sinh',  
                'HoGV' => 'Họ','TenGV' => 'Tên', 'Hinh' => 'Hình ảnh',
                'DiaChi' => 'Địa chỉ', 'SoDT' => 'Số điện thoại', 'MatKhau' => 'mật khẩu'
        ]);

        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
    //CHECK HAVE FILE
        $file = $request->file('Hinh');
        switch($file) {
            case null:  $nameImg = null; break;
            default: 
                $nameImg = $file->getClientOriginalName('Hinh');
                $file->move( 'assets/images', $nameImg );
        }
        $data = new GiaoVien();
        $data->MaGV = $request->MaGV; $data->HoGV = ucwords($request->HoGV);
        $data->TenGV = ucwords($request->TenGV);  $data->GioiTinh = $request->GioiTinh; 
        $data->NgaySinh = $request->NgaySinh; $data->DiaChi =  ucwords($request->DiaChi); 
        $data->SoDT = $request->SoDT; $data->password = bcrypt($request->MatKhau);
        $data->Hinh = $nameImg; $data->id_phuong = $request->Phuong;
        $check = $data->save();
        if($check) {
            return redirect('admin/giaovien')->with('noti', 'Thêm giao viên thành công');
        }
        else {
            return redirect()->back()->with('noti', 'Thêm không thành công');
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
        $data['giaovien'] = GiaoVien::find($id);
        return view('admin.giaovien.detail', $data);
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

        // $data['khoi'] = Khoi::get();
        // $data['lop'] = Lop::get();
        $data['phuong'] = Phuong::get();
        $data['giaovien'] = GiaoVien::find($id);
        return view('admin.giaovien.edit', $data);
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
        ['HoGV' => 'required', 'TenGV' => 'required', 
        'Hinh' => 'image', 'DiaChi' => 'required', 
        'SoDT' => 'required|regex:/^[0-9]*$/|min:10|max:11',
        ],[
            'required' => ":attribute không được để trống",
            'image' => 'File tải lên phải là file hình',
            'min' => ':attribute tổi thiểu phải từ :min chữ số',
            'max' => ':attribute phải tối đa :max',
            'regex' =>':attribute phải là ký tự số',
        ],[
            'HoGV' => 'Họ','TenGV' => 'Tên', 'Hinh' => 'Hình ảnh',
            'DiaChi' => 'Địa chỉ', 'SoDT' => 'Số điện thoại'
        ]);

        if($validate->fails()) return redirect()->back()->withInput()->withErrors($validate);
        
       
    //GET NAME IMAGE AND UPLOAD UP FOLDER
        $file = $request->file('Hinh');
        switch($file) {
            case null:  
                $nameImg = GiaoVien::find($id)->toArray()['Hinh'];
                break;
            default: 
                $nameImg = $file->getClientOriginalName('Hinh');
                $file->move( 'assets/images',   $nameImg  );
                break;
        }   
    //GET INFOR FROM INPUT
        $infor = [
            'HoGV' => $request->HoGV,'TenGV' =>$request->TenGV,
            'GioiTinh' => $request->GioiTinh,'NgaySinh' => $request->NgaySinh,
            'DiaChi' => $request->DiaChi,'id_phuong' => $request->Phuong,
            'Hinh' => $nameImg,'SoDT' => $request->SoDT
        ];

        //UPDATE TEACH
            $updateTeach  = GiaoVien::where('id', $id)->update($infor);

        //CHECK UPDATE AND NOTIFINECAITON
            if($updateTeach)
                return redirect('admin/giaovien/' . $id)->with('noti', 'Chỉnh sửa thành công');
            else 
                return redirect('admin/giaovien')->back()->with('noti', 'Chỉnh sửa thất bại');
    }

    public function delete($id) {
        
        $data['giaovien'] = GiaoVien::find($id);
        return view('admin.giaovien.delete', $data);
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
        $checkDelete = GiaoVien::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/giaovien')->with('noti', 'Xóa giáo viên thành công');
        }
        else {
            return redirect('admin/giaovien')->with('noti', 'Xóa giáo viên thất bại');
        }
        
    }

    public function getSearch(Request $request) {

        $data['stt'] = 1;
        $data['phuong'] = Phuong::get();
    // CHECK INPUT HAVE DATA AND NOTIFINCATION IF INPUT DON'T HAVE DATA
        if(isset($request->Phuong) ||   isset($request->GioiTinh) ||  
                isset($request->TenGV)|| isset($request->MaGV)) {
            //HANDLE CODE TEACHER WHEN USER ENTER IS ZERO
                $MaGV = $request->MaGV || $request->MaGV == '0' ? '%'. $request->MaGV .'%' : ' ';

            //GET INFOR USER ENTERED AND CHECK IF INPUT DON'T HAVE DATA => ' '
                $where = array(
                    $request->Phuong ? ['id_phuong', $request->Phuong] : '',
                    $request->GioiTinh ? ['GioiTinh', $request->GioiTinh] : '',
                    $request->TenGV ? ['TenGV', 'like',  '%'. $request->TenGV .'%'] : '',
                    $request->MaGV ? ['MaGV', 'like', $MaGV] : '',
                );
                $where = deleteValueNullOfArray($where);
        // GET DATA WITH WHERE FORM VALIABLE IS WHERE
            $data['giaovien'] = GiaoVien::where($where)->get();
        }
        else {
            return redirect()->back()->with('noti', 'Yêu cầu bạn nhập dữ liệu');
        }
        return view('admin.giaovien.search', $data);
    }
}
