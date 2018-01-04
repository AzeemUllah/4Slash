@include('includes.header')
<!-- content -->
{{--<div class="dash-main-content">
    <div class="container">
        <div class="row" style="margin-top: 65px; margin-bottom: 60px;">

            <div class="col-xs-12" style="text-align:-webkit-center;">
                <div class="row dash">
                    <h1 class="dash-heading">{{ (isset($_GET['search'])) ? 'Search result for "' . $_GET['search'] . '"' : (isset($gigType) ? $gigType->name : (isset($gigtype_subCat) ? $gigtype_subCat->name : '')) }} <? @if((isset($gigtype_subCat)))?> / {{ $gigtype_subCat->name  }} @endif</h1>
                    <div class="mp-box  ">
                        <div class="box-row p-b-30  p-t-10 ">
                            <article class="mp-gig-carousel">
                                <header>
                                    <h3 class="text-left" style="margin:0px; margin-bottom: 10px;border-bottom: 1px solid #E2E0E0;padding-bottom: 10px;">Packages</h3>
                                </header>
                                <div class="gig-carousel cf loading-dummy dummy-12"
                                     data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12"
                                     data-load-more="false" data-hide-empty="true" data-hide-parent="false" data-gigs-shown="4"
                                     data-do-sliding="false" data-two-lines="false" data-do-lazyload="false" data-do-endless="false"
                                     data-host="homepage" data-box-id="hp99912_1_4">


                                    <div class="slider-box">
                                        <div class="slider-hider cf">
                                            @if(!empty($packages))
                                                @foreach($packages as $featuredPackag)
                                                    <div class="slide gig-item gig-item-default js-slide js-gig-card "
                                                         data-gig-id="4864637"
                                                         data-cached-slug="create-unusual-illustrations-in-my-style" data-gig-index="0"
                                                         data-gig-category="graphics-design"
                                                         data-gig-sub-category="digital-illustration" data-gig-price="20" itemscope=""
                                                         itemtype="http://schema.org/Product">
                                                        --}}{{--<div id="sold" style="display: none;"><span style="color:white;font-weight: bold;font-size: 11px; position: relative;top:5px;">{{ $featuredGig['sale_count'] }}</span></div>--}}{{--
                                                        <div class="gig-seller">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span class="ratings-count" itemprop="ratingCount">(202)</span>
                        </span>
                                                            <meta itemprop="worstRating" content="1">
                                                            <span class="circ-rating-s8 rate-10" itemprop="ratingValue">10</span>
                                                            <meta itemprop="bestRating" content="10">
                                                            --}}{{--by <a href="/muravski" rel="nofollow" class="seller-name" itemprop="brand" itemscope="" itemtype="http://schema.org/Brand">muravski</a>--}}{{--
                                                        </div>

                                                        <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                                                           class="gig-link-main" itemprop="url">
                                            <span class="gig-pict-222" itemscope=""
                                                  itemtype="http://schema.org/ImageObject">
                                                @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                                                    <img src="{{ $featuredPackag['thumbnail'] }}"
                                                         alt="{{ $featuredPackag->title }}"></span>
                                                            @endif
                                                            <h3 itemprop="name">{{ str_limit($featuredPackag->title,50,'...')  }}</h3>
                                                            --}}{{--<h3 itemprop="name">{{ $featuredGig->title  }}</h3>--}}{{--
                                                            <div class="row" style="margin:0px;font-size: 15px;font-weight: normal; ">
                                                                <div class="col-xs-4">
                                                                    <p>Bronze</p>
                                                                    <img src="{{ url('/').'/img/bronze_label.png' }}" alt="bronze" width="30px">
                                                                    <p>{{ config('app.currency').$featuredPackag['package_bronze']->price }}</p>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <p>Silber</p>
                                                                    <img src="{{ url('/').'/img/silver_label.png' }}" alt="silver" width="30px">
                                                                    <p>{{ config('app.currency').$featuredPackag['package_silver']->price }}</p>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <p>Gold</p>
                                                                    <img src="{{ url('/').'/img/gold_label.png' }}" alt="gold" width="30px">
                                                                    <p>{{ config('app.currency').$featuredPackag['package_gold']->price }}</p>
                                                                </div>
                                                            </div>
                                                        </a>

                                                        <div class="col-xs-5">
                                                            <span class="gig-badges featured" itemprop="award">featured</span>
                                                        </div>
                                                        --}}{{--<div class="col-xs-3">
                                                            @if($user)
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
                                                            @endif
                                                        </div>--}}{{--
                                                        --}}{{--<div class="col-xs-4">
                                                            <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}"
                                                               class="gig-price" rel="nofollow" itemprop="offers" itemscope=""
                                                               itemtype="http://schema.org/Offer">
                                                                <small itemprop="price"></small>
                                                                <span itemprop="price">{{ config('app.currency') . $featuredPackag->price }}</span></a>
                                                        </div>--}}{{--
                                                    </div>
                                                @endforeach
                                            @else
                                                asdfasfasdf
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </article>
                        </div>
                    </div>

                </div>
                --}}{{--<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-th-large" style="margin-right:5px;"></span>View all Gigs</button>--}}{{--
            </div>
        </div>
    </div>
</div>--}}
<div class="m-grid m-grid--hor m-grid--root m-page">




    <div class="container-fluid">


        <div id="jssor_1" style="margin:113px auto;position: relative;top:69px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:980px;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="assets/img/spin.svg" />
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                <div>
                    <img data-u="image" src="assets/img/022.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/022-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/023.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/023-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/024.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/024-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/025.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/025-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/026.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/026-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/027.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/027-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/021.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/021-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/028.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/028-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/029.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/029-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/030.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/030-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/031.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/031-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
                <div>
                    <img data-u="image" src="assets/img/032.jpg" />
                    <div data-u="thumb">
                        <img data-u="thumb" class="i" src="assets/img/032-s96x48.jpg" />
                        <span class="ti">Title</span><br />
                        <span class="d">Slide Description</span>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Navigator -->
            <div data-u="thumbnavigator" class="jssort121" style="position:absolute;left:0px;top:0px;width:268px;height:380px;overflow:hidden;cursor:default;" data-autocenter="2" data-scale-left="0.75">
                <div data-u="slides">
                    <div data-u="prototype" class="p" style="width:268px;height:68px;">
                        <div data-u="thumbnailtemplate" class="t"></div>
                    </div>
                </div>
            </div>


        </div>
        <!--slider end-->


        <div class="col-md-12">
            <!--Begin::Main Portlet-->
            <div class="col-md-3">
                <!--begin:: Widgets/Sales Stats-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    bronze Bronze

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <!--<li class="m-portlet__nav-item m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover">-->
                                <!--<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn&#45;&#45;sm m-btn&#45;&#45;pill btn-secondary m-btn m-btn&#45;&#45;label-brand">-->
                                <!--Today-->
                                <!--</a>-->
                                <!--<div class="m-dropdown__wrapper">-->
                                <!--<span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust"></span>-->
                                <!--<div class="m-dropdown__inner">-->
                                <!--<div class="m-dropdown__body">-->
                                <!--<div class="m-dropdown__content">-->
                                <!--<ul class="m-nav">-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-share"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Activity-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-chat-1"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Messages-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-info"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--FAQ-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-lifebuoy"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Support-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--</ul>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-interface-3"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														JPEG Datei in 300 DPI
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+500-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-folder-4"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														PDF Datei in 300 DPI
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!-- -64-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-line-graph"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														Endformat 98x21mm
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+1080-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item m-widget4__item--last">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-diagram"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														Print-ready file
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+19-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
                                <canvas id="m_chart_latest_updates"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Sales Stats-->
            </div>
            <div class="col-md-3">
                <!--begin:: Widgets/Inbound Bandwidth-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    bronze Silber

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <!--<li class="m-portlet__nav-item m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover">-->
                                <!--<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn&#45;&#45;sm m-btn&#45;&#45;pill btn-secondary m-btn m-btn&#45;&#45;label-brand">-->
                                <!--Today-->
                                <!--</a>-->
                                <!--<div class="m-dropdown__wrapper">-->
                                <!--<span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust"></span>-->
                                <!--<div class="m-dropdown__inner">-->
                                <!--<div class="m-dropdown__body">-->
                                <!--<div class="m-dropdown__content">-->
                                <!--<ul class="m-nav">-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-share"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Activity-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-chat-1"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Messages-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-info"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--FAQ-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-lifebuoy"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Support-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--</ul>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-interface-3"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														JPEG Datei in 300 DPI
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+500-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-folder-4"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														PDF Datei in 300 DPI
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!-- -64-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-line-graph"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														EndFormat 98x21mm
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+1080-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item m-widget4__item--last">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-diagram"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
                                                        bleed
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+19-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
                                <canvas id="m_chart_latest_updates"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <!--end:: Widgets/Inbound Bandwidth-->

                <!--begin:: Widgets/Outbound Bandwidth-->

                <!--end:: Widgets/Outbound Bandwidth-->
            </div>
            <div class="col-md-3">
                <!--begin:: Widgets/Top Products-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    bronze Gold
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <!--<li class="m-portlet__nav-item m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover">-->
                                <!--<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn&#45;&#45;sm m-btn&#45;&#45;pill btn-secondary m-btn m-btn&#45;&#45;label-brand">-->
                                <!--Today-->
                                <!--</a>-->
                                <!--<div class="m-dropdown__wrapper">-->
                                <!--<span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust"></span>-->
                                <!--<div class="m-dropdown__inner">-->
                                <!--<div class="m-dropdown__body">-->
                                <!--<div class="m-dropdown__content">-->
                                <!--<ul class="m-nav">-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-share"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Activity-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-chat-1"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Messages-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-info"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--FAQ-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-lifebuoy"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Support-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--</ul>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-interface-3"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														JPEG Datei in 300 DPI
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+500-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-folder-4"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														Offenes Format 297x21mm
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!-- -64-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-line-graph"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
														Gesch.Format 98x21mm
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+1080-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__item m-widget4__item--last">
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon m--font-brand">
                                        <i class="flaticon-diagram"></i>
                                    </a>
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__text">
                                                        bleed
													</span>
                                </div>
                                <!--<div class="m-widget4__ext">-->
                                <!--<span class="m-widget4__stats m&#45;&#45;font-info">-->
                                <!--<span class="m-widget4__number m&#45;&#45;font-accent">-->
                                <!--+19-->
                                <!--</span>-->
                                <!--</span>-->
                                <!--</div>-->
                            </div>
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
                                <canvas id="m_chart_latest_updates"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Top Products-->
            </div>
            <div class="col-md-3">
                <!--begin:: Widgets/Top Products-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Order Information
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <!--<li class="m-portlet__nav-item m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover" aria-expanded="true">-->
                                <!--<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn&#45;&#45;sm m-btn&#45;&#45;pill btn-secondary m-btn m-btn&#45;&#45;label-brand">-->
                                <!--All-->
                                <!--</a>-->
                                <!--<div class="m-dropdown__wrapper">-->
                                <!--<span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust" style="left: auto; right: 36.5px;"></span>-->
                                <!--<div class="m-dropdown__inner">-->
                                <!--<div class="m-dropdown__body">-->
                                <!--<div class="m-dropdown__content">-->
                                <!--<ul class="m-nav">-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-share"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Activity-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-chat-1"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Messages-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-info"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--FAQ-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-lifebuoy"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Support-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--</ul>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget5-->
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 352px">
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo3.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														bronze Bronze
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
                                                       Details it. Product box Bronze
													</span>
                                    <!--<button type="button" class="btn m-btn&#45;&#45;pill    btn-secondary btn-sm">-->
                                    <!--Buy now-->
                                    <!--</button>-->
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$17
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo1.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														bronze Silber
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Details it. Product box Silber
													</span>
                                    <button type="button" class="btn m-btn--pill    btn-secondary btn-sm">
                                        Buy now
                                    </button>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$300
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														bronze Gold
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Details it. Product box Gold
													</span>
                                    <button type="button" class="btn m-btn--pill    btn-secondary btn-sm">
                                        Buy now
                                    </button>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$300
													</span>
												</span>
                            </div>
                            <!--<div class="m-widget4__chart m-portlet-fit&#45;&#45;sides m&#45;&#45;margin-top-20" style="height:260px;">-->
                            <!--<canvas id="m_chart_trends_stats_2"></canvas>-->
                            <!--</div>-->
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    We need
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <!--<li class="m-portlet__nav-item m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover">-->
                                <!--<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn&#45;&#45;sm m-btn&#45;&#45;pill btn-secondary m-btn m-btn&#45;&#45;label-brand">-->
                                <!--All-->
                                <!--</a>-->
                                <!--<div class="m-dropdown__wrapper">-->
                                <!--<span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust"></span>-->
                                <!--<div class="m-dropdown__inner">-->
                                <!--<div class="m-dropdown__body">-->
                                <!--<div class="m-dropdown__content">-->
                                <!--<ul class="m-nav">-->
                                <!--<li class="m-nav__section m-nav__section&#45;&#45;first">-->
                                <!--<span class="m-nav__section-text">-->
                                <!--Quick Actions-->
                                <!--</span>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-share"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Activity-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-chat-1"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Messages-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-info"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--FAQ-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="m-nav__link">-->
                                <!--<i class="m-nav__link-icon flaticon-lifebuoy"></i>-->
                                <!--<span class="m-nav__link-text">-->
                                <!--Support-->
                                <!--</span>-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--<li class="m-nav__separator m-nav__separator&#45;&#45;fit"></li>-->
                                <!--<li class="m-nav__item">-->
                                <!--<a href="#" class="btn btn-outline-danger m-btn m-btn&#45;&#45;pill m-btn&#45;&#45;wide btn-sm">-->
                                <!--Cancel-->
                                <!--</a>-->
                                <!--</li>-->
                                <!--</ul>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo5.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Logo / Slogan
													</span>
                                    <br>
                                    <!--<span class="m-widget4__sub">-->
                                    <!--Make Metronic Great Again-->
                                    <!--</span>-->
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$2500
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <!--<img src="assets/app/media/img/client-logos/logo4.png" alt="">-->
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Texte / Bilder
													</span>
                                    <br>
                                    <!--<span class="m-widget4__sub">-->
                                    <!--Good Coffee & Snacks-->
                                    <!--</span>-->
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														-$290
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <!--<img src="assets/app/media/img/client-logos/logo3.png" alt="">-->
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Design ideas / sketch
													</span>
                                    <br>
                                    <!--<span class="m-widget4__sub">-->
                                    <!--A Programming Language-->
                                    <!--</span>-->
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$17
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <!--<img src="assets/app/media/img/client-logos/logo2.png" alt="">-->
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Fonts
													</span>
                                    <br>
                                    <!--<span class="m-widget4__sub">-->
                                    <!--Make Green Great Again-->
                                    <!--</span>-->
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														-$2.50
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <!--<img src="assets/app/media/img/client-logos/logo1.png" alt="">-->
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Letter fold or z-fold
													</span>
                                    <br>
                                    <!--<span class="m-widget4__sub">-->
                                    <!--A Let's Fly Fast Again Language-->
                                    <!--</span>-->
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$200
													</span>
												</span>


                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Top Products-->
            </div>

        </div>


        <!--packet start-->
        <h1 style="font-size: 17px;text-align: center;">More packages in this category</h1>
        <hr style="border-bottom: 2px solid;width: 150px;">
        <div class="col-md-12" style="padding: 0 50px;">
            <div class="col-md-3">

                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                    <img src="assets/app/media/img/blog/pic4.jpg" style="width: 100%;">
                    <div class="card-content">
                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">T-shirts Design</h5>
                        <hr>
                        <i class="fa fa-heart" aria-hidden="true" style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>
                        <h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">STARTING AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">$5</span></h5>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                    <img src="assets/app/media/img/blog/pic4.jpg" style="width: 100%;">
                    <div class="card-content">
                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">ELEGANT Design</h5>
                        <hr>
                        <i class="fa fa-heart" aria-hidden="true" style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>
                        <h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">STARTING AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">$5</span></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                    <img src="assets/app/media/img/blog/pic4.jpg" style="width: 100%;">
                    <div class="card-content">
                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">flyer Din A4</h5>
                        <hr>
                        <i class="fa fa-heart" aria-hidden="true" style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>
                        <h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">STARTING AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">$5</span></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                    <img src="assets/app/media/img/blog/pic4.jpg" style="width: 100%;">
                    <div class="card-content">
                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">Flyer Din A4</h5>
                        <hr>
                        <i class="fa fa-heart" aria-hidden="true" style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>
                        <h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">STARTING AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">$5</span></h5>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


@include('includes.footer')

<script>
    $('#custom_offer').click(function(){

        $(".gig-style").toggle();
    });
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
        $('.gig-item-default').hover(function(){
            $(this).children('#sold').show();
        },function(){
            $(this).children('#sold').hide();
        });
    });
</script>