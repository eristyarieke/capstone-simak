<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelBerita extends Model
{
    protected $table = 'artikel_berita';
    protected $primaryKey = 'id_artikel';
    public $timestamps = false;

    protected $fillable = ['judul','isi','tanggal','penulis','foto'];
}
