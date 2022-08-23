<?php

use App\Http\Controllers\JenisHargaSampahController;
use App\Http\Controllers\JenisSatuanHargaController;
use App\Http\Controllers\JenisSatuanSampahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiNasabahController;
use App\Http\Controllers\TransaksiPengepulController;
use App\Models\NasabahModel;
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

// Route::get('/', function () {
//     return view('Template');
// });
// Route::middleware()

Route::get('/', [LoginController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('user.admin.dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::resource('jenis-harga-sampah', JenisHargaSampahController::class);

    Route::resource('jenis-satuan-sampah', JenisSatuanSampahController::class);

    Route::resource('sampah', SampahController::class);

    Route::resource('nasabah', NasabahController::class);

    route::resource('transaksi-nasabah', TransaksiNasabahController::class);

    route::resource('transaksi-pengepul', TransaksiPengepulController::class);
});

// Route::get('/test', function () {
//     return view('layouts.starter');
// })->middleware('auth');
