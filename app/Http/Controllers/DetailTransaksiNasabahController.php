<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiNasabahModel;
use App\Models\TransaksiNasabahModel;
use App\Models\Sampah;
use Illuminate\Http\Request;

class DetailTransaksiNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $getHarga = Sampah::where('id', $request->sampah_id)->value('harga_sampah');

        $request->validate([
            'sampah_id' => 'required',
            'transaksi_nasabah_id' => 'required',
            'kuantitas' => 'required'
        ]);

        $getSubtotal = $getHarga * $request->kuantitas;

        DetailTransaksiNasabahModel::create([
            'sampah_id' => $request->get('sampah_id'),
            'transaksi_nasabah_id' => $request->get('transaksi_nasabah_id'),
            'kuantitas' => $request->get('kuantitas'),
            'subtotal_harga' => $getSubtotal
        ]);

        return back()->with('success', 'data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'sampah' => Sampah::all(),
            'transaksi' => TransaksiNasabahModel::where('id', $id)->get(),
            'det_transaksi' => DetailTransaksiNasabahModel::where('transaksi_nasabah_id', $id)->get()
        ];
        return view('user.nasabah.transaksiSampah', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $getIdSampah = DetailTransaksiNasabahModel::where('id', $request->id)->value('sampah_id');
        $getHarga = Sampah::where('id', $getIdSampah)->value('harga_sampah');
        $getSubtotal = $getHarga * $request->kuantitas;

        $idDtrans = DetailTransaksiNasabahModel::findOrFail($id);
        $idDtrans->update([
            'kuantitas' => $request->kuantitas,
            'subtotal_harga' => $getSubtotal
        ]);
        return back()->with('success', 'data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailtransaksi = DetailTransaksiNasabahModel::findOrFail($id);
        $detailtransaksi->delete();
        return back();
    }

    public function checkout(Request $request)
    {
        $data = [
            'grand_total_harga' => DetailTransaksiNasabahModel::where('transaksi_nasabah_id', $request->transaksi_nasabah_id)->sum('subtotal_harga'),
            'transaksi_id' => $request->transaksi_nasabah_id
        ];

        return redirect()->route('transaksi-nasabah.update', $data );
    }
}
