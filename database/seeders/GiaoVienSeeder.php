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
            ['MaGV' => 'GV01', 'HoGV' => 'Huỳnh Văn','TenGV' =>'Nhứt' ,'NgaySinh' => '1978-06-12', 'GioiTinh' =>'Nam', 
                'DiaChi' => '86 Hai Tháng Tư', 'SoDT' => '0914113578', 'password' =>bcrypt('123456789'),
             'Hinh' =>'hinh1.jpg', 'id_phuong' =>'4'],
        ]);
    }
}
