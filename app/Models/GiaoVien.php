<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class GiaoVien extends Authenticatable
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

    protected $table = "giaovien";
    protected $fillable = ['MaGV', 'HoGV', 'TenGV', 'GioiTinh', 'NgaySinh', 'DiaChi', 
                        'SoDT', 'Hinh', 'password', 'id_phuong'];

    public function phuong() {
        return $this->belongsto(Phuong::class, 'id_phuong', 'id');
    }

    public function Lop() {
        return $this->hasOne(Lop::class, 'id_giaovien', 'id');
    }
    public function Hoc() {
        return $this->hasManyThrough(Hoc::class, Lop::class, 'id_giaovien', 'id_lop', 'id')->join('hocsinh', 'hocsinh.id', '=', 'hoc.id_hocsinh')
                                                                                            ->orderBy('TenHS','asc');
    }
    public function SoLienLac() {

        return $this->hasManyThrough(SoLienLac::class, HocSinh::class, 'id_');
    }
}
