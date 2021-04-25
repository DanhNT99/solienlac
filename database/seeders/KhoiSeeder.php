<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class KhoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Khoi')->insert([
            ['MaKhoi'=> 'K0003','TenKhoi' => 'Khối 3'],
            ['MaKhoi'=> 'K0004','TenKhoi' => 'Khối 4'],
            ['MaKhoi'=> 'K0005','TenKhoi' => 'Khối 5']
        ]);

    }
}
