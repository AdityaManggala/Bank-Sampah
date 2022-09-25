<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksiNasabah extends Model
{
    use HasFactory;
    public $table = "riwayat_transaksi_nasabah";
    protected $fillable = [
        'admin_nama',
        'nasabah_nama',
        'tipe_transaksi',
        'grand_total_harga',
        'created_at',
        'updated_ad',
    ];
}
