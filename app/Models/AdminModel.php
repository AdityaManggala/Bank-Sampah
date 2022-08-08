<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'saldo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function transaksiNasabah()
    {
        return $this->hasMany(TransaksiNasabahModel::class);
    }

    public function TransaksiPengepul()
    {
        return $this->hasMany(TransaksiPengepulModel::class);
    }
}
