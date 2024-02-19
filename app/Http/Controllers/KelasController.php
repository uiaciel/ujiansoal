<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::All();

        return view('admin.kelas', [
            'kelas' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kelas = new Kelas;
        $kelas->nama = $request->nama;
        $kelas->slug = Str::slug($request->nama);
        $kelas->tahun = $request->tahun;
        $kelas->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $slug = Kelas::where('slug', $id)->pluck('id');

        $user = User::where('kelas_id', $slug)->get();
        $namakelas = Kelas::where('id', $slug)->first();

        return view('admin.listkelas', [
            'user' => $user,
            'namakelas' => $namakelas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $kelas->nama = $request->nama;
        $kelas->slug = Str::slug($request->nama);
        $kelas->tahun = $request->tahun;
        $kelas->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {

        $kelas->delete();

        return redirect()->back();
    }
}
