<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="Prashant Thapa">
    <title>Youth Innovation</title>

    <link rel='stylesheet' id='style-css' href='{{ asset('frontend/stylefe9d.css?ver=4.7.3') }}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='color-css' href='{{ asset('frontend/css/colorfe9d.css?ver=4.7.3') }}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='prettyPhoto-css' href='{{ asset('frontend/css/prettyPhotofe9d.css?ver=4.7.3') }}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='responsive-css' href='{{ asset('frontend/css/responsivefe9d.css?ver=4.7.3') }}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='animate-css' href='{{ asset('frontend/css/animatefe9d.css?ver=4.7.3') }}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='js_composer_front-css'
          href='{{ asset('frontend/css/js_composer.min972f.css?ver=5.0.1') }}' type='text/css' media='all'/>
    <script type='text/javascript' src='{{ asset('frontend/js/jquery/jqueryb8ff.js?ver=1.12.4') }}'></script>
    <script type='text/javascript' src='{{ asset('frontend/js/jquery/jquery-migrate.min330a.js?ver=1.4.1') }}'></script>
    <script type='text/javascript'
            src='{{ asset('frontend/js/jquery.themepunch.tools.min4ee1.js?ver=5.3.1.5') }}'></script>
    <script type='text/javascript'
            src='{{ asset('frontend/js/jquery.themepunch.revolution.min4ee1.js?ver=5.3.1.5') }}'></script>

    <link rel='stylesheet' id='bootstrap.min-css'
          href={{asset("wp-content/plugins/tbdonations/css/bootstrap.min447e.css?ver=4.7.7")}} type='text/css'
          media='all'/>
    <link rel='stylesheet' id='bears_preset-css'
          href={{asset("wp-content/themes/alone/assets/css/presets/default447e.css?ver=4.7.7")}} type='text/css'
          media='all'/>


    @stack('styles')
</head>

<div class="page-wrap">
    @include('partials.header')

    @yield('content')

    @include('backend.layouts.partials.global-script')

    @include('partials.footer')
</div>

<link rel='stylesheet' id='vc_google_fonts_montserratregular700-css'
      href='http://fonts.googleapis.com/css?family=Montserrat%3Aregular%2C700&amp;ver=4.7.7' type='text/css'
      media='all'/>

<script type='text/javascript' src='{{ asset('frontend/js/bootstrap.minfe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript' src='{{ asset('frontend/js/dscountdown.minfe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript' src='{{ asset('frontend/js/jquery.appearfe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript' src='{{ asset('frontend/js/jquery.prettyPhotofe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript'
        src='{{ asset('frontend/js/jquery.carouFredSel-6.2.1-packedfe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript' src='{{ asset('frontend/js/scriptfe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript' src='{{ asset('frontend/js/jflickrfeed.minfe9d.js?ver=4.7.3') }}'></script>
<script type='text/javascript' src='{{ asset('frontend/js/comment-reply.minfe9d.js?ver=4.7.3') }}'></script>
@stack('scripts')
