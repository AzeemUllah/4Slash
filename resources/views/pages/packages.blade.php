@include('includes.header')
<!-- content -->





<div class="container-fluid">


    <div id="jssor_1" style="top:69px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:980px;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{asset('assets/img/spin.svg')}}" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
            @foreach($package_images as $package_image)
                @if(file_exists(public_path('/files/gigs/images').'/'.$package_image->image))
                    <div>
                        <img data-u="image" src="{{ url('files/gigs/images') . '/' . $package_image->image }}" />
                        <div data-u="thumb">
                            <img data-u="thumb" class="i" src="{{ url('files/gigs/images') . '/' . $package_image->image }}" />
                            <!--<span class="ti">Title</span><br />-->
                            <!--<span class="d">Slide Description</span>-->
                        </div>
                    </div>
                @endif
            @endforeach
            <div>
                @foreach($package_images as $package_image)
                    @if(file_exists(public_path('/files/gigs/images').'/'.$package_image->image))
                        <img style="display: inline-block; width: 100%;"
                             src="{{ url('files/gigs/images') . '/' . $package_image->image }}">
                        <div data-u="thumb">
                            <img data-u="thumb" class="i" src="{{ url('files/gigs/images') . '/' . $package_image->image }}" />
                            {{--<span class="ti">Title</span><br />--}}
                            {{--<span class="d">Slide Description</span>--}}
                        </div>
                    @endif
                @endforeach
            </div>


        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort121" style="position:absolute;left:0px;top:0px;width:115px;height:380px;overflow:hidden;cursor:default;" data-autocenter="2" data-scale-left="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:165px;height:68px;">
                    <div data-u="thumbnailtemplate" class="t"></div>
                </div>
            </div>
        </div>


    </div>
    <!--slider end-->


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6" style="top: 40px;">
        <!--Begin::Main Portlet-->

        {{--<div class="m-widget4__item" style="width: 100%;">--}}
        {{--<h2 style="font-size: 25px; display: inline-block;">{{$package->title }}</h2>--}}
        {{--<h1 class="s-head"--}}
        {{--style="font-size: 25px;display: inline-block;float: initial;">--}}
        {{--<span class="fa fa-clock-o" style="font-size: 25px;padding-right: 6px; margin-left: 25px;"></span>Delivery--}}
        {{--in {{$package->delivery_days }} days</h1>--}}


        {{--<i class="fa fa-star" aria-hidden="true" style="color: #ffc100;display: inline-block;margin-left: 12px;"><span>4.9<span--}}
        {{--style="color: grey;padding-left: 5px;">(1k)</span></span></i>--}}




        {{--</div>--}}
        <div class="col-lg-8">
            <div class="col-lg-12">
                <div class="m-portlet m-portlet--full-height m-portlet--fit">
                    <div class="m-portlet__head">
                        <div class="col-lg-4" style="padding: 0px;">
                            <h5 style="font-size: 25px;margin-top: 30px;"> Package Information</h5>
                        </div>
                        <div class="col-lg-4" style="padding: 0px;margin-top: 33px;">
                            @if(\Illuminate\Support\Facades\Auth::user()->check())
                                <aside data-url="{{ route('package.favourite') }}" data-coll-id="{{ $package->id }}" style="text-align: center; padding-left: 45px;">
                                    <a id="btn-favourite-submit" href="javascript:void(0);" class="gig-favourite-heart-icn btn btn-default right-btn favt_btn">
                                                                        <span class="favorite-span">
                                                                            @if(!empty($my_fav))
                                                                                <i class="fa fa-heart"></i>
                                                                                <span> Favorite</span>
                                                                            @else
                                                                                <i class="fa fa-heart-o"></i>
                                                                                <span> Favorite</span>
                                                                            @endif
                                                                        </span>

                                    </a>
                                </aside>
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

                        <div class="m-widget4__item" style="width: 100%;">
                            <h2 style="font-size: 25px; display: inline-block;">{{$package->title }}</h2>
                            <h1 class="s-head"
                            style="font-size: 25px;display: inline-block;float: initial;">
                            {{--<span class="fa fa-clock-o" style="font-size: 25px;padding-right: 6px;"></span>Delivery--}}
                            {{--in {{ $package_bronze->delivery_days }} days</h1>--}}


                            <i class="fa fa-star" aria-hidden="true" style="color: #ffc100;display: inline-block;margin-left: 40px;"><span>0<span
                                            style="color: grey;padding-left: 5px"></span></span></i>





                        </div>



                        <!--end::Widget 5-->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 get_package_details" style="cursor: pointer;" data-url="{{ route('get.single.package.details') }}" data-id="{{ $package_bronze->id }}" data-package-type="bronze">
                <!--begin::Portlet-->


                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption" style="width: 50%">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Bronze

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-caption" style="width: 50%;">
                            <div class="m-portlet__head-title" style="width: 100%;">
                                <h4 class="m-portlet__head-text" style="text-align: right; font-size: inherit;">
                                    Delivery in {{ $package_bronze->delivery_days }} Days
                                </h4>
                            </div>
                        </div>

                        <div class="m-portlet__head-caption">
                            {{--<div class="m-widget4__item" style="width: 100%;">--}}
                            {{--<h2 style="font-size: 25px; display: inline-block;">{{$package->title }}</h2>--}}
                            {{--<h1 class="s-head"--}}
                            {{--style="font-size: 25px;display: inline-block;float: initial;">--}}
                            {{--<span class="fa fa-clock-o" style="font-size: 25px;padding-right: 6px;"></span>Delivery--}}
                            {{--in {{$package->delivery_days }} days</h1>--}}


                            {{--<i class="fa fa-star" aria-hidden="true" style="color: #ffc100;display: inline-block;"><span>4.9<span--}}
                            {{--style="color: grey;padding-left: 5px">(1k)</span></span></i>--}}




                            {{--</div>--}}
                            {{--<div class="m-portlet__head-title">--}}
                            {{--<h3 class="m-portlet__head-text" style="font-size: 25px;display: inline-block;">--}}
                            {{--{{$package->title }}--}}
                            {{--<h1 class="s-head"--}}
                            {{--style="font-size: 25px;display: inline-block;float: initial;">--}}
                            {{--<span class="fa fa-clock-o" style="font-size: 25px;padding-right: 6px;"></span>Delivery--}}
                            {{--in {{ $package->delivery_days }} days</h1>--}}


                            {{--</h3>--}}
                            {{--</div>--}}
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
                    <div class="m-portlet__body" style="font-weight: 600;">
                        <p>{{ $package_bronze->package_name }}</p>
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                            <?php if (!empty($package_bronze->desc)) { ?>
                                    <?php
                                $doc = new DOMDocument();
                                $doc->loadHTML($package_bronze->desc);
                                echo $doc->saveHTML();
                                ?>
                                    <?php } ?>
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
                                <canvas id="m_chart_latest_updates"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    We Need
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">

                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body" style="font-weight: 600;">
                        <!--begin::Widget5-->
                        <div class="m-widget4">
                            <?php if (!empty($package->pack_desc)) { ?>
                                    <?php
                                $doc = new DOMDocument();
                                $doc->loadHTML($package->pack_desc);
                                echo $doc->saveHTML();
                                ?>
                                    <?php } ?>
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>


            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 get_package_details" style="cursor: pointer;" data-url="{{ route('get.single.package.details') }}" data-id="{{ $package_silver->id }}" data-package-type="silver">
                <!--begin:: Widgets/Inbound Bandwidth-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption" style="width: 50%">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Silver

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-caption" style="width: 50%;">
                            <div class="m-portlet__head-title" style="width: 100%;">
                                <h4 class="m-portlet__head-text" style="text-align: right; font-size: inherit;">
                                    Delivery in {{ $package_silver->delivery_days }} Days
                                </h4>
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
                    <div class="m-portlet__body" style="font-weight: 600;">
                        <p>{{ $package_silver->package_name }}</p>
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                            <?php if (!empty($package_silver->desc)) { ?>
                                    <?php
                                $doc = new DOMDocument();
                                $doc->loadHTML($package_silver->desc);
                                echo $doc->saveHTML();
                                ?>
                                    <?php } ?>
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
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 get_package_details" style="cursor: pointer;" data-url="{{ route('get.single.package.details') }}" data-id="{{ $package_gold->id }}" data-package-type="gold">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption" style="width: 50%">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Gold

                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-caption" style="width: 50%;">
                        <div class="m-portlet__head-title" style="width: 100%;">
                            <h4 class="m-portlet__head-text" style="text-align: right; font-size: inherit;">
                                Delivery in {{ $package_gold->delivery_days }} Days
                            </h4>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">


                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body" style="font-weight: 600;">
                    <p>{{ $package_gold->package_name }}</p>
                    <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                        <?php if (!empty($package_gold->desc)) { ?>
                                <?php
                            $doc = new DOMDocument();
                            $doc->loadHTML($package_gold->desc);
                            echo $doc->saveHTML();
                            ?>
                                <?php } ?>
                        <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
                            <canvas id="m_chart_latest_updates"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Top Products-->
        </div>
        </div>
        <div class="col-lg-4">
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
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
                <div class="m-portlet__body" style="font-weight: 600;">
                    <div class="m-widget4">
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                {{--<img src="{{asset('assets/app/media/img/client-logos/logo5.png')}}" alt="">--}}
                            </div>
                            <div class="m-widget4__info">

                                        <span class="m-widget4__title">
                                            <span class="m-widget4__title">
                                                <h3 class="package_name" style="color: #575962;font-weight: 600; text-align: inherit;">Bronze</h3>
														<span class="package_title">{{ $package_bronze->package_name }}</span>

													<span class="m-widget4__number m--font-brand gig_price package_price" style="position: absolute;bottom: 73%;right: 9%;">
														£{{ $package_bronze->price }}
													</span>



                                           </span>
                                        </span>
                                        <span class="package_desc">
                                             <?php if (!empty($package_bronze->desc)) { ?>
                                                <?php
                                                $doc = new DOMDocument();
                                                $doc->loadHTML($package_bronze->desc);
                                                echo $doc->saveHTML();
                                                ?>
                                            <?php } ?>
                                        </span>
                            </div>
                        </div>
                        {{--<span class="m-widget4__ext">--}}
                        {{--<span class="m-widget4__number m--font-brand gig_price">--}}
                        {{--{{ $package_silver->price }}£--}}
                        {{--</span>--}}
                        {{--</span>--}}
                    </div>
                    <div class="form-group m-form__group">
                        <div style="width: 80%; float: left;">
                            <label for="exampleInputPassword1">
                                Promo code
                            </label>
                            <input type="text" class="form-control m-input m-input--air"
                                   id="check_promo_field" placeholder="Enter Promo Code" style="width: 100% !important">
                            <input type="hidden" id="package_price_value" value="{{ $package_bronze->price }}">
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
                    <div class="m-widget4">
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
                                        <span class="m-widget4__number m--font-brand gig_price">
														£
                                        </span>
                                        <span class="m-widget4__number m--font-brand gig_price package_price1">
                                            {{ $package_bronze->price }}
                                        </span>
                                    </span>
                        </div>
                    </div>
                    <div class="twobtns" style="    text-align: -webkit-center;">
                        <form action="{{ route('order.package') }}" method="post">
                            <input type="hidden" name="package_id" value="{{ $package_bronze->id }}" id="package_id">
                            <input type="hidden" name="package_type" value="bronze" id="package_type">
                            <input type="hidden" name="promocode" value="" id="promocode_value_field">
                            <button type="submit" name="purchase_with_paypal" class="btn btn-primary" style="margin-top: 20px;margin-left: 35px;">
                                Purchase now
                            </button>
                            {{--<button type="submit" name="purchase_with_wallet" class="btn btn-primary" style="margin-top: 20px;">--}}
                            {{--Wallet--}}
                            {{--</button>--}}
                        </form>

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




    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6" style="padding: 0 50px;">
        <h1 style="font-size: 17px;text-align: center;margin-top: 50px;margin-top: 75px;">More packages in this category</h1>
        <hr style="border-bottom: 2px solid;width: 150px;">
        @foreach($categorypackages as $featuredPackag)
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">

                <div class="card" style="box-shadow: 0 1px 15px 1px rgba(113, 106, 202, .08);background-color: #fff;">
                    <a href="{{ route('site.single.package',['packageId' => $featuredPackag->id,'funnel' => uniqid(),'uuid' => rand(1,1000)]) }}"
                       class="gig-link-main" itemprop="url">
                        @if(!empty($featuredPackag['thumbnail']) AND $featuredPackag['thumbnail'] != '')
                            <img src="{{ $featuredPackag['thumbnail']}}" style="width: 100%"
                                 alt="{{ $featuredPackag->title }}"></span>
                        @endif
                    </a>
                    <div class="card-content">
                        <h5 style=" line-height: 1.3; color: black !important;text-align: center;font-size: 18px;padding-top: 15px;">T-shirts Design</h5>
                        <hr>

                            <aside  data-url="{{ route('package.favourite') }}"
                                    data-coll-id="{{$featuredPackag->id }}">
                                @if($user)
                                <a style="padding-left: 8px;position: relative;top: 24px;" id="btn-favourite-submit"
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

                                <i class="fa fa-star star1" aria-hidden="true"
                                   style=" padding-left: 8px;color: #ffc100;position: relative;top: 24px;"><span>0<span
                                                style="color: grey;padding-left: 5px"></span></span></i>


                            </aside>


                        {{--<i class="fa fa-heart" aria-hidden="true" style="padding-left: 10px; padding-right: 6px;padding-top: 9px; color: red;"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true" style="color: #ffc100;"><span>4.9<span style="color: grey;padding-left: 5px">(1k)</span></span></i>--}}
                        <h5 class="priceinfo2" style="display: inline-block;float: right;padding-right: 7px;font-size: 17px;">STARTING AT<span style="font-size: 17px;padding-left: 7px;color: cornflowerblue;">£5</span></h5>
                    </div>
                </div>

            </div>
        @endforeach



    </div>

</div>



<!--packet start-->






@include('includes.footer')

{{--<script>--}}
    {{--$('#custom_offer').click(function(){--}}

        {{--$(".gig-style").toggle();--}}
    {{--});--}}
    {{--$('.gig-favourite-heart-icn').click(function(e) {--}}

        {{--e.preventDefault();--}}
        {{--$selectedGig = $(this).parent();--}}

        {{--var gigId    = $selectedGig.data('coll-id');--}}
        {{--var url      = $selectedGig.data('url');--}}

        {{--// var className = $('span.favorite-span > i').attr('class');--}}

        {{--//  alert(className);--}}

        {{--if($(this).find('i').attr('class') == 'fa fa-heart'){--}}
            {{--var action = 'removeFavorite';--}}
            {{--$(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o" style=" margin-right: 3px;"></i></span>');--}}
        {{--}--}}
        {{--else{--}}
            {{--var action = 'addToFavorite';--}}
            {{--$(this).empty().html('<span class="favorite-span"><i class="fa fa-heart" style=" margin-right: 3px;"></i></span>');--}}
        {{--}--}}



        {{--$.ajax({--}}
            {{--url: url,--}}
            {{--method: 'POST',--}}
            {{--data: { 'gig-id': gigId, 'action': action },--}}
            {{--success: function(data) {--}}
                {{--console.log(data);--}}

            {{--}--}}
        {{--});--}}
    {{--});--}}


{{--</script>--}}
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

