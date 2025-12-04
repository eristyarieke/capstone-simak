<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    protected $fillable = [
        'id_user','nis','nama','jenis_kelamin','tanggal_lahir',
        'alamat','no_hp','id_kelas','tahun_masuk','foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_siswa');
    }
}
