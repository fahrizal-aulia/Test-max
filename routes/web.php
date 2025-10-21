<?php

use App\Models\Siswa;
use App\Models\Ujian;
use App\Models\Matpel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesertaUjianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $siswa = Siswa::count();
    $ujian = Ujian::count();
    $matpel = Matpel::count();
    return view('home', [
        'siswa' => $siswa,
        'ujian' => $ujian,
        'matpel' => $matpel,
    ]);
});

Route::resource('siswa', SiswaController::class);

// Ulangi untuk Matpel dan Ujian
Route::resource('matpel', MatpelController::class);
Route::resource('ujian', UjianController::class);


Route::prefix('ujian/{ujian}')->name('peserta.')->group(function () {
    Route::get('/peserta', [PesertaUjianController::class, 'index'])->name('index');
    Route::post('/peserta', [PesertaUjianController::class, 'store'])->name('store');
});
Route::put('/peserta/{peserta}/update-nilai', [PesertaUjianController::class, 'updateNilai'])->name('peserta.updateNilai');
Route::delete('/peserta/{peserta}', [PesertaUjianController::class, 'destroy'])->name('peserta.destroy');


// Rute untuk Laporan
Route::get('/laporan/by_tanggal', [LaporanController::class, 'ujianByTanggal'])->name('byTanggal');
Route::get('/laporan/jumlah-peserta', [LaporanController::class, 'jumlahPeserta'])->name('jumlahPeserta');
Route::get('/laporan/kelulusan', [LaporanController::class, 'statusKelulusan'])->name('kelulusan');

route::get("/algo", function() {
    return view('algo');
});