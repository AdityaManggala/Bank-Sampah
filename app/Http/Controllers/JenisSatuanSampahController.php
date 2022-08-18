<?php

namespace App\Http\Controllers;

use App\Models\JenisSatuanSampah;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenisSatuanSampahController extends Controller
{
    public function index()
    {
        $data = [
            'units' => JenisSatuanSampah::all()
        ];
        return view('user.admin.manajemenJenisSatuan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_satuan' => 'required'
        ]);

        JenisSatuanSampah::create($request->post());
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $unit = JenisSatuanSampah::find($id);
        $unit->nama_jenis_satuan = $request->nama_jenis_satuan;
        $unit->save();

        return response()->json(['success' => true]);
    }
    
    public function update(Request $request, $id)
    {
        $jenissatuan = JenisSatuanSampah::find($id);
        $jenissatuan->update($request->post());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        JenisSatuanSampah::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
