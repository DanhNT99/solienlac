<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lop')->insert([
            ['MaLop' => 'L00001', 'TenLop' => '1/1', 'id_khoi' => '1'],
            ['MaLop' => 'L00006', 'TenLop' => '1/2', 'id_khoi' => '1'],
            ['MaLop' => 'L00002', 'TenLop' => '2/1', 'id_khoi' => '2'],
            ['MaLop' => 'L00007', 'TenLop' => '2/2', 'id_khoi' => '2'],
            ['MaLop' => 'L00003', 'TenLop' => '3/1', 'id_khoi' => '3'],
            ['MaLop' => 'L00008', 'TenLop' => '3/2', 'id_khoi' => '3'],
            ['MaLop' => 'L00004', 'TenLop' => '4/1', 'id_khoi' => '4'],
            ['MaLop' => 'L00009', 'TenLop' => '4/2', 'id_khoi' => '4'],
            ['MaLop' => 'L00005', 'TenLop' => '5/1', 'id_khoi' => '5'],
            ['MaLop' => 'L00010', 'TenLop' => '5/2', 'id_khoi' => '5'],

        ]);
    }
}
