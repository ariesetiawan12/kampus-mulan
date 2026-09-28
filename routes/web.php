<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AnggotaImportController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RiwayatPeminjamanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BackupController;

/*
|--------------------------------------------------------------------------
| Redirect Awal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('login');

});
Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->name('dashboard');

Route::get(
    '/statistik',
    [StatistikController::class, 'index']
)->name('statistik.index');
/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::controller(LoginController::class)->group(function () {

    Route::get('/login', 'index')->name('login');

    Route::post('/login', 'login');

    Route::post('/logout', 'logout')->name('logout');

});

/*
|--------------------------------------------------------------------------
| Setelah Login
|--------------------------------------------------------------------------
*/

Route::middleware([])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */

    Route::resource('kategori', KategoriController::class);
    Route::resource('rak',RakController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('kelas', KelasController::class);

    /*
|--------------------------------------------------------------------------
| CETAK KARTU ANGGOTA
|--------------------------------------------------------------------------
*/

Route::get(
    '/anggota/cetak-semua-kartu',
    [AnggotaController::class, 'cetakSemuaKartu']
)->name('anggota.cetak-semua-kartu');

    Route::resource('anggota', AnggotaController::class);
    Route::get('/anggota-import', [AnggotaImportController::class, 'create'])
    ->name('anggota.import.create');

Route::post('/anggota-import', [AnggotaImportController::class, 'store'])
    ->name('anggota.import.store');

Route::get(
    '/anggota/{anggota}/cetak-kartu',
    [AnggotaController::class, 'cetakKartu']
)->name('anggota.cetak-kartu');
    Route::get(
    '/peminjaman/{peminjaman}/cetak',
    [PeminjamanController::class, 'cetak']
)->name('peminjaman.cetak');

Route::resource('peminjaman', PeminjamanController::class)
    ->only([
        'index',
        'create',
        'store',
        'show',
        'destroy'
    ]);

    Route::get(
    '/pengembalian',
    [PengembalianController::class, 'index']
)->name('pengembalian.index');

Route::get(
    '/pengembalian/{peminjaman}/create',
    [PengembalianController::class, 'create']
)->name('pengembalian.create');

Route::post(
    '/pengembalian/{peminjaman}',
    [PengembalianController::class, 'store']
)->name('pengembalian.store');

Route::get(
    '/pengembalian/{peminjaman}',
    [PengembalianController::class, 'show']
)->name('pengembalian.show');

Route::get(
    '/riwayat-peminjaman',
    [RiwayatPeminjamanController::class, 'index']
)->name('riwayat-peminjaman.index');
/*
|--------------------------------------------------------------------------
| LAPORAN
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan',
    [LaporanController::class, 'index']
)->name('laporan.index');

Route::get(
    '/laporan/cetak-peminjaman',
    [LaporanController::class, 'cetakPeminjaman']
)->name('laporan.cetak-peminjaman');

/*
|--------------------------------------------------------------------------
| PENGATURAN - MANAJEMEN ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('pengaturan')
    ->name('pengaturan.')
    ->group(function () {

        Route::resource(
            'admin',
            AdminController::class
        )->except([
            'create',
            'edit'
        ]);

    });

    Route::view(
    '/tentang-aplikasi',
    'tentang-aplikasi.index'
)->name('tentang-aplikasi');

Route::resource('petugas', PetugasController::class);

Route::get(
    '/backup',
    [BackupController::class, 'index']
)->name('backup.index');

Route::get(
    '/backup/download',
    [BackupController::class, 'download']
)->name('backup.download');

});
