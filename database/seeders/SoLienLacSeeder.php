<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SoLienLacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('solienlac')->insert([
            ['MaSLL' => 'NK202101', 'HocLuc' =>'', 'NhanXet' =>'', 'id_truong' => 2, 'id_hocsinh' =>1,]
        ]);
    }
}
