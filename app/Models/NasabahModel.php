<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "nasabah";
    protected $fillable = [
        'nama_nasabah',
        'password',
        'alamat_nasabah',
        'no_rekening',
        'jml_keluarga',
        'rata_volume_smph_harian',
        'tgl_msk'
    ];

    protected $hidden = ['password'];

    public function rekening()
    {
        return $this->hasOne(RekeningNasabahModel::class);
    }

    public function transaksiNasabah(){
        return $this->hasMany(TransaksiNasabahModel::class);
    }

}
