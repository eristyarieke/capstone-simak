<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'role', 'status'
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_user');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_user');
    }
}
