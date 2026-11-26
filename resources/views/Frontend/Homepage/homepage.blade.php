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
    <title>Aldrin Nur Ilyas</title>

</head>

<body>
    <section class="foto-profile">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div>
                        @if ($profile->isEmpty())
                            <img class="profile-picture" src="{{ asset('img/blank.jpg') }}" title="profile-picture">
                        @else
                            <img class="profile-picture" src="{{ asset('storage/' . $profile->first()->profile_img) }}"
                                title="profile-picture">
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h1 class="name">{{ $profile->first()->name }}</h1>
                    @if ($profile->isEmpty())
                        -
                    @else
                        <p class="subtitle typewriter-animation">{{ $profile->first()->bio }}</p>
                    @endif

                </div>
                <div style="margin-bottom:20px;" class="country">
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

                <div class="col-md-8">
                    <div class="main-menu">
                        <ul class="menu-list">
                            <li><a href="{{ url('about') }}">About </a></li>
                            <li><a href="{{ url('myworking') }}">Work </a></li>
                            <li><a href="{{ url('myprojects') }}">Projects </a></li>
                            <li><a href="{{ route('posts') }}">Daily Posts </a></li>
                            <li><a href="{{ url('mypodcast') }}">Podcast </a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>
