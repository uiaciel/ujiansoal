<?php

namespace App\Http\Controllers;

use App\Imports\SoalImport;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soal = Soal::orderBy('created_at', 'DESC')->where('user_id', Auth::id())->get();

        return view('soal.index', compact('soal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('soal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $soal = new Soal;
        $soal->user_id = Auth::id();
        $soal->title = $request->title;
        $soal->kategori = $request->kategori;
        $soal->mapel = $request->mapel;
        $soal->tanggal = $request->tanggal;
        $soal->menit = $request->menit;
        $soal->acaksoal = $request->acaksoal;
        $soal->acakjawaban = $request->acakjawaban;
        $soal->save();

        return redirect()->route('soal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Soal $soal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soal $soal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Soal $soal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soal $soal)
    {
        //
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->getClientOriginalName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);

        $request->session()->put('soal_id', $request->input('soal_id'));

        // import data
        $import = Excel::import(new SoalImport, storage_path('app/public/excel/'.$nama_file));

        if (Storage::disk('public')->exists('excel/'. $nama_file)) {
            Storage::disk('public')->delete('excel/'. $nama_file);
        }

        if($import) {
            //redirect
            return redirect()->back()->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->back()->with(['error' => 'Data Gagal Diimport!']);
        }


    }
}
