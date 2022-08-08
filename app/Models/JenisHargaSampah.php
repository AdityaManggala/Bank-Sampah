<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHargaSampah extends Model
{
    use HasFactory;

    public $table = "jenis_harga_sampah";
    protected $fillable = [
        'nama_jenis_harga'
    ];

    public function sampah()
    {
        return $this->hasMany(SampahModel::class);
    }
}
