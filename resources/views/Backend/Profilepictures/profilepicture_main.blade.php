<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Profile</title>
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
                    <h4>Profile</h4>
                    <hr>
                </div>

                <br>
                @if ($profilepicture->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="card w-100 mb-3">
                            <div class="card-body">
                                <div class="modal-body">
                                    <form action="{{ route('profilepictures.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label><strong>Upload Foto Profil</strong></label>
                                            <input type="file" name="profile_img" class="form-control"
                                                type="text">
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Nama</strong></label>
                                            <input type="text" name="name" class="form-control" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Bio</strong></label>
                                            <input class="form-control" name="bio" cols="30"
                                                rows="10"></input>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>About</strong></label>
                                            <textarea id="content-summernote" name="about"></textarea>
                                        </div>
                                        <br>

                                        <div class="btn-submit">
                                            <button type="submit" class="btn btn-primary">Simpan Profil</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($profilepicture as $picture)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <div class="img-profile">
                                        <label for=""><strong>Foto Profile</strong></label>
                                        <br>
                                        <img src="{{ asset('storage/' . $picture->profile_img) }}" alt=""
                                            class="img-fluid" style="width: 100px; height: 100px; border-radius: 10%;">

                                        <br>
                                        <hr>
                                        <label for=""><strong>Nama</strong></label>
                                        <p>{{ $picture->name }}</p>
                                        <hr>
                                        <label for=""><strong>Bio</strong></label>
                                        <p>{{ $picture->bio }}</p>
                                        <hr>
                                        <label for=""><strong>About</strong></label>
                                        <p>{!! $picture->about !!}</p>
                                    </div>
                                    <hr>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;"
                                            href="{{ route('profile_edit', $picture->id) }}">Ubah</a>


                                        <a class="btn btn-danger" style="size: 12px;" href="#" data-toggle="modal"
                                            data-target="#deleteModal{{ $picture->id }}">Hapus</a>



                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </main>
        </div>
    </div>

    @foreach ($profilepicture as $profile)
        <div class="modal fade" id="deleteModal{{ $profile->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $profile->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus informasi Profil anda?
                        <form action="{{ route('profile_delete', $picture->id) }}" method="POST">
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


    <!-- jQuery WAJIB pertama -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 4 JS (Summernote lebih cocok dengan ini) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>


    <script>
        $(document).ready(function() {


            $('#content-summernote').summernote({

                height: 300,

                placeholder: 'Tulis artikel Anda...',

                toolbar: [
                    ['style', ['style']],
                    ['font', [
                        'bold',
                        'italic',
                        'underline',
                        'clear'
                    ]],

                    ['color', ['color']],

                    ['para', [
                        'ul',
                        'ol',
                        'paragraph'
                    ]],

                    ['table', ['table']],

                    ['insert', [
                        'link',
                        'picture',
                        'video'
                    ]],

                    ['view', [
                        'fullscreen',
                        'codeview'
                    ]]
                ]

            });

        });
    </script>
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

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


</html>
