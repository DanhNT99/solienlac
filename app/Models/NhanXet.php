<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanXet extends Model
{
    use HasFactory;
    protected $table = "nhanxet";

    public function SoLienLac() {
        return $this->belongsTo(SoLienLac::class, 'id_sll', 'id');
    }
    public function LoaiHK() {
        return $this->belongsTo(LoaiHK::class, 'id_loaihocky', 'id');
    }
}
