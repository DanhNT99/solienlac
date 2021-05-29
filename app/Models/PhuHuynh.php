<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class PhuHuynh extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     
    protected $hidden = [
        'password',   'remember_token',
    ];

    protected $guard_name =  'web';

    protected $table = "phuhuynh";

    public function ChiTietGiaDinh() {
        return $this->hasMany(ChiTietGiaDinh::class, 'id_phuhuynh', 'id');
    }
}
