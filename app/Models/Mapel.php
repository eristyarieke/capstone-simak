<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'id_tahun_ajaran'
    ];

    /* RELATIONS */
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_mapel');
    }
}
