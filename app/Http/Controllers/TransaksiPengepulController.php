<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use App\Models\TransaksiPengepulModel;
use App\Models\DetailTransaksiPengepulModel;
use Yajra\DataTables\Facades\DataTables;

class TransaksiPengepulController extends Controller
{

    public function index()
    {
        $data = [
            'tr' => TransaksiPengepulModel::with('admin')->get()
        ];

        return view('user.admin.transaksiPengepul.index', $data);
    }

    // public function dataTransaksiPengepul()
    // {
    //     $model = TransaksiPengepulModel::with('admin');
    //     return DataTables::eloquent($model)
    //     ->addColumn('admin', function(TransaksiPengepulModel $transaksiPengepulModel){
    //         return $transaksiPengepulModel->admin;
    //     })
    //     ->a
    //     ->toJson();

    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.transaksiPengepul.create');
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
            'admin_id' => 'required',
            'nama_pengepul' => 'required',
            'status' => 'required'
        ]);

        $getId = TransaksiPengepulModel::create($request->post());
        return redirect()->route('transaksi-pengepul.show', $getId);
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
            'sampah' => Sampah::where('jenis_harga_sampah_id', 1)->get(),
            'transaksi' => TransaksiPengepulModel::where('id', $id)->get(),
            'det_transaksi' => DetailTransaksiPengepulModel::where('transaksi_pengepul_id', $id)->get()
        ];
        return view('user.admin.DetailTransaksiPengepul.index', $data);
    }


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
        $trp = TransaksiPengepulModel::where('id', $id)->firstOrFail();
        $trp->status = 2;
        $trp->grand_total_harga = $request->grand_total_harga;
        $trp->save();
        
        $data = [
            'saldo' => $request->grand_total_harga,
            'id_admin' => TransaksiPengepulModel::where('id', $id)->value('admin_id')
        ];
        return redirect()->route('admin.addSaldo', $data);
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
}
