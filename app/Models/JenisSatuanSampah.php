<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSatuanSampah extends Model
{
    use HasFactory;

    public $table = "jenis_satuan_sampah";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_jenis_satuan',
    ];

    public function sampah()
    {
        return $this->hasMany(SampahModel::class);
    }

    public function saldoSampah()
    {
        return $this->hasMany(SaldoSampah::class);
    }
}
