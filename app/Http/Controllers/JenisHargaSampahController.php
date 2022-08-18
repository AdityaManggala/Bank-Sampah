<?php

namespace App\Http\Controllers;

use App\Models\JenisHargaSampah;
use Illuminate\Http\Request;

class JenisHargaSampahController extends Controller
{

    public function index()
    {
        $data = [
            'prices' => JenisHargaSampah::all(),
        ];

        return view('user.admin.manajemenJenisHarga.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_harga' => 'required'
        ]);

        JenisHargaSampah::create($request->post());
        
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $jenisharga = JenisHargaSampah::find($id);
        $jenisharga->update($request->post());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $jenisharga = JenisHargaSampah::findOrFail($id);
        $jenisharga->delete();

        return response()->json(['success' => true]);
    }
}