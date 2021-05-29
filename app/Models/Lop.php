<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;
    protected $table = "lop";

    public function Khoi(){
        return $this->belongsto(Khoi::class, 'id_khoi','id');
    }

    public function Hoc() {
        return $this->hasMany(Hoc::class, 'id_lop', 'id');
    }

    public function Gvcn(){
        return $this->belongsto('App\Models\GiaoVien', 'id_giaovien','id');
    }
    
}
