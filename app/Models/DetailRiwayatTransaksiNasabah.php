<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRiwayatTransaksiNasabah extends Model
{
    use HasFactory;
    public $table = "detail_riwayat_transaksi_nasabah";
    protected $fillable = [
        'sampah_nama',
        'satuan',
        'rwyt_trans_nsb_id',
        'kuantitas',
        'subtotal_harga'
    ];
}
