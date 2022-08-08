<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_nasabah',
        'alamat_nasabah',
        'no_rekening',
        'tgl_msk',
        'jml_keluarga',
        'rata_volume_smph_harian'
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
