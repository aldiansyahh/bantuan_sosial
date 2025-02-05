<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bansos extends Model
{
    use HasFactory;

    protected $table = 'kepala_keluarga';

    protected $primaryKey = 'id';

    // Model bansos.php
    public function jenisPensiun()
    {
        return $this->belongsTo(JenisPensiun::class, 'kd_jenis_pensiun', 'kd_jenis_pensiun');
    }

    protected $fillable = [
        'id',
        'nama',              // No Register
        'rw',                     // Nama Peserta
        'status_bangunan',            // Tanggal Lahir
        'jumlah_kendaraan',            // Tanggal Masuk
        'penghasilan',                      // MKG
        'jumlah_tanggungan',                 // Golongan
        'keterangan',                  // Jabatan
    ];

    protected $guarded = [];


    public $timestamps = true;
}
