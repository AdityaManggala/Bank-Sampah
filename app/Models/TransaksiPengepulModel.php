<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPengepulModel extends Model
{
    use HasFactory;
    public $table = "transaksi_pengepul";
    protected $fillable = [
        'admin_id',
        'grand_total_harga',
        'tgl_transaksi',
        'nama_pengepul',
        'status'
    ];

    public function admin()
    {
        return $this->belongsTo(AdminModel::class);
    }

    public function detailTransaksiPengepul()
    {
        return $this->hasMany(DetailTransaksiPengepulModel::class);
    }
}
