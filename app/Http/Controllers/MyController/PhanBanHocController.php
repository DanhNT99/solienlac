<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PhanBanHoc;
use App\Models\Khoi;
use App\Models\BanHoc;
class PhanBanHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['phanbanhoc'] = PhanBanHoc::get();
        $data['stt'] = 1;

        return view('admin.phanbanhoc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['khoi'] = Khoi::get();
        $data['banhoc'] = BanHoc::get();
         return view('admin.phanbanhoc.create', $data);
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
        ['khoi' => 'required', 'banhoc' => 'required'],
        ['required' => ":attribute không được để trống"],
        ['khoi' =>'Khối', 'banhoc' => 'Ban học']);
        if($validate->fails()) return redirect()->back()->withErrors($validate);

        $data = new PhanBanHoc;
        $data->id_khoi = $request->khoi;
        $data->id_banhoc = $request->banhoc;
        $check = $data->save();
        if($check) {
            return redirect('admin/phanbanhoc')->with('noti', 'Phân ban học thành công');
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
