<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    public $timestamps = false;

    protected $fillable = ['judul','isi','tanggal','dibuat_oleh'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
