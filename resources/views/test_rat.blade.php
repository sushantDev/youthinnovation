<!DOCTYPE html>
<html>

<head>
    <title>jQuery Rate</title>
    <!-- External CSS and JS Libraries - Optional -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- jQury Rate CSS and JS -->
    <link rel="stylesheet" type="text/css" href="{{asset('rate/rate.min.css')}}">
    <script type="text/javascript" src="{{asset('rate/jquery.rate.min.js')}}"></script>

    <!-- Demo CSS and JS -->
    <link rel="stylesheet" type="text/css" href="{{asset('demo/demo/demo.css')}}">
    <script type="text/javascript" src="{{asset('demo/demo/demo.js')}}"></script>
</head>

<body>
    <div class="container">
        <div class="row marketing">
            <div class="col-lg-2">
                <div class="col-lg-6">
                    <label for="rate-circle-value" style=" padding-bottom: 10px">Value:</label>
                    <div class="rate-circle" data-value="0"></div>
                </div>
                <div class="form-group">
                    <input type="range" id="rate-circle-value" min="0" max="100" step="1" value="0">
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
