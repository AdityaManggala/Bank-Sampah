<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoSampah extends Model
{
    use HasFactory;
    public $table = "saldo_sampah";
    public $primaryKey = 'id';
    protected $fillable = [
        'sampah_id',
        'jenis_satuan_sampah_id',
        'qty'
    ];

    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }

    public function jenisSatuanSampah()
    {
        return $this->belongsTo(JenisSatuanSampah::class);
    }
}
