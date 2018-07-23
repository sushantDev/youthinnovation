<!doctype html>
<html>
<!-- Mirrored from www.leonardodicaprio.org/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jan 2018 10:33:15 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <link rel="stylesheet" href="{{asset('css/main.9b1d2dc9b05f216f3b484d4e041d6941.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Lato:400,700,900" rel="stylesheet">
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-61598901-2', 'auto');
        ga('send', 'pageview');
</script>
</head>

<body class="body--homepage">
<div class="wrapper" id="news"> <!--ko component: "header"-->
    <div class="grid--homepage" style="margin-top: 100px;">
            <div class="grid__inner">
    <div class="grid--homepage">
        <div class="grid__inner">
                <ul class="grid__list">
                    @foreach($news as $article)
                    <li class="grid__item"><a class="tout" href="{!! route('news.show', $article) !!}">
                            <div class="tout__background">
                                {{--{{ dd(url($article->image->path))}}--}}
                                <img alt="{{url( $article->image->path) }}" src="{{ isset($article->image) && file_exists($article->image->path) ? url($article->image->path) : '\img\post-placeholder.png' }}"">
                            </div>
                            <div class="tout__wrap">
                                <div class="tout__content">
                                    <h2 class="tout__heading"><span class="tout__rubric">{{$article->type}}</span>{{$article->title}}
                                    </h2></div>
                                <p class="tout__hover">{{$article->quote}}</p>
                            </div>
                        </a></li>
                        @endforeach
                </ul>
            </div>
        </div>
<script src="{{asset('js/main.e23a8eccd5085dca6eb4.js')}}"></script>
    </div>
</body>'
<!-- Mirrored from www.leonardodicaprio.org/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jan 2018 10:34:07 GMT -->
</html>