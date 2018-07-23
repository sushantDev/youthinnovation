<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Youth Innovation News</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/devicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/resume.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none"></span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{asset('')}}" alt="">
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#experience">Heading</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#education">News</a>
            </li>
        </ul>
    </div>
</nav>
@foreach($mainprojects as $eachProject)

<div class="container-fluid p-0">

    <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience">
        <div class="my-auto">
            <h1 class="mb-0">Towards prosperity:
                <span class="text-primary">Time to come out of cocoon</span>
            </h1>
            <div class="subheading mb-5">
                <a href="/">{{$eachProject->title}}</a>
            </div>
            <p>With the successful holding of three tiers of elections — local, provincial and federal parliament — under the new constitution adopted in 2015, the country is poised for political stability which can usher in a new era for Nepal</p>
        </div>
    </section>

    <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="education">
        <div class="my-auto">
            <h2 class="mb-5">News</h2>

            <div class="resume-item d-flex flex-column flex-md-row mb-5">
                <div class="resume-content mr-auto">
                    <p>  {{$eachProject->descr}} </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endforeach
<!-- Bootstrap core JavaScript -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<!-- Plugin JavaScript -->
<script src="{{asset('js/jquery.easing.min.js')}}"></script>
<!-- Custom scripts for this template -->
<script src="{{asset('js/resume.min.js')}}"></script>

</body>
</html>
