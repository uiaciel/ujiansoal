<?php

namespace App\Imports;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $soal_id = Session::get('soal_id');

        $pertanyaan = Pertanyaan::create([
            'soal_id' => $soal_id,
            'kategori' => $row['kategori'],
            'pertanyaan' => $row['pertanyaan'],
            'jawaban' => $row['kuncijawaban'],
            'nilai' => $row['nilai'],
        ]);

        //Jawaban Benar
        Jawaban::create([
            'pertanyaan_id' => $pertanyaan->id,
            'jawaban' => $row['jawaban1'],
        ]);

        //Pilihan 2
        Jawaban::create([
            'pertanyaan_id' => $pertanyaan->id,
            'jawaban' => $row['jawaban2'],
        ]);

        //Pilihan 3
        Jawaban::create([
            'pertanyaan_id' => $pertanyaan->id,
            'jawaban' => $row['jawaban3'],
        ]);

        //Pilihan 4
        Jawaban::create([
            'pertanyaan_id' => $pertanyaan->id,
            'jawaban' => $row['jawaban4'],
        ]);

        return $pertanyaan;

    }

}
