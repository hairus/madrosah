<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trx_nilai extends Model
{
    protected $table = 'trx_nilai';
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswa', 'nis', 'nis');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }
}
