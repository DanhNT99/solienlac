<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;
    protected $table = "lop";

    public function HocSinh() {
        return $this->hasMany('App\Models\HocSinh', 'id_lop','id');
    }

    public function Khoi(){
        return $this->belongsto('App\Khoi', 'id_khoi','id');
    }
}
