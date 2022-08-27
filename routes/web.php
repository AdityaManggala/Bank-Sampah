<?php

use App\Http\Controllers\DetailTransaksiNasabahController;
use App\Http\Controllers\JenisHargaSampahController;
use App\Http\Controllers\JenisSatuanHargaController;
use App\Http\Controllers\JenisSatuanSampahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiNasabahController;
use App\Http\Controllers\TransaksiPengepulController;
use App\Models\NasabahModel;
use App\Models\TransaksiNasabahModel;
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

Route::get('/transaksi-nasabah/indexTransaksi', [TransaksiNasabahController::class, 'indexTransaksi'])->name('index.transaksi');

Route::get('/transaksi-nasabah/transaksiSelesai', [TransaksiNasabahController::class, 'transaksiSelesai'])->name('end.transaksi');

Route::post('/detail-transaksi-nasabah/batalTransaksi/{id}', [DetailTransaksiNasabahController::class, 'batalTransaksi'])->name('batal.transaksi');

Route::post('/detail-transaksi-nasabah/checkout', [DetailTransaksiNasabahController::class, 'checkout'])->name('checkout.transaksi');

Route::get('/nasabah/tambahSaldo', [NasabahController::class, 'addSaldo'])->name('nasabah.addSaldo');

Route::resource('jenis-harga-sampah', JenisHargaSampahController::class)->middleware('auth'); 

Route::resource('jenis-satuan-sampah', JenisSatuanSampahController::class)->middleware('auth');

Route::resource('sampah', SampahController::class)->middleware('auth');

Route::resource('nasabah', NasabahController::class)->middleware('auth');

Route::resource('transaksi-nasabah', TransaksiNasabahController::class)->middleware('auth');

Route::resource('detail-transaksi-nasabah', DetailTransaksiNasabahController::class)->middleware('auth');

Route::resource('transaksi-pengepul', TransaksiPengepulController::class)->middleware('auth');

Route::get('/test', function () {return view('layouts.starter');})->middleware('auth');
