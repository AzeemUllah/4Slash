@include('includes.header')
        <div class="dash-main-content" class="dash1">
            @if(!isset($userDetail->company) || !isset($userDetail->country) || !isset($userDetail->surname))
                <div class="container">
                    <div class="alert alert-success" role="alert" class="profile1">Please complete your profile.</div>
                </div>
            @endif
            <div class="container">
                <div class="row" class="comp1">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        @include('includes.profile-side-menu')
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 main-gigs" class="comp2">
                        <div class="mp-box  ">
                            <div class="box-row p-b-30  p-t-10 ">


                                <article class="mp-gig-carousel">


                                    <div class="gig-carousel cf loading-dummy dummy-12" data-json-path="/gigs/endless_page_as_json?host=homepage&amp;type=endless&amp;category_id=99912&amp;limit=12" data-load-more="false" data-hide-empty="true" data-hide-parent="false" data-gigs-shown="4" data-do-sliding="false" data-two-lines="false" data-do-lazyload="false" data-do-endless="false" data-host="homepage" data-box-id="hp99912_1_4">


                                        <div class="slider-box">
                                            <div class="slider-hider cf">

                                                @foreach($gigs as $gig)
                                                    <div id="dash-gig"
                                                         class="slide gig-item gig-item-default js-slide js-gig-card "
                                                         data-gig-id="4864637"
                                                         data-cached-slug="create-unusual-illustrations-in-my-style"
                                                         data-gig-index="0" data-gig-category="graphics-design"
                                                         data-gig-sub-category="digital-illustration"
                                                         data-gig-price="20" itemscope=""
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

                                                        <a href="{{ url() }}/favors/{{ $gig['gigtype_slug'] }}/{{ $gig->slug }}?funnel={{ $gig->uuid }}"
                                                           class="gig-link-main" itemprop="url">
                                                            <span class="gig-pict-222" itemscope=""
                                                                  itemtype="http://schema.org/ImageObject"><img
                                                                        src="{{ $gig['thumbnail'] }}"
                                                                        alt="{{ $gig->title }}"></span>

                                                            <h3 itemprop="name">{{ str_limit($gig->title,23,'...') }}</h3>
                                                        </a>

                                                        <div class="col-xs-5">
                                                            @if($gig->featured)
                                                                <span class="gig-badges featured" itemprop="award">featured</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <aside data-url="{{ route('gig.favourite') }}"
                                                                   data-coll-id="{{ $gig->id }}">
                                                                <a id="btn-favourite-submit" href="javascript:void(0);"
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
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a href="#" class="gig-price" rel="nofollow"
                                                               itemprop="offers" itemscope=""
                                                               itemtype="http://schema.org/Offer">
                                                                <small itemprop="price"></small><span itemprop="price">
                                                                <?php $gig->price = str_replace('.', ',', number_format($gig->price, 2))?>
                                                                    {{ config('app.currency') . $gig->price }}</span>
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
                        <div class="text-center">
                            <!--<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-th-large" style="margin-right:5px;"></span>View all Gigs</button>-->
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
