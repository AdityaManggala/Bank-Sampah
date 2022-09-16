<?php

namespace App\Http\Controllers;

use App\Models\SaldoSampah;
use Illuminate\Http\Request;

class SaldoSampahController extends Controller
{
    public function index()
    {
        $saldo = SaldoSampah::all();
        return view('user.admin.saldo-sampah', ['data' => $saldo]);
    }
}
