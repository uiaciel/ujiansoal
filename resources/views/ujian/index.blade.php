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
                        <div><i class="fa fa-calendar" aria-hidden="true"></i> {{
                            Carbon\Carbon::parse($datanya->tanggal)->isoFormat('D MMMM YYYY'); }}</div>
                        <div>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#ujian{{ $datanya->id }}"><i class="fa fa-arrow-right"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ujian{{ $datanya->id }}" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Waktunya Ujian!
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card p-3">
                                <div class="d-flex align-items-top">
                                    <div class="image me-3">
                                        <img src="https://smksedkijakarta.files.wordpress.com/2017/11/smkn-3-jakarta.jpeg"
                                            class="rounded p-2" width="155">
                                    </div>
                                    <div class="ml-3 w-100">
                                        <h4 class="mb-0 mt-0">{{ Auth::user()->name }}</h4>
                                        <span class="mb-4">NIK : {{ Auth::user()->nik }}</span>
                                        <h5 class="mt-4">{{ $datanya->title }}</h5>
                                        <h3>{{ $datanya->mapel }}</h3>

                                        <div class="button mt-2 d-flex flex-row align-items-center">

                                            <span class="btn btn-sm btn-outline-danger me-2 w-100 btn-disable "><i class="fa fa-hourglass" aria-hidden="true"></i> {{ $datanya->menit }} menit</span>
                                            <a href="/ujian/create/{{ $datanya->id }}" onclick="openInNewWindow(event)"
                                                class="btn btn-sm btn-primary w-100 ml-2"><i class="fa fa-play" aria-hidden="true"></i> MASUK</a>
                                           </div>

                                    </div>
                                </div>
                            </div>


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
