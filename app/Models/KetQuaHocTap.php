<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQuaHocTap extends Model
{
    use HasFactory;

    protected $table = "ketquahoctap";

    public function SoLienLac() {
        return $this->belongsTo(SoLienLac::class, 'id_sll', 'id');
    }
    public function MonHoc() {
        return $this->belongsTo(MonHoc::class, 'id_monhoc', 'id');
    }
    public function LoaiHK() {
        return $this->belongsTo(LoaiHocKy::class, 'id_loaihocky', 'id');
    }
}
