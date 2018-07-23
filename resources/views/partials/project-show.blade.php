<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Project-({{$project->title}})</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('project/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="{{asset('project/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('project/vendor/devicons/css/devicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('project/vendor/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('project/css/resume.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Start Bootstrap</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{ $project->image && file_exists('../storage/app/public/'. $project->image->path.'.jpeg') ? $project->image->thumbnail(300,166) : '\img\post-placeholder.png' }}" alt="">
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#description">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#problem">Problem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#solution">Our Solution</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#impact">Impacts & Status</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{url('/')}}">Go Back</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid p-0">

    <section class="resume-section p-3 p-lg-5 d-flex d-column" id="description">
        <div class="my-auto">
            <h1 class="mb-0">
                {{$project->title}}
            </h1>
            <p class="mb-5">{{$project->description}}</p>
        </div>
    </section>

    <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="problem">
        <div class="my-auto">
            <h2 class="mb-5">Problem</h2>

            <div class="resume-item d-flex flex-column flex-md-row mb-5">
                <div class="resume-content mr-auto">
                    <p>{{$project->problem}}</p>
                </div>
                {{--<div class="resume-date text-md-right">--}}
                    {{--<span class="text-primary">March 2013 - Present</span>--}}
                {{--</div>--}}
            </div>

        </div>

    </section>

    <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="solution">
        <div class="my-auto">
            <h2 class="mb-5">Our Solution</h2>
            <div class="resume-item d-flex flex-column flex-md-row mb-5">
                <div class="resume-content mr-auto">
                    <div>{{$project->solution}}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="impact">
        <div class="my-auto">
            <h2 class="mb-5">Impact</h2>
            <div class="subheading mb-3">{{$project->impact}}</div>
            <h2 class="mb-5">status</h2>
            <div class="subheading mb-3">{{$project->status}}</div>
        </div>
    </section>
</div>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('project/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('project/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('project/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('project/js/resume.min.js')}}"></script>

</body>

</html>