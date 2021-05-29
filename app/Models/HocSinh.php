<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocSinh extends Model
{
    use HasFactory;
    protected $table = "hocsinh";

    public function Hoc() {
        return $this->hasOne(Hoc::class, 'id_hocsinh','id');
    }

    public function ChiTietGiaDinh() {
        return $this->hasMany(ChiTietGiaDinh::class, 'id_hocsinh','id');
    }

    public function SoLienLac() {
        return $this->hasOne(SoLienLac::class, 'id_hocsinh', 'id');
    }

    public function Phuong() {
        return $this->belongsTo(Phuong::class, 'id_phuong', 'id');
    }
}
