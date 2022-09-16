<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiNasabahModel;
use App\Models\DetailTransaksiPengepulModel;
use App\Models\JenisSatuanSampah;
use App\Models\SaldoSampah;
use App\Models\Sampah;
use Illuminate\Http\Request;

class DetailTransaksiPengepulController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'sampah_id' => 'required',
            'transaksi_pengepul_id' => 'required',
            'kuantitas' => 'required'
        ]);

        $countSampah = DetailTransaksipengepulModel::where('transaksi_pengepul_id', $request->transaksi_pengepul_id)->where('sampah_id', $request->sampah_id)->count();
        $sampah = Sampah::where('id', $request->sampah_id)->firstOrFail();
        $stokSampah = SaldoSampah::where('sampah_id', $request->sampah_id)->firstOrFail();
        $satuanSampah = JenisSatuanSampah::where('id', $sampah->jenis_satuan_sampah_id)->value('nama_jenis_satuan');

        if ($request->kuantitas > $stokSampah->qty) {
            return back()->with('msg', "Kuantitas Sampah $sampah->nama_sampah Kurang Dari $request->kuantitas $satuanSampah, Saldo Sampah $sampah->nama_sampah = $stokSampah->qty $satuanSampah");
        }

        $stokSampah->qty -= $request->kuantitas;
        $stokSampah->save();

        if ($countSampah == 0) {
            $getSubtotal = $sampah->harga_sampah * $request->kuantitas;
            DetailTransaksipengepulModel::create([
                'sampah_id' => $request->get('sampah_id'),
                'transaksi_pengepul_id' => $request->get('transaksi_pengepul_id'),
                'kuantitas' => $request->get('kuantitas'),
                'subtotal_harga' => $getSubtotal
            ]);

            return back()->with('success', "Data Sampah $sampah->nama_sampah Telah Ditambahkan");
        } else {
            $dtlSampah = DetailTransaksipengepulModel::where('transaksi_pengepul_id', $request->transaksi_pengepul_id)->where('sampah_id', $request->sampah_id)->firstOrFail();
            $dtlSampah->kuantitas += $request->kuantitas;
            $kuantitas = DetailTransaksipengepulModel::where('transaksi_pengepul_id', $request->transaksi_pengepul_id)->where('sampah_id', $request->sampah_id)->value('kuantitas');
            $dtlSampah->subtotal_harga = $kuantitas * $sampah->harga_sampah + $request->kuantitas * $sampah->harga_sampah;
            $dtlSampah->save();
            return back()->with('success', "Kuantitas Sampah $sampah->nama_sampah Telah Ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kuantitas' => 'required'
        ]);

        $dtTransaksiPengepul = DetailTransaksiPengepulModel::where('id', $request->id)->firstOrFail();
        $sampah = Sampah::where('id', $dtTransaksiPengepul->sampah_id)->firstOrFail();
        $stokSampah = SaldoSampah::where('sampah_id', $sampah->id)->firstOrFail();
        $satuanSampah = JenisSatuanSampah::where('id', $sampah->jenis_satuan_sampah_id)->value('nama_jenis_satuan');
        $stokTotal = $stokSampah->qty + $dtTransaksiPengepul->kuantitas;

        if ($request->kuantitas >= ($stokSampah->qty + $dtTransaksiPengepul->kuantitas)) {
            return back()->with('msg', "Kuantitas Sampah $sampah->nama_sampah Kurang Dari $request->kuantitas $satuanSampah, Saldo Sampah $sampah->nama_sampah = $stokTotal $satuanSampah");
        }

        if ($request->kuantitas > $dtTransaksiPengepul->kuantitas) {
            $selisih = $request->kuantitas - $dtTransaksiPengepul->kuantitas;
            $stokSampah->qty -= $selisih;
        } elseif ($request->kuantitas < $dtTransaksiPengepul->kuantitas) {
            $selisih = $dtTransaksiPengepul->kuantitas - $request->kuantitas;
            $stokSampah->qty += $selisih;
        }

        $stokSampah->save();
        $dtTransaksiPengepul->kuantitas = $request->kuantitas;
        $dtTransaksiPengepul->save();

        $setSubTotal = DetailTransaksiPengepulModel::where('id', $request->id)->firstOrFail();
        $setSubTotal->subtotal_harga = $sampah->harga_sampah * $request->kuantitas;
        $setSubTotal->save();

        return back()->with('success', "Kuantitas Sampah $sampah->nama_sampah Telah Diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailTrans = DetailTransaksiPengepulModel::findOrFail($id);
        $saldo = SaldoSampah::where('sampah_id', $detailTrans->sampah_id)->firstOrFail();
        $namaSampah = Sampah::where('id', $detailTrans->sampah_id)->value('nama_sampah');
        $saldo->qty += $detailTrans->kuantitas;
        $saldo->save();
        $detailTrans->delete();

        return back()->with('msg', "Sampah $namaSampah Telah Dihapus");
    }

    public function checkout(Request $request)
    {
        $data = [
            'grand_total_harga' => DetailTransaksiPengepulModel::where('transaksi_pengepul_id', $request->transaksi_pengepul_id)->sum('subtotal_harga'),
            'transaksi_pengepul_id' => $request->transaksi_pengepul_id
        ];
        return view('user.admin.transaksiPengepul.checkout', $data);
    }
}
