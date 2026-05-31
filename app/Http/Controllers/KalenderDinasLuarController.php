<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KalenderDinasLuar;

class KalenderDinasLuarController extends Controller
{
    // ADMIN / GLOBAL VIEW
    public function index()
    {
        $dinasLuar = KalenderDinasLuar::all();

        return view('dinasluar.kalender', compact('dinasLuar'));
    }

    // PETINGGI VIEW
    public function indexGlobal()
    {
        $dinasLuar = KalenderDinasLuar::all();

        return view('dinasluar.kalender', compact('dinasLuar'));
    }

    // REKAP
    public function rekapGlobal()
    {
        $data = KalenderDinasLuar::all();

        return view('dinasluar.rekap', [
            'dinasLuar' => $data
        ]);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'tanggal_dinas' => 'required|date',
            'keterangan' => 'nullable'
        ]);

        KalenderDinasLuar::create($request->all());

        return back()->with('success', 'Data berhasil disimpan');
    }

    // EDIT
    public function edit($id)
    {
        return KalenderDinasLuar::findOrFail($id);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $data = KalenderDinasLuar::findOrFail($id);
        $data->update($request->all());

        return back()->with('success', 'Data berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        KalenderDinasLuar::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}