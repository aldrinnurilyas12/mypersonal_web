<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Buat Postingan</title>
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
                    <h4>Buat Postingan Anda</h4>
                    <div class="card w-100 mb-3">
                        <div class="card-body">

                            <form action="{{ route('dailyposts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label><strong>Apa yang terjadi hari ini Aldrin?</strong></label>
                                    <br>
                                    <textarea name="post" id="content-summernote" class="form-control">
                                            </textarea>
                                </div>
                                <input type="text" name="updated_at" value="" hidden>
                                <br>
                                <div class="btn-submit">
                                    <button type="submit" class="btn btn-primary">Posting</button>
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
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

    body {
        font-family: "DM Sans", serif;
    }
</style>

</html>
