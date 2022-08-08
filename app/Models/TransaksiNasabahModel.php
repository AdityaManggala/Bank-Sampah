<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiNasabahModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'nasabah_id',
        'grand_total_sampah_nasabah',
        'grand_total_berat',
        'tgl_transaksi'
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
