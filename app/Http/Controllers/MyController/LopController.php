<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Lop;
use App\Models\Khoi;
use App\Models\GiaoVien;
use Spatie\Permission\Models\Role;


class LopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['lop'] = Lop::orderBy('TenLop', 'asc')->paginate(10);
        $data['stt'] = $data['lop']->firstItem();
        return view ('admin.lop.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dem = Lop::count();
        if($dem == 0)  $currentMaLop = 'L00';
        else $currentMaLop =  Lop::max('MaLop');
        $array_id = explode('L',$currentMaLop);
        $array_id[0] .="L";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['giaovien'] = array();
        foreach(GiaoVien::with('Lop')->get()->toArray() as $gv){
           if($gv['lop'] == null) {
               array_push($data['giaovien'], $gv);
           }
        }
        return view ('admin.lop.create', $data);
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
            ['TenLop' => 'required', 'khoi' => 'required',
            'giaovien' => 'required'],
            ['required' => ":attribute không được để trống"],
            ['TenLop' =>'Tên lớp', 'khoi' => 'Tên khối',
            'giaovien' => 'Tên giáo viên']);
        
        if($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $checkClass = Lop::where(['TenLop' => $request->TenLop, 'id_khoi' => $request->khoi])->get();
        if(count($checkClass)) {
            return redirect()->back()->withInput()->with('noti', 'Dữ liêu này đã tồn tại');
        }
        $data = new Lop();
        $data->MaLop = $request->MaLop;
        $data->TenLop = $request->TenLop;
        $data->id_khoi = $request->khoi;
        $data->id_giaovien = $request->giaovien;
        $check = $data->save();
        $giaovien = GiaoVien::find($request->giaovien);
        $idRole = Role::where('name', 'Giáo viên chủ nhiệm')->first()->id;
        $check = $giaovien->assignRole(['id'=> $idRole]);
        if($check) {
            return redirect('admin/lop')->with('noti', 'Thêm lớp thành công');
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
        $data['lop'] = Lop::find($id);
        return view('admin.lop.detail', $data);
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
        $giaovienht = GiaoVien::select('giaovien.*')->join('lop', 'lop.id_giaovien', 'giaovien.id')
                            ->where('lop.id', $id)->first()->toArray();
        $data['giaovien'] = array();
        array_push($data['giaovien'], $giaovienht);
        foreach(GiaoVien::with('Lop')->get()->toArray() as $gv){
           if($gv['lop'] == null) {
               array_push($data['giaovien'], $gv);
           }
        }
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['lop'] = Lop::find($id);
        return view('admin.lop.edit', $data);
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
        $updateLop = Lop::where('id', $id)->update(['id_giaovien' => $request->giaovien,
                                                        'id_khoi' => $request->khoi]);
        $giaovien = GiaoVien::find($request->giaovien);
        $idRole = Role::where('name', 'Giáo viên chủ nhiệm')->first()->id;
        $check = $giaovien->assignRole(['id'=> $idRole]);
        if($updateLop)
            return redirect('admin/lop')->with('noti', 'Chỉnh sửa lớp thành công');
        else 
            return redirect('admin/lop')->with('noti', 'Chỉnh sửa lớp thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $data['lop'] = Lop::find($id);
        return view('admin.lop.delete', $data);
    }

    public function destroy($id)
    {
        //

        $checkDelete = Lop::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/lop')->with('noti', 'Xóa lớp thành công');
        }
        else {
            return redirect('admin/lop')->with('noti', 'Xóa lớp  thất bại');
        }
    }
}
