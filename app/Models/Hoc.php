<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoc extends Model
{
    use HasFactory;
    protected $table = "hoc";

    public function HocSinh() {
        return $this->belongsTo(HocSinh::class, 'id_hocsinh', 'id')->orderBy('TenHS', 'asc');
    }

    public function Lop() {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }

    public function NienKhoa() {
        return $this->belongsTo(NienKhoa::class, 'id_nienkhoa', 'id');
    }
}
