<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,100,300,300italic,100italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>

<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/news/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/news/js/vendor/slick/slick.css')}}">
<link rel="stylesheet" href="{{asset('css/news/css/style.css')}}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
{{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
{{--<![endif]-->--}}

<!-- JS - MEDIAQUERIES -->
<script src="{{asset('css/news/js/css3-mediaqueries.js')}}"></script>
<!-- Blog Single -->
@extends('layouts.app')
@section('content')
<div class="main-content container">
    <div class="col-md-8 blog-single">
        <div class="bs-meta">
            <span class="bs-cat">Uncategorized</span>
            <span class="bs-comments"><a href="#"><i class="fa fa-comments-o"></i> 4 Comments</a> <em></em> <a href="#"><i class="fa fa-heart-o"></i> 23 Likes</a></span>
        </div>
        <h3>In Nepal with hope</h3>
    </h5>
        <div class="row">
            <div class="col-md-3 bs-aside">
                <img src="images/xtra/2.png" alt=""/>
                {{$news->author}}
                <div class="sep1"></div>
                <div class="space10"></div>
                <div class="rp-date">
                    <span>November</span>
                    04
                    <span><em>/</em> 2018</span>
                </div>
                <div class="space30"></div>
                <div class="sep1"></div>
                <div class="space20"></div>
                <em class="share-count"> SHARE</em>
                <span class="bsa-social">
					<a href="#"><i class="fa fa-facebook" style="margin-top: 10px;"></i></a>
					<a href="#"><i class="fa fa-twitter" style="margin-top: 10px;"></i></a>
					</span>
            </div>

            <div class="col-md-9">
                <div class="img-w-caption">
                    <img src="{{url( $news->image->path) }}" class="img-responsive" alt=""/>

                    <p></p>
                    {{--<span>Example : This is image caption fo sample</span>--}}
                </div>

                <p class="quote">
                    {{$news->quote}}
                </p>
                <p>
                    {{$news->body}}

                </p>
                <div class="bg-share">
                    <div class="row">
                        <div class="col-md-8">
                            <span>Share this post</span>
                        </div>
                        <div class="col-md-4">
                            <a href="#"><i class="fa fa-heart"></i> Like this post</a>
                        </div>
                    </div>
                </div>

                <div class="post-nav">
                    <div class="row">
                        <div class="col-md-6 pn-prev">
                            <a href="#" class="pull-left"><em>&#8592;</em> Previous Post</a>
                            <h4><a href="#">Duis Autem vel Eum Iriure Dolor in Hendrerit in Vulputate Velit</a></h4>
                        </div>
                        <div class="col-md-6 pn-next">
                            <a href="#" class="pull-right">Next Post <em>&#8594;</em></a>
                            <h4><a href="#">luptatum Zzril Delenit Augue Duis Dolore te Feugait Nulla Facilisi</a></h4>
                        </div>
                    </div>
                </div>
                <div class="author-info">
                    <img src="images/xtra/2.png" alt=""/>
                    <div class="ai-info">
                        <h6>John Smith</h6>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consue tudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comments -->
        <div class="comments-wrap">
            <div id="tabwrap">
                <ul id="tabs">
                    <li class="current"><a href="#comments">4 Comments</a></li>
                    <li><a href="#lcomment">Leave your comment</a></li>
                </ul>

                <div id="content">
                    <div id="comments" class="current">
                        <ul class="comments">
                            <li>
                                <div class="c-img"><img src="images/xtra/3.png" alt=""/></div>
                                <div class="comment-inner">
                                    <h6><span>Bob Marchetti</span> <a href="#">Reply</a></h6>
                                    <span class="c-date">20 Hours ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat</p>
                                </div>
                            </li>

                            <li>
                                <div class="c-img"><img src="images/xtra/4.png" alt=""/></div>
                                <div class="comment-inner">
                                    <h6><span>Michael Kosim</span> <a href="#">Reply</a></h6>
                                    <span class="c-date">20 Hours ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat</p>
                                </div>
                            </li>

                            <li class="sub-comment">
                                <div class="c-img"><img src="images/xtra/5.png" alt=""/></div>
                                <div class="comment-inner">
                                    <h6><span>Michael Kosim</span> <a href="#">Reply</a></h6>
                                    <span class="c-date">20 Hours ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat</p>
                                </div>
                            </li>

                            <li>
                                <div class="c-img"><img src="images/xtra/6.png" alt=""/></div>
                                <div class="comment-inner">
                                    <h6><span>Jony Kurniawan</span> <a href="#">Reply</a></h6>
                                    <span class="c-date">20 Hours ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div id="lcomment">
                        <div class="bs-comment">
                            <form class="c-form">
                                <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                                <label>Name <span>*</span></label>
                                <input type="text">
                                <label>Email <span>*</span></label>
                                <input type="text">
                                <label>Website</label>
                                <input type="text">
                                <label>Comment</label>
                                <textarea></textarea>
                                <button type="submit">Post Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="col-md-4">

        <!-- Popular News -->
        <div class="side-widget p-news">
            <h5><span>Popular news</span></h5>
            <div class="sw-inner">
                <ul>
                    <li>
                        <img src="images/aside/1.jpg" alt=""/>
                        <div class="pn-info">
                            <span>Politic</span>
                            <h4><a href="./single_post.html">Lorem Ipsum Dolor Sit Amet, Consetetuer Adipiscing Elit</a></h4>
                        </div>
                    </li>
                    <li>
                        <img src="images/aside/2.jpg" alt=""/>
                        <div class="pn-info">
                            <span>Politic</span>
                            <h4><a href="./single_post.html">Lorem Ipsum Dolor Sit Amet, Consetetuer Adipiscing Elit</a></h4>
                        </div>
                    </li>
                    <li>
                        <img src="images/aside/3.jpg" alt=""/>
                        <div class="pn-info">
                            <span>Business</span>
                            <h4><a href="./single_post.html">Lorem Ipsum Dolor Sit Amet, Consetetuer Adipiscing Elit</a></h4>
                        </div>
                    </li>
                    <li>
                        <img src="images/aside/4.jpg" alt=""/>
                        <div class="pn-info">
                            <span>Technology</span>
                            <h4><a href="./single_post.html">Lorem Ipsum Dolor Sit Amet, Consetetuer Adipiscing Elit</a></h4>
                        </div>
                    </li>
                    <li>
                        <img src="images/aside/5.jpg" alt=""/>
                        <div class="pn-info">
                            <span>Uncategorized</span>
                            <h4><a href="./single_post.html">Lorem Ipsum Dolor Sit Amet, Consetetuer Adipiscing Elit</a></h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Banner -->
        <div class="side-widget sw-banner">
            <a href="#"><img src="images/banner/2.jpg" class="img-responsive" alt=""/></a>
        </div>
    </aside>
</div>

<!-- Banner Full -->
<div class="big-banner">
    <a href="#"><img src="images/banner/3.jpg" class="img-responsive" alt=""/></a>
</div>

<!-- Footer -->
<div class="clearfix space30"></div>
@endsection
<!-- Javascript -->
<script src="{{asset('css/news/js/jquery.min.js')}}"></script>
<script src="{{asset('css/news/js/bootstrap.min.js')}}"></script>
<script src="{{asset('css/news/js/vendor/slick/slick.js')}}"></script>
<script src="{{asset('css/news/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('css/news/js/main.js')}}"></script>