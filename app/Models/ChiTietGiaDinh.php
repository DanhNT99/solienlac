<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGiaDinh extends Model
{
    use HasFactory;
    protected $table = "chitietgiadinh";

    public function HocSinh() {
        return $this->belongsTo(HocSinh::class, 'id_hocsinh', 'id');
    }

    public function PhuHuynh() {
        return $this->belongsTo(PhuHuynh::class, 'id_phuhuynh', 'id');
    }
}
