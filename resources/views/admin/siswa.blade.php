@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div  class="border-bottom border-2 mb-3 border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3 ">
                    <h2><i class="fa fa-rectangle-list" aria-hidden="true"></i> Managemen Siswa</h2>
                    <div>
                        <button
                    type="button"
                    class="btn btn-success btn-md"
                    data-bs-toggle="modal"
                    data-bs-target="#modalId"
                >
                 <i class="fa fa-print" aria-hidden="true"></i> Cetak Kartu
                 <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#importFile"> <i
                    class="fa fa-file-import" aria-hidden="true"></i> Import </button>
                </button>
                        <button
                    type="button"
                    class="btn btn-primary btn-md"
                    data-bs-toggle="modal"
                    data-bs-target="#modalId"
                >
                 <i class="fa fa-plus-circle" aria-hidden="true"></i> Siswa
                </button>
                <button
                    type="button"
                    class="btn btn-dark btn-md"
                    data-bs-toggle="modal"
                    data-bs-target="#modalId"
                >
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('ujian.import') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" value="{{ $siswa->id }}" name="soal_id"> --}}
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
                <div
                    class="modal fade"
                    id="modalId"
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
                                    Tambah Siswa
                                </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <form action="{{ route('siswa.store') }}" method="POST">
                                @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="" class="form-label">NIK</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nik"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Nama</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="email"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="password"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                </div>



                                <div class="mb-3">
                                    <label for="" class="form-label">Kelas</label>
                                    <select
                                        class="form-select"
                                        name="kelas_id"
                                        id=""
                                    >
                                    @foreach ($kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach

                                    </select>
                                </div>




                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Optional: Place to the bottom of scripts -->
                <script>
                    const myModal = new bootstrap.Modal(
                        document.getElementById("modalId"),
                        options,
                    );
                </script>

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
                            <td >{{ $loop->iteration }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->kelas->nama }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="text-center"><div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>

                                <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                              </div></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
