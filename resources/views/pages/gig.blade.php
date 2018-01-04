@include('includes.header')
<section>



<!--slider end-->
    <div id="jssor_1"
         style="position: relative;left: 0px;width: 980px;height: 380px;overflow: hidden;visibility: visible;top: -8px;">

        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin"
             style="position:absolute;top:0px;left:0px;width:980px;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;"
                 src="{{asset('assets/img/spin.svg')}}"/>
        </div>
        <div data-u="slides"
             style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
            @foreach($gig_images as $gig_image)
                @if(file_exists(public_path('/files/gigs/images').'/'.$gig_image->image))
                    <div>
                        <img data-u="image" src="{{ url('files/gigs/images') . '/' . $gig_image->image }}"/>
                        <div data-u="thumb">
                            <img data-u="thumb" class="i"
                                 src="{{ url('files/gigs/images') . '/' . $gig_image->image }}"/>
                            <!--<span class="ti">Title</span><br />-->
                            <!--<span class="d">Slide Description</span>-->
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort121"
             style="position:absolute;left:0px;top:0px;width:120px;height:380px;overflow:hidden;cursor:default;"
             data-autocenter="2" data-scale-left="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:160px;height:68px;">
                    <div data-u="thumbnailtemplate" class="t"></div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-lg-12">
        <form action="{{ route('payment') }}" method="post">
            <div class="row">
            <div class="col-lg-8">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit" style="margin-top: 25px;">
                    <div class="m-portlet__head">
                        <div class="col-lg-4" style="padding: 0px;">
                            <h5 style="font-size: 25px;margin-top: 30px;">Product Information</h5>
                        </div>
                        <div class="col-lg-4" style="padding: 0px;margin-top: 33px;">
                            @if(\Illuminate\Support\Facades\Auth::user()->check())
                                {{--<button  id="btn-favourite" type="button" class="btn btn-default right-btn favt_btn" data-toggle="tooltip" data-placement="right">--}}

                                <aside data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $gig->id }}" style="text-align: center;    padding-left: 45px;">
                                    <a id="btn-favourite-submit" href="javascript:void(0);"
                                       class="gig-favourite-heart-icn btn btn-default right-btn favt_btn">
                                                                        <span class="favorite-span">
                                                                            @if($my_fav)
                                                                                <i class="fa fa-heart"></i>
                                                                                <span> Favorite</span>
                                                                            @else
                                                                                <i class="fa fa-heart-o"></i>
                                                                                <span> Favorite</span>
                                                                            @endif
                                                                        </span>

                                    </a>
                                </aside>
                                {{--</button>--}}
                            @endif
                        </div>
                        <div class="col-lg-4" style="padding: 0px;margin-top: 22px;">
                            <div class="item1" style="display: inline-block;padding: 17px;background: #3b5998;border-radius: 30px;float: right;">
                                <a href="https://www.facebook.com/4Slash">
                            <i class="socicon-facebook"  style="color: white;font-size: 20px;"></i></a>
                            </div>
                            <div class="item1" style="display: inline-block;padding: 17px;background: red;border-radius: 30px;float: right;">
                                <a href="https://plus.google.com/b/101437234623967273816/101437234623967273816">
                                    <i class="socicon-google" style="color: white;font-size: 20px;"></i></a>
                            </div>
                            <div class="item1" style="display: inline-block;padding: 17px;background: #1da1f2;border-radius: 30px;float: right;">
                                <a href="https://twitter.com/4_slash">
                                <i class="socicon-twitter" style="color: white;font-size: 20px;"></i></a>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget5-->
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 480px">

                            <div class="m-widget4__item" style="width: 100%;">
                                <h2 style="font-size: 25px; display: inline-block;">{{$gig->title }}</h2>
                                <h1 class="s-head"
                                    style="font-size: 25px;display: inline-block;float: initial;margin-left: 60px;">
                                    <span class="fa fa-clock-o" style="font-size: 25px;padding-right: 6px;"></span>Delivery
                                    in {{ $gig->delivery_days }} days</h1>


                                <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;display: inline-block;margin-left: 40px;"><span>{{$rating_gig_show}}<span
                                style="color: grey;padding-left: 5px"></span></span></i>


                                <h2 style="text-align: center;font-size: 25px;font-weight: bold;display: inline-block;float: right">
                                    {{ config('app.currency').$amount = number_format($gig->price) }} </h2>

                            </div>
                            <div class="m-portlet__body" style="padding-left: 0px;">
                                <!--begin::Section-->
                                <div class="m-section">
                                    {{--<h3 class="m-section__heading" style="text-align: left;">What you will get</h3>--}}
                                    <span class="m-section__sub">
						You receive:
					{{--</span>--}}
                                    {{--<div class="m-section__content">--}}

                                        {{--<div class="m-demo__preview">--}}
                                            {{--<p><span>Office Stationary</span></p>--}}
                                            {{--<p><span class="m--font-bold">Preview files</span></p>--}}
                                            {{--<p><span class="m--font-bolder">High quality layout & design</span></p>--}}
                                            {{--<p><span class="m--font-boldest">Favicon Design</span></p>--}}
                                            {{--<p><span class="m--font-transform-u">A4 folder</span></p>--}}
                                            {{--<p><span class="m--font-transform-u">Envelope design</span></p>--}}
                                            {{--<p><span class="m--font-transform-u">Business Card Design</span></p>--}}
                                            {{--<p><span class="m--font-transform-u">Letterhead design</span></p>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}

                                    <?php if(!empty($gig->discription)){ ?>
                                    <?php
                                        $doc = new DOMDocument();
                                        $doc->loadHTML($gig->discription);
                                        echo $doc->saveHTML();
                                        ?>
                                <?php } ?>


                                </div>
                                <!--end::Section-->
                            </div>
                            {{--<div class="m-widget4__item">--}}
                            {{--<div class="m-widget4__img m-widget4__img--logo">--}}
                            {{--<img src="{{asset('assets/app/media/img/client-logos/logo3.png')}}" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="m-widget4__info">--}}
                            {{--<span class="m-widget4__title">--}}
                            {{--Project description--}}
                            {{--</span>--}}
                            {{--<br>--}}
                            {{--<span class="m-widget4__sub">--}}
                            {{--A Programming Language--}}
                            {{--<textarea class="form-control m-input" id="exampleTextarea" rows="3"></textarea>--}}
                            {{--</span><br>--}}
                            {{--<button type="button" class="btn m-btn--pill    btn-secondary btn-sm">--}}
                            {{--Order Now--}}
                            {{--</button>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--<div class="m-widget4__item">--}}
                            {{--<div class="m-widget4__img m-widget4__img--logo">--}}
                            {{--<img src="{{asset('assets/app/media/img/client-logos/logo1.png')}}"alt="">--}}
                            {{--</div>--}}
                            {{--<div class="m-widget4__info">--}}
                            {{--<span class="m-widget4__title">--}}
                            {{--Delivery in 10 days--}}
                            {{--</span>--}}
                            {{--<br>--}}
                            {{--<span class="m-widget4__sub">--}}
                            {{--A Let's Fly Fast Again Language--}}
                            {{--</span>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--<div class="m-widget4__item">--}}
                            {{--<div class="m-widget4__img m-widget4__img--logo">--}}
                            {{--<img src="{{asset('assets/app/media/img/client-logos/logo4.png')}}" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="m-widget4__info">--}}
                            {{--<span class="m-widget4__title">--}}
                            {{--Providers: Marketplace--}}
                            {{--</span>--}}
                            {{--<br>--}}
                            {{--<span class="m-widget4__sub">--}}
                            {{--Good Coffee & Snacks--}}
                            {{--</span>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Add Extension
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">

                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            @foreach($gig_addons as $gig_addon)
                            <div class="m-widget4__item" style="width: 100%;">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                                </div>
                                <div class="m-widget4__info" style="width: 50%;">
                                    <label class="m-checkbox box1">
                                        <input class="set_rows_to_cart" type="checkbox" value="{{ $gig_addon->id }}" name="addon[id][]"/>

                                        <span></span>
                                    </label>
                                    <span class="m-widget4__title">
                                                        {{ $gig_addon->addon }}
                                                    </span>
                                    <br>
                                    {{--<form id='myform' method='POST' action='#'>--}}

                                    {{--</form>--}}

                                </div>
                                <div class="addon_row" style="display: inline-block;">
                                    <input type="button" value="-" class="qtyminus" field="quantity" style="padding: 0px; width: 30px;font-size: 14px;"/>
                                    <input type="text" name="addon[quantity][]"  value="1" class="qty" disabled style="padding: 0px; width: 30px;    font-size: 16px;
    margin-top: 13px;"/>
                                    <input type='hidden' name='actual_price' class='actual_price' value='{{$gig_addon->amount}}'>
                                    <input type='button' value='+' class='qtyplus' field='quantity' style="padding: 0px;width: 30px;font-size: 14px;"/>
                                </div>
                                <span class="m-widget4__ext" style="display: inline-block;float: right;">
                                    <span>{{config('app.currency')}}</span>
                                    <span class="m-widget4__number m--font-brand priceplus">
                                            {{$gig_addon->amount}}
                                    </span>
                                </span>


                            </div>
                            @endforeach
                            {{--<div class="m-widget4__item" style="width: 100%;">--}}
                                {{--<div class="m-widget4__img m-widget4__img--logo">--}}
                                    {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                                {{--</div>--}}
                                {{--<div class="m-widget4__info" style="width: 50%;">--}}
                                    {{--<label class="m-checkbox">--}}
                                        {{--<input id="closeButton" type="checkbox" value="checked"/>--}}

                                        {{--<span></span>--}}
                                    {{--</label>--}}
                                    {{--<span class="m-widget4__title">--}}
														{{--Corporate logo (+1 business day)--}}
													{{--</span>--}}
                                    {{--<br>--}}
                                    {{--<form id='myform' method='POST' action='#'>--}}

                                    {{--</form>--}}

                                {{--</div>--}}
                                {{--<form id='myform1' method='POST' action='#' style="    display: inline-block;">--}}
                                {{--<div style="display: inline-block;">--}}
                                    {{--<input type='button' value='-'   class='qtyminus1' field='quantity1'/>--}}
                                    {{--<input type='text' name='quantity1' value='0'  class='qty'/>--}}
                                    {{--<input type='button' value='+'  class='qtyplus1' field='quantity1'/>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--<span class="m-widget4__ext" style="display: inline-block;float: right;">--}}
													{{--<span class="m-widget4__number m--font-brand">--}}
														{{--+$2500--}}
													{{--</span>--}}
												{{--</span>--}}
                            {{--</div>--}}
                            {{--<div class="m-widget4__item" style="width: 100%;">--}}
                                {{--<div class="m-widget4__img m-widget4__img--logo">--}}
                                    {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                                {{--</div>--}}
                                {{--<div class="m-widget4__info" style="width: 50%;">--}}
                                    {{--<label class="m-checkbox">--}}
                                        {{--<input id="closeButton" type="checkbox" value="checked"/>--}}

                                        {{--<span></span>--}}
                                    {{--</label>--}}
                                    {{--<span class="m-widget4__title">--}}
														{{--Corporate logo (+1 business day)--}}
													{{--</span>--}}
                                    {{--<br>--}}
                                    {{--<form id='myform' method='POST' action='#'>--}}

                                    {{--</form>--}}

                                {{--</div>--}}
                                {{--<form id='myform1' method='POST' action='#' style="    display: inline-block;">--}}
                                {{--<div style="display: inline-block;">--}}
                                    {{--<input type='button' value='-' class='qtyminus2' field='quantity2'/>--}}
                                    {{--<input type='text' name='quantity2' value='0' class='qty'/>--}}
                                    {{--<input type='button' value='+' class='qtyplus2' field='quantity2'/>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--<span class="m-widget4__ext" style="display: inline-block;float: right;">--}}
													{{--<span class="m-widget4__number m--font-brand">--}}
														{{--+$2500--}}
													{{--</span>--}}
												{{--</span>--}}
                            {{--</div>--}}
                            {{--<div class="m-widget4__item" style="width: 100%;">--}}
                                {{--<div class="m-widget4__img m-widget4__img--logo">--}}
                                    {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                                {{--</div>--}}
                                {{--<div class="m-widget4__info" style="width: 50%;">--}}
                                    {{--<label class="m-checkbox">--}}
                                        {{--<input id="closeButton" type="checkbox" value="checked"/>--}}

                                        {{--<span></span>--}}
                                    {{--</label>--}}
                                    {{--<span class="m-widget4__title">--}}
														{{--Corporate logo (+1 business day)--}}
													{{--</span>--}}
                                    {{--<br>--}}
                                    {{--<form id='myform' method='POST' action='#'>--}}

                                    {{--</form>--}}

                                {{--</div>--}}
                                {{--<form id='myform1' method='POST' action='#' style="display: inline-block;">--}}
                                {{--<div style="display: inline-block;">--}}
                                    {{--<input type='button' value='-' class='qtyminus4' field='quantity4'/>--}}
                                    {{--<input type='text' name='quantity4' value='0' class='qty'/>--}}
                                    {{--<input type='button' value='+' class='qtyplus4' field='quantity4'/>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--<span class="m-widget4__ext" style="display: inline-block;float: right;">--}}
													{{--<span class="m-widget4__number m--font-brand">--}}
														{{--+$2500--}}
													{{--</span>--}}
												{{--</span>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">

                                    <span class="m-section__sub" style="vertical-align: middle;font-size: 1.3rem;font-weight: 600;font-family: inherit;">
						We need:
					</span>
                        <div class="m-section__content">

                            <div class="m-demo__preview" style="font-weight: 600;">
                                <?php if(!empty($gig->discription2)){ ?>
                                <?php
                                    $doc = new DOMDocument();
                                    $doc->loadHTML($gig->discription2);
                                    echo $doc->saveHTML();
                                    ?>
                                <?php } ?>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
            <div class="col-lg-4" style=" margin-top: 25px;">
                <!--begin:: Widgets/Top Products-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Summary
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">

                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            <div class="m-widget4__item" style="width: 100%;">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                                </div>
                                <div class="m-widget4__info">

                                    <span class="m-widget4__title">
														{{ $gig->title }}
													</span>
                                    <br>

                                </div>
                                <span class="m-widget4__ext">
                                    <span class="m-widget4__number m--font-brand" style="left: 48px;">
														{{ config('app.currency') }}
													</span>
													<span class="m-widget4__number m--font-brand gig_price" style="float: right;">
														{{ $amount = number_format($gig->price) }}
													</span>
												</span>
                            </div>
                            <div class="m-widget4__item addons_rows" style="width: 100%">
                                <div class="m-portlet__head portlet__head_toggle" style="padding: 0px;">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h4 class="m-portlet__head-text">
                                                Addons
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="m-portlet__head-tools">
                                        <ul class="m-portlet__nav">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <div style="width: 80%; float: left;">
                                    <label for="exampleInputPassword1">
                                        Promo code
                                    </label>
                                    <input type="text" class="form-control m-input m-input--air"
                                           id="check_promo_field" placeholder="Enter Promo Code" style="width: 100% !important">
                                </div>
                                <div id="promocode_html" style="width: 20%; float: right; position: relative; top: 35px; left: 10px;">
                                    <label for="exampleInputPassword1">
                                    </label>
                                    <button type="button" id="apply_promocode" class="btn btn-primary" style="display: none;">Apply</button>
                                </div>
                                <p class="text-left error" style="color:red; padding-top: 20px; font-size: 12px; display: inline-block;"></p>
                                <table class="checkout-table" style="width: 100%; margin-top: 30px;">
                                    <tbody>
                                        <tr id="promocode_show">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="m-widget4__item" style="width: 100%">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                                </div>
                                <div class="m-widget4__info">

                                    <span class="m-widget4__title">
														Total price
													</span>
                                    <br>

                                </div>
                                <span class="m-widget4__ext">
                                    <span class="m-widget4__number m--font-brand" style="left: 48px;">
														{{ config('app.currency') }}
													</span>
													<span class="m-widget4__number m--font-brand price1" style="float: right;">
														{{number_format($gig->price)}}
													</span>
												</span>
                            </div>
                            <div class="twobtns" style="    text-align: -webkit-center;">
                                <input type="hidden" name="gig_id" value="{{ $gig->id }}">
                                <input type="hidden" name="promocode" value="" id="promocode_value_field">
                                <button type="submit" name="purchase_with_paypal" class="btn btn-primary" style="margin-top: 20px;margin-left: 35px;">
                                    Purchase now
                                </button>
                                {{--<button type="submit" name="purchase_with_wallet" class="btn btn-primary" style="margin-top: 20px;">--}}
                                    {{--Wallet--}}
                                {{--</button>--}}

                            </div>

                            <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Payment method
                                            </h5>

                                        </div>
                                        <div class="modal-body">
                                            <div class="m-form__group form-group">

                                                <div class="m-radio-list">
                                                    <label class="m-radio m-radio--success">
                                                        <input type="radio" name="example_2" value="1">
                                                        Paypal
                                                        <span></span>
                                                    </label>
                                                    <label class="m-radio m-radio--brand">
                                                        <input type="radio" name="example_2" value="2">
                                                        Credit card
                                                        <span></span>
                                                    </label>
                                                    <label class="m-radio m-radio--primary">
                                                        <input type="radio" name="example_2" value="3">
                                                        Wallet
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-primary">
                                                Select
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>


            </div>
        </div>
        </form>
    </div>


    <!--packet start-->

{{--<h1 style="font-size: 17px;text-align: center;">More packages in this category</h1>--}}
{{--<hr style="border-bottom: 2px solid;width: 150px;">--}}
{{--@foreach($categorygigs as $featuredGig)--}}
{{--<div>--}}
{{--<div class="col-md-3">--}}

{{--<div class="card"--}}
{{--style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">--}}
{{--<img src="" style="width: 100%;">--}}
{{--<div class="card-content">--}}
{{--<h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">--}}
{{--T-shirts Design</h5>--}}
{{--<hr>--}}
{{--<i class="fa fa-heart" aria-hidden="true"--}}
{{--style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>--}}
{{--<i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span--}}
{{--style="color: grey;padding-left: 5px">(1k)</span></span></i>--}}
{{--<h5 style="display: inline-block;float: right;padding-right: 7px;font-size: 12px;">STARTING--}}
{{--AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">$5</span></h5>--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--@endforeach--}}



<!--packet end-->
    <!--Categories end-->
</section>
@include('includes.footer')
<script>
    $('.carousel').carousel({
        interval: 3000
    })
</script>



<script>

    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId = $selectedGig.data('coll-id');
        var url = $selectedGig.data('url');

        if ($(this).find('i').attr('class') == 'fa fa-heart') {
            var action = 'removeFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o" style=" margin-right: 3px;"></i><span>Favorite</span></span>');
        }
        else {
            var action = 'addToFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart" style=" margin-right: 3px;"></i><span>Favorite</span></span>');
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






