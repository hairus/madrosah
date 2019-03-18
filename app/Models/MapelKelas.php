<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapelKelas extends Model
{
    protected $table = 'mapel_kelas';
    protected $guarded = [];

    public function mapels()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function kelass()
    {
        return $this->belongsTo('App\Models\Kelas');
    }
}
