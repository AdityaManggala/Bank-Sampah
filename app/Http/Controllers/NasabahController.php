<?php

namespace App\Http\Controllers;

use App\Models\NasabahModel;
use App\Models\RekeningNasabahModel;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'nasabah' => NasabahModel::all(),
            'rekening' => RekeningNasabahModel::all()
        ];
        return view('user.nasabah.index', $data);
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
        $request->validate([
            'nama_nasabah' => 'required',
            'password' => 'required',
            'alamat_nasabah' => 'required',
            'no_rekening' => 'required',
            'jml_keluarga' => 'required',
            'tgl_msk' => 'required',
            'nasabah_id'
        ]);

        $getId = NasabahModel::create([
            'nama_nasabah' => $request->get('nama_nasabah'),
            'password' => $request->get('password'),
            'alamat_nasabah' => $request->get('alamat_nasabah'),
            'no_rekening' => $request->get('no_rekening'),
            'jml_keluarga' => $request->get('jml_keluarga'),
            'tgl_msk' => $request->get('tgl_msk')
        ]);

        RekeningNasabahModel::create([
            'nasabah_id' => $getId->id
        ]);

        return redirect()->route('nasabah.index')->with('success', 'data nasabah telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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
        $nasabah = NasabahModel::findOrFail($id);
        $nasabah->update($request->all());
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
        $data = NasabahModel::find($id);
        // dd($data);
        $data->delete();
        return redirect()->route('nasabah.index')->with('success', 'data nasabah telah dihapus');
    }

    public function addSaldo(Request $request)
    {
        // dd($request->all());
        $debitAwal = RekeningNasabahModel::where('id', $request->id)->value('debit');
        $kreditAwal = RekeningNasabahModel::where('id', $request->id)->value('kredit');
        $addDebit = $debitAwal + $request->debit;
        $addSaldo = $addDebit - $kreditAwal;
        $idNasabah = RekeningNasabahModel::findOrFail($request->id);
        $idNasabah->update([
            'debit' => $addDebit,
            'saldo' => $addSaldo
        ]);

        $getIdNasabah = [
            'id' => $request->id,
            'grand' => $request->debit,
            'id_transaksi' => $request->id_transaksi
        ];

        return redirect()->route('end.transaksi', $getIdNasabah);
    }

    public function substractSaldo(Request $request)
    {
        $debitAwal = RekeningNasabahModel::where('id', $request->id)->value('debit');
        $kreditAwal = RekeningNasabahModel::where('id', $request->id)->value('kredit');
        $addKredit = $kreditAwal + $request->kredit;
        $addSaldo = $debitAwal - $addKredit;
        $idNasabah = RekeningNasabahModel::findOrFail($request->id);
        $idNasabah->update([
            'kredit' => $addKredit,
            'saldo' => $addSaldo
        ]);

        $getIdNasabah = [
            'id' => $request->id,
            'grand' => $request->kredit,
            'id_transaksi' => $request->id_transaksi
        ];

        return redirect()->route('end.transaksi', $getIdNasabah);
    }

    public function ambilSaldo(Request $request)
    {

        $data = [
            'saldo' => RekeningNasabahModel::where('id', $request->nasabah_id)->value('saldo'),
            'transaksi_id' => $request->transaksi_id,
            'nasabah_id' => $request->nasabah_id
        ];

        return view('user.nasabah.transaksiKredit', $data);
    }
}
