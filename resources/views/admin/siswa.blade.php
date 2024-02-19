@extends('layouts.app')
@section('content')
<div class="container">
    <div
                class="modal fade"
                id="tambahkelas"
                tabindex="-1"
                data-bs-backdrop="static"
                data-bs-keyboard="false"

                role="dialog"
                aria-labelledby="modalTitleId"
                aria-hidden="true"
            >
                <div
                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                    role="document"
                >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Modal title
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="{{ route('kelas.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Kelas</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nama"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    <small id="helpId" class="form-text text-muted">Help text</small>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Tahun</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="tahun"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    <small id="helpId" class="form-text text-muted">Help text</small>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

    <div class="row">
        <div class="col-md-12">
            <div class="border-bottom border-2 mb-3 border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3 ">
                    <h2><i class="fa fa-rectangle-list" aria-hidden="true"></i> Managemen Siswa</h2>
                    <div>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#importFile"> <i class="fa fa-file-import" aria-hidden="true"></i>
                                Import </button>

                        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
                            data-bs-target="#modalId">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Siswa
                        </button>
                        <button type="button" class="btn btn-dark btn-md" data-bs-toggle="modal"
                            data-bs-target="#tambahkelas">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Kelas
                        </button>
                    </div>
                </div>
                <!-- Modal trigger button -->
                <div class="modal fade" id="importFile" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Import Data
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('ujian.import') }}" enctype="multipart/form-data">
                                    @csrf
                                    {{-- <input type="hidden" value="{{ $siswa->id }}" name="soal_id"> --}}
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Choose file</label>
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
                <div class="modal fade" id="modalId" tabindex="-2" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Tambah Siswa
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('siswa.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">NIK</label>
                                                <input type="text" class="form-control" name="nik" id=""
                                                    aria-describedby="helpId" placeholder="" />
                                                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Email</label>
                                                <input type="text" class="form-control" name="email" id=""
                                                    aria-describedby="helpId" placeholder="" />
                                                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Password</label>
                                                <input type="text" class="form-control" name="password" id=""
                                                    aria-describedby="helpId" placeholder="" />
                                                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Nama</label>
                                                <input type="text" class="form-control" name="name" id=""
                                                    aria-describedby="helpId" placeholder="" />
                                                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Kelas</label>
                                                <select class="form-select" name="kelas_id" id="">
                                                    @foreach ($kelas as $kelasz)
                                                    <option value="{{ $kelasz->id }}">{{ $kelasz->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-default table-striped table-fixed" id="myTable">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $user )
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->kelas->nama }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update{{ $user->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </div>

                                <div class="modal fade" id="update{{ $user->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Tambah Siswa
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                                <div class="modal-body">
                                    <form action="{{ route('siswa.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">NIK</label>
                                        <input type="text" class="form-control" name="nik" value="{{ $user->nik }}"
                                            aria-describedby="helpId" placeholder="" />
                                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Nama</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                            aria-describedby="helpId" placeholder="" />
                                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                                            aria-describedby="helpId" placeholder="" />
                                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Password</label>
                                        <input type="text" class="form-control" name="password" value="{{ $user->nik }}"
                                            aria-describedby="helpId" placeholder="" />
                                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Kelas</label>
                                        <select class="form-select" name="kelas_id" id="">
                                            @foreach ($kelas as $kelasx)
                                            <option value="{{ $kelasx->id }}">{{ $kelasx->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>

                                </div>

                        </div>
                    </div>
                </div>
                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
