@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Hasil Ujian</h3>
            <div class="col-md-12">
                @can('isGuru')
                <div class="table-responsive">
                    <table class="table table-default table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">NAMA UJIAN</th>

                                <th scope="col">NILAI</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ujian as $ujian )
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ujian->created_at }}</td>
                                <td>{{ $ujian->soal->title }} - {{ $ujian->soal->mapel }}</td>
                                <td>{{ $ujian->total }}</td>
                                <td>
                                    <a name="" id="" class="btn btn-primary" href="/ujian/{{ $ujian->id }}"
                                        role="button">Review</a>
                                    {{-- <form action="{{ route('pertanyaan.create', $soal->id) }}">
                                        <input name="soal" value="{{ $soal->id }}" hidden>
                                        <button type="submit" class="btn btn-primary">
                                            Button
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endcan
                @can('isSiswa')
                <div class="table-responsive">
                    <table class="table table-default table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">NAMA UJIAN</th>

                                <th scope="col">NILAI</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ujian->where('user_id', Auth::id()) as $ujian )
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ujian->created_at }}</td>
                                <td>{{ $ujian->soal->title }} - {{ $ujian->soal->mapel }}</td>
                                <td>{{ $ujian->total }}</td>
                                <td>
                                    <a name="" id="" class="btn btn-primary" href="/ujian/{{ $ujian->id }}"
                                        role="button">Review</a>
                                    {{-- <form action="{{ route('pertanyaan.create', $soal->id) }}">
                                        <input name="soal" value="{{ $soal->id }}" hidden>
                                        <button type="submit" class="btn btn-primary">
                                            Button
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endcan

            </div>
        </div>
    </div>
@endsection
