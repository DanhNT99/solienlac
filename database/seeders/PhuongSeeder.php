<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PhuongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('phuong')->insert([
            ['MaPhuong' => 'P0002' , 'TenPhuong' => 'Phường Vĩnh Hải', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0003' , 'TenPhuong' => 'Phường Vĩnh Phước', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0004' , 'TenPhuong' => 'Phường Ngọc Hiệp', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0005' , 'TenPhuong' => 'Phường Vĩnh Thọ', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0006' , 'TenPhuong' => 'Phường Xương Huân', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0007' , 'TenPhuong' => 'Phường Vạn Thắng', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0008' , 'TenPhuong' => 'Phường Vạn Thạnh', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0009' , 'TenPhuong' => 'Phường Phương Sài', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0010' , 'TenPhuong' => 'Phường Phương Sơn', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0011' , 'TenPhuong' => 'Phường Phước Hải', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0012' , 'TenPhuong' => 'Phường Phước Tân', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0013' , 'TenPhuong' => 'Phường Lộc Thọ', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0014' , 'TenPhuong' => 'Phường Phước Tiến', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0015' , 'TenPhuong' => 'Phường Tân Lập', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0016' , 'TenPhuong' => 'Phường Phước Hòa', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0017' , 'TenPhuong' => 'Phường Vĩnh Nguyên', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0018' , 'TenPhuong' => 'Phường Phước Long', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0019' , 'TenPhuong' => 'Phường Vĩnh Trường', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0020' , 'TenPhuong' => 'Xã Vĩnh Lương', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0021' , 'TenPhuong' => 'Xã Vĩnh Phương', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0022' , 'TenPhuong' => 'Xã Vĩnh Ngọc', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0023' , 'TenPhuong' => 'Xã Vĩnh Thạnh', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0024' , 'TenPhuong' => 'Xã Vĩnh Trung', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0025' , 'TenPhuong' => 'Xã Vĩnh Hiệp', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0026' , 'TenPhuong' => 'Xã Vĩnh Thái', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0027' , 'TenPhuong' => 'Xã Phước Đồng', 'id_tinh' => '1'],
        ]);
    }
}
