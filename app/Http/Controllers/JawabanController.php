<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;

class JawabanController extends Controller
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
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jawaban = array_filter($request->jawaban);

        foreach ($jawaban as $key => $value) {
            $jawaban = new Jawaban;
            $jawaban->pertanyaan_id = $request->pertanyaan_id;
            $jawaban->jawaban = $value;
            $jawaban->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Jawaban $jawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jawaban $jawaban)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        $jawaban->jawaban = $request->jawaban;
        $jawaban->save();

        return Redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jawaban $jawaban)
    {
        $jawaban->delete();
        return Redirect()->back();
    }
}
