<meta charset="utf-8">
<title>Youth Innovation Rating</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/percircle.js')}}"></script>

<link rel="stylesheet" href="{{asset('css/percircle.css')}}">

<style>
    body {
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    }

    h1 {
        margin: 40px 0 60px 0;
    }

    .clearfix:before, .clearfix:after {
        content: " ";
        display: table;
    }

    .clearfix:after {
        clear: both;
    }

    .clearfix {
        *zoom: 1;
    }
    /* why not try uncommenting
    /* one of these lovely colors? */
    /* if you are experiencing the
        /* radios and the button being
        /* slightly misaligned (and moving
        /* by 1px(ish)) then resize your browser.
        /* Codepen's frames seem to be the
        /* culprit */
    label.chkbox {
        display: inline-block;
        *display: inline;
        *zoom: 1;
        position: relative;
        z-index: 2;
        vertical-align: top;
        width: 48px;
        height: 16px;
        border-radius: 5px;
        margin: 0 5px 5px 0;
        padding: 7px 10px;
        cursor: pointer;
        overflow: hidden;
        background-color: #cfcfcf;
        color: white;
        box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1);
        -webkit-transition: background-color 0.4s ease;
        -moz-transition: background-color 0.4s ease;
        -ms-transition: background-color 0.4s ease;
        -o-transition: background-color 0.4s ease;
        transition: background-color 0.4s ease;
    }
    label.chkbox .yes,
    label.chkbox .no {
        position: absolute;
        right: 8px;
        text-indent: -999em;
        height: 20px;
        width: 20px;
        background-repeat: no-repeat;
    }
    label.chkbox .no {
        margin-top: -2px;
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUM1RDY0NDE2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUM1RDY0NDI2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxQzVENjQzRjZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxQzVENjQ0MDZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ppxje+AAAAF/SURBVHjaYvz//z8DNQETA5XB4DeQBV2AkZERRDEDMRsQgwL4FxD/Q3IASByk6DcQ/0GPAxYsloAUcwOxGJT/Gog/Q9k8QCwKNfgNEH9Esgynl0EGcty7d6/n6NGjZUC2NBDzQQ2T2r59ezZQrjs/P18MqhYVgJyMjEGKLl26ZPcfCoAG9AHF9IBYG8SGid+8eTMApBZDPxYDwWH46dOnhTDNGzdunFxeXp4L43/8+HERLLiINRAEWN+9e7cEZMDPnz+/gDCI/ePHj0t79uwRx+lDfAYmJyfrfPjw4SbMZSB2QkKCLjSmsRqIKx2Ckg3/gwcPRP/9+wdXA2I/fPgQFBmCOFII9kiBxqre/fv3D4Fc9ufPn48gDGIDg+G2m5ubHVBegNhIAblIDGjYephXnzx5Eg+KeZihwGSzAahGAuQTYgxkvHr1qi3MsDdv3uRBLWECsdGSDROxkcL0/fv36q9fv2ahJX4mYJKJAsb43HPnzoliCzLG0fKQYgAQYAAqwK1lMkf1cgAAAABJRU5ErkJggg==');
    }
    label.chkbox .yes {
        margin-top: -1px;
        left: 8px;
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUM1RDY0M0Q2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUM1RDY0M0U2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxQzVENjQzQjZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxQzVENjQzQzZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PrTLJacAAAGWSURBVHjaYvz//z8DCDAyMjKQAECKmYAYpPkfzAwQYGEgHTADMTcQcwHxTyD+AsS/YZJMJBrGCDVMds6cOeH+/v5qQDY7igqQc5GdTABwALHyuXPnVgD1/H/16tVOIJ8HZgbYHBIMBPlGDOiy/P9Q8PHjxy1AMVZyDAR5lQeIdb58+fIcZNifP38+Hj16VAckh89AkCvYoBg5fEF8OaABs2Cue/nyZRNMDS4D4QEOxApAzA/VAMLCOTk5ATDDvn//fhk5MnAZCA6jDRs2VG/fvr0PyNYCYl6oVzWeP39+Dmbg7du3/aEOwGsg46pVq4xhmo4cOTIbKAZKFkq7du3qgYkDY3YKevrFGYZr166V/Pv37weY5pqamkwLCwu/X79+fYZFxPLly6XQYwxfpDDeu3fPD2bg58+fXwC9dwzGv3//fiK2zEAo2TC9fv268T8a+Pr162FobDOQaiAIsALT2yaYYchpjlwDGfbs2SMONOgBNEfU4cv3ROeUJ0+eCP/48cMNl8uwGchIQsHAQGyGH2EGAgQYANGzvfuxqx8aAAAAAElFTkSuQmCC');
    }
    label.chkbox .toggle {
        content: " ";
        width: 30px;
        height: 24px;
        border-radius: 3px;
        display: block;
        position: absolute;
        overflow: hidden;
        z-index: 3;
        left: 3px;
        top: 3px;
        background: transparent;
        box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.2), 0 0 1px #ffffff inset;
        transform: translateX(1px);
        -webkit-transition: -webkit-transform 0.3s ease;
        -moz-transition: -moz-transform 0.3s ease;
        -ms-transition: -ms-transform 0.3s ease;
        -o-transition: -o-transform 0.3s ease;
        transition: transform 0.3s ease;
        background-image: linear-gradient(#ffffff 0%, #e7e7e7 100%);
    }
    label.chkbox .toggle:after {
        content: " ";
        width: 16px;
        height: 16px;
        position: absolute;
        left: 7px;
        top: 4px;
        border-radius: 100%;
        background-image: linear-gradient(#dddddd 0%, #ffffff 100%);
        box-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
    }
    label.chkbox.on {
        background-color: #05abe0;
    }
    label.chkbox.on .toggle {
        transform: translateX(31px);
    }
    label.chkbox.focus {
        outline: 0;
        box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1), 0 0 8px #52a8ec, 0 0 1px 1px rgba(0, 0, 0, 0.75) inset;
    }
    label.radio {
        display: inline-block;
        height: 24px;
        width: 24px;
        position: relative;
        margin: 0 5px 5px 0;
        padding: 0;
        background-color: #cfcfcf;
        border-radius: 100%;
        vertical-align: top;
        box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    label.radio > span.pip {
        width: 16px;
        height: 16px;
        position: absolute;
        border-radius: 100%;
        background: blue;
        top: 4px;
        left: 4px;
        box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.3), 0 0 1px rgba(255, 255, 255, 0.4) inset;
        background-image: linear-gradient(#ffffff 0, #e7e7e7 100%);
        transform: scale(0, 0);
        transition: all 0.2s ease;
    }
    label.radio.on {
        background-color: #05abe0;
    }
    label.radio.on > span.pip {
        transform: scale(1, 1);
    }
    label.radio.focus {
        outline: 0;
        box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1), 0 0 8px #52a8ec, 0 0 1px 1px rgba(0, 0, 0, 0.75) inset;
    }
    input[type=checkbox].replaced,
    input[type=radio].replaced {
        position: absolute;
        left: -9999em;
    }
    .wrapper {
        width: 263px;
        margin: 30px auto;
    }
    label {
        height: 30px;
        line-height: 30px;
        margin-right: 20px;
    }
    h2 {
        color: #666;
        text-align: center;
        width: 560px;
        margin: 0 auto;
        line-height: 1.2em;
    }
    .forms{
        text-align: right;
    }
</style>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="generator" content="Aku 2.1.5"/>
<meta name="generator" content="Wolf Framework 2.2.0"/>
<!-- Favicons -->
<link rel="shortcut icon" href="http://hultprizedev.fifthtribe.com/wp-content/uploads/2017/04/favicon.ico">
<link rel="apple-touch-icon" href="{{asset('wp-content/uploads/2017/02/Favicon-57.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('wp-content/uploads/2017/02/Favicon-72.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('wp-content/uploads/2017/02/Favicon.png')}}">
<!-- facebook meta -->
<meta property="og:site_name" content="Youth Innovation"/>
<meta property="og:title" content=""/>
<meta property="og:url" content="index.html"/>
<!-- twitter meta -->
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="index.html">
<meta name="twitter:title" content="Youth Innovation">
<!-- google plus meta -->
<meta itemprop="name" content="Youth Innovation"/>
<!-- Title -->
<title>Youth Innovation</title>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<!-- RSS & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="Hult Prize RSS Feed" href="http://www.hultprize.org/feed/"/>
<link rel="pingback" href="http://www.hultprize.org/xmlrpc.php"/>

<!--[if lt IE 9]>
<script src="http://www.hultprize.org/wp-content/themes/aku/js/lib/html5shiv.min.js"
        type="text/javascript"></script>
<![endif]-->
<!-- This site is optimized with the Yoast SEO plugin v5.7.1 - https://yoast.com/wordpress/plugins/seo/ -->
<link rel="canonical" href="index.html"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="Youth Innovation"/>
<meta property="og:url" content="index.html"/>
<meta property="og:site_name" content="Youth Innovation"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="Youth Innovation"/>
<script type='application/ld+json'>
            {"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"http:\/\/www.hultprize.org\/","name":"Hult Prize","potentialAction":{"@type":"SearchAction","target":"http:\/\/www.hultprize.org\/?s={search_term_string}","query-input":"required name=search_term_string"}}

        </script>
<!-- / Yoast SEO plugin. -->
<link rel='dns-prefetch' href='http://www.youtube.com/'/>
<link rel='dns-prefetch' href='http://fonts.googleapis.com/'/>
<link rel='dns-prefetch' href='http://s.w.org/'/>
{{--<link rel="alternate" type="application/rss+xml" title="Hult Prize &raquo; Feed"--}}
{{--href="http://www.hultprize.org/feed/"/>--}}
{{--<link rel="alternate" type="application/rss+xml" title="Hult Prize &raquo; Comments Feed"--}}
{{--href="http://www.hultprize.org/comments/feed/"/>--}}
<script type="text/javascript">
    window._wpemojiSettings = {
        "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.3\/72x72\/",
        "ext": ".png",
        "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.3\/svg\/",
        "svgExt": ".svg",
        "source": {"concatemoji": "http:\/\/www.hultprize.org\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.8.4"}
    };
    !function (a, b, c) {
        function d(a) {
            var b, c, d, e, f = String.fromCharCode;
            if (!k || !k.fillText) return !1;
            switch (k.clearRect(0, 0, j.width, j.height), k.textBaseline = "top", k.font = "600 32px Arial", a) {
                case"flag":
                    return k.fillText(f(55356, 56826, 55356, 56819), 0, 0), b = j.toDataURL(), k.clearRect(0, 0, j.width, j.height), k.fillText(f(55356, 56826, 8203, 55356, 56819), 0, 0), c = j.toDataURL(), b !== c && (k.clearRect(0, 0, j.width, j.height), k.fillText(f(55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447), 0, 0), b = j.toDataURL(), k.clearRect(0, 0, j.width, j.height), k.fillText(f(55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447), 0, 0), c = j.toDataURL(), b !== c);
                case"emoji4":
                    return k.fillText(f(55358, 56794, 8205, 9794, 65039), 0, 0), d = j.toDataURL(), k.clearRect(0, 0, j.width, j.height), k.fillText(f(55358, 56794, 8203, 9794, 65039), 0, 0), e = j.toDataURL(), d !== e
            }
            return !1
        }

        function e(a) {
            var c = b.createElement("script");
            c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
        }

        var f, g, h, i, j = b.createElement("canvas"), k = j.getContext && j.getContext("2d");
        for (i = Array("flag", "emoji4"), c.supports = {
            everything: !0,
            everythingExceptFlag: !0
        }, h = 0; h < i.length; h++) c.supports[i[h]] = d(i[h]), c.supports.everything = c.supports.everything && c.supports[i[h]], "flag" !== i[h] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[i[h]]);
        c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function () {
            c.DOMReady = !0
        }, c.supports.everything || (g = function () {
            c.readyCallback()
        }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", g, !1), a.addEventListener("load", g, !1)) : (a.attachEvent("onload", g), b.attachEvent("onreadystatechange", function () {
            "complete" === b.readyState && c.readyCallback()
        })), f = c.source || {}, f.concatemoji ? e(f.concatemoji) : f.wpemoji && f.twemoji && (e(f.twemoji), e(f.wpemoji)))
    }(window, document, window._wpemojiSettings);
</script>
<style type="text/css">
    img.wp-smiley,
    img.emoji {
        display: inline !important;
        border: none !important;
        box-shadow: none !important;
        height: 1em !important;
        width: 1em !important;
        margin: 0 .07em !important;
        vertical-align: -0.1em !important;
        background: none !important;
        padding: 0 !important;
    }
</style>
<style>
    .button {
        padding: 15px 25px;
        font-size: 24px;
        text-align: center;
        cursor: pointer;
        outline: none;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
    }

    .button:hover {
        background-color: #3e8e41
    }

    .button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
</style>
<link rel='stylesheet' id='fancybox-css'
      href="{{asset('wp-content/themes/aku/css/lib/fancybox6b25.css?ver=2.1.4')}}" type='text/css' media='all'/>
<link rel='stylesheet' id='dashicons-css' href="{{asset('wp-includes/css/dashicons.minee45.css?ver=4.8.4')}}"
      type='text/css' media='all'/>
<link rel='stylesheet' id='aku-style-min-css'
      href="{{asset('wp-content/themes/aku/css/main.mind63f.css?ver=2.1.5')}}" type='text/css' media='all'/>
<link rel='stylesheet' id='aku-default-css' href="{{asset('wp-content/themes/aku-child/styled63f.css?ver=2.1.5')}}"
      type='text/css' media='all'/>
<!--[if lte IE 8]>
<link rel='stylesheet' id='aku-ie8-style-css'
      href='http://www.hultprize.org/wp-content/themes/aku/css/ie8.css?ver=4.8.4' type='text/css' media='all'/>
<![endif]-->
<link rel='stylesheet' id='rs-plugin-settings-css'
      href="{{asset('wp-content/plugins/revslider/public/assets/css/settings5223.css?ver=5.2.6')}}" type='text/css'
      media='all'/>
<style id='rs-plugin-settings-inline-css' type='text/css'>
    #rs-demo-id {
    }
</style>
<link rel='stylesheet' id='rt-tpg-css-css'
      href="{{asset('wp-content/plugins/the-post-grid/assets/css/thepostgrid4b1d.css?ver=1.8')}}" type='text/css'
      media='all'/>
<link rel='stylesheet' id='hultslidercss-css'
      href="{{asset('wp-content/themes/aku-child/hult-slideree45.css?ver=4.8.4')}}" type='text/css' media='all'/>
<link rel='stylesheet' id='wolf-theme-google-fonts-css'
      href='http://fonts.googleapis.com/css?family=Lato:400,700|Arimo:400,700|Open+Sans:400,700|Merriweather:400,700|Montserrat:400,700&amp;subset=latin,latin-ext'
      type='text/css' media='all'/>
<link rel='stylesheet' id='js_composer_front-css'
      href="{{asset('wp-content/plugins/js_composer/assets/css/js_composer.min972f.css?ver=5.0.1')}}"
      type='text/css' media='all'/>
<link rel='stylesheet' id='thickbox-css' href="{{asset('wp-includes/js/thickbox/thickboxee45.css?ver=4.8.4')}}"
      type='text/css' media='all'/>
<link rel='stylesheet' id='front_end_youtube_style-css'
      href="{{asset('wp-content/plugins/youtube-video-player/fornt_end/styles/baze_styles_youtubeee45.css?ver=4.8.4')}}"
      type='text/css' media='all'/>
<script type='text/javascript' src="{{asset('wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.min5223.js?ver=5.2.6')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.min5223.js?ver=5.2.6')}}"></script>
<script type='text/javascript' src="{{asset('wp-content/themes/aku/js/lib/modernizrf7ff.js?ver=2.8.3')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/plugins/youtube-video-player/fornt_end/scripts/youtube_embed_front_endee45.js?ver=4.8.4')}}"></script>
<script type='text/javascript' src='https://www.youtube.com/iframe_api?ver=4.8.4'></script>
<link rel='https://api.w.org/' href='http://www.hultprize.org/wp-json/'/>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.hultprize.org/xmlrpc.php?rsd"/>
<link rel="wlwmanifest" type="application/wlwmanifest+xml"
      href="http://www.hultprize.org/wp-includes/wlwmanifest.xml"/>
<meta name="generator" content="WordPress 4.8.4"/>
<meta name="generator" content="WolfAlbums 1.2.5"/>
<link rel='shortlink' href='http://www.hultprize.org/?p=40'/>
<link rel="alternate" type="application/json+oembed"
      href="http://www.hultprize.org/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fwww.hultprize.org%2Fmethodology%2F"/>
<link rel="alternate" type="text/xml+oembed"
      href="http://www.hultprize.org/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fwww.hultprize.org%2Fmethodology%2F&amp;format=xml"/>
<script type="text/javascript">
    if (typeof ajaxurl === "undefined") {
        var ajaxurl = 'http://www.hultprize.org/wp-admin/admin-ajax.php';
    }
</script>
<style type="text/css">/* Theme settings */
    a, .add_to_cart_button:hover, .wolf-button:hover, input[type='submit']:hover, input[type='reset']:hover, .wolf-social:hover, .wolf-show-ticket-button:hover, .team-member-social-container a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .content-light-font h1 a:hover, .content-light-font h2 a:hover, .content-light-font h3 a:hover, .content-light-font h4 a:hover, .content-light-font h5 a:hover, .content-light-font h6 a:hover, .site-footer a:hover, #site-navigation-secondary a:hover, .comment-reply-link, .widget a:not(.button):not(.wolf-button):hover, figure.effect-sadie .entry-meta a, #top-bar #lang_sel a.lang_sel_sel:hover, .video-sidebar-container .video-title a:hover, .video-category .video-author-name a:hover, .single-video .video-author-meta .video-author-name a:hover, .has-bg h2.entry-title a:hover, .post-archives .entry-content a:hover, .video-youtube-all.single-video .video-author-meta .video-author-name a:hover, .video-youtube.single-video .video-author-meta .video-author-name a:hover, .wolf-bigtweet-content:before {
        color: #ec008c;
    }
    .entry-meta a:hover, .edit-link a:hover, #work-filter a.active, #work-filter a:hover, #video-filter a.active, #video-filter a:hover, #gallery-filter a.active, #gallery-filter a:hover, #plugin-filter a.active, #plugin-filter a:hover, #theme-filter a.active, #theme-filter a:hover, #demo-filter a.active, #demo-filter a:hover, .menu-hover-text-color .nav-menu li a:hover, .menu-hover-text-color .nav-menu li.current-menu-item > a:first-child, .menu-hover-text-color .nav-menu li.current-menu-ancestor > a:first-child, .menu-hover-text-color .nav-menu li.active a:first-child, input[type='submit']#place_order:hover {
        color: #ec008c !important;
    }

    a#scroll-down:hover, a#top-arrow:hover, input[type='submit'], input[type='reset'], .wolf-button, .button, .add_to_cart_button, .wolf-show-ticket-button {
        background: #ec008c;
        border-color: #ec008c;
    }

    .content-light-font .border-button-accent-hover:hover, .border-button-accent-hover:hover, .trigger, .sidebar-footer input[type='submit'].wolf-mailchimp-submit:hover, input[type='submit']#place_order {
        background: #ec008c !important;
        border-color: #ec008c !important;
    }

    .sidebar-footer .wolf-mailchimp-email:focus, .bypostauthor .avatar {
        border-color: #ec008c;
    }

    .wolf-social.square:hover, .wolf-social.circle:hover {
        background: #ec008c;
        border-color: #ec008c;
    }

    .vc_progress_bar .vc_single_bar .vc_bar, .mejs-container .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
        background: #ec008c !important;
    }

    .wolf-social.hover-fill-in.square:hover, .wolf-social.hover-fill-in.circle:hover, .wolf-social.circle.wolf-social-no-custom-style.hover-fill-in:hover, .wolf-social.square.wolf-social-no-custom-style.hover-fill-in:hover, .icon-box.icon-type-circle .wolf-icon-no-custom-style.hover-fill-in:hover, .icon-box.icon-type-square .wolf-icon-no-custom-style.hover-fill-in:hover {
        -webkit-box-shadow: inset 0 0 0 1em #ec008c;
        box-shadow: inset 0 0 0 1em #ec008c;
        border-color: #ec008c;
    }

    .icon-box.icon-type-circle .wolf-icon-no-custom-style.hover-none:hover, .icon-box.icon-type-square .wolf-icon-no-custom-style.hover-none:hover {
        background: #ec008c;
        border-color: #ec008c !important;
    }

    .pricing-table-currency, .pricing-table-price, .pricing-table-strike:before {
        color: #ec008c !important;
    }

    #navbar-container .nav-menu li.button-style > a:first-child span, #navbar-container-left .nav-menu li.button-style > a:first-child span, #navbar-mobile .nav-menu li.button-style > a:first-child span {
        background-color: #ec008c !important;
    }

    #navbar-container .nav-menu li.button-style > a:first-child span:hover, #navbar-container-left .nav-menu li.button-style > a:first-child span:hover, #navbar-mobile .nav-menu li.button-style > a:first-child span:hover {
        background: #cc006c;
    }

    figure.effect-sadie .item-icon, #infscr-loading, .shortcode-videos-grid figure, .shortcode-works-grid figure, .shortcode-plugins-grid figure, .shortcode-albums-grid figure, .pricing-table-featured, .pricing-table-inner ul li.pricing-table-button a:hover, .pricing-table-active ul li.pricing-table-button a, .nav-menu .product-count, .menu .product-count, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce span.soldout, .woocommerce-page span.soldout, .woocommerce .woocommerce-tabs .panel, .woocommerce-page .woocommerce-tabs .panel, .woocommerce .woocommerce-tabs ul.tabs li.active, .woocommerce-page .woocommerce-tabs ul.tabs li.active, .pricing-table-price-strike:before, .notif-count {
        background: #ec008c;
    }

    ::-moz-selection {
        background-color: #ec008c !important;
    }

    ::selection {
        background-color: #ec008c !important;
    }

    .is-home-header .header-overlay {
        background-color: #000;
    }

    .is-home-header .header-overlay {
        opacity: 0.1
    }

    .entry-meta, .category, .edit-link, .author-link, .author-description, .share-link, .page-title-container .subheading, .page-title-container .category-description p {
        font-family: 'Montserrat'
    }

    .entry-meta, .category, .edit-link, .author-link, .author-description, .share-link, .page-title-container .subheading, .page-title-container .category-description p {
        font-style: normal
    }

    h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title {
        font-family: 'Montserrat'
    }

    h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title {
        font-style: normal
    }

    h1.page-title {
        font-family: 'Lato'
    }
</style>
<style type="text/css"></style>
<style type="text/css">.recentcomments a {
        display: inline !important;
        padding: 0 !important;
        margin: 0 !important;
    }</style>
<meta name="generator" content="Powered by Visual Composer - drag and drop page builder for WordPress."/>
<!--[if lte IE 9]>
<link rel="stylesheet" type="text/css"
      href="http://www.hultprize.org/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen">
<![endif]-->
<meta name="generator"
      content="Powered by Slider Revolution 5.2.6 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface."/>
<noscript>
    <style type="text/css"> .wpb_animate_when_almost_visible {
            opacity: 1;
        }</style>
</noscript>
<style>

    .section {
        position: relative;
        z-index: 9;
    }

    .section.black .section__overlay {
        background: rgba(0, 0, 0, 0.65);
    }

    .section.white .section__overlay {
        /*background: rgba(0, 0, 0, 0.65);*/
    }

    .section.black .s-title h2 {
        color: #fff;
        background: url("../img/title-sep_white.png") 50% 100% no-repeat;
    }

    .section#first {
        padding: 320px 0 50px;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .section#first {
            padding: 150px 0 50px;
        }
    }

    @media only screen and (max-width: 767px) {
        .section#first {
            padding: 70px 0 20px;
        }
    }

    .section_i {
        position: relative;
        z-index: 20;
        max-width: 1176px;
        margin: 0 auto;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .section_i {
            width: 95%;
        }
    }

    @media only screen and (max-width: 767px) {
        .section_i {
            width: 95%;
        }
    }

    .section__overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: block;
        z-index: 8;
    }
    .forum {
        position: relative;
        z-index: 10;
        background: rgba(0, 0, 0, 0.6);
        height: 150px;
    }

    .forum .f-links {
        float: left;
        width: 390px;
    }

    .forum .f-register {
        float: right;
        width: 400px;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .forum .f-links {
            width: 300px;
        }
    }

    @media only screen and (max-width: 767px) {
        .forum .f-links {
            width: 100%;
            float: none;
        }

        .forum .f-register {
            float: none;
            width: 100%;
            padding: 10px 0 15px;
            text-align: center;
        }
    }

    .f-links {
        margin: -2px 0 -2px;
    }

    .f-links table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 2px;
    }

    .f-links table tr td {
        width: 193px;
        height: 99px;
        vertical-align: middle;
        text-align: center;
        background: #d80380;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .f-links table tr td {
            width: 133px;
        }
    }

    @media only screen and (max-width: 767px) {
        .f-links table tr td {
            height: 60px;
        }
    }

    .f-links__link {
        display: block;
    }

    .f-links__link .icon {
        display: block;
        margin: 0 auto 10px;
    }

    .f-links__link span {
        display: block;
        text-align: center;
        font-size: 18px;
        line-height: 20px;
        color: #fff;
        font-family: 'ralewaymedium';
        text-transform: uppercase;
    }

    .forum_i {
        margin: 0 auto;
        width: 950px;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .forum_i {
            width: 95%;
        }
    }

    @media only screen and (max-width: 767px) {
        .forum_i {
            width: 95%;
        }
    }

    .f-register {
        padding: 30px 0 0;
    }

    .f-register__title {
        text-align: right;
    }

    .f-register__title h2 {
        color: #ff0097;
        font-size: 30px;
        line-height: 32px;
        font-weight: normal;
        font-family: 'ralewaybold';
    }

    .f-register__title p {
        font-size: 18px;
        color: #fff;
        line-height: 20px;
    }

    .f-register__title p i {
        font-style: normal;
        font-family: 'ralewayitalic';
    }

    @media only screen and (max-width: 767px) {
        .f-register__title {
            text-align: center;
        }

        .f-register__title h2 {
            font-size: 20px;
            line-height: 22px;
        }

        .f-register__title p {
            font-size: 14px;
            line-height: 16px;
        }
    }

    .f-register__main {
        text-align: right;
    }

    .f-register__main .f-date p {
        color: #fff;
        padding: 8px 0;
        font-size: 18px;
        line-height: 20px;
    }

    .f-register__main .f-date p span {
        color: #d80380;
    }

    @media only screen and (max-width: 767px) {
        .f-register__main {
            text-align: center;
        }
    }
    .s-title {
        padding: 135px 0 0;
        margin: 0 0 65px;
        position: relative;
        z-index: 14;
    }

    .s-title h2 {
        text-align: center;
        text-transform: uppercase;
        font-size: 35px;
        line-height: 37px;
        color: #272727;
        font-weight: normal;
        font-family: 'ralewaylight';
        background: url("../img/title-sep.png") 50% 100% no-repeat;
        padding: 0 0 15px;
    }

    .s-title h2 span {
        color: #ff0097;
        font-family: 'ralewaymedium';
    }

    .s-title p {
        color: #272727;
        font-size: 18px;
        line-height: 22px;
        text-align: center;
        text-transform: uppercase;
        font-family: 'ralewaymedium';
        padding: 15px 0 0;
    }

    .s-title p span {
        font-family: 'ralewaylight';
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .s-title {
            padding: 40px 0 0;
        }

        .s-title h2 {
            font-size: 30px;
            line-height: 32px;
        }
    }

    @media only screen and (max-width: 767px) {
        .s-title {
            padding: 20px 0 0;
        }

        .s-title h2 {
            font-size: 22px;
            line-height: 25px;
        }
    }

    .s-title.s-title_black h2 {
        color: #272727;
    }

    .s-title.s-title_black h2 span {
        color: #272727;
    }

    .about {
        padding: 0 10px 125px;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .about {
            padding: 0 10px 30px;
        }
    }

    @media only screen and (max-width: 767px) {
        .about {
            padding: 0 10px 20px;
        }
    }

    .about__text {
        float: left;
        width: 480px;
    }

    .about__text h2 {
        color: #ec008c;
        font-size: 30px;
        line-height: 32px;
        font-weight: normal;
        font-family: 'ralewaysemibold';
        padding: 0 0 20px;
    }

    .about__text p {
        font-size: 20px;
        line-height: 25px;
        color: #202020;
        padding: 0 0 15px;
    }

    .about__text .btns .btn {
        float: left;
        margin: 0 20px 0 0;
        width: 145px;
        padding: 0 5px;
        text-align: center;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .about__text {
            width: 100%;
            float: none;
        }

        .about__text .btns .btn {
            float: none;
            width: 100%;
            padding: 0;
            margin: 0 0 10px;
        }
    }

    @media only screen and (max-width: 767px) {
        .about__text {
            width: 100%;
            float: none;
        }

        .about__text .btns .btn {
            float: none;
            width: 100%;
            padding: 0;
            margin: 0 0 10px;
        }
    }

    .about__img {
        float: right;
        /*background: url("../img/about-info.png") 0 0 no-repeat;*/
        width: 525px;
        height: 484px;
        position: relative;
    }

    .about__img .about__img__link {
        position: absolute;
        height: 102px;
        width: 101px;
        padding: 20px;
    }

    .about__img .about__img__link a {
        position: absolute;
        color: #202020;
        text-align: center;
        display: block;
        font-size: 24px;
        line-height: 26px;
        font-family: 'ralewaysemibold';
        top: 50%;
        left: 50%;
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .blah{
        margin-left: 1000px;
    }

    .rcorners2 {
        /*border-radius: 25px;*/
        border: 2px solid white;
        padding: 20px;
        width: 300px;
        height: 768px;
        background-color: #f0f0f0;
    }

    .about__img .about__img__link a span {
        color: #ff19a1;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .about__img {
            display: none;
        }
    }

    @media only screen and (max-width: 767px) {
        .about__img {
            display: none;
        }
    }
    .rcorners1 {
        border: 2px solid white;
        margin-left: -2px;
        margin-right: 353px;
        margin-top: -16px;
        padding: 25px;
        background-color: #f0f0f0;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <img src="{{asset('images/event2.jpg')}}" width="815px">
            <div class="rcorners1">
                <a href='http://theme.bearsthemes.com/wordpress/alone4/tbdonations/fuel-efficient-cookstoves-fruit-planting/'
                   title='Fuel-Efficient Cookstoves Fruit Planting'><h4
                            class='title'>Farmers in Agriculture Innovation</h4></a>
                <div class='donate-meta'>
                    <div class='goal-process'><span class='raised'></span>
                        <ul>
                            <li>Innovation Started <span class='goal'>2005</span></li>
                            <li>Focus Area <span class='goal'>&nbsp;Agriculture and Innovation</span></li>
                            <li>Project Stage<span class='goal'>&nbsp;Startup</span></li>
                            <li>Project Stage<span class='goal'>&nbsp;$1500 - $2000</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="rcorners2" style="margin-left: 885px;margin-top: -768px">

{{--            {{ Form::open(['url' =>'ratinggg','class'=>'form form-validate','role'=>'form']) }}--}}

            <div class="wrapper">
                <label for="rad">Innovation</label>
                <input type="radio" id="rad" name="rad1" value="{{  old('rad1') }}" style="margin-left: 29px">
                <input type="radio" id="rad2" name="rad1" value="{{ old('rad1') }} ">
                <input type="radio" id="rad3" name="rad1" value="{{ old('rad1') }} ">
                <input type="radio" id="rad4" name="rad1" value="{{ old('rad1') }}">
                <input type="radio" id="rad5" name="rad1" value="{{ old('rad1') }}">
            </div>

            <div class="wrapper">
                <label for="rad">Impact</label>
                <input type="radio" id="rad6" name="rad2" value="1" style="margin-left: 55px">
                <input type="radio" id="rad7" name="rad2" value="2">
                <input type="radio" id="rad8" name="rad2" value="3">
                <input type="radio" id="rad9" name="rad2" value="4">
                <input type="radio" id="rad10" name="rad2" value="5">
            </div>

            <div class="wrapper">
                <label for="rad">Sustainability</label>
                <input type="radio" id="rad11" name="rad3" value="1" style="margin-left: 8px">
                <input type="radio" id="rad12" name="rad3" value="2">
                <input type="radio" id="rad13" name="rad3" value="3">
                <input type="radio" id="rad14" name="rad3" value="4">
                <input type="radio" id="rad15" name="rad3" value="5">
            </div>

            {{--<button type="submit" style="margin-left: 80px; margin-top: 34px">Rate Now</button>--}}
            {{--{{ Form::close() }}--}}

            <div class="clearfix">
                <div id="redBecomesBlue" class="red big"></div>
                @if($rating==1)
                    <a href="javascript:void(0);" id="changeCircle0" style="margin-left: 70px;">show rating</a>
                @elseif($rating==2)
                    <a href="javascript:void(0);" id="changeCircle1" style="margin-left: 70px;">show rating</a>
                @elseif($rating==3)
                    <a href="javascript:void(0);" id="changeCircle2" style="margin-left: 70px;">show rating</a>
                @elseif($rating==4)
                    <a href="javascript:void(0);" id="changeCircle3" style="margin-left: 70px;">show rating</a>
                @elseif($rating==5)
                    <a href="javascript:void(0);" id="changeCircle4" style="margin-left: 70px;">show rating</a>
                @endif
            </div><!-- /update value dynamically  -->
        </div>
    </div>
</div>
</p>


<div class="site-container">
    <div id="page-content">
        <div id="main" class="site-main clearfix">
            <div class="site-wrapper">
                <div id="primary" class="content-area">
                    <main class="site-content" role="main">
                        <div id="post-40"
                             class="post-40 page type-page status-publish hentry no-thumbnail text-only">

                            <div style="background-color:#ffffff;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;"
                                 class="wpb_row section wolf-row clearfix content-dark-font wolf-row-full-width ">
                                <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
                                    <div class="wrap">
                                        <div class="col-12   wolf-col">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_text_column wpb_content_element ">
                                                    <div class="hult-slider-section full-width">
                                                        <!-- Slider Setup -->
                                                        <input type="radio" name="slider" id="s1" class="secret"
                                                               checked="checked"/>
                                                        <input type="radio" name="slider" id="s2"
                                                               class="secret"/>
                                                        <input type="radio" name="slider" id="s3"
                                                               class="secret"/>
                                                        <input type="radio" name="slider" id="s4"
                                                               class="secret"/>
                                                        <input type="radio" name="slider" id="s5"
                                                               class="secret"/>
                                                        <input type="radio" name="slider" id="s6"
                                                               class="secret"/>
                                                        {{--<p class="methodology-intro">Youth Innovation</p>--}}
                                                        <div class="hult-slider-nav inner">
                                                            <ul>
                                                                <label for="s1" class="hult-slider-nav-item">
                                                                    <img src="{{asset('wp-content/uploads/2017/03/ignite.png')}}"
                                                                         class="img img-active" alt="Ignite"/><img
                                                                            src="{{asset('wp-content/uploads/2017/03/ignite-black.png')}}"
                                                                            class="img" alt="Ignite"/>
                                                                    <span class="text">Problem & Context<br></span>
                                                                </label>
                                                                <label for="s2" class="hult-slider-nav-item"
                                                                       style="margin-top: 139px;margin-left: -168px;">
                                                                    <img src="{{asset('wp-content/uploads/2017/03/educate.png')}}"
                                                                         class="img img-active" alt="Educate"/><img
                                                                            src="{{asset('wp-content/uploads/2017/03/educate-black.png')}}"
                                                                            class="img" alt="Educate"/>
                                                                    <span class="text">Our Solution<br></span>
                                                                </label>
                                                                <label for="s3" class="hult-slider-nav-item"
                                                                       style="margin-top: 264px;margin-left: -170px;">
                                                                    <img src="{{asset('wp-content/uploads/2017/03/compete.png')}}"
                                                                         class="img img-active" alt="Compete"/><img
                                                                            src="{{asset('wp-content/uploads/2017/03/compete-black.png')}}"
                                                                            class="img" alt="Compete"/>
                                                                    <span class="text">Impact in Numbers<br></span>
                                                                </label>
                                                                <label for="s4" class="hult-slider-nav-item"
                                                                       style="margin-top: 401px;margin-left: -168px;">
                                                                    <img src="{{asset('wp-content/uploads/2017/03/accelerate.png')}}"
                                                                         class="img img-active"
                                                                         alt="Accelerate"/><img src="{{asset('wp-content/uploads/2017/03/accelerate-black.png')}}"
                                                                                                class="img" alt="Accelerate"/>
                                                                    <span class="text">Current Status</span>
                                                                </label>
                                                            </ul>
                                                        </div>
                                                        <hr class="hult-slider-hr"/>
                                                        <div class="hult-slides">
                                                            <div class="hult-slide-overflow">
                                                                <div class="hult-slide s1" id="slide-ignite">
                                                                    <div class="hult-slide-inner">
                                                                        <h2>Problem & Context</h2>
                                                                        <p>We live in a society where parents are ready to spend millions of rupees for their children going abroad for job or studies but they don’t trust their children to use that money as seed investment to start their own local business in Nepal. The most affected group is the youth of the country; they compose 20% of the population. Many face challenges like poverty, unemployment and underemployment; gender-based violence; trafficking and forced labour, ethnic, religious and caste discrimination, and limited access to quality education, health and social services. Yet they continue to be excluded from the development processes at the local, regional and national levels. And options to venture beyond the traditional economic model is looked at negatively and highly discouraged.

                                                                            Nepal is a highly stratified society with 125 caste and ethnic groups (including 63 indigenous groups). With the vast majority of the people falling in the lower strata. This essentially has led to a subsistence driven economy and one in which 70% of the population live below the poverty line. The traditional economy does not have the capacity to create employment for all those entering the labour market this has fuelled the large scale migration of Nepalese to go abroad in seek of employment.

                                                                            Today’s social, economic and environmental challenges require collaboration of every possible field. YI-Lab believes that Youth Innovative Challenge helps to bring people together with different information, knowledge and skills will promote mutual learning, create a sense of ownership.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="hult-slide s2" id="slide-educate">
                                                                    <div class="hult-slide-inner">
                                                                        <h2>Our Solution</h2>
                                                                        <p>Youth Innovation Challenge invites ideas from brightest youths from around the country to solve most difficult problems of our society. The ideas collected will be shared in social media platform to evaluate and get feedback from the people. Then, the final 10 ideas will be selected for the grand finale of Youth Innovation Challenge, and successful 5 ideas will be granted with seed funding for further implementation.

                                                                            All the ideas collected from the youths will be shared in YI-Lab’s official website and further worked out to enhance the contents as per suggested by the experts—the ideas will be linked to investors by organizing various events and workshops.

                                                                            The Youth Innovation Challenge will be organized annually during Sept-Nov of each year. The YI-Lab decides its annual theme looking at the most pressing issues the country facing. For the long term sustainability and investment, the YI-Lab will have strategic partnership with Government of Nepal, I/NGOs, and private sectors.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="hult-slide s3" id="slide-compete">
                                                                    <div class="hult-slide-inner">
                                                                        <h2>Impact in Numbers</h2>
                                                                        <p></p>
                                                                    </div>
                                                                </div>
                                                                <div class="hult-slide s4"
                                                                     id="slide-accelerate">
                                                                    <div class="hult-slide-inner">
                                                                        <h2>Current Status</h2>
                                                                        <p>Ongoing</p>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--.wrap-->
                            </div><!--.wolf-row-inner-->
                        </div><!--.wolf-row-->
                </div>
                </main>
            </div>
        </div><!-- .entry-content -->
    </div>
</div><!-- #primary .content-area -->


<script type="text/javascript">
    $(document).ready(function () {
        $("#redBecomesBlue").percircle({percent:0, text: "Rate Project"});

        $('#changeCircle0').click(function (e) {
            e.preventDefault();
            changeCircle0();
        });
        $('#changeCircle1').click(function (e) {
            e.preventDefault();
            changeCircle1();
        });
        $('#changeCircle2').click(function (e) {
            e.preventDefault();
            changeCircle2();
        }); $('#changeCircle3').click(function (e) {
            e.preventDefault();
            changeCircle3();
        }); $('#changeCircle4').click(function (e) {
            e.preventDefault();
            changeCircle4();
        });
    });

    function changeCircle0() {
        $("#redBecomesBlue").percircle({
            text: "1/5",
            percent: 20,
            progressBarColor: "#1252c0"
        });
    }
    function changeCircle1() {
        $("#redBecomesBlue").percircle({
            text: "2/5",
            percent: 40,
            progressBarColor: "#1252c0"
        });
    }
    function changeCircle2() {
        $("#redBecomesBlue").percircle({
            text: "3/5",
            percent: 60,
            progressBarColor: "#1252c0"
        });
    }
    function changeCircle3() {
        $("#redBecomesBlue").percircle({
            text: "4/5",
            percent: 80,
            progressBarColor: "#1252c0"
        });
    }
    function changeCircle4() {
        $("#redBecomesBlue").percircle({
            text: "5/5",
            percent: 100,
            progressBarColor: "#1252c0"
        });
    }
</script>

<script>
    $.fn.chkbox = function() {

        return $(this).each( function(k,v) {

            var $this = $(v);
            if( $this.is(':checkbox') && !$this.data('checkbox-replaced') ) {

                // add some data to this checkbox so we can avoid re-replacing it.
                $this.data('checkbox-replaced', true);

                // create HTML for the new checkbox.
                var $l = $('<label for="'+$this.attr('id')+'" class="chkbox"></label>');
                var $y = $('<span class="yes">checked</span>');
                var $n = $('<span class="no">unchecked</span>');
                var $t = $('<span class="toggle"></span>');

                // insert the HTML in before the checkbox.
                $l.append( $y, $n, $t ).insertBefore( $this );
                $this.addClass('replaced');

                // check if the checkbox is checked, apply styling. trigger focus.
                $this.on('change', function() {

                    if ($this.is(':checked')) {  $l.addClass('on'); }
                    else { $l.removeClass('on'); }

                    $this.trigger('focus');

                });

                $this.on('focus', function() { $l.addClass('focus') });
                $this.on('blur', function() { $l.removeClass('focus') });

                // check if the checkbox is checked on init.
                if ($this.is(':checked')) {  $l.addClass('on'); }
                else { $l.removeClass('on'); }

            }

        });

    };
    $(':checkbox').chkbox();


    $.fn.rdo = function() {

        return $(this).each( function(k,v) {

            var $this = $(v);
            if( $this.is(':radio') && !$this.data('radio-replaced') ) {

                // add some data to this checkbox so we can avoid re-replacing it.
                $this.data('radio-replaced', true);


                // create HTML for the new checkbox.
                var $l = $('<label for="'+$this.attr('id')+'" class="radio"></label>');
                // var $p = $('<span class="pip"></span>');

                // insert the HTML in before the checkbox.
                $l.append( $p ).insertBefore( $this );
                $this.addClass('replaced');

                // check if the radio is checked, apply styling. trigger focus.
                $this.on('change', function() {

                    $('label.radio').each( function(k,v) {

                        var $v = $(v);
                        if( $('#'+ $v.attr('for') ).is(':checked') ) {
                            $v.addClass('on');
                        } else {
                            $v.removeClass('on');
                        }

                    });

                    $this.trigger('focus');

                });

                $this.on('focus', function() { $l.addClass('focus') });
                $this.on('blur', function() { $l.removeClass('focus') });


                // check if the radio is checked on init.
                $('label.radio').each( function(k,v) {

                    var $v = $(v);
                    if( $('#'+ $v.attr('for') ).is(':checked') ) {
                        $v.addClass('on');
                    } else {
                        $v.removeClass('on');
                    }

                });

            }

        });

    };

    $(':radio').rdo();

</script>

<style type='text/css' media='all'>.rt-tpg-container .layout1 .rt-holder .rt-detail h2 {
        margin-top: -20px;
    }</style>
<script type='text/javascript' src='../wp-content/themes/aku-child/js/hult.js'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var mejsL10n = {
        "language": "en-US",
        "strings": {
            "Close": "Close",
            "Fullscreen": "Fullscreen",
            "Turn off Fullscreen": "Turn off Fullscreen",
            "Go Fullscreen": "Go Fullscreen",
            "Download File": "Download File",
            "Download Video": "Download Video",
            "Play": "Play",
            "Pause": "Pause",
            "Captions\/Subtitles": "Captions\/Subtitles",
            "None": "None",
            "Time Slider": "Time Slider",
            "Skip back %1 seconds": "Skip back %1 seconds",
            "Video Player": "Video Player",
            "Audio Player": "Audio Player",
            "Volume Slider": "Volume Slider",
            "Mute Toggle": "Mute Toggle",
            "Unmute": "Unmute",
            "Mute": "Mute",
            "Use Up\/Down Arrow keys to increase or decrease volume.": "Use Up\/Down Arrow keys to increase or decrease volume.",
            "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.": "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds."
        }
    };
    var _wpmejsSettings = {"pluginPath": "\/wp-includes\/js\/mediaelement\/"};

</script>
<script type='text/javascript'
        src="{{asset('wp-includes/js/mediaelement/mediaelement-and-player.min51cd.js?ver=2.22.0')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-includes/js/mediaelement/wp-mediaelement.minee45.js?ver=4.8.4')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/themes/aku/js/lib/jquery.fancybox.packd63f.js?ver=2.1.5')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/themes/aku/js/lib/jquery.fancybox-media.min0ba6.js?ver=1.0.6')}}"></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var WolfThemeParams = {
        "ajaxUrl": "http:\/\/www.hultprize.org\/wp-admin\/admin-ajax.php",
        "siteUrl": "http:\/\/www.hultprize.org\/",
        "accentColor": "",
        "headerPercent": "100",
        "breakPoint": "1140",
        "lightbox": "fancybox",
        "videoLightbox": null,
        "footerUncover": null,
        "headerUncover": null,
        "sliderEffect": "slide",
        "sliderAutoplay": null,
        "sliderSpeed": "5000",
        "sliderPause": null,
        "infiniteScroll": "true",
        "infiniteScrollMsg": "Loading...",
        "infiniteScrollEndMsg": "No more post to load",
        "loadMoreMsg": "Load More",
        "infiniteScrollEmptyLoad": "http:\/\/www.hultprize.org\/wp-content\/themes\/aku\/images\/empty.gif",
        "newsletterPlaceholder": "Your email",
        "isHomeSlider": null,
        "heroFadeWhileScroll": "true",
        "heroParallax": "1",
        "homeHeaderType": "video",
        "isHome": "",
        "blogWidth": "boxed",
        "menuPosition": "default",
        "modernMenu": "",
        "currentPostType": [],
        "enableParallaxOnMobile": null,
        "enableAnimationOnMobile": null,
        "doPageTransition": "1",
        "doBackToTopAnimation": "1",
        "onePageMenu": "",
        "onePagePage": "http:\/\/www.hultprize.org\/methodology\/",
        "isOnePageOtherPage": "1",
        "isStickyMenu": "true",
        "addMenuType": "side",
        "workType": "classic",
        "isTopbar": null,
        "menuStyle": "plain",
        "years": "Years",
        "months": "Months",
        "weeks": "Weeks",
        "days": "Days",
        "hours": "Hours",
        "minutes": "Minutes",
        "seconds": "Seconds",
        "replyTitle": "Share your thoughts",
        "doWoocommerceLightbox": "1",
        "leftMenuTransparency": null,
        "layout": "wide",
        "HomeHeaderVideoBgType": "selfhosted",
        "language": "en_US"
    };
</script>
<script type='text/javascript' src="{{asset('wp-content/themes/aku/js/min/app.mind63f.js?ver=2.1.5')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/plugins/page-links-to/js/new-tab.min4315.js?ver=2.9.8')}}"></script>
<script type='text/javascript'>
    var thickboxL10n = {
        "next": "Next >",
        "prev": "< Prev",
        "image": "Image",
        "of": "of",
        "close": "Close",
        "noiframes": "This feature requires inline frames. You have iframes disabled or your browser does not support them.",
        "loadingAnimation": "http:\/\/www.hultprize.org\/wp-includes\/js\/thickbox\/loadingAnimation.gif"
    };
</script>
<script type='text/javascript' src="{{asset('wp-includes/js/thickbox/thickboxab87.js?ver=3.1-20121105')}}"></script>
<script type='text/javascript' src="{{asset('wp-includes/js/wp-embed.minee45.js?ver=4.8.4')}}"></script>
<script type='text/javascript'
        src="{{asset('wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min972f.js?ver=5.0.1')}}"></script>
<script type="text/javascript">
    var capnum = 0;

    function add() {
        capnum++;
        document.getElementById('display').innerHTML = capnum;
    }
</script>
<script>
    $('#addStar').onclick('.foodstars',function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: '/',
            data: $('#addStar').serialize(),
            success: function(data) {
                console.log(data);
            },

        });
        return false;
    });
</script><script>
    $('#addStar').onclick('.foodstars',function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: '/',
            data: $('#addStar').serialize(),
            success: function(data) {
                console.log(data);
            },

        });
        return false;
    });
</script><script>
    $('#addStar').onclick('.foodstars',function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: '/',
            data: $('#addStar').serialize(),
            success: function(data) {
                console.log(data);
            },

        });
        return false;
    });


</script>
<script type="text/javascript" src="{{asset('js/parallax.min.js')}}"></script>
