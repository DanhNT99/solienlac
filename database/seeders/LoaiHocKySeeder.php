<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class LoaiHocKySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('loaihocky')->insert([
            ['MaLoaiHK' => 'LHK01','TenLoaiHK' => 'Giữa học kỳ I', 'id_hocky' => '1'],
            ['MaLoaiHK' => 'LHK02','TenLoaiHK' => 'Cuối học kỳ I', 'id_hocky' => '1'],
            ['MaLoaiHK' => 'LHK03','TenLoaiHK' => 'Giữa học kỳ II', 'id_hocky' => '2'],
            ['MaLoaiHK' => 'LHK04','TenLoaiHK' => 'Cuối học kỳ II', 'id_hocky' => '2']
        ]);
    }
}
