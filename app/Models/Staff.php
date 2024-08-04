<?php

namespace App\Models;

use App\Models\data_wali_kelas;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $table = 'staff';
    protected $guarded = ['id'];
    protected $fillable = [
        'nip',
        'nama',
        'email',
        'jenis_kelamin',
        'role',
        'walikelas',
        'password',
    ];

    public function waliKelas()
    {
        return $this->hasOne(data_wali_kelas::class, 'id_staff');
    }
}

