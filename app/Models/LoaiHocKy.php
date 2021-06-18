<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiHocKy extends Model
{
    use HasFactory;

    protected $table = "loaihocky";

    public function HocKy() {
        return $this->belongsTo(HocKy::class, 'id_hocky', 'id');
    }

    public function NhanXet() {
        return $this->hasMany(NhanXet::class, 'id_loaihocky', 'id');
    }
}
