<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $profile->first()->profile_img) }}">
    <title>Aldrin Nur Ilyas - Podcast</title>
</head>

<body class="body-daily-post">
    <section class="main-daily-podcast">
        <div class="content-daily-post">
            <div class="title">
                <div class="dflex-title">
                    <div class="col-md-8">
                        <div class="back">
                            <a href="{{ url('aldrinnurilyas') }}"> <i class="fa fa-arrow-left"> </i>
                                <span>Back</span></a>
                        </div>
                    </div>

                    <div class="title-content">
                        <h1>Podcast</h1>
                    </div>
                </div>

                <div class="introduction">
                    <p class="intro-description">I'm wanna sharing my podcast for talks about software
                        engineering, friends, foods, and any field.
                    </p>
                </div>
                <hr class="hr-post">
            </div>



            <div class="content-wrap">
                <div class="card-post-podcast">
                    @if ($podcast->isEmpty())
                        <div class="container-fluid px-4">
                            <div style="text-align: center;margin-top:20px;font-size:14px;"
                                class="container-fluid px-4">
                                Aldrin belum memposting Podcast
                            </div>
                        </div>
                    @else
                        @foreach ($podcast as $podcast)
                            <div class="card-body-projects">
                                <div class="podcast-title">
                                    <div class="image-podcast">
                                        @if ($podcast->podcast_banner)
                                            <img class="podcast-img"
                                                src="{{ asset('storage/' . $podcast->podcast_banner) }}"
                                                alt="Profile Picture" class="img-fluid rounded-circle">
                                        @endif
                                    </div>


                                    <div class="main-title">
                                        <h5 class="title-project">{{ $podcast->podcast_title }}</h5>

                                        <div style="display: flex;flex-wrap: wrap;" class="project-category">
                                            <span>{{ $podcast->category_name }}</span>
                                        </div>
                                        <div style="align-items: center;" class="project-date">
                                            <span style="border:none;color:gray;font-size: 13px;"
                                                class="start-project-date">
                                                {{ \Carbon\Carbon::parse($podcast->created_at)->translatedFormat('d F Y') }}
                                            </span>
                                            &nbsp;
                                            @if ($podcast->last_edited_at)
                                                &nbsp;
                                                <span style="border:none;color:gray;font-size: 13px;" style=""
                                                    class="time">~ edited</span>
                                            @endif
                                        </div>

                                        <p class="description">{{ $podcast->podcast_subtitle }}</p>

                                        <div class="podcast-content">
                                            <button style="background: whitesmoke;color:#171d27;font-weight: bold;"
                                                class="btn btn-outline-primary open-player-btn"
                                                data-title="{{ $podcast->podcast_title }}"
                                                data-image="{{ asset('storage/' . $podcast->podcast_banner) }}"
                                                data-src="{{ asset('storage/' . $podcast->media_files) }}">
                                                <i class="fa fa-play-circle" style="color: black;background: none;"></i>
                                                Play Podcast
                                            </button>
                                            {{-- <div class="share">
                                                <a href="{{ route('myprojects') }}"> <i class="fa fa-share"></i>
                                                    <span class="text-share">Bagikan</span></a>
                                            </div> --}}

                                        </div>

                                    </div>
                                </div>
                                <hr class="hr-post">
                            </div>
                        @endforeach


                    @endif

                </div>
            </div>

            {{-- POPUP --}}
            <div class="content-audio">
                <div id="audio-player-popup" class="audio-popup hidden">
                    <div style="" class="btn-close">
                        <button id="close-popup-btn">
                            <i style="background: none;" class="fa fa-times" style="font-size:20px"></i>
                        </button>
                    </div>
                    <div class="audio-popup-content">
                        <img style="width: 80px; height:80px;" id="popup-audio-image" src="" alt="Podcast Cover"
                            class="popup-thumbnail">

                        <div style="background: none;" class="d-block">
                            <span id="audio-popup-title">Now Playing</span>
                            <br>
                            <audio style="width: 100%;" id="popup-audio" controls>
                                <source id="popup-audio-source" src="" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>

                    </div>
                </div>
            </div>




        </div>
    </section>

</body>
<style>
    .audio-popup {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #1e1e1e;
        color: white;
        padding: 10px 20px;
        display: flex;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        transition: transform 0.3s ease-in-out;
        height: 100px;
    }

    .d-block {
        width: 65%;
        align-items: center;
        display: block;
    }

    .audio-popup.hidden {
        transform: translateY(100%);
    }

    .open-player-btn {
        background: #171d27;
        color: white;
        padding: 6px;
        font-size: 14px;
        border: 1px solid white;
        border-radius: 4px;
        cursor: pointer;
        align-items: center;
    }

    .audio-popup-content {
        display: flex;
        align-items: center;
        gap: 15px;
        width: 100%;
        background: none;
    }

    .audio-popup-content audio {
        margin-top: 10px;
        max-width: 50%;
        flex: 1;
        background: none;
    }

    #audio-popup-title {
        font-weight: bold;
        margin-bottom: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        background: none;
    }

    #close-popup-btn {
        background: black;
        color: white;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .btn-close {
        background: none;
        justify-content: flex-end;

    }

    @media only screen and (max-width: 600px) {

        .audio-popup {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #1e1e1e;
            color: white;
            padding: 10px 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            transition: transform 0.3s ease-in-out;
            height: 160px;
        }

        .audio-popup-content audio {
            margin-top: 10px;
            max-width: 100%;
            flex: 1;
            background: none;
        }


        #audio-popup-title {
            white-space: wrap;
            margin-bottom: 15px;
            font-size: 20px;
        }

        audio#popup-audio {
            width: 100%;
            margin-top: 10px;
        }


    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const playButtons = document.querySelectorAll('.open-player-btn');
        const popup = document.getElementById('audio-player-popup');
        const audio = document.getElementById('popup-audio');
        const source = document.getElementById('popup-audio-source');
        const title = document.getElementById('audio-popup-title');
        const closeBtn = document.getElementById('close-popup-btn');
        const image = document.getElementById('popup-audio-image');

        playButtons.forEach(button => {
            button.addEventListener('click', () => {
                const audioSrc = button.getAttribute('data-src');
                const audioTitle = button.getAttribute('data-title');
                const imageSrc = button.getAttribute('data-image');

                // Pause current audio if different
                if (source.src !== audioSrc) {
                    audio.pause();
                    source.src = audioSrc;
                    audio.load(); // Reload new source
                    audio.play();
                } else if (audio.paused) {
                    audio.play();
                } else {
                    audio.pause();
                }

                title.textContent = audioTitle;
                image.src = imageSrc || '';
                popup.classList.remove('hidden');
            });
        });

        closeBtn.addEventListener('click', () => {
            audio.pause();
            popup.classList.add('hidden');
        });
    });
</script>



</html>
