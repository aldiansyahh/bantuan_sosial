<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PenerimabansosController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\RiwayatPenerimaController;
use App\Http\Controllers\SudahDibayarController;
use App\Models\Bansos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', [MasterController::class, 'master'])->name('master');
Route::get('/bansos', [BansosController::class, 'search'])->name('bansos');
Route::get('/bansos', [BansosController::class, 'bansos'])->name('bansos');
Route::get('/insertBansos', [BansosController::class, 'tambahbansos'])->name('insertBansos');
Route::post('/insertbansos', [BansosController::class, 'insertbansos'])->name('insertbansos');
Route::post('/importbansos', [BansosController::class, 'bansosimportexcel'])->name('importbansos');
Route::post('/reset-data', [BansosController::class, 'resetData'])->name('reset.data');

Route::get('/get-kepala-keluarga/{rw}', function ($rw) {
    $data = Bansos::where('rw', $rw)->get([
        'id',
        'nama',
        'rw',
        'penghasilan',
        'status_bangunan',
        'jumlah_kendaraan',
        'jumlah_tanggungan',
        'keterangan'
    ]);

    return response()->json($data);
});


// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/loginAdmin', [LoginController::class, 'loginAdmin'])->name('loginAdmin');
// Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
// Route::post('actionloginAdmin', [LoginController::class, 'actionloginAdmin'])->name('actionloginAdmin');
// Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
// Route::get('register', [RegisterController::class, 'register'])->name('register');
// Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');