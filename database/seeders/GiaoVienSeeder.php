<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class GiaoVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('giaovien')->insert([
            ['MaGV' => 'GV00001', 'HoTenGV' => 'Hồ Thị Lan', 'NgaySinh' => '1978/09/09', 'GioiTinh' =>'Nu', 
                'DiaChi' => '21 Thanh Tịnh', 'SoDT' => '0974191877', 'TaiKhoan' => '0974191877', 'MatKhau' =>bcrypt('123456'),
             'Hinh' =>'hinh1.jpg', 'id_phuong' =>'11'],
             ['MaGV' => 'GV00002', 'HoTenGV' => 'Phan Thị Thanh Thục', 'NgaySinh' => '1972/03/04', 'GioiTinh' =>'Nu', 
                'DiaChi' => '19 Trần Văn Giàu', 'SoDT' => '0984210216', 'TaiKhoan' => '0984210216', 'MatKhau' =>bcrypt('123456'),
             'Hinh' =>'hinh1.jpg', 'id_phuong' =>'16']
        ]);
    }
}
