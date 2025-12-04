<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileSekolah extends Model
{
    protected $table = 'profile_sekolah';
    protected $primaryKey = 'id_profile';
    public $timestamps = false;

    protected $fillable = [
        'nama_sekolah','alamat','telp','email','visi','misi','logo'
    ];
}
