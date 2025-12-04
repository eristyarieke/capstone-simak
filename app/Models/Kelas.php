<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = false;

    protected $fillable = ['nama_kelas', 'wali_kelas'];

    public function wali()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_kelas');
    }
}
