<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kep extends Model
{
    protected $table = 'kep';
    protected $guarded = [];

    public function siswas()
    {
        return $this->belongsTo('App\Models\mst_siswa', 'nis', 'nis');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'kelas');
    }
}
