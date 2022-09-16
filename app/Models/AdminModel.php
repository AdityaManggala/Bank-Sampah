<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use HasFactory;

    public $table = "admin";
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
