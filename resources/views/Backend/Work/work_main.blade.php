<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Working Experiences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="sb-nav-fixed">
    @include('components.component_admin.navbar.navbar')
    @include('components.component_admin.sidebar.sidebar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <br>
                <div class="container-fluid px-4">
                    <h4>Working Experiences</h4>
                    <hr>
                    <a class="btn btn-primary" style="size: 12px;" href="{{ route('workcreate') }}">Tambah Pengalaman
                        Kerja</a>
                </div>

                <br>
                @if ($working->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="alert alert-info" role="alert">
                            Aldrin belum menambahkan pengalaman kerja
                        </div>
                    </div>
                @else
                    @foreach ($working as $work)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><strong>Nama Perusahaan</strong></td>
                                                <td>: {{ $work->company_name }}
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><strong>Industri Perusahaan</strong></td>
                                                <td>: {{ $work->industry }}
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><strong>Posisi</strong></td>
                                                <td>: {{ $work->position }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Bekerja</strong></td>
                                                <td>:
                                                    {{ \Carbon\Carbon::parse($work->start_date)->format('d M Y') }}
                                                    <span>s.d</span>
                                                    {{ $work->end_date ? \Carbon\Carbon::parse($work->end_date)->format('d M Y') : 'Saat ini' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Deskripsi Pekerjaan</strong></td>
                                                <td>: {!! $work->job_description !!}</td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;"
                                            href="{{ route('workedit', $work->id) }}">Ubah</a>
                                        <a class="btn btn-danger" style="size: 12px;" href="#" data-toggle="modal"
                                            data-target="#deleteModal{{ $work->id }}">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </main>
        </div>
    </div>


    @foreach ($working as $work)
        <div class="modal fade" id="deleteModal{{ $work->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $work->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Pengalaman Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus Pengalaman Pekerjaan ini?
                        <form action="{{ route('work_delete', $work->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <br>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    @endforeach
</body>


@if (Session::has('message_success'))
    <script>
        Swal.fire({
            title: 'Berhasil',
            text: "{{ Session::get('message_success') }}",
            icon: 'success',
            position: 'top-end',
            toast: true,
            timer: 2000
        });
    </script>
@elseif (Session::has('message_error'))
    <script>
        Swal.fire({
            title: 'Gagal',
            text: "{{ Session::get('failed_message') }}",
            icon: 'error',
            position: 'top-end',
            toast: true,
            timer: 2000
        });
    </script>
@endif

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

    body {
        font-family: "DM Sans", serif;
    }

    .btn-action {
        display: flex;
        gap: 10px;
    }

    .date-posts {
        font-size: 12px;
        color: gray;
        margin-bottom: 10px
    }

    textarea {
        text-align: left;
    }

    .checkbox-tools {
        overflow-y: scroll;
        height: 100px
    }


    span.alert-desc {
        font-size: 13px;
        color: rgb(255, 0, 0);
        font-style: italic;
    }
</style>

</html>
