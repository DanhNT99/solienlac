<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truong extends Model
{
    use HasFactory;
    protected $table = "truong";

    public function listing() {
        return Array(
            array(
                'name' => 'Stt',
            ),
            array(
                'name' => 'Mã trường',
            ),
            array(
                'name' => 'Tên trường',
            )
            );
    }
}
