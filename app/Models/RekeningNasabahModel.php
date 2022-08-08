<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningNasabahModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'no_rekening',
        'tipe_transaksi',
        'kredit',
        'saldo'
    ];


    public function nasabah()
    {
        return $this->belongsTo(NasabahModel::class);
    }
}
