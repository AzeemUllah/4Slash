
@include('includes.header')
<!-- content -->
<div class="dash-main-content">
            <div class="container">
                <div class="row" style="margin-top: 65px; margin-bottom: 60px;"> 
                    
                    <div class="col-xs-12" style="text-align:-webkit-center;">
                        <div class="row dash">
                            <h1 class="dash-heading">{{ (isset($_GET['search'])) ? 'Search result for "' . $_GET['search'] . '"' : (isset($gigType) ? $gigType->name : (isset($gigtype_subCat) ? $gigtype_subCat->name : '')) }} <? @if((isset($gigtype_subCat)))?> / {{ $gigtype_subCat->name  }} @endif</h1>
                            <div class="mp-box  ">
                                <div class="box-row p-b-30  p-t-10 ">


                                    <article class="mp-gig-carousel"> 
                                        <header>
                                            <h3 class="text-left" style="margin:0px; margin-bottom: 10px;padding-bottom: 10px; color:#1b2432;">Gigs</h3>
                                        </header>
                                        <div class="gig-carousel cf loading-dummy dummy-12"
                                             data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12"
                                             data-load-more="false" data-hide-empty="true" data-hide-parent="false" data-gigs-shown="4"
                                             data-do-sliding="false" data-two-lines="false" data-do-lazyload="false" data-do-endless="false"
                                             data-host="homepage" data-box-id="hp99912_1_4">


                                            <div class="slider-box">
                                                <div class="slider-hider cf">

                                                    @if(!empty($gigs))
                                                    @foreach($gigs as $gig) 
                                                        <div class="slide gig-item gig-item-default js-slide js-gig-card "
                                                             data-gig-id="4864637"
                                                             data-cached-slug="create-unusual-illustrations-in-my-style" data-gig-index="0"
                                                             data-gig-category="graphics-design"
                                                             data-gig-sub-category="digital-illustration" data-gig-price="20" itemscope=""
                                                             itemtype="http://schema.org/Product">
                                                            {{--<div id="sold" style="display:none;"><span style="color:white;font-weight: bold;font-size: 11px; position: relative;top:0px;">{{ $sales_count[$gig->id] }}</span></div>--}}
                                                            <div class="gig-seller">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span class="ratings-count" itemprop="ratingCount">(202)</span>
                        </span>
                                                                <meta itemprop="worstRating" content="1">
                                                                <span class="circ-rating-s8 rate-10" itemprop="ratingValue">10</span>
                                                                <meta itemprop="bestRating" content="10">
                                                                {{--by <a href="/muravski" rel="nofollow" class="seller-name" itemprop="brand" itemscope="" itemtype="http://schema.org/Brand">muravski</a>--}}
                                                            </div>

                                                            <a href="{{ url() }}/favors/{{ $gig['gigType']->slug }}/{{ $gig->slug }}?funnel={{ $gig->uuid }}"
                                                               class="gig-link-main" itemprop="url">
                                            <span class="gig-pict-222" itemscope=""
                                                  itemtype="http://schema.org/ImageObject"><img
                                                        src="{{ $thumbs[$gig->id] }}" alt="{{ $gig->title }}"></span>

                                                                <h3 itemprop="name">{{ str_limit($gig->title, 50, '...') }}</h3>
                                                                {{--<h3 itemprop="name">{{$gig->title}}</h3>--}}
                                                            </a>

                                                            <div class="col-xs-5">
                                                                @if($gig->featured)
                                                                    <span class="gig-badges featured" itemprop="award">featured</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-3">
                                                                @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                                    <aside data-url="{{ route('gig.favourite') }}"
                                                                           data-coll-id="{{ $gig->id }}">
                                                                        <a id="btn-favourite-submit"
                                                                           href="javascript:void(0);"
                                                                           class="gig-favourite-heart-icn">
                                                                <span class="favorite-span">
                                                                    @if($gig['my_fav'])
                                                                        <i class="fa fa-heart"></i>
                                                                    @else
                                                                        <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                </span>

                                                                        </a>

                                                                    </aside>
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <a href="#" class="gig-price" rel="nofollow"
                                                                   itemprop="offers" itemscope=""
                                                                   itemtype="http://schema.org/Offer" style="font-size: 14px;">
                                                                    <small itemprop="price"></small>
                                                                    <span itemprop="price">{{ config('app.currency') . $gig->price }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                        @endif
                                                        <div class="slide gig-item gig-item-default js-slide">
                                                            <a href="#" id="custom_offer" class="gig-link-main">
                                                                <div style="padding: 8px;background-color: white;">
                                                                    <img src="https://4slash.com/img/slide_img1.jpg" style="width: 100%; height: 108px;">
                                                                    <h3 itemprop="name">Are you looking for something else?</h3>
                                                                    <div class="col-xs-5">
                                                                        <span class="gig-badges featured" itemprop="award">featured</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                </div>
                                            </div>

                                        </div>

                                        <header style="padding-top: 30px;">
                                            <h3 class="text-left" style="margin:0px; margin-bottom: 10px;padding-bottom: 10px; color:#1b2432;">Packages</h3>
                                        </header>
                                        <div class="gig-carousel cf loading-dummy dummy-12"
                                             data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12"
                                             data-load-more="false" data-hide-empty="true" data-hide-parent="false" data-gigs-shown="4"
                                             data-do-sliding="false" data-two-lines="false" data-do-lazyload="false" data-do-endless="false"
                                             data-host="homepage" data-box-id="hp99912_1_4">


                                            <div class="slider-box">
                                                <div class="slider-hider cf">
                                                    @foreach($packages as $featuredPackag)
                                                            <div class="slide gig-item gig-item-default js-slide js-gig-card "
                                                             data-gig-id="4864637"
                                                             data-cached-slug="create-unusual-illustrations-in-my-style" data-gig-index="0"
                                                             data-gig-category="graphics-design"
                                                             data-gig-sub-category="digital-illustration" data-gig-price="20" itemscope=""
                                                             itemtype="http://schema.org/Product">
                                                            {{--<div id="sold" style="display: none;"><span style="color:white;font-weight: bold;font-size: 11px; position: relative;top:5px;">{{ $featuredGig['sale_count'] }}</span></div>--}}
                                                            <div class="gig-seller">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span class="ratings-count" itemprop="ratingCount">(202)</span>
                        </span>
                                                                <meta itemprop="worstRating" content="1">
                                                                <span class="circ-rating-s8 rate-10" itemprop="ratingValue">10</span>
                                                                <meta itemprop="bestRating" content="10">
                                                                {{--by <a href="/muravski" rel="nofollow" class="seller-name" itemprop="brand" itemscope="" itemtype="http://schema.org/Brand">muravski</a>--}}
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
                                                                {{--<h3 itemprop="name">{{ $featuredGig->title  }}</h3>--}}
                                                                <div class="row" style="margin:0px;font-size: 15px; ">
                                                                    <div class="col-xs-4">
                                                                        <img src="{{ url('/').'/img/bronze_label.png' }}" alt="bronze" width="30px">
                                                                        <p>{{ config('app.currency').$featuredPackag['package_bronze']->price }}</p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <img src="{{ url('/').'/img/silver_label.png' }}" alt="silver" width="30px">
                                                                        <p>{{ config('app.currency').$featuredPackag['package_silver']->price }}</p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <img src="{{ url('/').'/img/gold_label.png' }}" alt="gold" width="30px">
                                                                        <p>{{ config('app.currency').$featuredPackag['package_gold']->price }}</p>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                            <div class="col-xs-5">
                                                                <span class="gig-badges featured" itemprop="award">Featured</span>
                                                            </div>
                                                                <div class="col-xs-3">
                                                                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                                        <aside data-url="{{ route('gig.favourite') }}"
                                                                               data-coll-id="{{ $featuredPackag->id }}">
                                                                            <a id="btn-favourite-submit"
                                                                               href="javascript:void(0);"
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
                                                                </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </article>

                                </div>
                            </div>

                        </div>
                        {{--<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-th-large" style="margin-right:5px;"></span>View all Gigs</button>--}}
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