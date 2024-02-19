@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fs-3">
                    Ujian {{ $soal->title }} - {{ $soal->mapel }} - <div id="timer"></div>
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
                                    <th scope="col">Penguji</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td>{{ $soal->title }}</td>
                                    <td>{{ $soal->mapel }}</td>
                                    <td>{{ $soal->tanggal }}</td>
                                    <td>{{ $soal->menit }} menit</td>
                                    <td>Acak Jawaban : <span class="badge bg-primary"> {{ $soal->acakjawaban }}</span><br />Acak
                                        Soal : <span class="badge bg-danger"> {{ $soal->acaksoal }}</span></td>
                                    <td><span class="badge bg-success">{{ $soal->user->name }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered" style="width: 400px;">
                            <tbody>
                                <tr>
                                    <td class="fs-bold">Nama Siswa</td>
                                    <td class="fs-bold">{{ Auth::user()->name }}</td>

                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>{{ Auth::user()->kelas->nama }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body p-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" id="myForm" action="{{ route('ujian.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input value="{{ $soal->id }}" name="soal_id" hidden>
                        <h5 class="mb-3">Jawablah pertanyaan ini dengan benar</h5>
                        <ol type="1">

                            @foreach ($pertanyaan->shuffle() as $pertanyaan )
                            <li class="mb-3"><div class="fw-bold fs-5">{!! $pertanyaan->pertanyaan !!}</div>
                                <div class="group">
                                    <input value="{{ $pertanyaan->id }}" name="pertanyaan[]" hidden>

                                    @foreach ($pertanyaan->pilihan->shuffle() as $jawab )

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $jawab->jawaban }}" {{ in_array($jawab->jawaban, old('jawaban', [])) ? 'checked' : '' }}
                                            data-pertanyaan="{{ $pertanyaan->id }}" name="jawaban[]">
                                        <label class="form-check-label" for=""> {{ $jawab->jawaban }} </label>
                                    </div>

                                    @endforeach



                                </div>
                            </li>
                            @endforeach
                        </ol>
                        <div class="mb-3 text-end">
                            <button type="button" data-bs-toggle="modal"
                            data-bs-target="#modalId" class="btn btn-primary">
                                Submit
                            </button>

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
                                                Ujian
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Kamu yakin ?
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Close
                                            </button>
                                        </div>
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
<script type="text/javascript">

    // Waktu dalam menit
    const duration = {{ $soal->menit }};
    let timeLeft = duration * 60;

     // Mencegah reload halaman saat tombol F5 atau Ctrl+R ditekan
     document.onkeydown = function (e) {
        if (e.key === 'F5' || (e.ctrlKey && e.key === 'r')) {
            e.preventDefault();
            alert('Refresh dinonaktifkan');
        }
    };

    const countdownTimer = document.getElementById('timer');

    function countdown() {
        const minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        countdownTimer.innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

        if (timeLeft == 600) {
            alert('Waktu tersisa 10 menit!');
        }

        if (timeLeft <= 0) {
            window.onbeforeunload = null;
            document.getElementById('myForm').submit();
        } else {
            timeLeft--;
            setTimeout(countdown, 1000);
        }
    }

    countdown();



    // Mencegah pengguna untuk kembali ke halaman sebelumnya
    window.history.pushState(null, null, window.location.href);
        window.onpopstate = function(event) {
            window.history.pushState(null, null, window.location.href);
        };

        // Mencegah reload halaman atau mengklik tombol refresh di browser
        window.onbeforeunload = function(event) {
            const formSubmitted = document.getElementById('myForm').submitted;

            if (!formSubmitted) {
                return "Apakah Anda yakin ingin meninggalkan halaman?";
            }
        };

        // Menandai bahwa formulir telah dikirim saat pengguna menekan tombol submit
        document.getElementById('myForm').addEventListener('submit', function(event) {
            this.submitted = true;
        });


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.group input[type="checkbox"]').click(function() {
            var pertanyaanId = $(this).data('pertanyaan');
            $('.group input[data-pertanyaan="' + pertanyaanId + '"]').not(this).prop('checked', false);
        });
    });
</script>
@endsection
