<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NasabahModel extends Authenticatable
{
    use HasFactory;
    
    public $timestamps = false;
    public $table = "nasabah";
    protected $fillable = [
        'nama_nasabah',
        'username',
        'password',
        'alamat_nasabah',
        'no_rekening',
        'jml_keluarga',
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
