<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\NasabahModel;
use App\Models\RekeningNasabahModel;
use App\Models\Sampah;
use Illuminate\Http\Request;
use App\Models\TransaksiNasabahModel;
use App\Models\TransaksiPengepulModel;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            // "transaksi nasabah" => TransaksiNasabahModel
            "saldo" => AdminModel::where('id', 1)->value('saldo'),
            "nasabah" => NasabahModel::select('id')->count(),
            "transaksi_nasabah_proses" => TransaksiNasabahModel::where('status', 1)->count(),
            "transaksi_nasabah_selesai" => TransaksiNasabahModel::where('status', 2)->count(),
            "transaksi_pengepul_selesai" => TransaksiPengepulModel::where('status', 2)->count(),
            "sampah_pengepul" => Sampah::where('jenis_harga_sampah_id', 1)->count(),
            "sampah_nasabah" => Sampah::where('jenis_harga_sampah_id', 2)->count(),
            "total_debit_nasabah" => RekeningNasabahModel::sum('saldo')
        ];
        return view('user.admin.dashboard', $data);
    }
}
