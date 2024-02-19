@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3 ">
                <h2>Managemen Soal</h2>
                <div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#importFile"> <i
                            class="fa fa-file-import" aria-hidden="true"></i> Import </button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalId"> <i
                            class="fa fa-plus-circle" aria-hidden="true"></i> Soal PG </button>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalId"> <i
                            class="fa fa-plus-circle" aria-hidden="true"></i> Soal Esai </button> --}}
                </div>
            </div>
            <div class="modal fade" id="importFile" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Import Data
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('ujian.import') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $soal->id }}" name="soal_id">
                                <div class="mb-3">
                                    <label for="" class="form-label">Choose file</label>
                                    <input type="file" class="form-control" name="file" />
                                    <div id="fileHelpId" class="form-text">Help text</div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Soal Pilihan Ganda
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('pertanyaan.store') }}">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" value="{{ $soal->id }}" name="soalid">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Pertanyaan</label>
                                    <textarea class="form-control" id="mytextarea" name="pertanyaan"
                                        rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Jawaban Benar</label>
                                    <input type="text" class="form-control" name="jawaban" id=""
                                        aria-describedby="helpId" placeholder="" />
                                    <small id="helpId" class="form-text text-muted">Help text</small>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Skor</label>
                                    <input type="number" class="form-control" name="nilai" id=""
                                        aria-describedby="helpId" placeholder="" />
                                    <small id="helpId" class="form-text text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">
                    {{ $soal->title}} - {{ $pertanyaansoal->pluck('nilai')->sum() }} poin
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-default table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Durasi</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td>{{ $soal->title }}</td>
                                    <td>{{ $soal->mapel }}</td>
                                    <td>{{ $soal->tanggal }}</td>
                                    <td>{{ $soal->menit }} menit</td>
                                    <td>Acak Jawaban : <span class="badge bg-primary"> {{ $soal->acakjawaban
                                            }}</span><br />Acak Soal : <span class="badge bg-danger"> {{ $soal->acaksoal
                                            }}</span></td>
                                    <td><span class="badge bg-success">{{ $soal->status }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-end fw-bold">
                    Pembuat Soal : {{ $soal->user->name }} {{ $soal->user->kelas->nama }}</p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class=" table-dark">
                        <tr>
                            <th>No</th>
                            <th>Soal + Jawaban</th>
                            <th scope="col">Pilihan Ganda</th>
                            <th scope="col" class="text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pertanyaansoal as $datasoal )
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-wrap" style="width: 400px">{!!$datasoal->pertanyaan!!}<br>
                                <h6><span class="badge bg-success">Jawaban Benar : {{ $datasoal->jawaban }} </span></h6>
                            </td>
                            <td>
                                <ol type="a">
                                    @forelse ($datasoal->pilihan as $pilihanjawaban )
                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                {{ $pilihanjawaban->jawaban }} @if ($pilihanjawaban->jawaban ==
                                                $datasoal->jawaban) <span class="badge bg-success"><i
                                                        class="fa fa-check" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $pilihanjawaban->id }}">
                                                    ...edit
                                                </a>
                                                <div class="modal fade" id="edit{{ $pilihanjawaban->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">
                                                                    Edit Jawaban
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                    action="{{ route('jawaban.update', $pilihanjawaban->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" value="{{ $datasoal->id }}"
                                                                        name="pertanyaan_id">
                                                                    <div class="mb-3">
                                                                        <label for=""
                                                                            class="form-label fw-bold">Pertanyaan :
                                                                        </label>
                                                                        {!! $datasoal->pertanyaan !!}
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for=""
                                                                            class="form-label fw-bold">Jawaban</label>
                                                                        <input type="text"
                                                                            value="{{ $pilihanjawaban->jawaban }}"
                                                                            class="form-control" name="jawaban" id=""
                                                                            aria-describedby="helpId" placeholder="" />
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Edit
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('jawaban.destroy', $pilihanjawaban->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                    <li>Belum Ada</li>
                                    @endforelse
                                </ol>
                                <div>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal{{ $datasoal->id }}">
                                            Tambah Jawaban
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-bold fs-1 text-center">{{ $datasoal->nilai }}</td>
                            <div class="modal fade" id="modal{{ $datasoal->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Pilihan Ganda
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('jawaban.store') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $datasoal->id }}" name="pertanyaan_id">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Pertanyaan : </label>
                                                    {!! $datasoal->pertanyaan !!}
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Pilihan Jawaban 1</label>
                                                    <input type="text" class="form-control" name="jawaban[]" id=""
                                                        aria-describedby="helpId" placeholder="" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Pilihan Jawaban 2</label>
                                                    <input type="text" class="form-control" name="jawaban[]" id=""
                                                        aria-describedby="helpId" placeholder="" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Pilihan Jawaban 3</label>
                                                    <input type="text" class="form-control" name="jawaban[]" id=""
                                                        aria-describedby="helpId" placeholder="" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Pilihan Jawaban 4</label>
                                                    <input type="text" class="form-control" name="jawaban[]" id=""
                                                        aria-describedby="helpId" placeholder="" />
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    Simpan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal trigger button -->
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
@endsection
