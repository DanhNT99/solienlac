<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public function PhanQuyen() {
        return $this->hasMany(PhanQuyen::class, 'roles_id', 'id');
    }
}
