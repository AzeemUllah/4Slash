<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="icon" href="/img/4slashsmalllogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="keywords" content="Grafik & Design, Geschäftsausstattungen, cnerr, Digital Marketing, Writing & Translation, Video & Animation, Music & Audio, Programmierung & Tech, Advertising, Favors, Icons für den IOS / Android, Digital Marketing / Social Media Marketing">
    <meta name="discription" content="Grafik, Design oder Programmierung? Natürlich auf CNERR  für 10€!">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/cookies.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/myjslib.js') }}"></script>
    <script type="text/javascript" src="js/1.js" async></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cnerr-app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/market.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/star-rating.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,200,300,100' rel='stylesheet'
          type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-social.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/awesome-bootstrap-checkbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/A-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/samo-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/A-style - Copy.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/O-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Z-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/c-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uploadify.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/social-share-kit.css') }}" type="text/css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery.filer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.filer-dragdropbox-theme.css') }}">
{{--<link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">--}}

<!-- Custom CSS -->
    <link href="{{ asset('css/half-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sam_style.css') }}" rel="stylesheet">


    <style>
        p{

            color: white;
            font-size: 35px;
            padding-top: 90px;

        }

        .timer-area {
            background: transparent url(img/timer-area-pattern.png) left top;
            text-align: center;
            padding-top: 2em;
            margin-bottom: 4em;
        }


    </style>



    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- JS -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(document).ready(function () {
            var downloadButton = document.getElementById("download");
            var counter = 10;
            var newElement = document.createElement("p");
            newElement.innerHTML = "You will be Redirected to your SPROUT in 10 seconds.";
            var id;

            downloadButton.parentNode.replaceChild(newElement, downloadButton);

            id = setInterval(function() {
                counter--;
                if(counter < 0) {
                    window.location.href = ("http://sprout.4slash.com:3000/signin");
                    clearInterval(id);
                } else {
                    newElement.innerHTML = "You will be Redirected to your SPROUT in " + counter.toString() + " seconds.";
                }
            }, 1000);

        })

    </script>
</head>
<body style="height: 300px;">



<div class="timer-area" style="height: 300px;">
    <h1 style="color: white;">THANKYOU</h1>
    <a href="downloadFile.zip" id="download" class="button">Download the file...</a>
</div>

<div class="container">

    <div class="col-md-12">

</div>
</div>

<script type="text/javascript" src="{{ asset('js/config.js') }}"></script>
{{--<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>--}}
{{--<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
<script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/jquery.uploadify.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jssor.slider.mini.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/star-rating.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/angular.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/sanitize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-validation-1.14.0/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('script/app.js') }}"></script>


</body>
</html>