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
            ['MaPhuong' => 'P0002' , 'DonVi' => 'Phường','TenPhuong' => 'Vĩnh Hải', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0003' , 'DonVi' => 'Phường','TenPhuong' => 'Vĩnh Phước', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0004' , 'DonVi' => 'Phường','TenPhuong' => 'Ngọc Hiệp', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0005' , 'DonVi' => 'Phường','TenPhuong' => 'Vĩnh Thọ', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0006' , 'DonVi' => 'Phường','TenPhuong' => 'Xương Huân', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0007' , 'DonVi' => 'Phường','TenPhuong' => 'Vạn Thắng', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0008' , 'DonVi' => 'Phường','TenPhuong' => 'Vạn Thạnh', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0009' , 'DonVi' => 'Phường','TenPhuong' => 'Phương Sài', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0010' , 'DonVi' => 'Phường','TenPhuong' => 'Phương Sơn', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0011' , 'DonVi' => 'Phường','TenPhuong' => 'Phước Hải', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0012' , 'DonVi' => 'Phường','TenPhuong' => 'Phước Tân', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0013' , 'DonVi' => 'Phường','TenPhuong' => 'Lộc Thọ', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0014' , 'DonVi' => 'Phường','TenPhuong' => 'Phước Tiến', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0015' , 'DonVi' => 'Phường','TenPhuong' => 'Tân Lập', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0016' , 'DonVi' => 'Phường','TenPhuong' => 'Phước Hòa', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0017' , 'DonVi' => 'Phường','TenPhuong' => 'Vĩnh Nguyên', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0018' , 'DonVi' => 'Phường','TenPhuong' => 'Phước Long', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0019' , 'DonVi' => 'Phường','TenPhuong' => 'Vĩnh Trường', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0020' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Lương', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0021' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Phương', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0022' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Ngọc', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0023' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Thạnh', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0024' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Trung', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0025' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Hiệp', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0026' , 'DonVi' => 'Xã ','TenPhuong' => 'Vĩnh Thái', 'id_tinh' => '1'],
            ['MaPhuong' => 'P0027' , 'DonVi' => 'Xã ','TenPhuong' => 'Phước Đồng', 'id_tinh' => '1'],
        ]);
    }
}
