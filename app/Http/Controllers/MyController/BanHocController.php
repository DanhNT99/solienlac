<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BanHoc;
use Validator;

class BanHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banhoc'] = BanHoc::get();
        $data['stt'] = 1;
        return view('admin.banhoc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = BanHoc::count();
        if($count == 0) $currentMaGV = 'BH00';
        else $idCurrent = BanHoc::max('MaBH');
        $array_id = explode('H',$idCurrent);
        $array_id[0] .= 'H';
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) 
            $array_id[1] = "0" . $array_id[1];
    
        $data['idBanHoc'] = implode('', $array_id);

        return view('admin.banhoc.create', $data);
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
            ['TenBH' => 'required'],
            ['required' => ":attribute không được để trống"],
            ['TenBH' =>'Tên ban học']);
        
        if($validate->fails()) 
            return redirect()->back()->withInput()->withErrors($validate);
        $data = new BanHoc;
        $data->MaBH = $request->MaBH;
        $data->TenBH = $request->TenBH;
        $check = $data->save();
        if($check) 
            return redirect('admin/banhoc')->with('noti', 'Thêm ban học thành công');
        else 
            return redirect()->back()->with('noti', 'Thêm không thành công');
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
        $data['banhoc'] = BanHoc::find($id);
        return view('admin.banhoc.edit', $data);
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
        $updateBanHoc = BanHoc::where('id', $id)->update(['TenBH' => $request->TenBH]);
        if($updateBanHoc)
            return redirect('admin/banhoc')->with('noti', 'Chỉnh sửa ban học thành công');
        else 
            return redirect('admin/banhoc')->with('noti', 'Chỉnh sửa ban học thất bại');
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
        $checkDelete = BanHoc::find($id)->delete();
        if( $checkDelete ) {
            return redirect('admin/banhoc')->with('noti', 'Xóa ban học thành công');
        }
        else {
            return redirect('admin/banhoc')->with('noti', 'Xóa ban học thất bại');
        }
        
    }
}
