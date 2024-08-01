<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_tahun_ajaran extends Model
{
    use HasFactory;

    protected $table = 'data_tahun_ajarans';
    protected $guarded = ['id'];
}
