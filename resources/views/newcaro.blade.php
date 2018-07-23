<head>

    <meta charset="utf-8">

    <title>Pure CSS Percentage Circle</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- styles for this little demo page -->
    <style type="text/css">

        body{
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        .page {
            margin: 40px;
        }

        h1{
            margin: 40px 0 60px 0;
        }

        .dark-area {
            background-color: #666;
            padding: 40px;
            margin: 0 -40px 20px -40px;
            clear: both;
        }

        .clearfix:before,.clearfix:after {content: " "; display: table;}
        .clearfix:after {clear: both;}
        .clearfix {*zoom: 1;}

    </style>

    <link rel="stylesheet" href="{{asset('css/circle.css')}}">

</head>

<body>

<div class="page">

    <h1>Pure CSS Percentage Circle - circle100</h1>

    <!-- default -->
    <div class="clearfix">

        <div class="c100 p50 big">
            <span>1</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

        <div class="c100 p25">
            <span>25%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

        <div class="c100 p12 small">
            <span>12%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

    </div>
    <!-- /default -->

    <!-- green -->
    <div class="clearfix">

        <div class="c100 p50 big green">
            <span>50%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

        <div class="c100 p25 green">
            <span>25%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

        <div class="c100 p12 small green">
            <span>12%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

    </div>
    <!-- /green -->

    <!-- orange -->
    <div class="clearfix">

        <div class="c100 p50 big orange">
            <span>50%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

        <div class="c100 p25 orange">
            <span>25%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

        <div class="c100 p12 small orange">
            <span>12%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>

    </div>
    <!-- /orange -->




    <div class="dark-area clearfix">

        <!-- default -->
        <div class="clearfix">

            <div class="c100 p50 big dark">
                <span>50%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

            <div class="c100 p25 dark">
                <span>25%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

            <div class="c100 p12 small dark">
                <span>12%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

        </div>
        <!-- /default -->

        <!-- green -->
        <div class="clearfix">

            <div class="c100 p50 big dark green">
                <span>50%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

            <div class="c100 p25 dark green">
                <span>25%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

            <div class="c100 p12 dark small green">
                <span>12%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

        </div>
        <!-- /green -->

        <!-- orange -->
        <div class="clearfix">

            <div class="c100 p50 dark big orange">
                <span>50%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

            <div class="c100 p25 dark orange">
                <span>25%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

            <div class="c100 p12 dark small orange">
                <span>12%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>

        </div>
        <!-- /orange -->

    </div><!-- /.dark-area -->

    <small>Andre Firchow | <a href="http://firchow.net">Blog</a></small>

</div>

</body>
