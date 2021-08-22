<?php

namespace App\Http\Controllers\MyController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use App\Models\KetQuaRenLuyen;
use App\Models\PhamChatNangLuc;
use App\Models\NienKhoa;
use App\Models\HocKy;
use Auth,Validator, DB;

class KQRLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['kqrl'] = KetQuaRenLuyen::get();
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['nienkhoa'] = NienKhoa::where('TrangThai', 1)->get()->first();
        $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $data['nienkhoa']->id)->get()->first();
        $data['pcnl'] = PhamChatNangLuc::orderBy('LoaiPCNL', 'asc')->get();
        $data['pcnlfirst'] =  $data['pcnl']->first();
        $data['stt'] = 1;
        $data['kqrl'] = '';
        return view('admin.ketquarenluyen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['nienkhoa'] = NienKhoa::where('TrangThai', 1)->get()->first();
        $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $data['nienkhoa']->id)->get()->first();
        $data['pcnl'] = PhamChatNangLuc::get();
        $data['stt'] = 1;

        return view('admin.ketquarenluyen.create',$data);
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

        //validate input 
            $validate = Validator::make($request->all(),
                ['PCNL' => 'required', 'LoaiHK' => 'required'],
                ['required' => ":attribute không được để trống"],
                ['PCNL' =>'PCNL', 'LoaiHK' => 'Loại học kỳ']);
            // will notifinecation when have errors
            if($validate->fails()) return redirect()->back()->withErrors($validate);
        //end


        //add result Ren luyện
            //check id of contact book
            $checkAdd = false;
            $data = false;
            if(count($request->SoLienLac) > 0) {
                //duyet qua từng contact book
                foreach($request->SoLienLac as $key => $item) {
                    //check user enter?
                    if($request->XepLoai[$key]) {
                        $where = array(
                            ['id_sll', '=', $item],
                            ['id_pcnl', '=', $request->PCNL],
                            ['id_loaihocky', '=', $request->LoaiHK]
                        );
                        $checkKQHT =  KetQuaRenLuyen::where($where)->get();
                        //check xem có kết quả nào giống này chưa
                        // dd( $checkKQHT );
                        if(!count($checkKQHT) > 0) {
                            $data = new KetQuaRenLuyen;
                            $data->id_sll = $item;
                            $data->id_pcnl = $request->PCNL;
                            $data->id_loaihocky = $request->LoaiHK;
                            $data->XepLoai = $request->XepLoai[$key];
                            $checkAdd = $data->save();
                        }
                        else  $data =  KetQuaRenLuyen::where($where)->update(['XepLoai' => $request->XepLoai[$key]]);
                    }
                }
                if($checkAdd || $data) return redirect('admin/timkiemketquarenluyen/' . $request->PCNL)->with('noti','Đánh giá thành công');
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

    public function getSearch($idPCNL) {
        $data['giaovien'] = GiaoVien::find(Auth::guard('giao_vien')->user()->id);
        $data['nienkhoa'] = NienKhoa::where('TrangThai', 1)->get()->first();
        $data['hocky'] = HocKy::where('TrangThai', 1)->where('id_nienkhoa', $data['nienkhoa']->id)->first();
        $data['pcnl'] = PhamChatNangLuc::orderBy('LoaiPCNL', 'asc')->get();
        $data['idPCNL'] = $idPCNL;
        $data['stt'] = 1;
        $idClass =  $data['giaovien']->Lop->toArray()['id'];
        $where = [['id_pcnl','=',$idPCNL], ['id_lop','=', $idClass],['solienlac.id_nienkhoa', '=', $data['nienkhoa']->id]];
        $data['kqrl'] = DB::table('ketquarenluyen')->join('solienlac', 'ketquarenluyen.id_sll', 'solienlac.id')
                            ->join('hocsinh', 'hocsinh.id', 'solienlac.id_hocsinh')
                            ->join('hoc', 'hocsinh.id', 'hoc.id_hocsinh')
                            ->join('lop', 'lop.id', 'hoc.id_lop')
                            ->where($where)->orderBy('TenHS', 'asc')->select('ketquarenluyen.*')->get();
        return view('admin.ketquarenluyen.search', $data);
    }
}
