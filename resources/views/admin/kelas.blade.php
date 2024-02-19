@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Managemen Kelas</h3>
            <div
                class="table-responsive"
            >
                <table
                    class="table table-default" id="myTable"
                >
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $kelas )
                        <tr class="">
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $kelas->nama }}</td>
                            <td>{{ $kelas->tahun }}</td>
                            <td></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- Modal trigger button -->
            <button
                type="button"
                class="btn btn-primary btn-md"
                data-bs-toggle="modal"
                data-bs-target="#modalId"
            >
                <i class="bi bi-plus"></i> Kelas
            </button>

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

            <!-- Optional: Place to the bottom of scripts -->
            <script>
                const myModal = new bootstrap.Modal(
                    document.getElementById("modalId"),
                    options,
                );
            </script>


        </div>
    </div>
</div>
@endsection
