<?php

use App\Http\Controllers\Admin\BobotController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\PenilaianSemesterController;
use App\Http\Controllers\Admin\RankingSiswaController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TahunAjarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/',[LoginController::class,'auth']);
Route::post('/logout',[LoginController::class,'logout'])->middleware('auth');


Route::middleware(['auth','user-access:admin-tu'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('home-tu');
    Route::resource('/admin/siswa', SiswaController::class)->except('show');
    Route::resource('/admin/kriteria/penilaian', PenilaianController::class)->except('show');
    Route::resource('/admin/kriteria/bobot', BobotController::class)->except('show');
    Route::resource('/admin/tahun-ajar', TahunAjarController::class)->except('show');
    Route::resource('/admin/kelas', KelasController::class)->except('show');
    Route::resource('/admin/user', UserController::class)->except('show');
    Route::get('/admin/penilaian/siswa', [RankingSiswaController::class, 'index']);

    Route::resource('/admin/penilaian/kelas', PenilaianSemesterController::class);

    Route::get('/admin/export/excel', [RankingSiswaController::class, 'exportExcel']);
    Route::get('/admin/export/pdf', [RankingSiswaController::class, 'exportPdf']);
});

Route::middleware(['auth','user-access:guru'])->group(function() {
    Route::get('/guru/dashboard', [DashboardController::class,'index'])->name('home-tu');
    Route::resource('/guru/siswa', SiswaController::class)->only('index');
    // Route::resource('/guru/kriteria/penilaian', PenilaianController::class)->except('show');
    // Route::resource('/guru/kriteria/bobot', BobotController::class)->except('show');
    // Route::resource('/guru/tahun-ajar', TahunAjarController::class)->except('show');
    // Route::resource('/guru/kelas', KelasController::class)->except('show');
    // Route::resource('/guru/user', UserController::class)->except('show');

    Route::resource('/guru/penilaian/kelas', PenilaianSemesterController::class)->only(['index', 'show']);
    Route::post('/guru/penilaian/kelas/nilai-siswa/{kela}', [PenilaianSemesterController::class, 'penilaianSiswa']);
    Route::get('/guru/penilaian/siswa', [RankingSiswaController::class, 'index']);
    Route::get('/guru/export/excel', [RankingSiswaController::class, 'exportExcel']);
    Route::get('/guru/export/pdf', [RankingSiswaController::class, 'exportPdf']);
});
