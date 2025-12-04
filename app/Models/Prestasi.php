<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa', 'nama_prestasi', 'tingkat', 'tahun', 'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
