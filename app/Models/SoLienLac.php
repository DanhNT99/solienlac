<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoLienLac extends Model
{
    use HasFactory;
    protected $table = "solienlac";
    
    public function HocSinh() {
        return $this->belongsTo(HocSinh::class, 'id_hocsinh', 'id');
    }

    public function KetQuaHocTap() {
        return $this->hasMany(KetQuaHocTap::class, 'id_sll', 'id');
    }

    public function KetQuaRenLuyen() {
        return $this->hasMany(KetQuaRenLuyen::class, 'id_sll', 'id');
    }
    
}
