<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function users()
    {
        $users = User::All();

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function siswa()
    {
        $kelas = Kelas::All();
        $siswa = User::where('role', 'Siswa')->get();

        return view('admin.siswa', [
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function tambahsiswa(Request $request)
    {
        User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Siswa',
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->back();
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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
        $import = Excel::import(new SiswaImport, storage_path('app/public/excel/'.$nama_file));

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
