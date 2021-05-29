<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class PhuHuynhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('phuhuynh')->insert([
            ['MaPH' => 'PH01', 'HoTenPH' => 'Trần Thị Lan' ,'NgheNghiep' => 'Nội trợ', 'NoiLamViec' =>'Tại nhà'
            ,'GioiTinh' =>'Nu', 'SoDT' => '0378853580', 'TaiKhoan' => '0378853580', 'MatKhau' =>bcrypt('123456789')],
            ['MaPH' => 'PH02', 'HoTenPH' => 'Lê Văn Tài' ,'NgheNghiep' => 'Bác sỉ', 'NoiLamViec' =>'Bệnh viện Tỉnh Khánh Hòa'
            ,'GioiTinh' =>'Nam', 'SoDT' => '0989210523', 'TaiKhoan' => '0989210523', 'MatKhau' =>bcrypt('123456789')],
            
        ]);
    }
}
