
@include('includes.header')

<section>
    <div class="col-md-12" style="margin-top: 200px;">
        <h1 style="text-align:center" class="dash-heading">{{ (isset($_GET['search'])) ? 'Search result for "' . $_GET['search'] . '"' : (isset($gigType) ? $gigType->name : (isset($gigtype_subCat) ? $gigtype_subCat->name : '')) }} <? @if((isset($gigtype_subCat)))?> / {{ $gigtype_subCat->name  }} @endif</h1>


        <br>

        <br>


        @if(!empty($gigs))
            @foreach($gigs as $gig)
                <div class="col-md-3" style="padding-top: 20px;">

                    <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                        <a href="{{ url() }}/favors/{{ $gig['gigType']->slug }}/{{ $gig->slug }}?funnel={{ $gig->uuid }}">
                            <img src="{{ $thumbs[$gig->id] }}" alt="{{ $gig->title }}" width="100%">
                            <div class="card-content">
                                <div class="" style="position: absolute;bottom: 0;display: block;z-index: 1;padding-left: 6.2rem;padding-bottom: 4.1rem;margin: 105px !important;">
                                    <button type="button" class="btn btn-sm m-btn--pill  btn-brand" style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px; padding-top: 0px;">
                                        Top rated
                                    </button>
                                </div>
                                <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">{{ str_limit($gig->title, 50, '...') }}</h5>
                                <hr>
                                @if(\Illuminate\Support\Facades\Auth::user()->check())
                                    <aside   style="height:0px;" data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $gig->id }}">
                                        <a style="padding-left:8px;" id="btn-favourite-submit" href="javascript:void(0);"
                                           class="gig-favourite-heart-icn">
                                                         <span class="favorite-span">
                                                                         @if($gig['my_fav'])
                                                                 <i class="fa fa-heart"></i>
                                                             @else
                                                                 <i class="fa fa-heart-o"></i>
                                                             @endif
                                                                     </span>

                                        </a>
                                        <i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>


                                    </aside>
                                @endif
                                <h5 style="display: inline-block;float: right;padding-right: 7px;font-size:17px;">ONLY AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $gig->price }}</span></h5>
                                {{--<i class="fa fa-star" aria-hidden="true" style=" padding-left:8px;color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>--}}
                                {{--<h5 style="display: inline-block;float: right;padding-right: 7px;font-size:17px;">ONLY AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">{{ config('app.currency') . $gig->price }}</span></h5>--}}



                            </div>
                        </a>
                    </div>

                </div>


            @endforeach
        @endif
    </div>


    {{--<div class="col-md-12" style="margin-top: 200px;">--}}
        {{--<h1 style="font-size: 20px;text-align: center;" class="dash-heading">Packages</h1>--}}
        {{--<hr style="border-bottom: 2px solid;width: 150px;">--}}
        {{--@foreach($packages as $featuredPackag)--}}


            {{--<div class="col-md-3" style="padding-top: 20px;">--}}


                {{--<div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">--}}
                    {{--<a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"--}}
                       {{--class="gig-link-main" itemprop="url">--}}
                        {{--@if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')--}}
                            {{--<img src="{{ $featuredPackag['thumbnail'] }}"--}}
                                 {{--alt="{{ $featuredPackag->title }}"width="100%"></span>--}}
                        {{--@endif--}}
                    {{--</a>--}}
                    {{--<div class="card-content">--}}
                        {{--<div class="m-widget19__title m--font-light" style="position: absolute;bottom: 0;display: block;z-index: 1;padding-left: 6.2rem;padding-bottom: 4.1rem;margin: 105px !important;">--}}
                            {{--<button type="button" class="btn btn-sm m-btn--pill  btn-brand" style="padding-left: 4px;padding-right: 2px;padding-bottom: 0px; padding-top: 0px;">--}}
                                {{--Top rated--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">Graphics & design</h5>--}}
                        {{--<i class="fa fa-heart" aria-hidden="true" style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>--}}
                        {{--<h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">ONLY AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">$5</span></h5>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--@endforeach--}}



    {{--</div>--}}

</section>
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
