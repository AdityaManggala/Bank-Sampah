<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\NasabahModel;
use App\Models\TransaksiNasabahModel;

use Illuminate\Http\Request;

class TransaksiNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'admin' => AdminModel::all(),
            'nasabah' => NasabahModel::all(),
            'trnasabah' => TransaksiNasabahModel::all()
        ];
        return view('user.nasabah.transaksi', $data);
    }

    public function indexTransaksi()
    {
        $data = [
            'nasabah' => NasabahModel::all()
        ];
        return view('user.nasabah.transaksiAdd', $data);
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
        if ($request->tipe_transaksi == 'debit') {
            $request->validate([
                'admin_id' => 'required',
                'nasabah_id' => 'required',
                'tipe_transaksi' => 'required'
            ]);
            $getId = TransaksiNasabahModel::create($request->post());
            return redirect()->route('detail-transaksi-nasabah.show', $getId);
        } else {
            $request->validate([
                'admin_id' => 'required',
                'nasabah_id' => 'required',
                'tipe_transaksi' => 'required'
            ]);
            $getNasabah = [
                'transaksi_id' => TransaksiNasabahModel::create($request->post()),
                'nasabah_id' => $request->nasabah_id
            ];
            return redirect()->route('nasabah.ambilSaldo', $getNasabah);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTransaksiNasabah($id)
    {
        $data = [
            'trnasabah' => TransaksiNasabahModel::where('nasabah_id', $id)->get(),
        ];
        
        return view('user.nasabah.transaksiNasabah', $data);
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
        $getIdNasabah = [
            'id' => TransaksiNasabahModel::where('id', $id)->value('nasabah_id'),
            'debit' => $request->grand_total_harga,
            'id_transaksi' => $id
        ];

        return redirect()->route('nasabah.addSaldo', $getIdNasabah);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function transaksiSelesai(Request $request)
    {
        $idDtrans = TransaksiNasabahModel::findOrFail($request->id_transaksi);
        $idDtrans->update([
            'grand_total_harga' => $request->grand,
            'status' => '2'
        ]);
        return redirect()->route('transaksi-nasabah.index');
    }
}
