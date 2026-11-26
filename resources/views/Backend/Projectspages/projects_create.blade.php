<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Tambah Projects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                    <h4>Tambah Project Anda</h4>
                    <div class="card w-100 mb-3">
                        <div class="card-body">

                            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label><strong>Nama Project</strong></label>
                                    <input name="project_name" class="form-control" placeholder="Masuka nama Project"
                                        type="text">
                                </div>

                                <div class="form-group">
                                    <label><strong>Subtitle</strong></label>
                                    <textarea name="subtitle" class="form-control" placeholder="Masukan subtitle project">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>Kategori Project</strong></label>
                                    <select class="form-control" name="category_id" id="">
                                        <option value="">=== Pilih Kategori Project ===</option>
                                        @foreach ($project_category as $project)
                                            <option value="{{ $project->id }}">{{ $project->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><strong>Link Github</strong></label>
                                    <input name="github_link" class="form-control" type="text"
                                        placeholder="Masukan link Github project">
                                </div>

                                <div class="form-group">
                                    <label><strong>Link Demo</strong></label>
                                    <input name="demo_project_link" class="form-control" type="text"
                                        placeholder="Masukan link demo project">
                                </div>

                                <div class="form-group">
                                    <label><strong>Tanggal Mulai Project</strong></label>
                                    <input name="start_date" class="form-control" type="date">
                                </div>

                                <div class="form-group">
                                    <label><strong>Tanggal Akhir Project</strong></label>
                                    <input name="end_date" class="form-control" type="date">
                                </div>

                                <div class="form-group">
                                    <label><strong>Status Project</strong></label>
                                    <select class="form-control" name="project_status" id="">
                                        <option value="">=== Pilih status project ===</option>
                                        <option value="Progress">Progress</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Peninjauan ulang">Revisi/Tinjau Ulang</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><strong>Contributors (opsional)</strong></label>
                                    <input name="contributors" class="form-control" type="text">
                                </div>

                                <div class="form-group">
                                    <label><strong>Upload Gambar Utama (Wajib)</strong></label>
                                    <input type="file" name="media_files" class="form-control" type="text"
                                        required>
                                </div>


                                <div class="form-group">
                                    <label><strong>Deskripsi Project</strong></label>
                                    <textarea name="description" id="content-summernote" cols="30" rows="10"></textarea>
                                </div>

                                <div class="button-submit">
                                    <button class="btn btn-primary" type="submit">Simpan Project</button>
                                </div>



                            </form>



                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </main>
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

                    placeholder: 'Masukan deskripsi project...',

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
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

    body {
        font-family: "DM Sans", serif;
    }
</style>

</html>
