<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiNasabahModel extends Model
{
    use HasFactory;

    public $table = "transaksi_nasabah";
    protected $fillable = [
        'admin_id',
        'nasabah_id',
        'tipe_transaksi',
        'status',
        'grand_total_harga',
        'created_at',
        'updated_ad',
        'status'
    ];

    public function nasabah()
    {
        return $this->belongsTo(NasabahModel::class);
    }

    public function admin()
    {
        return $this->belongsTo(AdminModel::class);
    }

    public function detailTransaksiNasabah()
    {
        return $this->hasMany(DetailTransaksiNasabahModel::class);
    }
}
