<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanKepsek extends Model
{
    use HasFactory;

    protected $table = 'sambutan_kepsek';

    protected $fillable = [
        'nama_kepsek',
        'foto',
        'isi_sambutan',
    ];
}
