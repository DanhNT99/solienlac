<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PhamChatNangLuc;

class PCNLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['pcnl'] = PhamChatNangLuc::get();
        $data['stt'] = 1;
        return view('admin.phamchatnangluc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // id auto increase
            $count = PhamChatNangLuc::count();
            if($count == 0) {
                $current = 'PCNL00';
            }
            else {
                $current =  PhamChatNangLuc::max('MaPCNL');
            }
            $array_id = explode('L',$current);
            $array_id[0] .= "L";
            $array_id[1] = intval($array_id[1]) + 1;
            if($array_id[1] < 10) {
                $array_id[1] = "0" . $array_id[1];
            }
            $data['text_id'] = implode('', $array_id);
        //end

        return view('admin.phamchatnangluc.create', $data);
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input
            $validate = Validator::make($request->all(),
                ['TenPCNL' => 'required', 'LoaiPCNL' => 'required'],
                ['required' => ":attribute không được để trống"],
                ['TenPCNL' =>'Tên phẩm chất năng lực',
                'LoaiPCNL' =>'Loại phẩm chất năng lực']);
            
            // will notifinecation when have errors
            if($validate->fails()) {
                return redirect()->back()->withInput()->withErrors($validate);
            }
        //end

        //add new pcnl in database
            $data = new PhamChatNangLuc();
            $data->MaPCNL = $request->MaPCNL;
            $data->TenPCNL = $request->TenPCNL;
            $data->LoaiPCNL = $request->LoaiPCNL;
            $checkAdd = $data->save();
            //check added pcnl
            if($checkAdd) {
                return redirect('admin/phamchatnangluc')->with('noti', 'Thêm thành công');
            }
            else {
                return redirect('admin/phamchatnangluc')->with('noti', 'Thêm không thành công');
            }
        //end
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
