<?php

namespace App\Imports;

use App\Models\GiaoVien;
use App\Models\Phuong;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class ImportTeach implements ToModel, withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {   

        $date = str_replace('/', '-', $row['ngaysinh']);  //HANDLE DATE
    //HANDLE DELET " " WHEN ENTER
        $array = explode(' ',$row['phuong']);
        foreach($array as $key => $value) {
            if($value == "") unset($array[$key]);
        }
        $TenPhuong = implode(" ",$array);
    //END

    //HANLDE CODE TEACHER AUTO
        $count = GiaoVien::count();
        if($count == 0) $currentMaGV = 'GV00';
        else $currentMaGV =  GiaoVien::max('MaGV');
        $array_id = explode('V',$currentMaGV);
        $array_id[0] .= "V";
        $array_id[1] = intval($array_id[1]) + 1;
        if($array_id[1] < 10) {
            $array_id[1] = "0" . $array_id[1];
        }
        $data['text_id'] = implode('', $array_id);
    //GET ID PHƯƠNG BY NAME WHEN USER ENTER
        $id_phuong = Phuong::where('TenPhuong', 'like', $TenPhuong)->value('id');
        return new GiaoVien([
            //
            'MaGV' =>  $data['text_id'], 
            'HoGV' => $row['hogiaovien'], 
            'TenGV' => $row['tengiaovien'], 
            'GioiTinh' => $row['gioitinh'],
            'NgaySinh' => date('Y-m-d', strtotime($date)),
            'DiaChi' => $row['diachi'], 
            'SoDT' => $row['sodienthoai'],
            'TaiKhoan' => $row['taikhoan'],
            'password' => bcrypt($row['matkhau']),
            'Hinh' => 'Null',
            'id_phuong' => $id_phuong,
        ]);
    }
}
