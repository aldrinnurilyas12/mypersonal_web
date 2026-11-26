<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <!-- Font Awesome 6.7.2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $profile->first()->profile_img) }}">
    <title>Aldrin Nur Ilyas - About</title>
</head>

<body class="body-daily-post">

    <section class="main-daily-post">
        <div class="content-daily-post">
            <div style="margin-bottom: 30px;" class="title">
                <div class="dflex-title">
                    <div class="col-md-8">
                        <div class="back">
                            <a href="{{ url('aldrinnurilyas') }}"> <i class="fa fa-arrow-left"> </i>
                                <span>Back</span></a>
                        </div>
                    </div>

                    <div class="title-content">
                        <h1>About</h1>
                    </div>
                </div>
            </div>


            <div class="content-wrap">
                <div class="container">
                    <div class="row">
                        <div style="display: flex;flex-wrap: nowrap; gap:20px;" class="content-center-text">
                            <div class="profile-image">
                                @if ($profile->isEmpty())
                                    <img class="profile-picture" src="{{ asset('img/blank.jpg') }}" title="stories">
                                @else
                                    <img class="profile-picture"
                                        src="{{ asset('storage/' . $profile->first()->profile_img) }}" title="stories">
                                @endif
                            </div>

                            <div style="display: block;" class="profile-name-content">
                                <h1 class="name" style="margin-top: 0px;">{{ $profile->first()->name }}</h1>

                                <div style="margin-bottom:15px;" class="country">
                                    <span class="fi fi-id"></span> Jakarta, Indonesia
                                </div>

                                <div class="col-md-8">
                                    <div class="icons">
                                        <a href="https://www.instagram.com/aldrinnurilyas/" target="_blank">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="https://x.com/aldrinnryas" target="_blank">
                                            <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/in/aldrinnurilyas/" target="_blank">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                        <a href="https://www.github.com/aldrinnurilyas12/" target="_blank">
                                            <i class="fa-brands fa-github"></i>
                                        </a>
                                        <a href="mailto:aldrinnoor1201@gmail.com" target="_blank">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <br>

                        <div class="col-md-8">
                            <div style="height: 40vh; overflow-y:auto; " class="main-menu">
                                <div style="overflow-y:auto;" class="p">
                                    {!! $profile->first()->about !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>


</html>
