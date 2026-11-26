<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <title>{{ $project_data->first()->project_name }}</title>
</head>

<body class="body-daily-post">
    <section class="main-daily-post">
        <div class="content-daily-post">
            <div class="title">
                <div class="dflex-title">
                    <div class="col-md-8">
                        <div class="back">
                            <a href="{{ url('myprojects') }}">
                                <i class="fa fa-arrow-left"></i>
                                <span>Back</span></a>
                        </div>
                    </div>

                    <div class="title-content">
                        <h1>Projects Portfolio</h1>
                    </div>
                </div>


            </div>



            <div class="content-wrap">
                <div class="card-post">

                    @foreach ($project_data as $project)
                        <div class="card-body-projects">
                            <div class="image-project">

                                @if ($project->media_files)
                                    <img class="project-img-show" src="{{ asset('storage/' . $project->media_files) }}"
                                        title="Project Picture" class="img-fluid rounded-circle">
                                @else
                                @endif
                            </div>
                            <div class="projects-title-display">
                                <div class="main-title">

                                    <div class="container-center">
                                        <h5 class="title-project-display">
                                            <p class="project-title">{{ $project->project_name }}</p>
                                        </h5>

                                        <div class="project-date-display">
                                            <span
                                                class="start-project-date">{{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('F Y') }}

                                            </span>
                                            <span>-</span>
                                            @if ($project->end_date == null)
                                                <span class="end-project-date">Ongoing</span>
                                            @else
                                                <span
                                                    class="end-project-date">{{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('F Y') }}
                                                </span>
                                            @endif
                                        </div>

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
                                    </div>

                                    @if ($project->contributors)
                                        <p class="description-display"><strong> Contributors:</strong>
                                            {{ $project->contributors }}
                                        </p>
                                    @else
                                    @endif
                                    <div class="text-post">
                                        <p class="description-display">
                                            {!! $project->description !!}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>


        </div>
    </section>
</body>

</html>
