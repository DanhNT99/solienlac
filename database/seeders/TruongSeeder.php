<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class TruongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('truong')->insert([
            'MaTruong' => 'T1',
            'TenTruong' => 'Phương Sơn',
            'SoDT' => '0374167657',
            'DiaChi' => '81 Phương Sai',
            'id_phuong' => '8'
        ]);
    }
}
