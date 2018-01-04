<!DOCTYPE html> 
<html>
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W4FJRF');</script>
    <!-- End Google Tag Manager -->
<title>4Slash | Passion For e-volving Businesses</title> 
    <meta charset="UTF-8">
    <meta name="keywords" content="Graphics & Design,graphic art, cnerr, Digital Marketing,online marketing,web marketing, Writing & Translation, Video & Animation,video maker,movie maker,video editor, Music & Audio,stock music,stock audio, Programming & Tech, Advertising,ads,online advertising,business advertising,Business & Writting,business writing skills, Favors">
    <meta name="description" content="Graphics, Design or programming Digital Marketing ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-1.11.3.min.js"></script>
    <link rel="icon" href="/img/cnerrfav.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="css/cnerr-app.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,200,300,100' rel='stylesheet'
          type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/O-style.css') }}">

    <link rel="stylesheet" href="css/Z-style.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/social-share-kit.css') }}" type="text/css">
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-81823945-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- Start of Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = "c59a3689716727e70aef59778d589e50d08fdb71";
window.smartsupp||(function(d) {
	var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
	s=d.getElementsByTagName('script')[0];c=d.createElement('script');
	c.type='text/javascript';c.charset='utf-8';c.async=true;
	c.src='//www.smartsuppchat.com/loader.js';s.parentNode.insertBefore(c,s);
})(document);
</script>

</head>
<body ng-app="cnerr">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4FJRF"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Left & centered positioning -->
<div class="ssk-sticky ssk-left ssk-center ssk-lg">
    <a href="" class="ssk ssk-facebook"></a>
    <a href="" class="ssk ssk-twitter"></a>
    <a href="" class="ssk ssk-google-plus"></a>
</div>
<div id="fb-root"></div>

<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>
    $(document).ready(function(){
        $('.form-btn').click(function(){
            $('.gig-style').css('display', 'none');
        });
    })
</script>

@include('pages.partials.fiverr-components.header-nav')
<!-- hello -->


<h6>sdasdasdasdasd</h6>
<div class="cnerr-background-image">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="">
                <nav class="navbar cnerr-navbar">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed mob-nav" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar" ></span>
                            <span class="icon-bar" ></span>
                            <span class="icon-bar" ></span>
                        </button>
                        <a class="navbar-brand" href=""></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse border-none" id="bs-example-navbar-collapse-1">
                        {{--<ul class="nav navbar-nav navbar-right index-navbar">--}}
                        {{--<li><a href="#" data-toggle="modal" data-target="#gridSystemModal">Einloggen</a></li>--}}
                        {{--<li><span class="cnerr-navbar-bar hidden-xs hidden-sm">|</span></li>--}}
                        {{--<li><a href="#" data-toggle="modal" data-target="#gridSystemModal1">Registrieren</a></li>--}}
                        {{--</ul>--}}
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="row rowvideo">
            @if(\Illuminate\Support\Facades\Session::has('successMessage'))
                <div class="alert alert-success" role="alert">{{ \Illuminate\Support\Facades\Session::get('successMessage') }}</div>
            @endif
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 cnerr-logo-margin-top ">
                    {{--<img src="img/logobanner.png">--}}
                    {{--<p class="cnerr-slider-para">Marktplatz für kreative Köpfe</p>--}}
                  <video src="img/Cnerr - final.mp4" controls loop width="85%" poster="img/cnerr-poster.png"></video>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="img/hand-phone.png" class="cnerr-hand-image hidden-xs hidden-sm">
            </div>
        </div>
    </div>
</div>
<div class="cnerr-main-content-background-color text-center">
    <div class="container main-container">













        @if($featuredGigs->count() > 0)
            <div>
               {{-- <h1>Ausgewählte Katagorien</h1>--}}
                {{--<div class="row">
                    @if(!empty($featuredCat))
                        @foreach($featuredCat as $fcat)
                        <div class="col-md-3 col-sm-6 col-xs-12 c-top-head-gigs">
                            <div class="c-gig-box">
                                <a href="/gigs/{{$fcat->slug}}">
                                    <p style="margin-bottom: 0px;"><strong>{{$fcat->name}}</strong></p>
                                    <p style="font-size:12px; margin-bottom:7px; padding:0"><strong>{{ $fcat->description}}</strong></p>
                                    <img src="{{ url('/files/gigs/images') . '/' . $fcat->image }}" alt="{{ $fcat->name }}" class="gig-image">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif

        </div><!-------row--------->--}}
            </div><!-------div--------->
        <div class="white" class="white1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cnerr-main-content-heading margin-top" class="main-content">
                        Graphic, design or programming?<br/>of course on
                        <span class="txt-color">
                            <img src="https://4slash.com/img/cnerr_logo_dark.png" alt="" class="dark1">
                        </span>
                        für 10€!
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p class="web1">Need designers, graphic artists, creative work, web and app programmer or developer for their <i class="design2">Favors</i>?<br />we have the experts who <i class="develop3">24/7</i>
                        working for you!</p>
                </div>
            </div>
        </div>
        <div class="mp-box mp-box-center-flex" class="mp-box1">

                <article class="mp-gig-carousel">

                    <header>
                        <h2 class="heading" class="heading1">


                            our services

                        </h2>
                    </header>

                    <div class="gig-carousel cf loading-dummy dummy-12">
                        <div class="slider-box">
                            <div class="slider-hider cf">
                                <div class="slide gig-item gig-item-default js-slide">
                                    <div class="tab1">
                                        <img src="https://4slash.com/img/slide_img1.jpg" class="img1">
                                        <p class="item"><i>
                                                We will create your individual <font class="fav">Favors</font> with our team of experts.</i></p>
                                    </div>
                                </div>
                                <div class="slide gig-item gig-item-default js-slide">
                                    <div class="screen1">
                                        <img src="https://4slash.com/img/slide_img2.jpg" class="top1">
                                        <p class="screen2"><i>Our experts are here for you! If you wish <font class="top2">24/7!</font></i></p>
                                    </div>
                                </div>
                                <div class="slide gig-item gig-item-default js-slide">
                                    <div class="screen3">
                                        <img src="https://4slash.com/img/slide_img3.jpg" class="top3">
                                        <p class="screen4"><i>Cnerr works in a SSL protected environment. Your data is encrypted!</i></p>
                                    </div>
                                </div>
                                <div class="slide gig-item gig-item-default js-slide">
                                    <div class="screen5">
                                        <img src="https://4slash.com/img/slide_img4.jpg" class="top4">
                                        <p class="screen6"><i>No risk with ours <font class="top5">Favors</font>! We work so long until you are satisfied</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p style=""><i>* Favor / -s we call our products, which we can do for you. Small or big favors! ;-)</i></p>

                    <header>
                        <h2 class="heading" class="heading2">


                            Our recommendations

                        </h2>
                    </header>

                    <div class="gig-carousel cf loading-dummy dummy-12"
                         data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12"
                         data-load-more="false" data-hide-empty="true" data-hide-parent="false" data-gigs-shown="4"
                         data-do-sliding="false" data-two-lines="false" data-do-lazyload="false" data-do-endless="false"
                         data-host="homepage" data-box-id="hp99912_1_4">


                        <div class="slider-box">
                            <div class="slider-hider cf"> 

                                @foreach($featuredGigs as $featuredGig)
                                    <div class="slide gig-item gig-item-default js-slide js-gig-card "
                                         data-gig-id="4864637"
                                         data-cached-slug="create-unusual-illustrations-in-my-style" data-gig-index="0"
                                         data-gig-category="graphics-design"
                                         data-gig-sub-category="digital-illustration" data-gig-price="20" itemscope=""
                                         itemtype="http://schema.org/Product">


                                        <div class="gig-seller">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span class="ratings-count" itemprop="ratingCount">(202)</span>
                        </span>
                                            <meta itemprop="worstRating" content="1">
                                            <span class="circ-rating-s8 rate-10" itemprop="ratingValue">10</span>
                                            <meta itemprop="bestRating" content="10">
                                            {{--by <a href="/muravski" rel="nofollow" class="seller-name" itemprop="brand" itemscope="" itemtype="http://schema.org/Brand">muravski</a>--}}
                                        </div>

                                        <a href="{{ url() }}/gigs/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}"
                                           class="gig-link-main" itemprop="url">
                                            <span class="gig-pict-222" itemscope=""
                                                  itemtype="http://schema.org/ImageObject">
                                                @if(!empty($featuredGig['thumbnail']) AND $featuredGig['thumbnail'] != '')
                                                    <img src="{{ $featuredGig['thumbnail'] }}" alt="{{ $featuredGig->title }}"></span>
                                                @endif
                                            <h3 itemprop="name">{{ str_limit($featuredGig->title, 45)  }}</h3>
                                        </a>

                                        <aside class="card-badges cf">

                                            <span class="gig-badges featured" itemprop="award">featured</span>

                                        </aside>


                                        <div class="gig-sub cf">


                                            <a href="{{ url() }}/gigs/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}"
                                               class="gig-price" rel="nofollow" itemprop="offers" itemscope=""
                                               itemtype="http://schema.org/Offer">
                                                <small itemprop="price"></small>
                                                <span itemprop="price">{{ config('app.currency') . $featuredGig->price }}</span></a>
                                            @if($user)
                                            <aside data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $featuredGig->id }}">
                                                <a id="btn-favourite-submit" href="javascript:void(0);" class="gig-favourite-heart-icn">
                                                                <span class="favorite-span">
                                                                    @if($featuredGig['my_fav'])
                                                                        <i class="fa fa-heart"></i>
                                                                    @else
                                                                        <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                </span>

                                                </a>

                                            </aside>
                                            @endif
                                            {{--<aside class="gig-collect js-gig-collect" id="coll-gig-4864637"
                                                   data-coll-id="4864637">
                                                --}}{{--<a class="icn-heart-toggle hint--top js-gtm-event" href="#" data-hint="Save in..." data-coll-gig="coll-gig-4864637" data-gtm-action="hp-clicked-list" data-gtm-event="collections"><span></span></a>--}}{{--
                                                @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                    <a class="icn-heart hint--top js-gtm-event" href="#"
                                                       data-hint="Favorite" data-gtm-action="hp-clicked-heart"
                                                       data-gtm-event="collections"><span></span></a>
                                                @endif
                                            </aside>--}}


                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>


                </article>

        </div>
        @endif
        </div>
    <div class="cnerr-main-content-background-color text-center" class="main1">
        <div class="container">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="img/setting.png" class="image-top-margin">

                <p class="img-caption top-bottom-margin">Creativity</p>

                <p class="cnerr-main-content-paragragh-cat">
                    Use our creativity and experience to make your product come true. Our experts have many years of experience and will incorporate them in your product.</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="img/document.png" class="image-top-margin">

                <p class="img-caption top-bottom-margin">professionalism</p>

                <p class="cnerr-main-content-paragragh-cat">We work exclusively with professional partners in our network. We check our high demands on the product before transmission by quality control. Only then we deliver the orders.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="img/bulb.png" class="image-top-margin">

                <p class="img-caption top-bottom-margin">reliability</p>

                <p class="cnerr-main-content-paragragh-cat">Each product on our marketplace has a certain delivery time, which the customer can influence with. The delivery is guaranteed within the desired date.</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="img/world.png" class="image-top-margin">

                <p class="img-caption top-bottom-margin">No risk</p>

                <p class="cnerr-main-content-paragragh-cat">
                    If you are not 100% satisfied with the creative work, we will refund you the purchase price. Thus you have no risk at Cnerr.</p>
            </div>
        </div>
    </div>
        </div>
</div>
<div class="cnerr-public-topcontent-background-color text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="cnerr-public-topcontent-heading margin-top">“Cnerr reliably performs our work”</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="cnerr-public-topcontent-paragragh"><b>Dr.Alexander Schuller, </b><span class="designation-color"> Dentist, the Netherlands</span>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="cnerr-public-background-color"> 
    <img src="img/publicimage.jpg" width="100%">
</div>
<div class="cnerr-social-background-color text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="cnerr-social-heading margin-top">Be a part of Cnerr. We're glad.</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="cnerr-social-paragragh top-bottom">Sign up for free and browse our marketplace.</p>
            </div>
        </div>
    </div>
</div>


@include('includes.footer')
<script type="text/javascript">

    $(document).ready(function(){

        $('#formCustomOrder').validate({
            submitHandler: function(form) {
                MyJSLib.Ajaxifier.submitForm(form, 'Your request has been received by us and will be processed!', 'Custom Order sending failed please try again');
                $(".gig-style").slideToggle();
            }

        });
    })
</script>
<script>

    $('.gig-favourite-heart-icn').click(function(e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId    = $selectedGig.data('coll-id');
        var url      = $selectedGig.data('url');

        // var className = $('span.favorite-span > i').attr('class');

        //  alert(className);

        if($(this).find('i').attr('class') == 'fa fa-heart'){
            var action = 'removeFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o"></i></span>');
        }
        else{
            var action = 'addToFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart"></i></span>');
        }



        $.ajax({
            url: url,
            method: 'POST',
            data: { 'gig-id': gigId, 'action': action },
            success: function(data) {
                console.log(data);

            }
        });
    });


</script>


</body>
</html>