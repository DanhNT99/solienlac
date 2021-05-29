<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanBanHoc extends Model
{
    use HasFactory;
    protected $table = 'phanbanhoc';

    public function Khoi() {
        return $this->belongsTo(Khoi::class, 'id_khoi', 'id');
    }
    
    public function BanHoc() {
        return $this->belongsTo(BanHoc::class, 'id_banhoc', 'id');
    }

}
