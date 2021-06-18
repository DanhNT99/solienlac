<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Phuong;
use App\Models\Tinh;

class PhuongConTroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['phuong'] = Phuong::orderBy('TenPhuong', 'asc')->paginate(10);
        $data['stt'] =   $data['phuong']->firstItem();
        return view('admin.phuong.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $count = Phuong::count();
        if($count == 0) {
            $idCurrent = 'P00';
        }
        else {
            $idCurrent =  Phuong::max('MaPhuong');
        }
        $array_id = explode('P',$idCurrent);
        $array_id[0] .= "P";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
        $data['tinh'] = Tinh::get();
        return view('admin.phuong.create', $data);
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
            'TenPhuong' => 'required', 'tinh' => 'required',
            'donvi' => 'required'
        ],[
            'required' => ":attribute không được để trống",
        ],[
            'TenPhuong' => 'Tên phường','tinh' => 'Tên tỉnh',
            'donvi' =>'Đơn vị'
        ]);

        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $data = new Phuong();
        $data->MaPhuong = $request->MaPhuong;
        $data->TenPhuong =ucwords( $request->TenPhuong);
        $data->DonVi = $request->donvi;
        $data->id_tinh = $request->tinh;
        $check = $data->save();
        if($check) {
            return redirect('admin/phuong')->with('noti', 'Thêm phường thành công');
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
        $checkDelete = Phuong::find($id)->delete();
        if($checkDelete) {
            return redirect('admin/phuong')->with('noti', 'Xóa phường thành công');
        }
        else {
            return redirect('admin/phuong')->with('noti', 'Xóa phường  thất bại');
        }
    }
}
