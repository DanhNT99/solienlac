<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Khoi;
use App\Models\BanHoc;


class KhoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['khoi'] = Khoi::orderBy('TenKhoi', 'asc')->get();
        $data['stt'] = 1;
        return view ('admin.khoi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = Khoi::count();
        if($count == 0) $current = 'K00';
    
        else $current =  Khoi::max('MaKhoi'); 
        $array_id = explode('K',$current);
        $array_id[0] .="K";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
        return view ('admin.khoi.create', $data);
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
            ['TenKhoi' => 'required|unique:khoi', 'DuocPhep' => 'required'],
            ['required' => ":attribute không được để trống",
            'unique' => ':attribute đã tồn tại'],
            ['TenKhoi' =>'Tên khôi', 'DuocPhep' => 'Được phép']);
        
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $data = new Khoi;
        $data->MaKhoi = $request->MaKhoi;
        $data->TenKhoi = $request->TenKhoi;
        $data->DuocPhep = $request->DuocPhep;
        $check = $data->save();
        if($check) {
            return redirect('admin/khoi')->with('noti', 'Thêm khối thành công');
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
        $data['khoi'] = Khoi::find($id);
        return view('admin.khoi.detail', $data);
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
        $data['khoi'] = Khoi::find($id);
        return view('admin.khoi.edit', $data);
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
        // $validate = Validator::make($request->all(),
        //     ['TenKhoi' => 'required|unique:khoi'],
        //     ['unique' => ':attribute đã tồn tại'],
        //     ['TenKhoi' =>'Tên khôi']);
        
        // if($validate->fails()) {
        //     return redirect()->back()->withErrors($validate);
        // }
        $updateGrade  = Khoi::where('id', $id)->update(['TenKhoi' => $request->TenKhoi, 'DuocPhep' => $request->DuocPhep]);

        //CHECK UPDATE AND NOTIFINECAITON
            if($updateGrade)
                return redirect('admin/khoi')->with('noti', 'Chỉnh sửa khối thành công');
            else 
                return redirect('admin/khoi')->back()->with('noti', 'Chỉnh sửa khối thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id) {
        $data['khoi'] = Khoi::find($id);
        return view('admin.khoi.delete', $data);
    }
    
    public function destroy($id)
    {
        //
        $checkDelete = Khoi::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/khoi')->with('noti', 'Xóa khối thành công');
        }
        else {
            return redirect('admin/khoi')->with('noti', 'Xóa khối  thất bại');
        }
    }
}
