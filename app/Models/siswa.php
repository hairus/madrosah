<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\models\trx_nilai;

class siswa extends Model
{
    protected $table ='mst_siswa';
    protected $guarded = [];

    public function nilais()
    {
        return $this->hasMany('App\Models\trx_nilai', 'nis', 'nis');
    }
    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id', 'kls');
    }
}
