@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-3">
        @foreach ($daftarujian as $datanya )
        <div class="col-md-4">

            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $datanya->title }} {{ $datanya->mapel }}</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <p class="fs-3">{{ $datanya->menit }} menit</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div><i class="fa fa-calendar" aria-hidden="true"></i> {{ $datanya->tanggal }}</div>
                        <div>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ujian{{ $datanya->id }}"><i
                                    class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ujian{{ $datanya->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Waktunya Ujian!
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Kamu sudah siap ?</p>
                            <p>{{ Auth::user()->name }} - {{  Auth::user()->nik }}</p>
                        </div>
                        <div class="modal-footer">
                            <a href="/ujian/create/{{ $datanya->id }}"  onclick="openInNewWindow(event)" class="btn btn-primary">Yakin</a>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    @can('isGuru')
    <div class="row">
        <div class="col-md-12">
            <h2>Data Nilai Ujian</h2>
            <div class="table-responsive">
                <table class="table table-default table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">NAMA UJIAN</th>
                            <th scope="col">SISWA</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">NILAI</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ujian as $ujian )
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ujian->tanggal() }}</td>
                            <td>{{ $ujian->soal->title }} - {{ $ujian->soal->mapel }}</td>

                            <td>{{ $ujian->user->name }}</td>
                            <td>{{ $ujian->user->kelas->nama }}</td>

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
        </div>
    </div>
    @endcan
</div>
<script>
    function openInNewWindow(event) {
        event.preventDefault(); // Mencegah perilaku default dari tautan

        // Membuka tautan dalam jendela baru
        window.open(event.target.href, '_blank', 'fullscreen=yes,toolbar=no,location=no');
    }
</script>
@endsection
