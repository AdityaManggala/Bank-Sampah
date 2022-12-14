<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiPengepulModel extends Model
{
    use HasFactory;
    public $table = 'detail_transaksi_pengepul';
    protected $fillable = [
        'sampah_id',
        'transaksi_pengepul_id',
        'kuantitas',
        'subtotal_harga',
    ];

    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }

    public function transaksiPengepuk()
    {
        return $this->belongsTo(TransaksiPengepulModel::class);
    }
}
