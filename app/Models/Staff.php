<?php

namespace App\Models;

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
}
