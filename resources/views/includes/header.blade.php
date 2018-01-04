<head>
    <meta charset="utf-8"/>
    <title>
        4slash
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--begin::Web font -->
    <script src="{{asset('assets/webfont/webfont.js')}}"></script>

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '549a15db001b09e9594cc1044783089377dbbc1c';
        window.smartsupp || (function (d) {
            var s, c, o = smartsupp = function () {
                o._.push(arguments)
            };
            o._ = [];
            s = d.getElementsByTagName('script')[0];
            c = d.createElement('script');
            c.type = 'text/javascript';
            c.charset = 'utf-8';
            c.async = true;
            c.src = '//www.smartsuppchat.com/loader.js?';
            s.parentNode.insertBefore(c, s);
        })(document);
    </script>
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
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-47676690-1', 'auto');
        ga('send', 'pageview');

    </script>


    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
{{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    <link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.bundle.css') }}">
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="assets/demo/demo2/media/img/logo/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/core.min.css') }}">

    <link href=" {{ asset('css/thesaas.min.css') }}" rel="stylesheet">

    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/demo/demo2/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <!-- Styles -->
{{--<link href="{{asset('assets/css/O-style.css')}}" rel="stylesheet">--}}

    <link href="{{asset('assets/css/core.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/thesaas.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    {{--<link href="{{asset('assets/css/Z-style.css')}}" rel="stylesheet">--}}
    <link href="{{asset('assets/css/uploadify.min.css')}}"rel="stylesheet">
    <link href="{{asset('css/socicon.css')}}"rel="stylesheet">
    {{--<link rel="stylesheet" href="{{ asset('assets/css/jquery.filer.min.css') }}">--}}
    <link href="{{asset('assets/css/jquery.filer.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/jquery.filer-dragdropbox-theme.min.css')}}"rel="stylesheet">
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}"rel="stylesheet">
   {{-- <link href="{{asset('assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/slick-theme.css')}}" rel="stylesheet">--}}


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{asset('assets/img/apple-touch-icon.png')}}">
    <link rel="icon" href="{{asset('assets/img/logo.png')}}">
    <style>
        /* jssor slider loading skin spin css */
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .jssorb111 .i {
            position: absolute;
            color: #fff;
            font-family: "Helvetica neue", Helvetica, Arial, sans-serif;
            text-align: center;
            cursor: pointer;
            z-index: 0;
        }

        .jssorb111 .i .n {
            display: none;
        }

        .jssorb111 .i .b {
            fill: #fff;
            stroke: #000;
            stroke-width: 500;
            stroke-miterlimit: 10;
            stroke-opacity: .5;
        }

        .jssorb111 .i:hover .b {
            fill: #fea900;
            stroke: #fea900;
            stroke-width: 6000;
            stroke-opacity: 1;
        }

        .jssorb111 .iav .b {
            fill: #000;
            stroke-width: 6000;
            stroke-opacity: 1;
        }

        .jssorb111 .i.idn {
            opacity: .3;
        }

        .jssorb111 .iav .n, .jssorb111 .i:hover .n {
            display: block;
        }

        .jssort121 .p {
            position: absolute;
            top: 0;
            left: 0;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
            box-sizing: border-box;
            color: #fff;
            background: rgba(0, 0, 0, .1);
            opacity: .7;
        }

        .jssort121 .p .t {
            position: absolute;
            padding: 10px;
            box-sizing: border-box;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            line-height: 24px;
            overflow: hidden;
        }

        .jssort121 .p .i {
            margin-right: 10px;
            position: relative;
            top: 0;
            left: 0;
            width: 96px;
            height: 48px;
            border: none;
            float: left;
        }

        .jssort121 .pav, .jssort121  {
            color: #000;
            background: #2c2d3a !important;
        }
        .jssort121:hover .pav:hover  {
            color: #000;
            background: #262734 !important;
        }
        @media (min-width: 1366px){
            #late-order {

                margin-right:220px;
            }
        }
        #late-order{
            background: red;
            padding: 0px 11px;
            font-weight:bold;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            position: absolute;
            top: 16px;
            right: 0px;
        }

        .jssort121 .p:hover {
            opacity: .75;
        }

        .jssort121 .pav, .jssort121 .p:hover.pdn {
            opacity: 1;
        }

        .jssort121 .ti {
            position: relative;
            font-size: 14px;
            font-weight: bold;
        }

        .jssort121 .d {
            position: relative;
            font-size: 12px;
        }
        .days, .hours, .minutes, .seconds{
            display: inline-block;
            margin-left: 5px;
            margin-right: 5px;
            text-align: center;
        }

        .dy, .hr, .mint, .sec {
            width:70px;
            height:39px;
        }

        /*.jssort121 .d:before {content:'\a';white-space:pre;}*/
    </style>


</head>
<body>
@include('pages.partials.fiverr-components.header-nav')

