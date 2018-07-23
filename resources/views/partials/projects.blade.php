<div class="row" id="projects" style="margin-top: 100px">
    <div class="col-md-12">
        <article class="parallex-section" style="background-image:url({{asset('images/event6.jpg')}});">
            <div class="container">
                <div class="col-md-3 col-sm-6 col-xs-12 animated" data-animation="flipInX" data-delay="0">
                    <div class="portfolio-left">
                        <header class="heading text-center">
                            <h3>Our Projects</h3>
                        </header>
                        <p class="text-center"></p>
                    </div>
                </div>

@foreach($main_projects as $main_project)

                <div class="col-md-3 col-sm-6 col-xs-12 animated" data-animation="flipInX" data-delay="200">
                    <a href="{{url('/yic')}}">

                    <div class="portfolio-box">
                        <figure>
                            <img width="150" height="150" src="{{asset('images/event1-150x150.jpg')}}" class="attachment-thumbnail size-thumbnail wp-post-image" alt=""/>
                            {{--<figcaption>--}}
                                {{--<a title="Women&#8217;s Rights" data-rel="prettyPhoto" href="{{url('/yic')}}" class="zoom">--}}
                                    {{--+--}}
                                {{--</a>--}}
                            {{--</figcaption>--}}
                        </figure>
                        <div class="portfolio-detail">
                            <h4>{{$main_project->title}}</h4>
                            <p style="font-family: Montserrat">{{ str_limit($main_project->title_description, 500) }}</p>
                            <a href="{!! route('mainproject.show', $main_project) !!}" target="_blank"></a>
                        </div>
                    </div>
                </a>
                </div>
            </div>
            @endforeach

                {{--<div class="col-md-3 col-sm-6 col-xs-12 animated" data-animation="flipInX" data-delay="400">--}}
                  {{--<a href="{{url('/hp')}}">--}}
                    {{--<div class="portfolio-box">--}}
                        {{--<figure>--}}
                            {{--<img width="150" height="150" src="{{asset('images/event2-150x150.jpg')}}" class="attachment-thumbnail size-thumbnail wp-post-image" alt=""/>--}}
                            {{--<figcaption>--}}
                                {{--<a title="Donate for Future" data-rel="prettyPhoto" href="{{asset('images/event2.jpg')}}" class="zoom">--}}
                                    {{--+--}}
                                {{--</a>--}}
                            {{--</figcaption>--}}
                        {{--</figure>--}}
                        {{--<div class="portfolio-detail">--}}
                            {{--<h4>Hamropratinidhi</h4>--}}
                            {{--<p>Hamropratinidhi is an interactive web portal envisioned to maintain profiles of a hierarchy of the government that ranges from the Prime Minister to the local level representatives..</p>--}}
                            {{--<a href="{{url('/hp')}}" class="more-link">+</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                  {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col-md-3 col-sm-6 col-xs-12 animated" data-animation="flipInX" data-delay="600">--}}
                   {{--<a href="{{url('/cih')}}">--}}
                    {{--<div class="portfolio-box">--}}
                        {{--<figure>--}}
                            {{--<img width="150" height="150" src="{{asset('images/event3-150x150.jpg')}}" class="attachment-thumbnail size-thumbnail wp-post-image" alt=""/>--}}
                            {{--<figcaption>--}}
                                {{--<a title="Health and Education" data-rel="prettyPhoto" href="{{asset('images/event3.jpg')}}" class="zoom">--}}
                                    {{--+--}}
                                {{--</a>--}}
                            {{--</figcaption>--}}
                        {{--</figure>--}}
                        {{--<div class="portfolio-detail">--}}
                            {{--<h4>Community Impact Hubs</h4>--}}
                            {{--<p>Community Impact Hubs is a volunteer initiative of YI-Lab to promote culture of entrepreneurship and innovation in grassroot level..</p>--}}
                            {{--<a href="{{url('/cih')}}" class="more-link">+</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                   {{--</a>--}}
            {{--</div>--}}
        </article>
    </div>
</div>
