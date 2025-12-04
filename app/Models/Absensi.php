<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa', 'id_jadwal', 'tanggal', 'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'id_jadwal');
    }
}
