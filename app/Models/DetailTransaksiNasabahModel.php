<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiNasabahModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "detail_transaksi_nasabah";
    public $primaryKey ="id";
    protected $fillable = [
        'sampah_id',
        'transaksi_nasabah_id',
        'kuantitas',
        'subtotal_harga'
    ];

    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }

    public function transaksiNasabah()
    {
        return $this->belongsTo(TransaksiNasabahModel::class);
    }
}
