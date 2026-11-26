<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $profile->first()->profile_img) }}">
    <title>Aldrin Nur Ilyas - Working Experiences</title>
</head>

<body class="body-daily-post">
    <section class="main-daily-post">
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
                        <h1>Work</h1>
                    </div>
                </div>


                <div class="introduction">
                    <p class="intro-description">I'm want sharing my work experiences.
                    </p>
                </div>
                <hr class="hr-post">
            </div>


            <div class="content-wrap">
                <div class="card-post-project">
                    @if ($working->isEmpty())
                        <div class="container-fluid px-4">
                            <div style="text-align: center;margin-top:20px;font-size:14px;"
                                class="container-fluid px-4">
                                Aldrin belum memposting
                            </div>
                        </div>
                    @else
                        @foreach ($working as $work)
                            <div class="card-body-projects">

                                <div class="main-title">
                                    <div class="title-company-name">
                                        <div style="display: block;" class="content-company-name">
                                            <h5 style="margin-bottom: 10px;">{{ $work->company_name }}
                                            </h5>
                                            <div style="display: flex;gap:4px;" class="project-date">
                                                <span
                                                    class="start-project-date">{{ \Carbon\Carbon::parse($work->start_date)->translatedFormat('F Y') }}

                                                </span>
                                                <span>-</span>
                                                @if ($work->end_date == null)
                                                    <span class="end-project-date">Ongoing</span>
                                                @else
                                                    <span
                                                        class="end-project-date">{{ \Carbon\Carbon::parse($work->end_date)->translatedFormat('F Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="content-flex-job">
                                                <span class="job-title">{{ $work->position }}</span>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="job-desc">
                                        <span class="title-jobdesc">Deskripsi Pekerjaan:</span>

                                        <div class="jobdesc-content">

                                            <p class="jobdesc-p">

                                                {!! $work->job_description !!}

                                            </p>


                                        </div>



                                    </div>

                                </div>
                                <hr class="hr-post">
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>


        </div>
    </section>
</body>

</html>
