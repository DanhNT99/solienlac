<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class MonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('monhoc')->insert([
            ['MaMH' =>'MH01', 'TenMH' =>'Toán'],
            ['MaMH' =>'MH02', 'TenMH' =>'Tiếng việt'],
            ['MaMH' =>'MH03', 'TenMH' =>'Đạo đức'],
            ['MaMH' =>'MH04', 'TenMH' =>'Thể dục'],
            ['MaMH' =>'MH05', 'TenMH' =>'Âm nhạc'],
            ['MaMH' =>'MH06', 'TenMH' =>'Mĩ thuật'],
            ['MaMH' =>'MH07', 'TenMH' =>'Tự nhiên và xã hội'],
            ['MaMH' =>'MH08', 'TenMH' =>'Anh văn'],
            ['MaMH' =>'MH09', 'TenMH' =>'Lich sử và Địa lí'],
            ['MaMH' =>'MH10', 'TenMH' =>'Khoa học'],
            ['MaMH' =>'MH11', 'TenMH' =>'Tin học và công nghệ']
        ]);
    }
}
