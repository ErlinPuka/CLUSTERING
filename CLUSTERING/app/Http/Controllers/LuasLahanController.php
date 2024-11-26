<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Luaslahan;
use App\Models\werehouse;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use RealRashid\SweetAlert\Facades\Alert;

class LuasLahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtlokasi = Luaslahan::orderBy('tahun', 'asc')->get();
        $title = 'Hapus Lokasi';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('luaslahan.index', compact('dtlokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('luaslahan.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Luaslahan::create([
            'id_kecamatan' => $request->input('id_kecamatan'),
            'luas_lahan' => $request->input('luas_lahan'),
            'tahun' => $request->input('tahun'),

        ]);
        Alert::success("Success", "Data berhasil disimpan");

        return redirect('luaslahan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Luaslahan $luaslahan)
    {
        $kecamatan = Kecamatan::all();
        return view('luaslahan.edit', compact('luaslahan', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Luaslahan $luaslahan)
    {
        $dtlokasi = $request->all();

        $luaslahan->update($dtlokasi);
        Alert::success("Success", "Data berhasil diupdate");
        return redirect("luaslahan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Luaslahan $luaslahan)
    {
        $luaslahan->delete();
        Alert::success("Success", "Data berhasil dihapus");

        return redirect('luaslahan');
    }
}
