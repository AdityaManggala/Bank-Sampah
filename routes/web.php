<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DetailTransaksiNasabahController;
use App\Http\Controllers\DetailTransaksiPengepulController;
use App\Http\Controllers\JenisHargaSampahController;
use App\Http\Controllers\JenisSatuanSampahController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SaldoSampahController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiNasabahController;
use App\Http\Controllers\TransaksiPengepulController;
use App\Models\NasabahModel;
use App\Http\Controllers\RiwayatTransaksiNasabahController;
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




Route::get('/', LandingPageController::class)->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');


Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::middleware('auth:nasabah')->group(function () {

    Route::get('/transaksi-nasabah/showTransaksiNasabah/{id}', [TransaksiNasabahController::class, 'showTransaksiNasabah'])->name('transaksi.nasabah');

    Route::get('/nasabah/profilNasabah', [NasabahController::class, 'profilNasabah'])->name('nasabah.profilNasabah');

    Route::post('/nasabah/editNasabah/{id}', [NasabahController::class, 'editNasabah'])->name('nasabah.editNasabah');

    Route::get('/nasabah/indexUpdPass', [NasabahController::class, 'indexUpdPass'])->name('nasabah.updPass');

    Route::post('/nasabah/cekPwd', [NasabahController::class, 'cekPwd'])->name('nasabah.cekPwd');

    Route::post('/nasabah/gantiPass', [NasabahController::class, 'gantiPass'])->name('nasabah.gantiPass');
});

Route::middleware('auth:admin')->group(function () {

    Route::get('dashboard', [dashboardController::class, 'index'])->name('dashboard');

    Route::get('/transaksi-nasabah/indexTransaksi', [TransaksiNasabahController::class, 'indexTransaksi'])->name('index.transaksi');

    Route::get('/transaksi-nasabah/transaksiSelesai', [TransaksiNasabahController::class, 'transaksiSelesai'])->name('end.transaksi');

    Route::post('/detail-transaksi-nasabah/batalTransaksi/{id}', [DetailTransaksiNasabahController::class, 'batalTransaksi'])->name('batal.transaksi');

    Route::post('/detail-transaksi-nasabah/checkout', [DetailTransaksiNasabahController::class, 'checkout'])->name('checkout.transaksi');

    Route::get('/nasabah/tambahKredit', [NasabahController::class, 'substractSaldo'])->name('nasabah.substractSaldo');

    Route::get('/nasabah/tambahSaldo', [NasabahController::class, 'addSaldo'])->name('nasabah.addSaldo');

    Route::get('/nasabah/ambilSaldo', [NasabahController::class, 'ambilSaldo'])->name('nasabah.ambilSaldo');

    Route::post('/nasabah/ubahPass/{id}', [NasabahController::class, 'ubahPass'])->name('nasabah.ubahPass');

    Route::resource('jenis-harga-sampah', JenisHargaSampahController::class);

    Route::resource('jenis-satuan-sampah', JenisSatuanSampahController::class);

    Route::resource('sampah', SampahController::class);

    Route::resource('detail-transaksi-nasabah', DetailTransaksiNasabahController::class);

    Route::resource('nasabah', NasabahController::class);

    route::resource('transaksi-nasabah', TransaksiNasabahController::class);

    Route::post('/transaksi-pengepul/checkout', [DetailTransaksiPengepulController::class, 'checkout'])->name('checkout.transaksi.pengepul');

    route::resource('transaksi-pengepul', TransaksiPengepulController::class);

    route::resource('detail-transaksi-pengepul', DetailTransaksiPengepulController::class);

    route::get('admin/tambah-saldo', [AdminController::class, 'addSaldo'])->name('admin.addSaldo');

    Route::get('saldo-sampah', [SaldoSampahController::class, 'index'])->name('saldo-sampah');

    Route::get('riwayat-transaksi', [RiwayatTransaksiNasabahController::class, 'index'])->name('riwayat-transaksi.index');
    Route::get('riwayat-transaksi/show/{id}', [RiwayatTransaksiNasabahController::class, 'show'])->name('riwayat-transaksi.show');
});
