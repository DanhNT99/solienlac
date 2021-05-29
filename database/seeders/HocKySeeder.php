<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class HocKySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hocky')->insert([
            ['MaHK' => 'NK202101', 'TenHK' =>'Học kỳ 1', 'TrangThai' => 0, 'id_nienkhoa' => 1]
            ['MaHK' => 'NK202102', 'TenHK' =>'Học kỳ 2', 'TrangThai' => 1, 'id_nienkhoa' => 1]
        ]);
    }
}
