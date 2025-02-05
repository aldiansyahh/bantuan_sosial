<?php

namespace App\Imports;

use App\Models\Bansos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BansosImport implements ToModel, WithMultipleSheets
{
    /**
     * Menentukan hanya membaca sheet ke-3
     */
    public function sheets(): array
    {
        return [
            6 => $this // Index sheet dimulai dari 0, jadi 2 = sheet ke-3
        ];
    }

    /**
     * Memetakan data dari Excel ke model Bansos.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Abaikan baris pertama yang berisi judul (indeks 0)
        static $isFirstRow = true;
        if ($isFirstRow) {
            $isFirstRow = false;
            return null; // Abaikan baris pertama
        }

        // Validasi: Abaikan baris jika rw kosong
        if (empty($row[1])) {
            return null;
        }

        return new Bansos([
            'nama' => $row[0],
            'rw' => $row[1],
            'penghasilan' => $row[2],
            'status_bangunan' => $row[3],
            'jumlah_kendaraan' => $row[4],
            'jumlah_tanggungan' => $row[5],
            'keterangan' => $row[6],
        ]);
    }
}
