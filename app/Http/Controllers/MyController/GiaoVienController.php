<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DB;
use App\Models\GiaoVien;
use App\Models\Lop;
use App\Models\Phuong;
use App\Models\Tinh;
use App\Models\HocSinh;
use App\Models\PhuHuynh;

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
        $data['giaovien'] = GiaoVien::orderBy('TenGV','asc')->paginate(5);
        $data['stt'] = $data['giaovien']->firstItem();
        return view('admin.giaovien.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dem = GiaoVien::count();
        if($dem == 0) {
            $currentMaGV = 'GV00';
        }
        else {
            $currentMaGV =  GiaoVien::max('MaGV');
        }
        $array_id = explode('V',$currentMaGV);
        $array_id[0] .="V";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);

        $data['tinh'] = Tinh::get();
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
                'Hinh' => 'required|image', 'DiaChi' => 'required',
                'SoDT' => 'required|min:10|max:11|unique:giaovien', 'MatKhau' => 'required|min:8'
            ],[
                'required' => ":attribute không được để trống",
                'file' => "Bạn chưa chọn file",
                'image' => 'File tải lên phải là file hình',
                'min' => ':attribute tổi thiểu phải từ :min chữ số',
                'max' => ':attribute phải tối đa :max',
                'integer' =>'là số',
                'unique' => ':attribute đã tồn tại'
            ],[
                'Khoi' =>'Khối', 'Lop' =>'Lớp', 'Phuong' =>'Phường', 
                'Tinh' =>'Tỉnh', 'GioiTinh' =>'Giới tính', 'NgaySinh' =>'Ngày sinh',  
                'HoGV' => 'Họ','TenGV' => 'Tên', 'Hinh' => 'Hình ảnh',
                'DiaChi' => 'Địa chỉ', 'SoDT' => 'Số điện thoại', 'MatKhau' => 'mật khẩu'
        ]);

        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $file = $request->file('Hinh');
        $nameImg = $file->getClientOriginalName('Hinh');
        $file->move(
            'assets/images',// thưc mục cần lưu
            $nameImg// ten cần lưu
        );

        $data = new GiaoVien();
        $data->MaGV = $request->MaGV; $data->HoGV = ucwords($request->HoGV);
        $data->TenGV = ucwords($request->TenGV);  $data->GioiTinh = $request->GioiTinh; 
        $data->NgaySinh = $request->NgaySinh; $data->DiaChi =  ucwords($request->DiaChi); 
        $data->SoDT = $request->SoDT; $data->TaiKhoan = $request->SoDT;
        $data->password = bcrypt($request->MatKhau);
        $data->Hinh = $nameImg; $data->id_phuong = $request->Phuong;
        $check = $data->save();
        echo $check;
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
                $nameImg = GiaoVien::find($id)->toArray()['Hinh'];
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

        // $data['keySearch'] = '';

        // //IF USER DON'T SELECT DATA GET ALL CLASS ELSE GET CLASS USER SELECTA
        //     $data['lop'] = Lop::get();
        //     $data['idLop'] = Lop::where('id', $request->Lop)->value('id');
        // //END

        //GET DATA INPUT CODE TEACHER
            $data['MaGV'] = $request->MaGV ?  $request->MaGV : '';
            $data['HoTen'] = $request->TenGV ?  $request->TenGV : '';

        //IF USER DON'T SELECT DATA GET ALL PHUONG ELSE GET PHUONG USER SELECTED
            $data['phuong'] = Phuong::get();
            $data['idPhuong'] = Phuong::where('id', $request->Phuong)->value('id');

        //GET GENDER USER SELECTED
            $data['gioitinh'] = $request->GioiTinh;

        //SỐ THỨ TỰ
        $data['stt'] = 1;

       // CHECK INPUT HAVE DATA AND NOTIFINCATION IF INPUT DON'T HAVE DATA
            if(isset($request->Phuong) ||   isset($request->GioiTinh) ||  
                 isset($request->TenGV)|| isset($request->MaGV)) {

                //HANDLE CODE TEACHER WHEN USER ENTER IS ZERO
                    $MaGV = $request->MaGV || $request->MaGV == '0' ? '%'. $request->MaGV .'%' : ' ';

                //GET INFOR USER ENTERED AND CHECK IF INPUT DON'T HAVE DATA => ' '
                    $where = array(
                        $request->Phuong ? ['phuong.id', '=', $request->Phuong] : '',
                        $request->GioiTinh ? ['GioiTinh', '=', $request->GioiTinh] : '',
                        $request->TenGV ? ['TenGV', 'like',  '%'. $request->TenGV .'%'] : '',
                        $request->MaGV ? ['MaGV', 'like', $MaGV] : '',
                    );
                    //DELETE ' ' IN ARRAY
                    foreach($where as $key => $value) {
                        if($value == NULL) {
                            unset($where[$key]);
                        }
                    }
                    // dd($where);
            // GET DATA WITH WHERE FORM VALIABLE IS WHERE
                $data['giaovien'] = DB::table('giaovien')->join('phuong', 'phuong.id','giaovien.id_phuong')
                                        ->where($where)->select('giaovien.*')->get();
            }
            else {
                return redirect()->back()->with('noti', 'Yêu cầu bạn nhập dữ liệu');
            }
        return view('admin.giaovien.search', $data);
}

}
