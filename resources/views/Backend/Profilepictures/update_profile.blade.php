<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.css" rel="stylesheet">
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
                    <h4>Update Profile</h4>
                    <hr>
                </div>

                <br>
                @if ($profilepicture)
                    <div class="container-fluid px-4">
                        <div class="card w-100 mb-3">
                            <div class="card-body">
                                <div class="modal-body">
                                    <form action="{{ route('profile_update', $profilepicture->first()->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <div class="foto-profile">
                                                <label for=""><strong>Foto saat ini</strong></label>
                                                <img src="{{ asset('storage/' . $profilepicture->first()->profile_img) }}"
                                                    alt="" class="img-fluid"
                                                    style="width: 100px; height: 100px; border-radius: 10%;">
                                            </div>
                                            <label><strong>Ubah Foto Profil</strong></label>
                                            <input type="file" name="profile_img" class="form-control"
                                                type="text">
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Nama</strong></label>
                                            <input type="text" value="{{ $profilepicture->first()->name }}"
                                                name="name" class="form-control" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Bio</strong></label>
                                            <input class="form-control" value="{{ $profilepicture->first()->bio }}"
                                                name="bio" cols="30" rows="10"></input>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>About</strong></label>
                                            <textarea style="display:none;" id="content-summernote" name="about">
                                                {!! $profilepicture->first()->about !!}
                                            </textarea>
                                        </div>
                                        <br>
                                        <div class="btn-submit">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>



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

</html>
