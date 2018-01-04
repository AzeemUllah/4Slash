@include('includes.header')
<style>
    .cnerr-footer-background-color{
        position: relative;
    }
    @media(max-width: 450px){
        .dash-main-content{
            height: initial !important;
        }
    }
</style>
<div class="dash-main-content" style="height: 100vh;">  
    <!-- content -->
    <div style="background-color: #f1f2f2;">
        <div class="container main-body">
            @if(\Illuminate\Support\Facades\Session::has('successMessage'))
                <div class="alert alert-success"
                     role="alert" style="margin-top: 120px; text-align: center;">{{ \Illuminate\Support\Facades\Session::get('successMessage') }}</div>
            @endif

            @if(\Illuminate\Support\Facades\Session::has('errorMessage'))
                <div class="alert alert-danger"
                     role="alert">{{ \Illuminate\Support\Facades\Session::get('errorMessage') }}</div>
            @endif
                <div class="row">
                    <div class="col-md-7 col-xs-12 extra-padd">
                        <h1 class="first-head">
                            <span class="pull-left">{{$package->title }}</span>
                            @if(!empty($packagetype))
                            <span class="pull-right"><a href="{{ route('gigscategory.gigs',['categoryslug'=> $packagetype->slug]) }}">Category >> {{ $packagetype->name }}</a></span>
                            @else
                            <span class="pull-right"><a href="{{ route('gigscategory.gigs',['categoryslug'=> $package_cat_type->slug]) }}">Category >> {{ $package_cat_type->name }}</a></span>
                            @endif
                        </h1>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="slider" style="width: 100%;">
                        <div class="single-item" style="margin-bottom:0px;">
                            @foreach($package_images as $package_image)
                                @if(file_exists(public_path('/files/gigs/images').'/'.$package_image->image))
                                    <div class="slide">
                                        <div class="back">
                                            <img style="display: inline-block; width: 100%;"
                                                 src="{{ url('files/gigs/images') . '/' . $package_image->image }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="multiple-items" style="background-color:rgb(227, 227, 227);">
                            @foreach($package_images as $package_image)
                                @if(file_exists(public_path('/files/gigs/images').'/'.$package_image->image))
                                    <div class="slide custom-border-color-for-images" style="margin-right: 5px">
                                        <img src="{{ url('files/gigs/images') . '/' . $package_image->image }}"
                                             style="height:60px; border:2px solid #2f8dd7;width: 100%;">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row thumbnail-row">
                        <div class="inner-padd col-sm-4 col-xs-12">
                            <a style="display: inline-block; width: 100%;"  class="accordion-toggle bronze-click" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <div class="col-xs-12 thumbnail thumbnail-padd toggle_class bronze-box ">
                            <span class="custom-color-for-img-tag"><img src="{{ url('/').'/img/bronze.png' }}" alt="bronze" width="20px">
                            Bronze</span>
                                <br><br>
                                <p class="pack-head custom-color-for-pakage-details-ptag">{{ $package_bronze->package_name }}</p>
                                    <div class="zero-margg-bott min-height text-adjust">
                                        {{--{{ $package_bronze->desc }}--}}
                                        <div class="packdisscription_bronze packdescbronze_act">
                                            <?php if (!empty($package_bronze->desc)) { ?>
                                <?php
                                                $doc = new DOMDocument();
                                                $doc->loadHTML($package_bronze->desc);
                                                echo $doc->saveHTML();
                                                ?>
                                <?php } ?>
                                        </div>
                                    </div>
                                <hr>
                                <p class="zero-margg-bott min-adjust-height custom-color-for-pakage-details-ptag">
                                    <i class="fa fa-clock-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                    In {{ $package_bronze->delivery_days }} Tage
                                </p>
                                <p class="zero-margg-bott min-adjust-height custom-color-for-pakage-details-ptag">
                                    @if($package_bronze->source_file > 0)
                                        <i class="fa fa-check-circle-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                        source file

                                    @else
                                        <i class="fa fa-check-circle-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                        -
                                    @endif
                                </p>
                                <p class="zero-margg-imp min-adjust-height custom-color-for-pakage-details-ptag">
                                    <i class="fa fa-pencil fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                    @if($package_bronze->revisions > 0)
                                        {{ $package_bronze->revisions }}
                                        Amendments
                                    @else
                                        No changes

                                    @endif
                                </p>



                                <span class="col-xs-12 text-center package-price a-button a-button-override-for-gig btn-get-this-gig">
                                <p>{{ $package_bronze->price.config('app.currency') }}</p>
                                </span>



                            </div>
                            </a>
                        </div>
                        <div class="inner-padd col-sm-4 col-xs-12">
                            <a style="display: inline-block; width: 100%;"  class="accordion-toggle silver-click" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <div class="col-xs-12 thumbnail thumbnail-padd toggle_class_silver silver_toggle">
                            <span class="custom-color-for-img-tag"><img src="{{ url('/').'/img/silver.png' }}" alt="bronze" width="20px">
                            Silber</span>
                                <br><br>
                                <p class="pack-head custom-color-for-pakage-details-ptag">{{ $package_silver->package_name }}</p>
                                <div class="zero-margg-bott min-height text-adjust">
                                    <div class="packdisscription_silver packdescsilver">
                                    {{--{{ $package_silver->desc }}--}}
                                    <?php if (!empty($package_silver->desc)) { ?>
                                <?php
                                        $doc = new DOMDocument();
                                        $doc->loadHTML($package_silver->desc);
                                        echo $doc->saveHTML();
                                        ?>
                                <?php } ?>
                                    </div>
                                </div>
                                <hr>
                                <p class="zero-margg-bott min-adjust-height custom-color-for-pakage-details-ptag">
                                    <i class="fa fa-clock-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                    In {{ $package_silver->delivery_days }} Tage
                                </p>
                                <p class="zero-margg-bott min-adjust-height custom-color-for-pakage-details-ptag">
                                    @if($package_silver->source_file > 0)
                                        <i class="fa fa-check-circle-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                        Quelldatei
                                    @else
                                        <i class="fa fa-check-circle-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                        -
                                    @endif
                                </p>
                                <p class="zero-margg-imp min-adjust-height custom-color-for-pakage-details-ptag">
                                    <i class="fa fa-pencil fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                    @if($package_silver->revisions > 0)
                                        {{ $package_silver->revisions }}
                                        Änderungen
                                    @else
                                        Keine Änderungen
                                    @endif
                                </p>
                                <span class="col-xs-12 text-center package-price a-button a-button-override-for-gig btn-get-this-gig">
                                <p>{{ $package_silver->price.config('app.currency') }}</p>
                            </span>
                            </div>
                            </a>
                        </div>
                        <div class="inner-padd col-sm-4 col-xs-12">
                            <a style="display: inline-block; width: 100%;" class="accordion-toggle gold-click" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <div class="col-xs-12 thumbnail thumbnail-padd toggle_class_gold gold_toggle">
                            <span class="custom-color-for-img-tag"><img src="{{ url('/').'/img/gold.png' }}" alt="bronze" width="20px">
                            Gold</span>
                                <br><br>
                                <p class="pack-head custom-color-for-pakage-details-ptag">{{ $package_gold->package_name }}</p>
                                    {{--{{ $package_gold->desc }}--}}
                                    <div class="zero-margg-bott min-height text-adjust">
                                        <div class="packdisscription_gold packdescgold">
                                        {{--{{ $package_bronze->desc }}--}}
                                        <?php if (!empty($package_gold->desc)) { ?>
                                <?php
                                            $doc = new DOMDocument();
                                            $doc->loadHTML($package_gold->desc);
                                            echo $doc->saveHTML();
                                            ?>
                                <?php } ?>
                                        </div>
                                    </div>
                                <hr>
                                <p class="zero-margg-bott min-adjust-height custom-color-for-pakage-details-ptag">
                                    <i class="fa fa-clock-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                    In {{ $package_gold->delivery_days }} Tage
                                </p>
                                <p class="zero-margg-bott min-adjust-height custom-color-for-pakage-details-ptag">
                                    @if($package_gold->source_file > 0)
                                        <i class="fa fa-check-circle-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                        source file

                                    @else
                                        <i class="fa fa-check-circle-o fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                        -
                                    @endif
                                </p>
                                <p class="zero-margg-imp min-adjust-height custom-color-for-pakage-details-ptag">
                                    <i class="fa fa-pencil fa-custom-color" aria-hidden="true" style="color: #367fa9; margin-right: 3px;"></i>
                                    @if($package_gold->revisions > 0)
                                        {{ $package_gold->revisions }}
                                        Änderungen
                                    @else
                                        Keine Änderungen
                                    @endif
                                </p>
                                <span class="col-xs-12 text-center package-price a-button a-button-override-for-gig btn-get-this-gig">
                                <p>{{ $package_gold->price.config('app.currency') }}</p>
                            </span>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12  right-panel">

                    <div class="text-center order-basic-info" style="padding: 0px;">
                        <p class="f-head custom-color-for-ptag"><span>Order Information</span>
                            <span class="circle-the-span tooltipper custom-circle-span-prop" style="padding: 2px 7px; background: #fcfcfc;border-radius: 15px;box-shadow: 0 1px 3px #ccc;" data-toggle="popover" data-trigger="focus" data-placement="left"
                                  data-content="

As a customer, you have the possibility to submit additional order-relevant data (FTP data, information, details, etc.) by means of chat correspondence in your user account. You communicate directly with our sales team.">
                                    <i style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info fa-custom-color" role="button"></i>
                                </span>
                        </p>
                        <div class="accordion-2 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a style="display: inline-block; width: 100%;"  class="accordion-toggle bronze-click" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <span class="col-xs-3 text-left">
                                                <span class="pack_price custom-color-pack-price">{{ $package_bronze->price.config('app.currency') }}</span>
                                            </span>
                                            <span class="col-xs-7 text-center">
                                                <img src="{{ url('/').'/img/bronze.png' }}" alt="bronze" width="40px">
                                                <span class="span-label span-pack-label custom-color-override-for-span-pakages">Bronze</span>
                                            </span>
                                            {{--<span class="col-xs-2">
                                                <i class="fa fa-chevron-up black servicedrop" aria-hidden="true"></i>
                                                <i class="fa fa-chevron-down black servicedrop" style="display: none;" aria-hidden="true"></i>
                                            </span>--}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body text-center">
                                        <p class="text-color">Details it. Product box Bronze</p>


                                        <button data-target="#payment1" data-toggle="modal" type="button" class="custom-margin-top-for-pakage-btn a-button a-button-override-for-gig btn-get-this-gig">
                                            <span></span>Buy Now
                                        </button>


                                        <!--
                                            <a href="#" class="btn btn-pay-start" data-toggle="modal" data-target="#payment1">Buy now
                                            </a>
                                        -->


                                            <div class="row top-gap-new" style="padding-top:{{ (\Illuminate\Support\Facades\Auth::user()->check()) ? "" : "10px !important" }}"> 
                                                <div class="button col-md-12 col-sm-12 col-xs-12">
                                                    {{--<button  id="btn-favourite" type="button" class="btn btn-default right-btn favt_btn" data-toggle="tooltip" data-placement="right">--}}
                                                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                    <aside data-url="{{ route('gig.favourite') }}"
                                                           data-coll-id="{{ $package->id }}">
                                                        <a id="btn-favourite-submit" href="javascript:void(0);"
                                                           class="gig-favourite-heart-icn btn btn-default right-btn favt_btn">
                                                                    <span class="favorite-span">
                                                                        @if(!empty($my_fav))
                                                                            <i class="fa fa-heart"></i>
                                                                            <span>Favourite</span>
                                                                        @else
                                                                            <i class="fa fa-heart-o"></i>
                                                                            <span>Favourite</span>
                                                                        @endif
                                                                    </span>

                                                        </a>
                                                    </aside>
                                                    @endif
                                                    {{--</button>--}}
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a style="display: inline-block; width: 100%;"  class="accordion-toggle silver-click" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <span class="col-xs-3 text-left">
                                                <span class="pack_price custom-color-pack-price">{{ $package_silver->price.config('app.currency') }}</span>
                                            </span>
                                            <span class="col-xs-7 text-center">
                                                <img src="{{ url('/').'/img/silver.png' }}" alt="bronze" width="40px">
                                                <span class="span-label span-pack-label custom-color-override-for-span-pakages">Silber</span>
                                            </span>
                                            {{--<span class="col-xs-2">
                                                <i class="fa fa-chevron-up black servicedrop" style="display: none;" aria-hidden="true"></i>
                                                <i class="fa fa-chevron-down black servicedrop" aria-hidden="true"></i>
                                            </span>--}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body text-center">
                                        <p class="text-color">Details it. Product box Silber</p>


                                        <button data-target="#payment2" data-toggle="modal" type="button" class="custom-margin-top-for-pakage-btn a-button a-button-override-for-gig btn-get-this-gig">
                                            <span></span>Buy Now
                                        </button>



                                        <!--
                                            <a href="#" class="btn btn-pay-start" data-toggle="modal" data-target="#payment2">Buy now
                                            </a>
                                        -->
                                            <div class="row top-gap-new" style="padding-top:{{ (\Illuminate\Support\Facades\Auth::user()->check()) ? "" : "10px !important" }}">
                                                <div class="button col-md-12 col-sm-12 col-xs-12">
                                                    {{--<button  id="btn-favourite" type="button" class="btn btn-default right-btn favt_btn" data-toggle="tooltip" data-placement="right">--}}
                                                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                    <aside data-url="{{ route('gig.favourite') }}"
                                                           data-coll-id="{{ $package->id }}">
                                                        <a id="btn-favourite-submit" href="javascript:void(0);"
                                                           class="gig-favourite-heart-icn btn btn-default right-btn favt_btn">
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
                                                    {{--</button>--}}
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a style="display: inline-block; width: 100%;" class="accordion-toggle gold-click" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <span class="col-xs-3 text-left">
                                                <span class="pack_price custom-color-pack-price">{{ $package_gold->price.config('app.currency') }}</span>
                                            </span>
                                            <span class="col-xs-7 text-center">
                                                <img src="{{ url('/').'/img/gold.png' }}" alt="bronze" width="40px">
                                                <span class="span-label span-pack-label custom-color-override-for-span-pakages">Gold</span>
                                            </span>
                                            {{--<span class="col-xs-2">
                                                <i class="fa fa-chevron-up black servicedrop" style="display: none;" aria-hidden="true"></i>
                                                <i class="fa fa-chevron-down black servicedrop" aria-hidden="true"></i>
                                            </span>--}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body text-center">
                                        <p class="text-color">Details it. Product box Gold</p>



                                        <button data-target="#payment3" data-toggle="modal" type="button" class="custom-margin-top-for-pakage-btn a-button a-button-override-for-gig btn-get-this-gig">
                                            <span></span>Favorite
                                        </button>




                                        <!--
                                            <a href="#" class="btn btn-pay-start" data-toggle="modal" data-target="#payment3">Favorite</a>
                                        -->
                                            <div class="row top-gap-new" style="padding-top:{{ (\Illuminate\Support\Facades\Auth::user()->check()) ? "" : "10px !important" }}">
                                                <div class="button col-md-12 col-sm-12 col-xs-12">
                                                    {{--<button  id="btn-favourite" type="button" class="btn btn-default right-btn favt_btn" data-toggle="tooltip" data-placement="right">--}}
                                                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                                                    <aside data-url="{{ route('gig.favourite') }}"
                                                           data-coll-id="{{ $package->id }}">
                                                        <a id="btn-favourite-submit" href="javascript:void(0);"
                                                           class="gig-favourite-heart-icn btn btn-default right-btn favt_btn">
                                                                    <span class="favorite-span">
                                                                        @if(!empty($my_fav))
                                                                            <i class="fa fa-heart"></i>
                                                                            <span> Favorit</span>
                                                                        @else
                                                                            <i class="fa fa-heart-o"></i>
                                                                            <span> Favorit</span>
                                                                        @endif
                                                                    </span>

                                                        </a>
                                                    </aside>
                                                    @endif
                                                    {{--</button>--}}
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="agency-head2 custom-color-for-ptag">Providers: {{ !empty(\App\User::find($package->suggested_by)->username) ? \App\User::find($package->suggested_by)->username : '' }}</p>
                    </div>

                    <div class="left-para" style="padding: 5px;">
                        <div class="white" style="max-height:1200px; background-color:white;border: 1px solid rgba(165, 165, 165, 0.38) !important;">
                            <h1 class="zero-margg  custom-padding-val-for-we-need custom-color-for-ptag " style="padding:15px 10px; background: #a177ff; color:white; font-size:16px; letter-spacing: 0.06em;">
                                <span class="span-shift-a-bit"> We Need </span>
                                <span class="circle-the-span tooltipper custom-circle-span-prop" style="padding: 2px 8px; background: #fcfcfc;border-radius: 15px;box-shadow: 0 1px 3px #ccc; font-size: 17px" data-toggle="popover" data-trigger="focus" data-placement="left"
                                      data-content="If you want to transfer files, you can upload them and upload them to your customer account after uploading.">
                                    <i style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button"></i>
                                </span>
                            </h1>
                            <div class="gigdisscription text-left custom-margin-top-for-grid-subscription">
                                <?php if (!empty($package->pack_desc)) { ?>
                                <?php
                                    $doc = new DOMDocument();
                                    $doc->loadHTML($package->pack_desc);
                                    echo $doc->saveHTML();
                                    ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                   <!-- <a href="javascript:void(0)" class="btn btn-primary show-contact-form" style="width: 100%; background: #a177ff; border: 0px;"><span class="hidden-xs">Are you looking for something else? Send us your inquiry!</span><span class="hidden-sm hidden-md hidden-lg">Contact</span><span class="custom-gig"><span class="glyphicon glyphicon-menu-down" id="custom-gig"></span><span class="glyphicon glyphicon-menu-up" id="custom-gig" style="display:none;"></span></span></a> -->
                    <div class="modal-body"
                         style="z-index: 99; padding:0 15px 0 40px; margin:0px; display:none; background:#fff">
                        <div class="modal-signin">
                            <div class="container kontackt-form" style="padding-left:0; width:100%">

                                <div class="row row-centered">
                                    <form method="get" action="{{ route('contact') }}">

                                        @if($errors->has('others'))
                                            <div class="alert alert-danger"
                                                 role="alert">{{ $errors->first('others') }}</div> 
                                        @endif


                                        <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                                             style="positon:relative;margin-bottom:0px !important; padding-left:0px">
                                            <div class="" style="margin: 0 auto;">

                    <span style="position:relative; top:35px; left:10px;">
                      <i class="fa fa-user"></i>
                     </span>
                                                <input value="{{ \Illuminate\Support\Facades\Input::old('name') }}"
                                                       name="name" type="text" class="form-control em1" id="name"
                                                       placeholder="Name"
                                                       style="height:50px; padding: 6px 45px;">
                                                @if($errors->has('email'))
                                                    <p class="help-block">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>


                                        </div>
                                        <div id="padd-remove" class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                                             style="positon:relative;margin-bottom:0px !important">
                                            <div class="" style="margin: 0 auto;">
                     <span style="position:relative; top:35px; left:10px;">
                      <i class="fa fa-envelope"></i>
                     </span>
                                                <input type="hidden" value="{{Request::segment(3)}}"
                                                       name="gig_title">
                                                <input name="email" type="text" class="form-control em2" id="email"
                                                       placeholder="Email"
                                                       style="height:50px; padding: 6px 45px;margin-bottom:0px !important">
                                                @if($errors->has('email'))
                                                    <p class="help-block">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                                             style="positon:relative; padding-left:0px">
                                            <div class="" style="margin: 0 auto;">
                             <span style="position:relative; top:35px; left:10px;">
                                  <i class="fa fa-pencil"></i>
                             </span>
                                                <input name="betreff" type="text" class="form-control em2"
                                                       id="betreff" placeholder="Betreff"
                                                       style="height:50px; padding: 6px 45px; ">
                                                @if($errors->has('betreff'))
                                                    <p class="help-block">{{ $errors->first('betreff') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                                             style="positon:relative; padding-left:0px">
                                            <div class="" style="margin: 0 auto;">

                                                        <textarea placeholder="Nachricht" class="form-control"
                                                                  rows="6" cols="5"
                                                                  name="msg">{{ \Illuminate\Support\Facades\Input::old('msg') }}</textarea>
                                                @if($errors->has('betreff'))
                                                    <p class="help-block">{{ $errors->first('msg') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                                             style="positon:relative">
                                            <div class="Nachricht" style="margin: 0 auto; text-align: left;;">
                                                <input type="submit" name="submit" value="Nachricht senden"
                                                       class="btn btn-primary" style="background: #367FA9; border: 0px;">

                                            </div>
                                        </div>

                                        <div>
                                        </div>

                                    </form>
                                </div>{{--end of row row-centered--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
            <h3 style="color:#848484;">More packages in this category</h3>
            <div class="multiple-items1">
                @foreach($categorypackages as $featuredPackag)
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
                                                    <img src="{{ $featuredPackag['thumbnail']}}"
                                                         alt="{{ $featuredPackag->title }}"></span>
                            @endif
                            <h3 itemprop="name">{{ str_limit($featuredPackag->title,50,'...')  }}</h3>
                            {{--<h3 itemprop="name">{{ $featuredGig->title  }}</h3>--}}
                            <div class="row" style="margin:0px;">
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
                            <span class="gig-badges featured" itemprop="award">featured</span>
                        </div>
                        {{--<div class="col-xs-3">
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
                        </div>--}}
                        {{--<div class="col-xs-4">
                            <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}"
                               class="gig-price" rel="nofollow" itemprop="offers" itemscope=""
                               itemtype="http://schema.org/Offer">
                                <small itemprop="price"></small>
                                <span itemprop="price">{{ config('app.currency') . $featuredPackag->price }}</span></a>
                        </div>--}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div id="payment1" style="padding: 0px !important;" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">

        <div class="modal-content modal-costom-padding-bottom custom-line-height">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <table class="order-view">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="4"><b></b></th>
                    </tr>
                    <tr>

                        <th>Packages</th>
                        <th></th>
                        <th></th>
                        <th class="text-right">Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>

                        <td>{{ $package_bronze->package_name }}</td>

                        <td></td>
                        <td></td>
                        <td class="text-right">{{ config('app.currency') }}<span class="package-amount">{{ $package_bronze->price }}</span></td>
                    </tr>

                    </tbody>
                </table>

                <br>

                <br>
                <table class="order-view">
                    <tbody>
                    <tr>
                        <td>
                            Total packages
                        </td>
                        <td>
                                <span id="NetTotal" class="pull-right">{{ config('app.currency') }}{{ $package_bronze->price }}
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="order-view">
                    <tbody>
                    <tr>
                        <td>Net</td>
                        <td>
                                <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                    <?php $net = number_format($package_bronze->price / (1+9 / 100),2) ?>
                                    {{ $net }}
                                </span>
                        </td>
                    </tr>
                    <tr>
                        <td>19% VAT.</td>
                        <td><span id="taxIncluded" class="pull-right">{{ config('app.currency') }}{{ number_format(($package_bronze->price - $net),2)  }}</span></td>
                    </tr>
                    <tr>
                        <td><b>shopping cart</b></td>
                        <td><span class="pull-right total-grand-order-amount">{{ config('app.currency') }}{{ $package_bronze->price }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Paypal fee 5:50</td>
                        <td>
                                <span id="processingFees" class="pull-right">
                                    <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                        <?php $net_paypal = number_format(($package_bronze->price * 5.50) / 100,2) ?>
                                        {{ $net_paypal }}
                                </span>
                                </span>
                        </td>
                    </tr>

                    <tr>
                        <td><h5>Total price 5:50</h5></td>  
                        <td><h5><span id="FinalAmount" class="pull-right">
                                         <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                             {{ number_format($package_bronze->price + $net_paypal,2) }}
                                </span>
                                    </span>
                            </h5></td>
                    </tr>
                    </tbody>
                </table>
                <br>
            </div>

            <a href="{{ route('order.package', ['package_id' =>$package_bronze->id ,'package_name' => 'bronze']) }}">
            <button  type="button" class="a-button a-button-override-for-gig btn-get-this-gig">
                <span></span>Pay now with Paypal
            </button>
            </a>

            <!--
            <a href="{{ route('order.package', ['package_id' =>$package_bronze->id ,'package_name' => 'bronze']) }}"  style="border-radius: 6px; margin-bottom:40px; background: #367FA9;"  class="btn btn-primary">Pay now with Paypal</a>
            -->


            {{--<button  type="submit" class="btn btn-primary btn-lg" style="border-radius: 6px; margin-bottom:40px;">Pay with PayPal--}}
            {{--</button>--}}

            {{--<a href="{{ route('order.package') }}?package-id={{ $package->packages_id }}"  style="border-radius: 6px; margin-bottom:40px;" type="submit" class="btn btn-primary">Pay with PayPal</a>--}}
        </div>

    </div>
</div> <!-- modal -->
<div id="payment2" style="padding: 0px !important;" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">

        <div class="modal-content modal-costom-padding-bottom custom-line-height">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <table class="order-view">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="4"><b></b></th>
                    </tr>
                    <tr>

                        <th>Packages</th>
                        <th></th>
                        <th></th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>

                        <td>{{ $package_bronze->price }}£</td>

                        <td></td>
                        <td></td>
                        <td>{{ config('app.currency') }}<span class="package-amount">{{ $package_silver->price }}</span></td>
                    </tr>

                    </tbody>
                </table>

                <br>

                <br>
                <table class="order-view">
                    <tbody>
                    <tr>
                        <td>
                            Total packages
                        </td>
                        <td>
                                <span id="NetTotal" class="pull-right">{{ config('app.currency') }}{{ $package_silver->price }}
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="order-view">
                    <tbody>
                    <tr>
                        <td>Net</td>
                        <td>
                                <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                    <?php $net = number_format($package_silver->price / (1+9 / 100),2) ?>
                                    {{ $net }}
                                </span>
                        </td>
                    </tr>
                    <tr>
                        <td>19% MwSt.</td>
                        <td><span id="taxIncluded" class="pull-right">{{ config('app.currency') }}{{ number_format(($package_silver->price - $net),2)  }}</span></td>
                    </tr>
                    <tr>
                        <td><b>shopping cart</b></td>
                        <td><span class="pull-right total-grand-order-amount">{{ config('app.currency') }}{{ $package_silver->price }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Paypal fee 5.50%</td>
                        <td>
                                <span id="processingFees" class="pull-right">
                                    <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                        <?php $net_paypal = number_format(($package_silver->price * 5.50) / 100,2) ?>
                                        {{ $net_paypal }}
                                </span>
                                </span>
                        </td>
                    </tr>

                    <tr>
                        <td><h5>total price</h5></td>
                        <td><h5><span id="FinalAmount" class="pull-right">
                                         <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                             {{ number_format($package_silver->price + $net_paypal,2) }}
                                </span>
                                    </span>
                            </h5></td>
                    </tr>
                    </tbody>
                </table>
                <br>
            </div>


            <a href="{{ route('order.package', ['package_id' =>$package_silver->id ,'package_name' => 'silver']) }}">
                <button  type="button" class="a-button a-button-override-for-gig btn-get-this-gig">
                    <span></span>Pay now with Paypal
                </button>
            </a>


            <!--
            <a href="{{ route('order.package', ['package_id' =>$package_silver->id ,'package_name' => 'silver']) }}"  style="border-radius: 6px; margin-bottom:40px; background: #367FA9;"  class="btn btn-primary">Pay now with Paypal</a>
            -->

            {{--<button  type="submit" class="btn btn-primary btn-lg" style="border-radius: 6px; margin-bottom:40px;">Pay with PayPal--}}
            {{--</button>--}}

            {{--<a href="{{ route('order.package') }}?package-id={{ $package->packages_id }}"  style="border-radius: 6px; margin-bottom:40px;" type="submit" class="btn btn-primary">Pay with PayPal</a>--}}
        </div>

    </div>
</div> <!-- modal -->
<div id="payment3" style="padding: 0px !important;" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">

        <div class="modal-content modal-costom-padding-bottom custom-line-height">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <table class="order-view">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="4"><b></b></th>
                    </tr>
                    <tr>

                        <th>Packages</th>
                        <th></th>
                        <th></th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>

                        <td>{{ $package_gold->package_name }}</td>

                        <td></td>
                        <td></td>
                        <td>{{ config('app.currency') }}<span class="package-amount">{{ $package_gold->price }}</span></td>
                    </tr>

                    </tbody>
                </table>

                <br>

                <br>
                <table class="order-view">
                    <tbody>
                    <tr>
                        <td>
                            Total packages
                        </td>
                        <td>
                                <span id="NetTotal" class="pull-right">{{ config('app.currency') }}{{ $package_gold->price }}
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="order-view">
                    <tbody>
                    <tr>
                        <td>Net</td>
                        <td>
                                <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                    <?php $net = number_format($package_gold->price / (1+9 / 100),2) ?>
                                    {{ $net }}
                                </span>
                        </td>
                    </tr>
                    <tr>
                        <td>19% MwSt.</td>
                        <td><span id="taxIncluded" class="pull-right">{{ config('app.currency') }}{{ number_format(($package_gold->price - $net),2)  }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Shopping cart</b></td>
                        <td><span class="pull-right total-grand-order-amount">{{ config('app.currency') }}{{ $package_gold->price }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Paypal fee 5.50%</td>
                        <td>
                                <span id="processingFees" class="pull-right">
                                    <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                        <?php $net_paypal = number_format(($package_gold->price * 5.50) / 100,2) ?>
                                        {{ $net_paypal }}
                                </span>
                                </span>
                        </td>
                    </tr>

                    <tr>
                        <td><h5>Total Price</h5></td>
                        <td><h5><span id="FinalAmount" class="pull-right">
                                         <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                             {{ number_format($package_gold->price + $net_paypal,2) }}
                                </span>
                                    </span>
                            </h5></td>
                    </tr>
                    </tbody>
                </table>
                <br>
            </div>


            <a href="{{ route('order.package', ['package_id' =>$package_gold->id ,'package_name' => 'gold']) }}">
                <button  type="button" class="a-button a-button-override-for-gig btn-get-this-gig">
                    <span></span>Pay now with Paypal
                </button>
            </a>


<!--
            <a href="{{ route('order.package', ['package_id' =>$package_gold->id ,'package_name' => 'gold']) }}"  style="border-radius: 6px; margin-bottom:40px; background: #367FA9;"  class="btn btn-primary">Pay now with Paypal</a>
   -->
            {{--<button  type="submit" class="btn btn-primary btn-lg" style="border-radius: 6px; margin-bottom:40px;">Pay with PayPal--}}
            {{--</button>--}}

            {{--<a href="{{ route('order.package') }}?package-id={{ $package->packages_id }}"  style="border-radius: 6px; margin-bottom:40px;" type="submit" class="btn btn-primary">Pay with PayPal</a>--}}
        </div>

    </div>
</div> <!-- modal -->
@include('includes.footer')
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script>
    (function($){
        $(window).on("load",function(){

            $("body").mCustomScrollbar({
                theme:"minimal"
            });

        });
    })(jQuery);
</script>
<script>

    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId = $selectedGig.data('coll-id');
        var url = $selectedGig.data('url');

        if ($(this).find('i').attr('class') == 'fa fa-heart') {
            var action = 'removeFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o"></i><span>Favorit</span></span>');
        }
        else {
            var action = 'addToFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart"></i><span>Favorit</span></span>');
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
<script>




    (function () {

        $('[data-toggle="tooltip"]').tooltip();

        $('.single-item').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.multiple-items',
            prevArrow: "<div class=\"slid-prev\"></div>",
            nextArrow: "<div class=\"slid-next\"></div>",
            adaptiveHeight: true
        });

        $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 4,
            arrows: false,
            asNavFor: '.single-item',
            focusOnSelect: true,
            centerMode: true,
            centerPadding: '15px',
        });

        $('.multiple-items1').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: false
        });
    })();
</script>
<script>
    $(document).ready(function(){
        $('.show-contact-form').click(function () {
            $('.modal-body').slideToggle();
        });
    });
    /*jQuery('.accordion-2 .panel-heading a[data-toggle="collapse"]').on('click', function () {
        jQuery('.accordion-2 .panel-heading a[data-toggle="collapse"]').removeClass('active-accordian');
        $(this).addClass('active-accordian');
    });*/
</script>
<script type="text/javascript">
   /* $(".collapsed").on("click",function(){
        $(this).parent().find(".fa-chevron-up").toggle();
        $(this).parent().find(".fa-chevron-down").toggle();
    });*/
    $(".bronze-click").on("click",function(){
       $(".toggle_class").toggleClass("bronze_toggle bronze-box");
        $(".toggle_class_silver").removeClass("silver-box");
        $(".toggle_class_gold").removeClass("gold-box");
        $(".packdisscription_bronze").toggleClass("packdescbronze packdescbronze_act");
        $(".packdisscription_silver").removeClass("packdescsilver_act");
        $(".packdisscription_gold").removeClass("packdescgold_act");
    });
    $(".silver-click").on("click",function(){
        $(".toggle_class_silver").toggleClass("bronze_toggle silver-box");
        $(".toggle_class").removeClass("bronze-box");
        $(".toggle_class_gold").removeClass("gold-box");
        $(".packdisscription_silver").toggleClass("packdescsilver packdescsilver_act");
        $(".packdisscription_bronze").removeClass("packdescbronze_act");
        $(".packdisscription_gold").removeClass("packdescgold_act");
    });
    $(".gold-click").on("click",function(){
        $(".toggle_class_gold").toggleClass("bronze_toggle gold-box");
        $(".toggle_class").removeClass("bronze-box");
        $(".toggle_class_silver").removeClass("silver-box");
        $(".packdisscription_gold").toggleClass("packdescgold packdescgold_act");
        $(".packdisscription_bronze").removeClass("packdescbronze_act");
        $(".packdisscription_silver").removeClass("packdescsilver_act");
    });
</script>
<script type="text/javascript">
    $(".tooltipper").popover({
        'trigger': 'hover'
    })
</script>
</body>
</html>