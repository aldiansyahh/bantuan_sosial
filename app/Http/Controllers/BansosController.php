<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Pengguna;
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
        // Ambil data terakhir dari info_pengguna
        $infoPengguna = Pengguna::latest()->first();

        // Pastikan data tidak null agar tidak error
        $tahun = $infoPengguna->tahun ?? 'Tahun Tidak Ditemukan';
        $judul = $infoPengguna->judul ?? 'Judul Tidak Ditemukan';

        // Menghitung total data
        $totalKeluarga = Bansos::count();
        $totalLayak = Bansos::where('keterangan', 'Layak')->count();
        $totalTidakLayak = Bansos::where('keterangan', 'Tidak Layak')->count();

        // Mengambil data kepala keluarga dengan menghitung jumlah total, layak, dan tidak layak per RW
        $dataKepalaKeluarga = Bansos::select(
            'rw',
            Bansos::raw('COUNT(*) as total'),
            Bansos::raw("SUM(CASE WHEN keterangan = 'Layak' THEN 1 ELSE 0 END) as layak"),
            Bansos::raw("SUM(CASE WHEN keterangan = 'Tidak Layak' THEN 1 ELSE 0 END) as tidak_layak")
        )
            ->groupBy('rw')
            ->get();

        // Filter berdasarkan status
        $status = $request->input('status', 'all');

        if ($status == 'layak') {
            $kepala_keluarga = Bansos::where('keterangan', 'Layak')->get();
        } elseif ($status == 'tidakLayak') {
            $kepala_keluarga = Bansos::where('keterangan', 'Tidak Layak')->get();
        } else {
            $kepala_keluarga = Bansos::all();
        }

        // Mengembalikan data ke view dengan tambahan judul dan tahun
        return view('bansos.bansos', compact(
            'dataKepalaKeluarga',
            'kepala_keluarga',
            'totalKeluarga',
            'totalLayak',
            'totalTidakLayak',
            'tahun',
            'judul'
        ));
    }








    public function bansosimportexcel(Request $request)
    {


        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2020|max:2030',
            'file' => 'required|file|mimes:xlsx,csv,xls'
        ]);

        // Simpan judul dan tahun ke dalam tabel info_pengguna
        $infoPengguna = new Pengguna();
        $infoPengguna->judul = $request->judul;
        $infoPengguna->tahun = $request->tahun;
        $infoPengguna->save();
        $tahun = $request->input('tahun', date('Y')); // Default tahun ke tahun saat ini
        $judul = $request->input('judul', 'judul'); // Default judul jika tidak ada input
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
