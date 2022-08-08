<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiNasabahModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'sampah_id',
        'transaksi_nasabah_id',
        'kuantitas',
        'subtotal_harga'
    ];

    public function sampah()
    {
        return $this->belongsTo(SampahModel::class);
    }

    public function transaksiNasabah()
    {
        return $this->belongsTo(TransaksiNasabahModel::class);
    }
}
