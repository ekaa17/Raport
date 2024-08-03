<?php

namespace App\Models;

use App\Models\data_mapel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMapelKelas extends Model
{
    use HasFactory;

    protected $table = 'detail_mapel_kelas';
    protected $guarded = ['id'];

    public function mapel()
    {
        return $this->belongsTo(data_mapel::class, 'mapel_id');
    }
}
