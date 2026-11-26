<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Daily Posts</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
</head>

<body class="sb-nav-fixed">
    @include('components.component_admin.navbar.navbar')
    @include('components.component_admin.sidebar.sidebar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <br>
                <div class="container-fluid px-4">
                    <h4>Posting</h4>
                    <hr>
                    <a class="btn btn-primary" style="size: 12px;" href="{{ route('dailypost_create') }}">Buat
                        Postingan</a>
                </div>

                <br>
                @if ($posts->isEmpty())
                    <div class="container-fluid px-4">

                        <div class="alert alert-info" role="alert">
                            Aldrin belum memposting
                        </div>

                    </div>
                @else
                    @foreach ($posts as $post)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <p class="date-posts">Tanggal
                                        post: {{ \Carbon\carbon::parse($post->created_at)->format('d M Y h:i a') }}</p>
                                    @if ($post->last_edited_at)
                                        <p class="date-posts">Terakhir
                                            ubah:
                                            {{ \Carbon\carbon::parse($post->last_edited_at)->format('d M Y h:i a') }}
                                        </p>
                                    @endif
                                    <hr>
                                    <p class="card-text">{!! $post->post !!}
                                    </p>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;"
                                            href="{{ route('postupdate', $post->id) }}">Ubah</a>

                                        <a class="btn btn-danger" style="size: 12px;" href="#" data-toggle="modal"
                                            data-target="#deletePost{{ $post->id }}">Hapus Postingan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </main>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($posts as $post)
        <div class="modal fade" id="deletePost{{ $post->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus postingan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus postingan ini?

                        <form action="{{ route('deleteposts', $post->id) }}" method="POST">
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
            timer: 2000,
            confirmButtonText: 'OK'
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
        font-size: 14px;
        color: rgb(14, 14, 14);
        margin-bottom: 10px
    }

    textarea {
        text-align: left;
    }
</style>

</html>
