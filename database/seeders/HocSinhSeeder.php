<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class HocSinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hocsinh')->insert([
            ['MaHS' => 'NK202101', 'HoHS' => 'Nguyễn Tài','TenHS' =>'Danh' ,'NgaySinh' => '2012/01/01', 'GioiTinh' =>'Nam', 
                'DiaChi' => '21 Tố Hưu', 'Hinh' =>'danh.jpg', 'id_phuong' => 10, 'id_lop' => 2, 'id_cha' => 1, 'id_me' => 2]
        ]);
    }
}
