<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'nama',
        'jabatan',
        'status_kepegawaian',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user','id_user');
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'id_guru');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_guru');
    }
}
