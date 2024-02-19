@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">

                            <div>
                                Nama : {{ $ujian->user->name }}<br/>
                        Kelas : {{ $ujian->user->kelas->nama }}
                            </div>
                            <div class="text-end">
                                {{ $ujian->soal->title }} - {{ $ujian->soal->mapel }}<br/>
                                {{ $ujian->soal->created_at }}
                            </div>

                        </div>






<div
    class="table-responsive mt-3"
>
    <table
        class="table table-default"
    >
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th scope="col">Pertanyaan</th>
                <th scope="col">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilujian as $hasil)

            <tr class="">
                <td>{{ $loop->iteration }}</td>
                <td>{!! $hasil->pertanyaan !!} <p>Jawaban Anda : <strong>{{ $hasil->jawaban }}</strong></p></td>
                <td class="fs-4 fw-bold">{{ $hasil->nilai }}</td>

            </tr>

            @endforeach
            <tr class="">
                <td colspan="2" class="fs-5 text-end">Nilai Akhir : </td>
                <td class="fs-4 fw-bold">{{ $hasilujian->pluck('nilai')->sum() }}</td>


            </tr>

        </tbody>
    </table>
</div>


                        <ol type="1">



                    </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
