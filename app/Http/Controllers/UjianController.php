<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use App\Models\Pertanyaan;
use App\Models\Soal;
use App\Models\Ujian;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujian = Ujian::all();
        $soal = Soal::all();

        return view('ujian.index', [
            'ujian' => $ujian,
            'daftarujian' => $soal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $soal = Soal::find($id);
        $pertanyaan = Pertanyaan::where('soal_id', $id)->get();

        return view('ujian.create', [
            'soal' => $soal,
            'pertanyaan' => $pertanyaan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $pertanyaan = $request->pertanyaan;
        $jawaban = $request->jawaban;
        $nilai = 0;

        $ujian = new Ujian;
        $ujian->user_id = Auth::id();
        $ujian->soal_id = $request->soal_id;
        $ujian->save();

        foreach($pertanyaan as $key => $value) {

            $per = Pertanyaan::find($value);
            $datapertanyaan = $per->pertanyaan;

            // Periksa jika jawaban kosong
            if (!isset($jawaban[$key])) {
                $jawaban[$key] = NULL;
            }
            //Jika jawaban benar
            if($jawaban[$key] == $per->jawaban) {
                $nilai += $per->nilai;

                $hasilujian = new HasilUjian;
                $hasilujian->ujian_id = $ujian->id;
                $hasilujian->pertanyaan = $datapertanyaan;
                $hasilujian->jawaban = $jawaban[$key];
                $hasilujian->nilai = $per->nilai;
                $hasilujian->save();

            }
            // Jika jawaban salah
            else {
                $nilai += 0;

                $hasilujian = new HasilUjian;
                $hasilujian->ujian_id = $ujian->id;
                $hasilujian->pertanyaan = $datapertanyaan;
                $hasilujian->jawaban = $jawaban[$key];
                $hasilujian->nilai = 0;
                $hasilujian->save();

            }


        }

        Ujian::find($ujian->id)->update(['total' => $nilai]);

        return redirect()->route('ujian.hasil');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ujian $ujian)
    {

        $hasilUjian = HasilUjian::where('ujian_id', $ujian->id)->get();

        return view('ujian.show', [
            'ujian' => $ujian,
            'hasilujian' => $hasilUjian
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ujian $ujian)
    {
        //
    }

    public function import(Ujian $ujian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ujian $ujian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ujian $ujian)
    {
        //
    }

    public function hasilujian()
    {
        $ujian = Ujian::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('ujian.hasil', compact('ujian'));
    }


}
