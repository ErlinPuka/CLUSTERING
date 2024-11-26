<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\werehouse;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
// use App\Kecamatan\Kecamatan;
use RealRashid\SweetAlert\Facades\Alert;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtlokasi = Kecamatan::all();
        $title = 'Hapus Kecamatan';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('kecamatan.index', compact('dtlokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Kecamatan::create([
            'kecamatan' => $request->input('kecamatan'),

        ]);
        Alert::success("Success", "Data berhasil disimpan");

        return redirect('kecamatan');
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
    public function edit(Kecamatan $kecamatan)
    {
        return view('kecamatan.edit', compact('Kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $dtlokasi = $request->all();

        $kecamatan->update($dtlokasi);
        Alert::success("Success", "Data berhasil diupdate");
        return redirect("kecamatan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        Alert::success("Success", "Data berhasil dihapus");

        return redirect('kecamatan');
    }
}
