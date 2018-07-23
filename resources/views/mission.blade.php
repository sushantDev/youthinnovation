@extends('layouts.apps')

@section('content')
    <title>Providing Online Contest Management Software Solutions and More</title>
    <meta name="keywords" content="contest software, competition software, award software" />
    <meta name="description" content="Need software for a competition or contest? We've got the solutions that will help you organize and manage your events from the beginning to the award ceremony." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/ico" href="../favicon.ico" />
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link type="text/css" href="{{asset('css/owl.carousel.css')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('css/jquery.fancybox.css')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('css/styles.css')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('css/tablet.css')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('css/mobile.css')}}" rel="stylesheet"/>

    <script src="{{asset('js/6890430168.js')}}"></script>

    <body id="page-solutions">

    <div id="outer_wrap">
        <div id="wrap" >
            <header >
                <section id="header_intro" class="no_text">
                    <div class="content_box clearfix">
                        <div class="tabbar">
                            <div class="tabs-wrapper">
                                <ul class="tabs_paging">
                                    <li></li>
                                    <li class="active"><a href="{{url('mission')}}" title="Recognizing talent with an awards program?"><span><br><br>Our Mission</span></a></li>
                                    <li><a href="{{url('how')}}"  title="Recognizing talent with an awards program?"><span><br><br>How we work?</span></a></li>
                                    <li><a href="{{url('what')}}" title="Creatively market your event?"><span><br><br>What we do?</span></a></li>
                                    <li><a href="{{url('team')}}" title="Be a better global citizen?"><span><br><br>Team</span></a></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </header>
        <section class="tabs_content">
            <div class="tab">
                <div class="secondary_intro with_banner">
                    <div class="content_box">
                        The Youth Innovation Lab (YI-Lab) is an initiative of social enterprise with a mission to challenge the TINA (There Is No Alternative) mentality. It does this by democratizing the skills, knowledge and tools for co-creating regenerative and inclusive innovation that cares for all people and the planet.
                        <div class="banner_holder"><img src="{{asset('images/running-a-challenge.jpg')}}" alt="" class="banner_image" /></div>
                    </div>
                </div>
                <div class="content_box">
                    <ul id="solution_steps">
                        <li>
                            <span class="step_badge design">OUR MISSION</span>
                                
                            <p class="highlight">Learn: Education and capability-building</p>
                            @foreach($mission_data as $data)
                            @if($data->learn)
                            <p>{{$data->learn}}
                            </p>
                            @endif
                            @endforeach
                            <img src="{{asset('images/mission1.png')}}" style="    margin-left: -253px;
    margin-top: -213px;">
                            

                        </li>
                        
                        <li>
                          
                            <span class="step_badge setup" style="width: 500px; height: 158px;">Setup</span>
                            <p class="highlight">Connect: Outreach and community-building</p>
                              @foreach($mission_data as $data)
                              @if($data->connect)
                              <p>
                            {{$data->connect}}
                            </p>
                            @endif
                            @endforeach
                            <img src="{{asset('images/mission2.png')}}" style="    margin-left: 614px;
    margin-top: -157px;">

                            
                        </li>
                        <li>

                            <span class="step_badge play">Play</span>
                            <img src="{{asset('images/mission3.png')}}" style="    margin-left: -306px;
    margin-top: 59px;">
                                
                            <p class="highlight" style="margin-top: -212px;">Serve: consultancy (fee for service)</p>
                        @foreach($mission_data as $data)
                        @if($data->serve)
                       <p>{{$data->serve}}</p>
                        @endif
                        @endforeach
                        </li>
                        
                    </ul>
                </div><!-- end of content_box -->
            </div>
        </section>
    </div><!-- end wrap -->
</div><!-- end outer_wrap -->

<script src="{{asset('js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/owl.carousel.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.fancybox-media.js')}}" type="text/javascript"></script>
<script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('js/jquery.event.move.js')}}"></script>
<script src="{{asset('js/jquery.event.swipe.js')}}"></script>
<script src="{{asset('js/scripts.js')}}" type="text/javascript"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','../www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-307802-3', 'auto');
    ga('send', 'pageview');

</script>

<script>
    (function() {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '../connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
        _fbq.push(['addPixelId', '815517808535536']);
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', 'PixelInitialized', {}]);
</script>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="{{asset('js/2750165.js')}}"></script>
<!-- End of HubSpot Embed Code -->

<noscript>
    <img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=815517808535536&amp;ev=PixelInitialized" />
</noscript>
@endsection