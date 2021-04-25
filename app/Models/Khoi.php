<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoi extends Model
{
    use HasFactory;
    protected $tabale = "khoi";
    
    public function Lop() {
      return $this->hasMany('App\Models\Lop', 'id_khoi','id');
    }
    public function HocSinh() {
        return $this->hasManyThrough('App\HocSinh', 'App\Lop','id_lop', 'id_khoi', 'id');
    }
}
