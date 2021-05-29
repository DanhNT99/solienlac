<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Tinh;

class TinhConTroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['tinh'] = Tinh::get();
        $data['stt'] =  1;
        return view('admin.tinh.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dem = Tinh::count();
        if($dem == 0) {
            $currentMaGV = 'T00';
        }
        else {
            $currentMaGV =  Tinh::max('MaTinh');
        }
        $array_id = explode('T',$currentMaGV);
        $array_id[0] .="T";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
        return view('admin.tinh.create', $data);
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
            'TenTinh' => 'required',
        ],[
            'required' => ":attribute không được để trống",
        ],[
            'TenTinh' => 'Tên tỉnh',
        ]);

        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $data = new Tinh();
        $data->MaTinh = $request->MaTinh;
        $data->TenTinh =ucwords( $request->TenTinh);
        $check = $data->save();
        if($check) {
            return redirect('admin/tinh')->with('noti', 'Thêm khối thành công');
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
    }
}
