<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'id_user',
        'nama',
        'jabatan',
        'jenis_kelamin',
        'agama',
        'id_tahun_ajaran'
    ];

    /* RELATIONS */

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_guru'); // wali kelas
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_guru');
    }
}
