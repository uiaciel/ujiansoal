@extends('layouts.app')
@section('content')
<div class="container">

@can('isGuru')

<div class="row align-items-md-stretch mb-3">
    <div class="col-md-12">
        <div class="h-100 p-5 text-white bg-dark border rounded-3" >
            <h2>Selamat Datang, {{ Auth::user()->name }} ({{ Auth::user()->role }})</h2>
            <p>
                Website Ujian Online SMK N 3 JAKARTA
            </p>
            <button class="btn btn-outline-primary" type="button" >Profile</button>
        </div>
    </div>

</div>
@endcan

@can('isSiswa')

<div class="row align-items-md-stretch mb-3">
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
                            <a href="/ujian/create/{{ $datanya->id }}" target="_blank" class="btn btn-primary">Yakin</a>

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

@endcan

</div>
@endsection
