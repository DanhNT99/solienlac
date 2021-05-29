<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class QuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['quyen'] = Role::get();
        $data['stt'] = 1;

        $dem = Role::count();
        if($dem == 0) $current = 'Q00';
        else $current =  Role::max('MaQuyen');
    
        $array_id = explode('Q',$current);
        $array_id[0] .= "Q";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) 
            $array_id[1] = "0" . $array_id[1];
        $data['text_id'] = implode('', $array_id);
        return view('admin.quyen.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.quyen.create');
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
        $data = Role::create(['MaQuyen' => $request->MaQuyen, 'name' => $request->TenQuyen]);

        if($data) {
            return redirect('admin/quyen')->with('noti', 'Thêm quyền thành công');
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
        $data['quyen'] = Role::find($id);
        return view('admin.quyen.edit', $data);
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
        $updateRole = Role::where('id', $id)->update(['name' => ucfirst($request->TenQuyen)]);
        if($updateRole)
            return redirect('admin/quyen')->with('noti', 'Chỉnh sửa quyền thành công');
        else 
            return redirect('admin/quyen')->with('noti', 'Chỉnh sửa quyền thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function delete($id) {
        $data['quyen'] = Role::find($id);
        return view('admin.quyen.delete', $data);
    }

    public function destroy($id)
    {
        //

        $checkDelete = Role::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/quyen')->with('noti', 'Xóa quyền thành công');
        }
        else {
            return redirect('admin/quyen')->with('noti', 'Xóa quyền  thất bại');
        }
        
    }
}
