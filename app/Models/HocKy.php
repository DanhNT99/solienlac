<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    use HasFactory;

    protected $table = "hocky";

    public function LoaiHocKy() {
        return $this->hasMany(LoaiHocKy::class, 'id_hocky', 'id');
    }

    public function NienKhoa() {
        return $this->belongsTo(NienKhoa::class, 'id_nienkhoa', 'id');
    }
}
