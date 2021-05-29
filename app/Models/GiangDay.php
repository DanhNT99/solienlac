<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiangDay extends Model
{
    use HasFactory;
    protected $table = "giangday";

    public function GiaoVien() {
        return $this->belongsto('App\Models\GiaoVien', 'id_giaovien', 'id');
    }

    public function MonHoc() {
        return $this->belongsto('App\Models\MonHoc', 'id_monhoc', 'id');
    }

    public function Lop() {
        return $this->belongsto('App\Models\Lop', 'id_lop', 'id');
    }
}
