<?php

namespace App\Http\Controllers;

use App\Models\JenisSatuanSampah;
use App\Models\JenisHargaSampah;
use App\Models\SaldoSampah;
use App\Models\Sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{

    public function index()
    {
        $data = [
            'sampah' => Sampah::all(),
            'satuan' => JenisSatuanSampah::all(),
            'harga' => JenisHargaSampah::all(),
        ];
        return view('user.admin.manajemenSampah.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sampah' => 'required',
            'harga_sampah' => 'required',
            'jenis_harga_sampah_id' => 'required',
            'jenis_satuan_sampah_id' => 'required'
        ]);

        // dd($request->all());

        $id = Sampah::create([
            'nama_sampah' => $request->get('nama_sampah'),
            'harga_sampah' => $request->get('harga_sampah'),
            'jenis_harga_sampah_id' => $request->get('jenis_harga_sampah_id'),
            'jenis_satuan_sampah_id' => $request->get('jenis_satuan_sampah_id')
            // $request->all()
        ])->id;

        if ($request->jenis_harga_sampah_id == 1) {
            SaldoSampah::create([
                'sampah_id' => $id,
                'jenis_satuan_sampah_id' => $request->jenis_satuan_sampah_id,
                'qty' => 0
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sampah' => 'required',
            'harga_sampah' => 'required',
            'jenis_harga_sampah_id' => 'required',
            'jenis_satuan_sampah_id' => 'required'
        ]);
        $data = Sampah::findOrFail($id);
        $data->update(request()->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        Sampah::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
