

    <!--Header start-->
    @include('includes.header')
    <!--header end-->




    <div class="container-fluid" style="background-color: #ff5071;">
        <!--top-banner-->
        <div class="top-banner" style="margin-top: 200px">
            <img src="assets/css/gif/creativeservice.gif" class="gif" id="bg" alt="creative" style="float: right;width: 54%;">
            <div class="new-heading" style="width: 40%;    padding-left: 90px;">
                <h3 class="bannerheading" style="float: left;color: white;font: 900 49px/52px metric;line-height: 0.8;font-family: roboto;margin-top: 80px;">
                    Come Let's Sprout<br><img src="assets/css/gif/withus-gif.gif" id="pg" alt="with us" style="float: left; max-width: 250px;margin: 15px; margin-top: 0px;"></h3>

            </div>

        </div>
        <!--top-banner-->

    </div>
    <div class="container-fluid" style="padding: 0px">
        <!--second-div-->
        <div class="col-md-12" style="padding: 0px;padding-top: 25px;">

            <section class="section">
                <div class="container">
                    <header class="section-header">
                        <small style="font-size: 20px;">Features</small>
                        <h2>Designed for everyone, everywhere</h2>
                        <hr>
                        <p class="lead"> 4Slash is a Fusion of data, design & technology & results-driven Marketing
                            Communications Services Company.
                            We integrate technology with critical agendas to drive strategic business outcomes.
                            We have committed teams of professionals with experience in variety of tools and
                            platforms.</p>
                    </header>

                    <div class="row gap-y">

                        <div class="col-md-4 col-sm-4">
                            <p class="feature-icon text-success"><i class="icon-search" style="font-size: 30px;"></i></p>
                            <h5>Your Terms</h5>
                            <p>Be 100% sure that we won’t stop,
                                Until you get what you wanted.</p>
                        </div>


                        <div class="col-md-4 col-sm-4">
                            <p class="feature-icon text-info"><i class="icon-mobile" style="font-size: 30px;"></i></p>
                            <h5>Your Timeline</h5>
                            <p>Find our product and packages based on your goals and deadlines,
                                Or just create a custom order, it’s that simple.</p>
                        </div>


                        <div class="col-md-4 col-sm-4">
                            <p class="feature-icon text-danger"><i class="icon-tools" style="font-size: 30px;"></i></p>
                            <h5>Your Safety</h5>
                            <p>Your payment is always secure, our system protect,
                                Your peace of mind.

                            </p>
                        </div>

                    </div>

                </div>
            </section>


        </div>
    </div>

    <div>
        <div class="col-md-12 col-sm-12 col-xs-12 bluebardiv" style="z-index: 30">

            <h2 style="padding-top: 40px; color: white; text-align: center;">Explore Our Marketplace</h2>
            <p style="text-align: center;">Get inspired to build your business</p>
        </div>
    </div>
    <!--second-div-->
    <section>
        <div class="col-md-12" >


            <div class="row">
                <div class="col-md-4 col-sm-12" style="padding-left: 60px;padding-right: 60px" >
                    <p style="text-align: center;">
                        <img src="assets\demo\demo2\media\img\logo\graphics.png.png" style=" width: 100%; padding-top: 65px;">
                    </p>

                    <h3 style="color: #2c2e3e; text-align: center;"> Graphics & Design</h3>
                    <div class="m-widget7__desc graphics-text" style=" text-align: center;font-weight: 600;">

                        We create value by augmenting your business with a solution that not only possesses the right capabilities but also the real-life fit that relates to your specific business requirements.
                    </div>
                    <div style="text-align: center; margin-top: 25px;">
                        <a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
                            Preview Portfolio
                        </a>
                    </div>
                </div>


                <div class="col-md-8 col-sm-12" style="padding-left: 60px;padding-right: 60px">
                    <div class="row" style=" padding-top: 108px;">

                        <!--gigs start-->
                        @foreach($featuredGigs1 as $featuredGig)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}">
                                        @if(!empty($featuredGig['thumbnail']) AND $featuredGig['thumbnail'] != '')
                                            <img src="{{ $featuredGig['thumbnail'] }}" style="width: 100%;" alt="{{ $featuredGig->title }}">
                                        @endif
                                            <div class="m-widget19__title m--font-light topbtn2">
                                                <button type="button" class="btn btn-sm m-btn--pill  btn-brand" style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px;padding-top: 0px;color: #fff;background-color: #564ec0;border-color: #4d44bd;">
                                                    Top rated
                                                </button>
                                            </div>

                                    <div class="card-content">
                                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($featuredGig->title,50, '...') }}</h5>
                                        <hr>

                                            <aside  style="height:0px;" data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $featuredGig->id }}">
                                                @if($user)
                                                <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                                   class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($featuredGig['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                                    @else
                                                                 <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                     </span>

                                                </a>
                                                @endif
                                                <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show1}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                            </aside>

                                        <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size:17px;">ONLY AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $featuredGig->price }}</span></h5>


                                    </div>
                                    </a>
                                    </div>
                                </div>


                             @endforeach
                        @foreach($featuredPackages1 as $featuredPackag)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                                       class="gig-link-main" itemprop="url">
                                        @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                                            <img src="{{ $featuredPackag['thumbnail'] }}"  alt="{{ $featuredPackag->title }}" style="width: 100%;">
                                        @endif
                                    <div class="card-content">
                                        <h5  style=" line-height: 1.3; color: black !important;text-align: center;font-size: 17px;padding-top: 15px;">{{ str_limit($featuredPackag->title,50,'...') }}</h5>
                                        <hr>

                                            <aside  style="height:0px;" data-url="{{ route('package.favourite') }}" data-coll-id="{{ $featuredPackag->id }}">
                                                @if($user)
                                                <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                                   class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($featuredPackag['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                                     </span>

                                                </a>
                                                @endif
                                                <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show9}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                            </aside>

                                        {{--@if($user)
                                            <aside data-url="{{ route('gig.favourite') }}"
                                                   data-coll-id="{{ $featuredPackag->id }}">
                                                <a id="btn-favourite-submit" href="javascript:void(0);"
                                                   class="gig-favourite-heart-icn">
                                                            <span class="favorite-span">
                                                                @if($featuredPackag['my_fav'])
                                                                    <i class="fa fa-heart"></i>
                                                                @else
                                                                    <i class="fa fa-heart-o"></i>
                                                                @endif
                                                            </span>

                                                </a>

                                            </aside>
                                        @endif--}}

                                        <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size: 17px;">STARTING AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency').$featuredPackag['package_bronze']->price }}</span></h5>
                                    </div>
                                    </a>
                                </div>

                             </div>
                        @endforeach

                    </div>



                </div>

            </div>

        </div>

    </section>

    <section>
        <div class="col-md-12" >


            <div class="row">
                <div class="col-md-4 col-sm-12" style="padding-left: 60px;padding-right: 60px" >
                    <p style="text-align: center;">
                        <img src="assets\app\media\img\blog\mobiledev.png" style=" width: 100%; padding-top: 65px;">
                    </p>

                    <h3 style="color: #2c2e3e; text-align: center;"> Programing & Tech</h3>
                    <div class="m-widget7__desc graphics-text" style="text-align: center;font-weight: 600;">

                        We create value by augmenting your business with a solution that not only possesses the right capabilities but also the real-life fit that relates to your specific business requirements.
                    </div>
                    <div style="text-align: center; margin-top: 25px;">
                        <a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
                            Preview Portfolio
                        </a>
                    </div>
                </div>


                <div class="col-md-8 col-sm-12" style="padding-left: 60px;padding-right: 60px">
                    <div class="row" style=" padding-top: 108px;">

                        <!--gigs start-->
                        @foreach($featuredGigs2 as $featuredGig)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}">
                                        @if(!empty($featuredGig['thumbnail']) AND $featuredGig['thumbnail'] != '')
                                            <img src="{{ $featuredGig['thumbnail'] }}" style="width: 100%;" alt="{{ $featuredGig->title }}">
                                        @endif
                                        <div class="m-widget19__title m--font-light topbtn3">
                                            <button type="button" class="btn btn-sm m-btn--pill  btn-brand" style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px;padding-top: 0px;color: #fff;background-color: #564ec0;border-color: #4d44bd;">
                                                Top rated
                                            </button>
                                        </div>

                                        <div class="card-content">
                                            <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($featuredGig->title,50, '...') }}</h5>
                                            <hr>


                                                <aside  style="height:0px;" data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $featuredGig->id }}">
                                                    @if($user)
                                                    <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                                       class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($featuredGig['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                                     </span>

                                                    </a>
                                                    @endif
                                                    <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show2}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                                </aside>

                                            <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size:17px;">ONLY AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $featuredGig->price }}</span></h5>
                                        </div>
                                    </a>
                                </div>
                            </div>


                        @endforeach
                        @foreach($featuredPackages2 as $featuredPackag)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                                       class="gig-link-main" itemprop="url">
                                        @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                                            <img src="{{ $featuredPackag['thumbnail'] }}"  alt="{{ $featuredPackag->title }}" style="width: 100%;">
                                        @endif
                                        <div class="card-content">
                                            <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 17px;padding-top: 15px;">{{ str_limit($featuredPackag->title,50,'...') }}</h5>
                                            <hr>

                                                <aside style="height:0px;" data-url="{{ route('package.favourite') }}" data-coll-id="{{ $featuredPackag->id }}">
                                                    @if($user)
                                                    <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                                       class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($featuredPackag['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                                     </span>

                                                    </a>
                                                    @endif
                                                    <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show9}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                                </aside>



                                            <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size: 17px;">STARTING AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency').$featuredPackag['package_bronze']->price }}</span></h5>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        @endforeach

                    </div>



                </div>
            </div>

        </div>

    </section>



    <section>
        <div class="col-md-12" >


            <div class="row">
                <div class="col-md-4 col-sm-12" style="padding-left: 60px;padding-right: 60px" >
                    <p style="text-align: center;">
                        <img src="assets\app\media\img\blog\webdev.png" style=" width: 100%; padding-top: 65px;">
                    </p>

                    <h3 style="color: #2c2e3e; text-align: center;"> Digital & Marketing</h3>
                    <div class="m-widget7__desc graphics-text" style="text-align: center;font-weight: 600;">

                        Home to some of the world’s most talented digital experts who deliver standout work across SEO, Paid Media, Content Marketing and Design & Development. Over 50+ employees. Try any thing from the wish list and we bet you wont go anywhere else.
                    </div>
                    <div style="text-align: center; margin-top: 25px;">
                        <a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
                            Preview Portfolio
                        </a>
                    </div>
                </div>


                <div class="col-md-8 col-sm-12" style="padding-left: 60px;padding-right: 60px">
                    <div class="row" style=" padding-top: 108px;">

                        <!--gigs start-->
                        @foreach($featuredGigs3 as $featuredGig)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}">
                                        @if(!empty($featuredGig['thumbnail']) AND $featuredGig['thumbnail'] != '')
                                            <img src="{{ $featuredGig['thumbnail'] }}" style="width: 100%;" alt="{{ $featuredGig->title }}">
                                        @endif
                                        <div class="m-widget19__title m--font-light topbtn4">
                                            <button type="button" class="btn btn-sm m-btn--pill  btn-brand" style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px;padding-top: 0px;color: #fff;background-color: #564ec0;border-color: #4d44bd;">
                                                Top rated
                                            </button>
                                        </div>

                                        <div class="card-content">
                                            <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($featuredGig->title,50, '...') }}</h5>
                                            <hr>


                                                <aside  style="height:0px;" data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $featuredGig->id }}">
                                                    @if($user)
                                                    <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                                       class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($featuredGig['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                                     </span>

                                                    </a>
                                                    @endif
                                                    <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show3}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                                </aside>

                                            <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size:17px;">ONLY AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $featuredGig->price }}</span></h5>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                        @foreach($featuredPackages3 as $featuredPackag)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                                       class="gig-link-main" itemprop="url">
                                        @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                                            <img src="{{ $featuredPackag['thumbnail'] }}"  alt="{{ $featuredPackag->title }}" style="width: 100%;">
                                        @endif
                                        <div class="card-content">
                                            <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($featuredPackag->title,50,'...') }}</h5>
                                            <hr>

                                                <aside  style="height:0px;color: #ffc100;" data-url="{{ route('package.favourite') }}"
                                                        @if($user)
                                                       data-coll-id="{{ $featuredPackag->id }}">
                                                    <a style="padding-left:8px;"  id="btn-favourite-submit" href="javascript:void(0);"
                                                       class="gig-favourite-heart-icn">
                                                            <span class="favorite-span">
                                                                @if($featuredPackag['my_fav'])
                                                                    <i class="fa fa-heart"></i>
                                                                @else
                                                                    <i class="fa fa-heart-o"></i>
                                                                @endif
                                                            </span>

                                                    </a>
                                                    @endif
                                                    <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show10}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                                </aside>



                                            <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size: 17px;">STARTING AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency').$featuredPackag['package_bronze']->price }}</span></h5>
                                        </div>
                                    </a>
                                </div>

                                </div>

                            </div>
                        @endforeach
                    </div>



                </div>
            </div>

        </div>

    </section>

    <section>
        <div class="col-md-12" >


            <div class="row">
                <div class="col-md-4 col-sm-12" style="padding-left: 60px;padding-right: 60px" >
                    <p style="text-align: center;">
                        <img src="assets\app\media\img\blog\fashion_fade.png" style=" width: 100%; padding-top: 65px;">
                    </p>

                    <h3 style="color: #2c2e3e; text-align: center;"> Video & Animation</h3>
                    <div class="m-widget7__desc graphics-text" style="text-align: center;font-weight: 600;">

                        We develop and amplify communication ideas through intelligent execution and relevant technology – unlocking the potential of digital platforms for agencies and their clients. Professional high quality 3D rendering services.
                    </div>
                    <div style="text-align: center; margin-top: 25px;">
                        <a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
                            Preview Portfolio
                        </a>
                    </div>
                </div>


                <div class="col-md-8 col-sm-12" style="padding-left: 60px;padding-right: 60px">
                    <div class="row" style=" padding-top: 108px;">

                        <!--gigs start-->
                        @foreach($featuredGigs4 as $featuredGig)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}">
                                        @if(!empty($featuredGig['thumbnail']) AND $featuredGig['thumbnail'] != '')
                                            <img src="{{ $featuredGig['thumbnail'] }}" style="width: 100%;" alt="{{ $featuredGig->title }}">
                                        @endif
                                        <div class="m-widget19__title m--font-light topbtn5">
                                            <button type="button" class="btn btn-sm m-btn--pill  btn-brand" style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px;padding-top: 0px;color: #fff;background-color: #564ec0;border-color: #4d44bd;">
                                                Top rated
                                            </button>
                                        </div>

                                        <div class="card-content">
                                            <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($featuredGig->title,50, '...') }}</h5>
                                            <hr>
                                            <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size:17px;">ONLY AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $featuredGig->price }}</span></h5>

                                                <aside data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $featuredGig->id }}">
                                                    @if($user)
                                                    <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                                       class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($featuredGig['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                                     </span>

                                                    </a>
                                                    @endif
                                                    <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>{{$rating_gig_show4}}<span style="color: grey;padding-left: 5px"></span></span></i>


                                                </aside>




                                        </div>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                        @foreach($featuredPackages4 as $featuredPackag)
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding-top: 20px;">


                                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                                    <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                                       class="gig-link-main" itemprop="url">
                                        @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                                            <img src="{{ $featuredPackag['thumbnail'] }}"  alt="{{ $featuredPackag->title }}" style="width: 100%;">
                                        @endif
                                        <div class="card-content">
                                            <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($featuredPackag->title,50,'...') }}</h5>
                                            <hr>

                                            <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>{{$rating_gig_show12}}<span style="color: grey;padding-left: 5px">(1k)</span></span></i>
                                            <h5 class="packetprice" style="display: inline-block;float: right;padding-right: 7px;font-size: 11px;">STARTING AT<span class="packetprice" style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency').$featuredPackag['package_bronze']->price }}</span></h5>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>



                </div>
            </div>

        </div>

    </section>








 {{--   <section>--}}
        {{--<div class="col-md-12" >--}}


            {{--<div class="row">--}}
                {{--<div class="col-md-4 col-sm-12" style="padding-left: 60px;padding-right: 60px" >--}}
                    {{--<p style="text-align: center;">--}}
                        {{--<img src="assets\app\media\img\blog\business.png" style=" width: 100%; padding-top: 65px;">--}}
                    {{--</p>--}}

                    {{--<h3 style="color: #2c2e3e; text-align: center;"> Business & Writing</h3>--}}
                    {{--<div class="m-widget7__desc graphics-text" style="text-align: center;font-weight: 600;">--}}

                        {{--We create value by augmenting your business with a solution that not only possesses the right capabilities but also the real-life fit that relates to your specific business requirements.--}}
                    {{--</div>--}}
                    {{--<div style="text-align: center; margin-top: 25px;">--}}
                        {{--<a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">--}}
                            {{--Preview Portfolio--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}


               {{----}}
            {{--</div>--}}

        {{--</div>--}}

    {{--</section>--}}



    <!-- Footer -->
    @include('includes.footer')
    <!-- END Footer -->
    <script>

        $('.gig-favourite-heart-icn').click(function (e) {

            e.preventDefault();
            $selectedGig = $(this).parent();

            var gigId = $selectedGig.data('coll-id');
            var url = $selectedGig.data('url');

            // var className = $('span.favorite-span > i').attr('class');

            //  alert(className);

            if ($(this).find('i').attr('class') == 'fa fa-heart') {
                var action = 'removeFavorite';
                $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o"></i></span>');
            }
            else {
                var action = 'addToFavorite';
                $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart"></i></span>');
            }


            $.ajax({
                url: url,
                method: 'POST',
                data: {'gig-id': gigId, 'action': action},
                success: function (data) {

                }
            });
        });


    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            /*$('.gig-item-default').hover(function(){
             $(this).children('.col-xs-5').removeClass('hover-transition');
             },function(){
             $(this).children('.col-xs-5').addClass('hover-transition');
             });
             $('.gig-item-default').hover(function(){
             $(this).children('.col-xs-4').removeClass('hover-transition');
             },function(){
             $(this).children('.col-xs-4').addClass('hover-transition');
             });*/
            $('.gig-item-default').hover(function () {
                $(this).children('#sold').show();
            }, function () {
                $(this).children('#sold').hide();
            });
            $('#custom_offer').click(function () {

                $(".gig-style").toggle();
            });


        });
    </script>
    <script>
        $(document).ready(function () {


            //console.log("abc" + $('#pagination:last-child'));



            $('.multiple-items').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });

        });





    </script>




