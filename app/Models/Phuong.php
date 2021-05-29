<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phuong extends Model
{
    use HasFactory;
    protected $table = "phuong";

    public function Tinh() {
        return $this->belongsto('App\Models\Tinh', 'id_tinh', 'id');
    }
    public function HocSinh()  {
        return $this->hasMany(HocSinh::class, 'id_phuong', 'id');
    }
}
