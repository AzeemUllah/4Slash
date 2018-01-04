@include('includes.header')

        <!-- Content -->
<div class="notify-main-content top-gap" style="min-height: 740px;">
    <div class="container">
        <div class="well">
            <h1 class="heading-responsive">My favorites</h1>

            <div class="row my-favourites">

                <div class="mp-box mp-box-my-favourite">

                    <article class="mp-gig-carousel">


                        <div class="gig-carousel cf loading-dummy dummy-12"
                             data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12"
                             data-load-more="false" data-hide-empty="true" data-hide-parent="false"
                             data-gigs-shown="4" data-do-sliding="false" data-two-lines="false"
                             data-do-lazyload="false" data-do-endless="false" data-host="homepage"
                             data-box-id="hp99912_1_4">


                            <div class="slider-box">
                                <div class="slider-hider cf">

                                    @foreach($myFavouriteGigs as $gig)
                                        <div class="slide gig-item gig-item-default js-slide js-gig-card "
                                             data-gig-id="4864637"
                                             data-cached-slug="create-unusual-illustrations-in-my-style"
                                             data-gig-index="0" data-gig-category="graphics-design"
                                             data-gig-sub-category="digital-illustration" data-gig-price="20"
                                             itemscope="" itemtype="http://schema.org/Product">


                                            <div class="gig-seller">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span class="ratings-count" itemprop="ratingCount">(202)</span>
                        </span>
                                                <meta itemprop="worstRating" content="1">
                                                    <span class="circ-rating-s8 rate-10"
                                                          itemprop="ratingValue">10</span>
                                                <meta itemprop="bestRating" content="10">
                                                {{--by <a href="/muravski" rel="nofollow" class="seller-name" itemprop="brand" itemscope="" itemtype="http://schema.org/Brand">muravski</a>--}}
                                            </div>

                                            <a href="{{ url() }}/favors/{{ $gig['gigType']->slug }}/{{ $gig->slug }}?funnel={{ $gig->uuid }}"
                                               class="gig-link-main" itemprop="url">
                                                    <span class="gig-pict-222" itemscope=""
                                                          itemtype="http://schema.org/ImageObject"><img
                                                                src="{{ $gig['thumbnail'] }}"
                                                                alt="{{ $gig->title }}"></span>

                                                <h3 itemprop="name">{{ str_limit($gig->title,50,'...') }}</h3>
                                                {{--<h3 itemprop="name">{{ $gig->title }}</h3>--}}
                                            </a>
                                            <div class="col-xs-5">
                                                @if($gig->featured)
                                                    <span class="gig-badges featured"
                                                          itemprop="award">featured</span>
                                                @endif
                                            </div>
                                            <div class="col-xs-3">
                                                <aside data-url="{{ route('gig.unfavourite') }}"
                                                       data-id="{{ $gig->id }}">
                                                    <a id="btn-favourite-submit" href="javascript:void(0);"
                                                       class="gig-favourite-heart-icn">
                                                                <span class="favorite-span">
                                                                        <i class="fa fa-heart"></i>
                                                                    </span>

                                                    </a>
                                                </aside>
                                            </div>
                                            <div class="col-xs-4 text-right">
                                                <a href="#"
                                                   class="gig-price" rel="nofollow" itemprop="offers" itemscope=""
                                                   itemtype="http://schema.org/Offer">
                                                    <small itemprop="price"></small>
                                                    <span itemprop="price">{{ config('app.currency') . $gig->price }}</span>
                                                </a>
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
    </div>
</div>
</div>
</div>
</div>
</div>


@include('includes.footer')

<script>

    $('.gig-favourite-heart-icn').click(function(e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId    = $selectedGig.data('id');
        var url      = $selectedGig.data('url');
      $.ajax({
            url: url,
            method: 'POST',
            data: { 'gig-id': gigId},
            success: function(data) {
                console.log(data);
                location.reload();
            }
        });
        /*location.reload();*/
    });


</script>

</body>
</html>