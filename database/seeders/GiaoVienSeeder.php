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
            'DiaChi' => '21 Thanh Tịnh', 'SoDT' => '0974191877', 'Hinh' =>'hinh1.jpg', 'id_phuong' =>'11']
        ]);
    }
}
