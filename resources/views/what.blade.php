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
                                    <li><a href="{{url('mission')}}" title="Recognizing talent with an awards program?"><span><br><br>Our Mission</span></a></li>
                                    <li><a href="{{url('how')}}"  title="Recognizing talent with an awards program?"><span><br><br>How we work?</span></a></li>
                                    <li class="active"><a href="{{url('what')}}" title="Creatively market your event?"><span><br><br>What we do?</span></a></li>
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
                 @foreach($what_data as $data)
                        <div class="banner_holder "> {{--{{ dd(url($data->image->path))}}--}}
                            <img class="banner_image" alt="{{url( $data->image->path) }}" src="{{ isset($data->image) && file_exists($data->image->path) ? url($data->image->path) : '\img\post-placeholder.png' }}" style="width: 1536px; height: 200px" />
                            </div>
                        @endforeach
                </div>
                <div class="content_box">
                    {{--<div class="col-md-12">--}}
                      <div class="row" style="width: 1400px">
                            {{--<div class="col-md-1"></div>--}}
                            <div class="col-md-2">
                      <img src="{{asset('images/what4.png')}}" width="140px" style="margin-left: -10px;">
                    <div class="span">Facts & Research</div>
                      
                      @foreach($what_data as $data)
                        @if($data->facts)
                      <br><p style="color: #606060;margin-top: 40px;font-size: 16px;">
                            {{$data->facts}}
                            
                      </p>
                      @endif
                    @endforeach
                  </div>

                          <div class="col-md-2">
                          <img src="{{asset('images/what3.png')}}" width="140px" style="margin-left: -10px;">

                          <div class="span">Open Data & Technology</div>
                          @foreach($what_data as $data)
                        @if($data->data)
                          <br><p style="color: #606060;margin-top:10px;font-size: 16px;"> 
                            {{$data->data}}
                          </p>
                           @endif
                    @endforeach
                      </div>
                            <div class="col-md-2">
                                <img src="{{asset('images/what2.png')}}" width="140px" style="margin-left: -10px;">

                              <div class="span">Spirit of Volunteerism</div>
                              @foreach($what_data as $data)
                        @if($data->spirit)
                                <br><p style="color: #606060;margin-top:10px;font-size: 16px;"> {{$data->spirit}}
                                </p>
                                @endif
                    @endforeach
                      </div>
                            <div class="col-md-2">
                                <img src="{{asset('images/what5.png')}}" width="140px" style="margin-left: -10px;">

                              <div class="span">Strategic Innovation</div>
                               @foreach($what_data as $data)
                                @if($data->strategy)
<br><p style="color: #606060;font-size: 16px;margin-top: 42px;">{{$data->strategy}}</p>
                            @endif
                            @endforeach

                      </div>

                            <div class="col-md-2">
                                <img src="{{asset('images/what1.png')}}" width="140px" style="margin-left: -10px;">

                              <div class="span">Advocacy</div>
                              @foreach($what_data as $data)
                                @if($data->advocacy)
                                <p style="color: #606060; margin-top: 68px;font-size: 16px;"> {{$data->advocacy}}
                                </p>
                                @endif
                            @endforeach
                            </div>
                            {{--<div class="col-md-1"></div>--}}
                        </div>
                    {{--</div>--}}
                </div>
                </div><!-- end of content_box -->
        </section>
    </div>


    </div><!-- end wrap -->
<div class="foot">
    <img src="{{asset('images/whatimage.png')}}">

</div>
</body>

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
    })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-307802-3', 'auto');
    ga('send', 'pageview');

</script>

<script>
    (function() {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '../../connect.facebook.net/en_US/fbds.js';
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