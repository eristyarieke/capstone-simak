<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';

    protected $fillable = [
        'nama_tahun',
        'is_aktif'
    ];

    public static function aktif()
    {
        return self::where('is_aktif', 1)->firstOrFail();
    }

    /* RELATIONS */
    public function guru()
    {
        return $this->hasMany(Guru::class, 'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_tahun_ajaran');
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'id_tahun_ajaran');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_tahun_ajaran');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_tahun_ajaran');
    }
}
