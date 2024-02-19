@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Data Siswa <strong>{{ $namakelas->nama }}</strong></h3>
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
                        @foreach ($user->where('role', 'Siswa') as $user )
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
