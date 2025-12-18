<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = true;
    protected $keyType = 'int';

    // 🔴 MATIKAN TIMESTAMPS
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'agama',
        'id_kelas',
        'tahun_masuk',
    ];

    // Relasi ke Kelas (opsional tapi bagus)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Relasi ke User (opsional)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
