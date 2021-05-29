<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQuaRenLuyen extends Model
{
    use HasFactory;

    protected $table = "ketquarenluyen";

    public function SoLienLac() {
        return $this->belongsTo(SoLienLac::class, 'id_sll', 'id');
    }

    public function PCNL() {
        return $this->belongsTo(PhamChatNangLuc::class, 'id_pcnl', 'id');
    }

    public function LoaiHK() {
        return $this->belongsTo(LoaiHocKy::class, 'id_loaihocky', 'id');
    }
}
