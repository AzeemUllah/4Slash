@include('includes.header')

<section>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6" style="margin-top: 100px;">

        <h1 class="dash-heading dashhead">{{ (isset($_GET['search'])) ? 'Search result for "' . $_GET['search'] . '"' : (isset($gigType) ? $gigType->name : (isset($gigtype_subCat) ? $gigtype_subCat->name : '')) }} <? @if((isset($gigtype_subCat)))
                ?> / {{ $gigtype_subCat->name  }} @endif</h1><h2 style="color: #37404d; text-align: center;">Products</h2>


        <br>

        <br>


        @if(!empty($gigs))
            @foreach($gigs as $gig)

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6" style="padding-top: 20px;">

                    <div class="card"
                         style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                        <a href="{{ url() }}/favors/{{ $gig['gigType']->slug }}/{{ $gig->slug }}?funnel={{ $gig->uuid }}">
                            <img src="{{ $thumbs[$gig->id] }}" alt="{{ $gig->title }}" width="100%">
                            <div class="card-content">
                                <div class="m-widget19__title m--font-light topbtn1">
                                    <button type="button" class="btn btn-sm m-btn--pill  btn-brand"
                                            style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px; padding-top: 0px;color: #fff;background-color: #564ec0;border-color: #4d44bd">
                                        Top rated
                                    </button>
                                </div>
                                <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($gig->title, 50, '...') }}</h5>
                                <hr>

                                <h5 class="priceinfo" style="display: inline-block;float: right;padding-right: 7px;font-size:17px;padding-top: 9px;">ONLY
                                    AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $gig->price }}</span>
                                </h5>

                                    <aside  data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $gig->id }}">
                                        @if(\Illuminate\Support\Facades\Auth::user()->check())
                                        <a style="float: left; margin-top: 17px; margin-left: 10px;" id="btn-favourite-submit" href="javascript:void(0);" class="gig-favourite-heart-icn hearticons">
                                                         <span class="favorite-span " >
                                                                         @if($gig['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                         </span>

                                        </a>
                                        @endif
                                        <i class="fa fa-star star1" aria-hidden="true" style=" padding-left: 8px;color: #ffc100;position: relative;top: 16px;float: left;"><span>{{ $gig['show_rating'] }}<span style="color: grey;padding-left: 5px"></span></span></i>


                                    </aside>



                            </div>
                        </a>
                    </div>

                </div>



            @endforeach
        @endif
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 200px;">
        <h2 style="text-align: center;" class="dash-heading">Packages</h2>
        <hr style="border-bottom: 2px solid;width: 150px;">
        @foreach($packages as $featuredPackag)
            <div class="col-lg-3 col-md-6 col-sm-6" style="padding-top: 20px;">


                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                    <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                       class="gig-link-main" itemprop="url">
                        @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                            <img src="{{ $featuredPackag['thumbnail'] }}"
                                 alt="{{ $featuredPackag->title }}" width="100%"></span>
                        @endif
                    </a>
                    <div class="card-content">
                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ $featuredPackag->title }}</h5>
                        <hr>
                        <h5 class="priceinfo3" style="display: inline-block;float: right;padding-right: 7px;font-size: 17px;">STARTING AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency').$featuredPackag['package_bronze']->price }}</span></h5>

                            <aside data-url="{{ route('package.favourite') }}"
                                   @if(\Illuminate\Support\Facades\Auth::user()->check())
                                   data-coll-id="{{ $featuredPackag->id }}">
                                <a style="padding-left: 8px;" id="btn-favourite-submit"
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
                                @endif
                                @if(!empty($gig['show_rating']))
                                <i class="fa fa-star star1" aria-hidden="true"
                                   style=" padding-left: 8px;color: #ffc100;position: relative;top: 16px;float: left;"><span>{{ $gig['show_rating'] }}<span
                                                style="color: grey;padding-left: 5px"></span></span></i>
                                @endif

                            </aside>



                        {{--<i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>--}}
                        {{--<h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">ONLY AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;"></span></h5>--}}
                    </div>
                </div>

            </div>
        @endforeach


    </div>

</section>
@include('includes.footer')

<script>
    $('#custom_offer').click(function () {

        $(".gig-style").toggle();
    });
    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId    = $selectedGig.data('coll-id');
        var url      = $selectedGig.data('url');

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
        $('.gig-item-default').hover(function () {
            $(this).children('#sold').show();
        }, function () {
            $(this).children('#sold').hide();
        });
    });
</script>
