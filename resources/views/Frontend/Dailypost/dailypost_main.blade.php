<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $profile->first()->profile_img) }}">
    <title>Aldrin Nur Ilyas - Posts</title>
</head>

<body class="body-daily-post">
    <section class="main-daily-post">
        <div class="content-daily-post">
            <div class="title">
                <div class="dflex-title">

                    <div class="back">
                        <a href="{{ url('aldrinnurilyas') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>Back</span></a>
                    </div>

                    <div class="title-content">
                        <h1>Daily Posts</h1>
                    </div>
                </div>


                <div class="introduction">
                    <p class="intro-description">I'm wanna sharing my momment and experiences in my life.
                    </p>
                </div>
                <hr class="hr-post">
            </div>




            <div class="content-wrap">
                <div class="tab-content" id="ex1-content">
                    {{-- Postingan --}}
                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <div id="table-detail" class="table-responsive">
                            <div class="card-post-blog">
                                @if ($posts->isEmpty())
                                    <div style="text-align: center;margin-top:20px;font-size:14px;"
                                        class="container-fluid px-4">
                                        Aldrin belum memposting
                                    </div>
                                @else
                                    @foreach ($posts as $post)
                                        <div class="card-body">
                                            @if (!$profile_img)
                                            @else
                                                <img class="profile-picture-post"
                                                    src="{{ asset('storage/' . $profile_img->first()->profile_img) }}"
                                                    alt="Profile Picture" class="img-fluid rounded-circle">
                                            @endif

                                            <div class="content-daily">
                                                <div style="display: flex;justify-content: space-between;"
                                                    class="flex-content-name">
                                                    <div class="title-time">
                                                        <h5 class="card-title">Aldrin Nur Ilyas</h5>
                                                        <div class="content-flex-time">
                                                            <span
                                                                class="time">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j F Y h:i a') }}
                                                            </span>
                                                            @if ($post->last_edited_at)
                                                                &nbsp;
                                                                <span class="time">~ edited</span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="content-daily-posts">
                                                    <div class="text-post">{!! $post->post !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr-post">
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>


                </div>
    </section>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>
