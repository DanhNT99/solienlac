<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Models\GiaoVien;
use App\Models\PhanQuyen;
use App\Models\Quyen;
use DB;

class PhanQuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['phanquyen'] = PhanQuyen::get();
        $data['giaovien'] = GiaoVien::orderBy('TenGV', 'asc')->get();
        $data['quyen'] = Role::get();
        $data['stt'] = 1;
        return view('admin.phanquyen.index',$data);
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
        if(!isset($request->giaovien) || !isset($request->quyen)) {
            return redirect('admin/phanquyen')->with('noti', 'Bạn chưa điền đủ thông tin');
        }
        else {
            $giaovien = GiaoVien::find($request->giaovien);
            $check = $giaovien->assignRole(['id'=>$request->quyen]);
            if($check) 
                return redirect('admin/phanquyen')->with('noti', 'Phân quyền thành công');
            else
                return redirect()->back()->with('noti', 'Phân quyền thành công');
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
        $data['phanquyen'] = PhanQuyen::where('model_id', $id)->first();
        $data['quyen'] = Quyen::get();
        // dd( $data['phanquyen']);
        return view('admin.phanquyen.edit', $data);
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
        $updatePhanQuyen = DB::table('model_has_roles')->where('model_id', $id)->update(['role_id' => $request->TenQuyen]);
        if($updatePhanQuyen)
            return redirect('admin/phanquyen')->with('noti', 'Chỉnh sửa  thành công');
        else 
            return redirect('admin/phanquyen')->with('noti', 'Chỉnh sửa thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function delete($id) {
    //     $data['phanquyen'] = PhanQuyen::where('model_id', $id)->first();
    //     return view('admin.phanquyen.delete', $data);
    // }

    public function destroy($id)
    {
        //
        $checkDelete = PhanQuyen::where('model_id', $id)->delete();

        if($checkDelete) {
            return redirect('admin/phanquyen')->with('noti', 'Xóa  thành công');
        }
        else {
            return redirect('admin/phanquyen')->with('noti', 'Xóa thất bại');
        }
    }
}
