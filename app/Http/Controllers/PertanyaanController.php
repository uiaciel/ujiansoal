<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\Soal;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $idsoal = $request->soal;

        $soal = Soal::find($idsoal);
        $pertanyaan = Pertanyaan::where('soal_id', $idsoal)->get();


        return view('pertanyaan.create', [
            'soal' => $soal,
            'idsoal' => $idsoal,
            'pertanyaansoal' => $pertanyaan
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pertanyaan = new Pertanyaan;
        $pertanyaan->soal_id = $request->soalid;
        $pertanyaan->kategori = $request->kategori;
        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->jawaban = $request->jawaban;
        $pertanyaan->nilai = $request->nilai;
        $pertanyaan->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        //
    }
}
