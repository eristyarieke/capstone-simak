<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'agama',
        'id_kelas',
        'id_tahun_ajaran'
    ];

    /* RELATIONS */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_siswa');
    }
}
