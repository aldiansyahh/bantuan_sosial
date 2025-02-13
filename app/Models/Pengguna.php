<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'info_pengguna'; // Nama tabel dalam database

    protected $fillable = [
        'judul',
        'tahun',
    ];
}
