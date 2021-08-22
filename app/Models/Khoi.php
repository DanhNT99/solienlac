<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoi extends Model
{
    use HasFactory;
    protected $table = "khoi";

    public function Lop() {
        return $this->hasMany(Lop::class, 'id_khoi', 'id')->orderBy('TenLop', 'asc');
    }

    public function Hoc() {
        return $this->hasManyThrough(Hoc::class, Lop::class, 'id_khoi','id_lop', 'id');
    }

    public function MonHoc () {
        return $this->hasMany(PhanMonHoc::class, 'id_khoi', 'id')
                ->join('monhoc', 'monhoc.id','phanmonhoc.id_monhoc')->select('monhoc.*')
                ->orderBy('ChoPhepNhapDiem', 'desc');
    }

    public function PhanMonHoc () {
        return $this->hasMany(PhanMonHoc::class, 'id_khoi', 'id')->orderBy('id_monhoc', 'asc');
    }
}
