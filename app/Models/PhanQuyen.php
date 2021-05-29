<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    use HasFactory;
    protected $table = "model_has_roles";

    public function Quyen() {
        return $this->belongsTo(Quyen::class, 'role_id', 'id');
    }
    public function GiaoVien() {
        return $this->belongsTo(GiaoVien::class, 'model_id', 'id');
    }
}
