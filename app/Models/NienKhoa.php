<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NienKhoa extends Model
{
    use HasFactory;
    protected $table = "nienkhoa";
    
    public function HocKy() {
        return $this->hasMany(HocKy::class, 'id_nienkhoa', 'id')->orderBy('MaHK', 'asc');
    }

    public function LoaiHK() {
        return $this->hasManyThrough(LoaiHocKy::class, HocKy::class, 'id_nienkhoa', 'id_hocky', 'id');
    }
    public function SoLienLac() {
        return $this->hasMany(SoLienLac::class, 'id_nienkhoa', 'id');
    }
}