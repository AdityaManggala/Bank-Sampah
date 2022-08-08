<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    public $table = "sampah";
    protected $fillable = [
        'nama_sampah',
        'jenis_harga_sampah_id',
        'jenis_satuan_sampah_id',
        'harga_sampah'
    ];

    public function jenisSatuanSampah()
    {
        return $this->belongsTo(JenisSatuanSampah::class);
    }

    public function jenisHargaSampah()
    {
        return $this->belongsTo(JenisHargaSampah::class);
    }

    public function detailTransaksiNasabah()
    {
        return $this->hasMany(DetailTransaksiNasabahModel::class);
    }

    public function detailTransaksiPengepul()
    {
        return $this->hasMany(DetailTransaksiPengepulModel::class);
    }
}
