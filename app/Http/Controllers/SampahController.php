<?php

namespace App\Http\Controllers;

use App\Models\JenisSatuanSampah;
use App\Models\JenisHargaSampah;
use App\Models\Sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'sampah' => Sampah::latest()->Paginate(15),
            'satuan' => JenisSatuanSampah::all(),
            'harga' => JenisHargaSampah::all()
        ];
        return view('user.admin.manajemenSampah.index', $data);
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
            'nama_sampah' => 'required',
            'harga_sampah' => 'required',
            'jenis_harga_sampah_id' => 'required',
            'jenis_satuan_sampah_id' => 'required'
        ]);

        // dd($request->all());

        Sampah::create([
            'nama_sampah' => $request->get('nama_sampah'),
            'harga_sampah' => $request->get('harga_sampah'),
            'jenis_harga_sampah_id' => $request->get('jenis_harga_sampah_id'),
            'jenis_satuan_sampah_id' => $request->get('jenis_satuan_sampah_id')
            // $request->all()
        ]);

        return redirect()->route('sampah.index')->with('success', 'data sampah telah ditambahkan');
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
        $data = Sampah::findOrFail($id);
        return view($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sampah::find($id);
        // dd($data);
        $data->delete();
        return redirect()->route('sampah.index')->with('success', 'data sampah telah dihapus');
    }
}
