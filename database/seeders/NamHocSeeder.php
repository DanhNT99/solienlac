<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class NamHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nienkhoa')->insert([
            ['MaNK' => 'Nk2021', 'NamBatDau' => '2020', 'NamKetThuc' => '2021', 'TrangThai' => 1]
        ]);
    }
}
