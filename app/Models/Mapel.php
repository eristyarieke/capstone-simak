<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    public $timestamps = false;

    protected $fillable = ['kode_mapel', 'nama_mapel', 'tahun_ajaran', 'id_guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru','id_guru');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_mapel');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_mapel');
    }
}
