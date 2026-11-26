<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
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
                    <h4>Projects Porfolio</h4>
                    <hr>
                    <a class="btn btn-primary" style="size: 12px;" href="{{ route('projects_create') }}">Buat
                        Project</a>
                </div>

                <br>
                @if ($projects->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="alert alert-info" role="alert">
                            Aldrin belum memposting project
                        </div>
                    </div>
                @else
                    @foreach ($projects as $project)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <table class="table table-border">
                                        <tbody>
                                            <tr>
                                                <td><strong>Nama Project</strong></td>
                                                <td>: {{ $project->project_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Subtitle</strong></td>
                                                <td>: {{ $project->subtitle }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Upload</strong></td>
                                                <td>: {{ $project->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Kategori Project</strong></td>
                                                <td>: {{ $project->category_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Kontributor Project</strong></td>
                                                <td>: {{ $project->contributors ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>GitHub</strong></td>
                                                <td>: {{ $project->github_link ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Demo Project</strong></td>
                                                <td>: {{ $project->demo_project_link ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Mulai</strong></td>
                                                <td>:
                                                    {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Selesai</strong></td>
                                                <td>:
                                                    {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Deskripsi</strong></td>
                                                <td>:
                                                    <div style="height: 200px;overflow-x:auto;" class="text-post">
                                                        <p class="description-display">
                                                            {!! $project->description !!}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;"
                                            href="{{ route('projects_edit', $project->id) }}">Ubah Project</a>

                                        <a class="btn btn-danger" href="#" data-toggle="modal"
                                            data-target="#projectModal{{ $project->id }}">Hapus Project</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </main>
        </div>
    </div>



    {{-- END --}}
    <!--  UPDATE PROJECTS Modal -->
    @foreach ($projects as $project)
        <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Projects</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus project <strong>{{ $project->project_name }}</strong> ?
                        </p>
                        <form action="{{ route('projects_delete', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
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
</style>

</html>
