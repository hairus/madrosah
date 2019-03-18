<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trx_absen extends Model
{
    protected $table = 'trx_absen';
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswa', 'nis', 'nis');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function keterangan()
    {
        return $this->belongsTo('App\Models\ket', 'ket', 'ketA');
    }

}
