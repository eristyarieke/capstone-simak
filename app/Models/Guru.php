<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    public $timestamps = false;

    protected $fillable = [
        'id_user', 'nip', 'nama', 'jenis_kelamin', 'alamat',
        'no_hp', 'email', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
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
