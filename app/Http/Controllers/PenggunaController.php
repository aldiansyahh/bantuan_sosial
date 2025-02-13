<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2020|max:2030',
        ]);

        Pengguna::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
