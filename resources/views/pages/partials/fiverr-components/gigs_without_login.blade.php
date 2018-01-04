@include('includes.header')

<!-- content -->
<div class="dash-main-content">
            <div class="container">
                <div class="row" style="margin-top: 65px; margin-bottom: 60px;">
                    
                    <div class="col-xs-12" style="text-align:-webkit-center;">
                        <div class="row dash">

                            <h1 class="dash-heading">{{ (isset($_GET['search'])) ? 'Search result for "' . $_GET['search'] . '"' : (isset($gigType) ? $gigType->name : (isset($gigtype_subCat) ? $gigtype_subCat->name : '')) }}</h1>
                            <div class="mp-box  ">
                                <div class="box-row p-b-30  p-t-10 ">


                                    <article class="mp-gig-carousel">  

                                        <div class="gig-carousel cf loading-dummy dummy-12"
                                             data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12"
                                             data-load-more="false" data-hide-empty="true" data-hide-parent="false" data-gigs-shown="4"
                                             data-do-sliding="false" data-two-lines="false" data-do-lazyload="false" data-do-endless="false"
                                             data-host="homepage" data-box-id="hp99912_1_4">


                                            <div class="slider-box">
                                                <div class="slider-hider cf">

                                                    @if(isset($gigs))
                                                    @foreach($gigs as $gig)
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

                                                            <a href="{{ url() }}/gigs/{{ $gig['gigType']->slug }}/{{ $gig->slug }}?funnel={{ $gig->uuid }}"
                                                               class="gig-link-main" itemprop="url">
                                            <span class="gig-pict-222" itemscope=""
                                                  itemtype="http://schema.org/ImageObject"><img
                                                        src="{{ $gig['thumbnail'] }}" alt="{{ $gig->title }}"></span>

                                                                <h3 itemprop="name">{{ $gig->title }}</h3>
                                                            </a>

                                                            <aside class="card-badges cf">
                                                                @if($gig->featured)
                                                                    <span class="gig-badges featured" itemprop="award">featured</span>
                                                                @endif
                                                            </aside>

                                                            <div class="gig-sub cf">


                                                                <a href="/muravski/create-unusual-illustrations-in-my-style?context=old.cat_99912&amp;context_type=auto&amp;pos=1&amp;funnel=499168c7-6bda-4234-9ca1-1758feff76ae"
                                                                   class="gig-price" rel="nofollow" itemprop="offers" itemscope=""
                                                                   itemtype="http://schema.org/Offer">
                                                                    <small itemprop="price"></small>
                                                                    <span itemprop="price">{{ config('app.currency') . $gig->price }}</span></a>

                                                                <aside class="gig-collect js-gig-collect" id="coll-gig-4864637"
                                                                       data-coll-id="4864637">
                                                                    {{--<a class="icn-heart-toggle hint--top js-gtm-event" href="#" data-hint="Save in..." data-coll-gig="coll-gig-4864637" data-gtm-action="hp-clicked-list" data-gtm-event="collections"><span></span></a>--}}
                                                                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                                        <a class="icn-heart hint--top js-gtm-event" href="#"
                                                                           data-hint="Favorite" data-gtm-action="hp-clicked-heart"
                                                                           data-gtm-event="collections"><span></span></a>
                                                                    @endif
                                                                </aside>


                                                            </div>

                                                        </div>
                                                    @endforeach
                                                        @endif

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


    </body>
</html> 