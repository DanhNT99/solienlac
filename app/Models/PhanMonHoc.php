<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanMonHoc extends Model
{
    use HasFactory;
    protected $table = 'phanmonhoc';

    public function MonHoc() {
        return $this->belongsTo(MonHoc::class, 'id_monhoc', 'id');
    }
    
    public function Khoi() {
        return $this->belongsTo(Khoi::class, 'id_khoi', 'id');
    }
}
