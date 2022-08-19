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

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::resource('jenis-harga-sampah', JenisHargaSampahController::class)->middleware('auth'); 

Route::resource('jenis-satuan-sampah', JenisSatuanSampahController::class)->middleware('auth');

Route::resource('sampah', SampahController::class)->middleware('auth');

Route::resource('nasabah', NasabahController::class)->middleware('auth');

route::resource('transaksi-nasabah', TransaksiNasabahController::class)->middleware('auth');

route::resource('transaksi-pengepul', TransaksiPengepulController::class)->middleware('auth');

Route::get('/test', function () {return view('layouts.starter');})->middleware('auth');
