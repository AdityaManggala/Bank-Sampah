<?php

namespace App\Http\Controllers;

use App\Models\DetailRiwayatTransaksiNasabah;
use App\Models\RiwayatTransaksiNasabah;
use Illuminate\Http\Request;

class RiwayatTransaksiNasabahController extends Controller
{
    public function index()
    {
        $data = [
            'riwayat' => RiwayatTransaksiNasabah::all()
        ];
        return view('user.admin.RiwayatTransaksi.index', $data);
    }

    public function show($id)
    {
        $data = [
            'detail_riwayat' => DetailRiwayatTransaksiNasabah::where('rwyt_trans_nsb_id', $id)->get()
        ];
        return view('user.admin.RiwayatTransaksi.show', $data);
    }
}
