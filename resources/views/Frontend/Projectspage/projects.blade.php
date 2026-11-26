<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $profile->first()->profile_img) }}">
    <title>Aldrin Nur Ilyas - Projects Portfolio list</title>
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
                        <h1>Projects</h1>
                    </div>
                </div>

                <div class="introduction">
                    <p class="intro-description">I'm wanna sharing to my projects for show projects in software
                        engineering and others.
                    </p>
                </div>
                <hr class="hr-post">
            </div>



            <div class="content-wrap">
                <div class="card-post-project">
                    @if ($projects->isEmpty())
                        <div class="container-fluid px-4">
                            <div style="text-align: center;margin-top:20px;font-size:14px;"
                                class="container-fluid px-4">
                                Aldrin belum memposting
                            </div>
                        </div>
                    @else
                        @foreach ($projects as $project)
                            <div class="card-body-projects">
                                <div class="projects-title">
                                    <div class="main-title">
                                        <h5 class="title-project">
                                            <a class="link-project"
                                                href="{{ route('displayproject', $project->project_code) }}">{{ $project->project_name }}</a>
                                        </h5>

                                        <div class="project-category">
                                            <span>{{ $project->category_name }}</span>

                                            @if ($project->github_link)
                                                <span class="github-link">
                                                    <a href="{{ $project->github_link }}" target="_blank">
                                                        <i class="fa-brands fa-github"></i>
                                                    </a>
                                                </span>
                                            @else
                                            @endif

                                            @if ($project->demo_project_link)
                                                <span class="github-link">
                                                    <a href="{{ $project->demo_project_link }}" target="_blank">
                                                        <i class="fa fa-globe"></i>
                                                    </a>
                                                </span>
                                            @else
                                            @endif
                                        </div>

                                        <div style=" display: flex; gap:3px;align-items: center;" class="project-date">
                                            <div class="content-flex-time">
                                                <p class="time" style="margin: 0;">
                                                    {{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('F Y') }}

                                                </p>
                                                <p class="time" style="margin: 0;">-</p>
                                                @if ($project->end_date == null)
                                                    <p class="time" style="margin: 0;">Ongoing</p>
                                                @else
                                                    <p class="time" style="margin: 0;">
                                                        {{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('F Y') }}
                                                    </p>
                                                @endif
                                                @if ($project->last_edited_at)
                                                    &nbsp;
                                                    <span class="time">~ edited</span>
                                                @endif
                                            </div>
                                        </div>


                                        <p class="description">
                                            {{ $project->subtitle }}
                                        </p>
                                    </div>

                                    <div class="image-project">

                                        @if ($project->media_files)
                                            <img class="project-img"
                                                src="{{ asset('storage/' . $project->media_files) }}"
                                                alt="Profile Picture" class="img-fluid rounded-circle">
                                        @else
                                        @endif
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
