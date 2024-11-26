<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Produksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produksi = Produksi::all();
        // return view('Produksi.produksi', compact($produksi));

        $produksi = Produksi::orderBy('tahun', 'asc')->get();
        $title = 'Hapus Produksi';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('Produksi.produksi',compact('produksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatan = Lokasi::all();
        return view('Produksi.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Produksi::create([
            'kecamatan' => $request->input('kecamatan'),
            'tahun' => $request->input('tahun'),
            'produksi' => $request->input('produksi'),
        ]);

        Alert::success("Success", "Data berhasil disimpan");
        return redirect('produksi');

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
    public function edit(Produksi $produksi)
    {
        $kecamatan = Lokasi::all();
        return view('Produksi.editproduksi', compact('produksi', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produksi $produksi)
    {
        
        $data = $request->all();

        $produksi->update($data);
        Alert::success("Success", "Data berhasil diupdate");
        return redirect("produksi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produksi $produksi)
    {
        $produksi->delete();
        Alert::success("Success", "Data berhasil dihapus");

        return redirect('produksi');
    }
}
