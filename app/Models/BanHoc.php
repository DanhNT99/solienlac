<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanHoc extends Model
{
    use HasFactory;

    protected $table = 'banhoc';
    
    public function PhanMonHoc() {
        return $this->hasMany(PhanMonHoc::class, 'id_banhoc', 'id');
    }
}
