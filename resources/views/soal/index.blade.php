@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="border-bottom border-2 mb-3 border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3 ">
                    <h2>Managemen Ujian</h2>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalId">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Buat </button>
                    </div>
                </div>
                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Buat Ujian Baru
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form method="POST" action="{{ route('soal.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="mb-3 row">
                                                <label for="" class="form-label text-end fw-bold col-sm-4">Judul</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="title" />
                                                    {{-- <small id="helpId" class="form-text text-muted">Help
                                                        text</small> --}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="form-label text-end fw-bold col-sm-4">Mata
                                                    Pelajaran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="mapel" />
                                                    {{-- <small id="helpId" class="form-text text-muted">Help
                                                        text</small> --}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for=""
                                                    class="form-label text-end fw-bold col-sm-4">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" name="tanggal" />
                                                    {{-- <small id="helpId" class="form-text text-muted">Help
                                                        text</small> --}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="form-label text-end fw-bold col-sm-4">Waktu
                                                    (Menit)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="menit" />
                                                    {{-- <small id="helpId" class="form-text text-muted">Help
                                                        text</small> --}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="form-label text-end fw-bold col-sm-4">Acak
                                                    Soal</label>
                                                <div class="col-sm-8">
                                                    <select class="form-select" name="acaksoal" id="">
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="form-label text-end fw-bold col-sm-4">Acak
                                                    Jawaban</label>
                                                <div class="col-sm-8">
                                                    <select class="form-select" name="acakjawaban" id="">
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" name="" id="" class="btn btn-primary">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-default table-striped table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($soal as $soal )
                    <tr class="">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $soal->title }}</td>
                        <td>{{ $soal->mapel }}</td>
                        <td>{{ $soal->tanggal }}</td>
                        <td>{{ $soal->menit }} menit</td>
                        <td>Acak Jawaban : <span class="badge bg-primary"> {{ $soal->acakjawaban }}</span><br />Acak
                            Soal : <span class="badge bg-danger"> {{ $soal->acaksoal }}</span></td>
                        <td><span class="badge bg-success">{{ $soal->status }}</span></td>
                        <td>
                            <form action="{{ route('pertanyaan.create', $soal->id) }}">
                                <input name="soal" value="{{ $soal->id }}" hidden>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                </button>
                                <a href="/ujian/create/{{ $soal->id }}" target="popup" onclick="window.open('width=1000,height=700')" class="btn btn-success"><i class="fa fa-eye"
                                        aria-hidden="true"></i></a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <h3>Kamu tidak memiliki Soal</h3>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
