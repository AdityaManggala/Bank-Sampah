<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningNasabahModel extends Model
{
    use HasFactory;

    
    public $table = "rekening_nasabah";
    protected $fillable = [
        'nasabah_id',
        'tipe_transaksi',
        'kredit',
        'debit',
        'saldo'
    ];


    public function nasabah()
    {
        return $this->belongsTo(NasabahModel::class);
    }
}
