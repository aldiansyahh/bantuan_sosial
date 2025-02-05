<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Imports\BansosImport;
use Illuminate\Http\Request;
use App\Models\SudahDibayar;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\bansosExport;
use DateTime;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controllers;
use App\Models\Penerimabansos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

Paginator::useBootstrap(); // Untuk styling Bootstrap



class BansosController extends Controller
{


    public function bansos(Request $request)
    {
        $totalKeluarga = Bansos::count();
        $totalLayak = Bansos::where('keterangan', 'Layak')->count();
        $totalTidakLayak = Bansos::where('keterangan', 'Tidak Layak')->count();

        // Mengambil data kepala keluarga dengan menghitung jumlah total, layak, dan tidak layak
        $dataKepalaKeluarga = Bansos::select(
            'rw', // Menampilkan RW
            Bansos::raw('COUNT(*) as total'), // Jumlah total kepala keluarga
            Bansos::raw("SUM(CASE WHEN keterangan = 'Layak' THEN 1 ELSE 0 END) as layak"), // Menghitung 'Layak'
            Bansos::raw("SUM(CASE WHEN keterangan = 'Tidak Layak' THEN 1 ELSE 0 END) as tidak_layak") // Menghitung 'Tidak Layak'

        )
            ->groupBy('rw') // Kelompokkan berdasarkan RW
            ->get();


        $status = $request->input('status', 'all'); // Mengambil status filter (all, layak, tidak layak)

        if ($status == 'layak') {
            // Menampilkan semua data yang 'Layak' sesuai filter
            $kepala_keluarga = Bansos::where('keterangan', 'Layak')->get();
        } elseif ($status == 'tidakLayak') {
            // Menampilkan semua data yang 'Tidak Layak' sesuai filter
            $kepala_keluarga = Bansos::where('keterangan', 'Tidak Layak')->get();
        } else {
            // Menampilkan semua data tanpa filter
            $kepala_keluarga = Bansos::all();
        }
        // Mengembalikan data ke view
        return view('bansos.bansos', compact('dataKepalaKeluarga', 'kepala_keluarga', 'totalKeluarga', 'totalLayak', 'totalTidakLayak'));
    }




    public function bansosimportexcel(Request $request)
    {
        // Memastikan file diunggah
        $file = $request->file('file');

        // Jika file tidak ada, kirimkan pesan error
        if (!$file) {
            return redirect()->back()->with('error', 'File tidak ditemukan. Harap unggah file.');
        }

        $namaFile = $file->getClientOriginalName();

        // Memindahkan file ke folder Uploadbansos di dalam folder public
        $file->move(public_path('data_bansos'), $namaFile);

        try {
            // Mengimpor data dari file Excel
            Excel::import(new BansosImport, public_path('data_bansos/' . $namaFile));

            // Menampilkan alert sukses
            return redirect('/bansos')->with('success', 'Data berhasil diimpor!');
        } catch (\Exception $e) {
            // Menampilkan alert gagal
            return redirect('/')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
    public function resetData()
    {
        try {
            // Matikan sementara foreign key constraint
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Hapus semua data dari tabel bansos
            Bansos::query()->delete();

            // Aktifkan kembali foreign key constraint
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect('/')->with('success', 'Semua data telah dihapus.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


    public function tambahbansos()
    {
        return view('bansos.insertbansos');
    }


    public function insertbansos(request $request)
    {
        bansos::create($request->all());
        return redirect()->route('bansos')->with('success', 'Data Berhasil Ditambahkan!');
    }


    private function findbansos($id)
    {
        return bansos::where('id', $id)->first();
    }
    public function noloop()
    {
        $bansos = bansos::paginate(10); // Misalkan 10 item per halaman
        return view('your_view_name', compact('bansos'));
    }

    public function bansosDelete(Request $request, $id)
    {
        $bansos = $this->findbansos($id);

        if (!$bansos) {
            return redirect()->route('bansos')->with('error', 'Data tidak ditemukan!');
        }

        $bansos->delete();
        return redirect()->route('bansos', ['search' => $request->input('search')])->with('delete', 'Data berhasil dihapus');
    }



    public function updatebansos(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nomor_pegawai' => 'required',

        ]);

        // Cari bansos berdasarkan ID
        $bansos = bansos::find($id);
        if (!$bansos) {
            return redirect('/bansos')->with('error', 'bansos tidak ditemukan');
        }
        // Perbarui data bansos
        $bansos->update($request->all());

        return redirect('/bansos')->with('success', 'Data bansos berhasil diperbarui.');
    }
}
