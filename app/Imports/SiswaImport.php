<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{

    public function model(array $row)
    {

        $siswa = User::create([

            'nik' => $row['nik'],
            'email' => $row['email'],
            'jawaban' => $row['kuncijawaban'],
            'nilai' => $row['nilai'],
        ]);


        return $siswa;

    }
}
