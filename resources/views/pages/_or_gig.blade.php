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
<div class="dash-main-content footer-overlap-issue-resolve" style="height: 100vh;">
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

                </div>
            <div class="row">
                <div class="col-md-7 extra-padd">
                    <h5 class="first-head">
                        <span class="pull-left">{{$gig->title }}</span>
                        <span class="pull-right"><a href="{{ route('gigscategory.gigs',['categoryslug'=> $gigType->slug]) }}">category >> {{ $gigType->name }}</a></span>
                    </h5>
                </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="slider slider-image-border-custom" style="width: 100%;">
                            <div class="single-item" style="margin-bottom:0px;">
                                @foreach($gig_images as $gig_image)
                                    @if(file_exists(public_path('/files/gigs/images').'/'.$gig_image->image))
                                    <div class="slide">
                                        <div class="back">
                                            <img style="display: inline-block; width: 100%;"
                                                 src="{{ url('files/gigs/images') . '/' . $gig_image->image }}">
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                    @if(!empty($gig->gig_videos))
                                        <div class="slide">
                                            <div class="back">
                                                <?php echo $gig->gig_videos;  ?>
                                            </div>
                                        </div>
                                    @endif
                            </div>
                            <div class="multiple-items" style="background-color:rgb(227, 227, 227);">
                                @foreach($gig_images as $gig_image)
                                    @if(file_exists(public_path('/files/gigs/images').'/'.$gig_image->image))
                                    <div class="slide" style="margin-right: 5px">
                                        <img src="{{ url('files/gigs/images') . '/' . $gig_image->image }}"
                                             style="height:60px; border:2px solid #2f8dd7;width: 100%;">
                                    </div>
                                    @endif
                                @endforeach
                                @if(!empty($gig->gig_videos))
                                    <div class="slide">
                                        <div class="back">
                                            <img src="{{ url('files/gigs/video-thumbnail.png') }}"
                                                 style="height:60px; border:2px solid #2f8dd7;width: 100%;">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="left-para ">
                            <h1>Product description
                                </h1>

                            {{--<p>{{htmlentities($gig->discription) }}</p>--}}
                            <div class="white mCustomScrollbar"  data-mcs-theme="minimal" style="max-height:1200px; background-color:white;border: 1px solid rgba(165, 165, 165, 0.38) !important;">
                            <h1 class="zero-margg" style="padding:15px 10px; background: #f1f2f2; color:#848484;"><b>You receive:</b></h1>
                            <div class="gigdisscription">
                                <?php if(!empty($gig->discription)){ ?>
                                    <?php
                                    $doc = new DOMDocument();
                                    $doc->loadHTML($gig->discription);
                                    echo $doc->saveHTML();
                                    ?>
                                <?php } ?>
                            </div>
                                <h1 style="padding:15px 10px; background: #f1f2f2; color:#848484;"><b>We need:</b>
                                    <span class="circle-the-span tooltipper color-for-infocircle" style="padding: 2px 8px; background: #fcfcfc;border-radius: 15px;box-shadow: 0 1px 3px #ccc; font-size: 17px;" data-toggle="popover" data-trigger="focus" data-placement="right"
                                          data-content="If you want to transfer files, You can use this to  successful order
in your account by Upload-upload feature and transmit.">
                                    <i  style="color:white; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button"></i>
                                </span>
                                </h1>
                            <div class="gigdisscription customized-left-para">
                                <?php if(!empty($gig->discription2)){ ?>
                                <?php
                                $doc = new DOMDocument();
                                $doc->loadHTML($gig->discription2);
                                echo $doc->saveHTML();
                                ?>
                                <?php } ?>
                            </div>
                            {{--<h1 style="padding:15px 10px; background: #f1f2f2; color:#848484;"><b>Erweiterungen (Aufpreis):</b></h1>--}}
                            <div class="gigdisscription">
                                <?php /*if(!empty($gig->discription3)){ */?><!--
                                <?php
    /*                            $doc = new DOMDocument();
                                $doc->loadHTML($gig->discription3);
                                echo $doc->saveHTML();
                                */?>
                                --><?php /*} */?>
                            </div>
                            </div>
                            <br>
                        </div>


                    </div>

                    <div class="col-md-5 col-sm-12  right-panel">
                        <form id="gigPurchaseForm" method="get" action="{{ route('proceed.checkout') }}">
                            <div class="text-center order-basic-info remove-padding-order-basic-info" style="{{ \Illuminate\Support\Facades\Auth::user()->check() ? 'padding-bottom:50px' : '' }}">
                                <p class="f-head custom-color-for-ptag "><span>Ordering Information</span>
                                    <span class="circle-the-span tooltipper custom-circle-span-prop" style="padding: 2px 7px; background: #ff5071;border-radius: 15px;box-shadow: 0 1px 3px #ccc;" data-toggle="popover" data-trigger="focus" data-placement="left"
                                          data-content="
                                           As a customer, you have in your account
Possibility via chat correspondence further order-relevant data(FTP-Data, Informationen, Details, uvm.)
To convey They communicate directly with our sales team.">
                                        <i  style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button" ></i>
                                    </span>
                                </p>
                                <div class="gig-final-cost" style="margin: 0 auto;margin-bottom: 10px;margin-top: 5px;">
                                    <div style=" font-size: 50px; color:#161d28;">{{ config('app.currency') }}

                                        <span class="gig-final-cost-amount">{{ number_format($gig->price,2) }}</span></div>
                                </div>
                                <div class="buttons">
                                    {{--<button class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>Contact with Me--}}
                                    {{--</button>--}}
                                    <button onclick="showGigPurchase()" type="button" class="a-button a-button-override-for-gig btn-get-this-gig">
                                        <span></span>CHECKOUT

                                    </button>
                                </div>

                                <div class="well" id="company-info-block">

                                    <p class="comp-desc">Project description</p>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php $count = 1;?>
                                            @foreach($questions as $question)
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <p class="no-color-class">{{  $question->question }}</p>

                                                        @if($question->type == 'check')

                                                            <div class="row text-center">

                                                                @foreach($question->answers as $answer)
                                                                    <div class="col-sm-3">
                                                                        <div class="checkbox checkbox-info checkbox-circle">

                                                                            <input id="{{ str_replace(" ", "-", strtolower($answer)) }}{{ $count }}"
                                                                                   class="styled" value="{{ $answer }}"
                                                                                   type="radio"
                                                                                   name="question[{{ $question->id }}]">

                                                                            <label for="{{ str_replace(" ", "-", strtolower($answer)) }}{{ $count }}"
                                                                                   style="margin-left:25px; margin-bottom:10px;">

                                                                            </label>
                                                                            <div><p class="font-family-color">{{ $answer }}</p>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        @elseif($question->type == 'range')
                                                            <table class="ranges">
                                                                @foreach($question->answers as $answer)
                                                                    <?php $options = explode(',', $answer); ?>


                                                                    <tr>
                                                                        <td>{{ $options[0] }}</td>
                                                                        <td><input name="{{ $question->id }}[]" class="ex1"
                                                                                   data-slider-id='ex1Slider' type="text"
                                                                                   data-slider-min="0" data-slider-max="10"
                                                                                   data-slider-step="1" data-slider-value="0"/>
                                                                        </td>
                                                                        <td class="classic">{{ $options[1] }}</td>
                                                                    </tr>


                                                                @endforeach
                                                            </table>
                                                        @endif

                                                    </div>
                                                </div>

                                                <?php $count++; ?>
                                            @endforeach

                                            @if(!empty($user))
                                                <div style="display:none;" class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <input value="{{ $user->username }}" required name="company_name"
                                                                   type="text" class="form-control" placeholder="Comapny Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="display:none;" class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <input value="{{ $user->name }}" required name="company_tagline"
                                                                   type="text" class="form-control" placeholder="Tagline">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="display:none;" class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <input value="{{ $user->name }}" required name="company_industry"
                                                                   type="text" class="form-control" placeholder="Industry">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <textarea required name="company_discription" class="form-control"
                                                                  rows="5" placeholder="Oder must Details to your order. Listen Briefly your exact requirements on, e.g. Style, colors or fonts etc." id="comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <button id="btn-pay-start" type="submit" class="a-button a-button-override-for-gig">
                                                ORDER NOW
                                            </button>
                                            {{--<button type="submit" class="btn btn-primary" style="width: 100px; border-radius: 6px;">Pay & Start</button>--}}


                                            <div id="paymentConfirmationModal1" style="overflow: hidden;" class="modal fade bs-example-modal-sm paypal"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="mySmallModalLabel">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header login-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="order-view">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center" colspan="4">FAVOR</th>
                                                                </tr>
                                                                <tr>

                                                                    <th>Gigs</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>{{ $gig->title }}</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>{{ config('app.currency') }}<span
                                                                                class="gig-amount">{{ $amount = number_format($gig->price, 2) }}</span>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <br>

                                                            <table class="order-view order-view-addon">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center" colspan="4">ADDONS</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Addon</th>
                                                                    <th>Price</th>
                                                                    <th>Amount</th>
                                                                    <th>Total price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>

                                                            <br>
                                                            <table class="order-view">
                                                                <tbody>
                                                                <tr>
                                                                    <td><b>Gigs Gesamt</b></td>
                                                                    <td><span id="GigTotal" class="pull-right">&euro;</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Net</td>
                                                                    <td><span id="NetTotal" class="pull-right">&euro; 0</span>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <table class="order-view">
                                                                <tbody>

                                                                <tr>
                                                                    <td>19% MwSt.</td>
                                                                    <td><span id="taxIncluded" class="pull-right">&euro;
                                                                            0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>shopping cart</b></td>
                                                                    <td><span class="pull-right total-grand-order-amount">&euro;
                                                                            0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Paypal fee 5.50%</td>
                                                                    <td><span id="processingFees" class="pull-right">&euro;
                                                                            0</span></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><h5>total price
                                                                        </h5></td>
                                                                    <td><h5><span id="FinalAmount" class="pull-right">0</span>
                                                                        </h5></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>


                                                        <button type="submit" class="btn btn-primary btn-lg"
                                                                style="border-radius: 6px; margin-bottom:40px; background: #367FA9;">Pay now With Paypal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div> <!-- modal -->
                                        </div>
                                    </div>
                                </div>


                                <h1 class="s-head"><span class="glyphicon glyphicon-time clock"></span>Delivery
                                    in {{ $gig->delivery_days }} days</h1>
                                {{--<h4 style="padding-right:40px;"><span style="margin-right:18px;" class="glyphicon glyphicon-briefcase" style="margin-right:55px;"></span>Total Sales : {{$sales}}</h4>--}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        @if(\Illuminate\Support\Facades\Auth::user()->check())
                                            {{--<button  id="btn-favourite" type="button" class="btn btn-default right-btn favt_btn" data-toggle="tooltip" data-placement="right">--}}

                                            <aside data-url="{{ route('gig.favourite') }}" data-coll-id="{{ $gig->id }}">
                                                <a id="btn-favourite-submit" href="javascript:void(0);"
                                                   class="gig-favourite-heart-icn btn btn-default right-btn favt_btn">
                                                                        <span class="favorite-span">
                                                                            @if($gig['my_fav'])
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
                                </div>
                                <p class="agency-head custom-color-for-ptag">Providers: {{ !empty(\App\User::find($gig->suggested_by)->username) ? \App\User::find($gig->suggested_by)->username : '' }}</p>
                            </div>

                            <div class="right-para text-left">
                            <h1 class="right-addon-head">Add extensions
                            </h1>

                            <div class="addons col-xs-12">
                                @foreach($gig_addons as $gig_addon)
                                    <div class="form-group row first-addon">
                                        <div class="checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx2 col-md-8">
                                            <input id="checkbox12" class="styled radio-btn-addon" type="checkbox">
                                            <label for="checkbox12">
                                                <p class="chck-bx-p addon-name">{{ $gig_addon->addon }}
                                                    @if(!empty($gig_addon->addon) && $gig_addon->addon == "Express Delivery")
                                                        @if($gig_addon->day > 0)
                                                            in {{$gig_addon->day}} Werktage
                                                        @else
                                                            in {{$gig_addon->day}} Werktage
                                                        @endif
                                                    @endif
                                                </p>
                                            </label>
                                        </div>
                                        <div class="col-md-4 select select-div-for-outline">
                                            <select data-addon-id="{{ $gig_addon->id }}" class="selectpicker select-addon">
                                                @if($gig_addon->addon != "Express Delivery")
                                                @for($i = 1; $i <= 10; $i++)
                                                    <option data-amount="{{ $gig_addon->amount * $i }}"
                                                            value="{{ $i }}">{{ $i }}
                                                        ({{ config('app.currency') }}{{ $gig_addon->amount * $i }})
                                                    </option>
                                                @endfor
                                                @else
                                                    <option data-amount="{{ $gig_addon->amount }}"
                                                            value="{{ 1 }}">{{ 1 }}
                                                        ({{ config('app.currency') }}{{ $gig_addon->amount }})
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                            <input type="hidden" name="funnel" value="{{ $_REQUEST['funnel'] }}">
                            <input type="hidden" name="gig_price" value="{{ number_format($gig->price,2) }}">
                        </form>
                       <!-- <a href="javascript:void(0)" class="btn btn-primary show-contact-form" style="width: 100%; background: #a177ff; border: 0px;"><span class="hidden-xs">Are you looking for something different? Send us your request!</span><span class="hidden-sm hidden-md hidden-lg">Kontakt</span><span class="custom-gig"><span class="glyphicon glyphicon-menu-down" id="custom-gig"></span><span class="glyphicon glyphicon-menu-up" id="custom-gig" style="display:none;"></span></span></a> -->
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
                                                    <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                              <input type="submit" name="submit" value="Nachricht senden" class="btn btn-primary" style="background: #367FA9; border: 0px;">

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
            <h3 style="color:#848484;">More favor in this category</h3>
            <div id="carousel" class="flexslider">
                <ul class="slides">
                    @foreach($categorygigs as $featuredGig)
                        <li style="width: inherit !important; float: none !important;">
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

                                <a style="outline:none;"
                                   href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}"
                                   class="gig-link-main" itemprop="url">
                                            <span class="gig-pict-222" itemscope=""
                                                  itemtype="http://schema.org/ImageObject">
                                                @if(!empty($featuredGig['thumbnail']) AND $featuredGig['thumbnail'] != '')
                                                    <img src="{{ $featuredGig['thumbnail'] }}"
                                                         alt="{{ $featuredGig->title }}"></span>
                                    @endif
                                    <h3 itemprop="name">{{ str_limit($featuredGig->title,50,'...')  }}</h3>
                                    {{--<h3 itemprop="name">{{ $featuredGig->title  }}</h3>--}}
                                </a>

                                <div class="col-xs-5">
                                    <span class="gig-badges featured" itemprop="award">featured</span>
                                </div>
                                <div class="col-xs-3">
                                    @if($user)
                                        <aside data-url="{{ route('gig.favourite') }}"
                                               data-coll-id="{{ $featuredGig->id }}">
                                            <a id="btn-favourite-submit" href="javascript:void(0);"
                                               class="gig-favourite-heart-icn">
                                                                <span class="favorite-span">
                                                                    @if($featuredGig['my_fav'])
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
                                    <a href="{{ url() }}/favors/{{ $featuredGig['gigtype_slug'] }}/{{ $featuredGig->slug }}?funnel={{ $featuredGig->uuid }}"
                                       class="gig-price" rel="nofollow" itemprop="offers" itemscope=""
                                       itemtype="http://schema.org/Offer">
                                        <small itemprop="price"></small>
                                        <span itemprop="price">{{ config('app.currency') . $featuredGig->price }}</span></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        </div>
    </div>
</div>
    </div>
</div>

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

    function showGigPurchase() {
        $('#company-info-block').slideToggle();
    }



    (function () {
        $('#gigPurchaseForm').validate();

        document.querySelector('#btn-pay-start').addEventListener('click', function (e) {

            if ($('#gigPurchaseForm').valid()) {
                $('body').css("padding","0px");
                $('#paymentConfirmationModal').modal('show');
                $('#paymentConfirmationModal').css('padding','0px');
            }

        });
        /* document.querySelector('#btn-favourite').addEventListener('click', function() {

         var fav_text = $('.fav-text').html();

         if(fav_text == 'Favorit') {

         var Favorite = 'addToFavorite';

         }
         else {
         var Favorite = 'DeleteFavorite';

         }
         $.ajax({
         url: window.location,
         method: 'post',
         data: {'Favorite': Favorite},
         success: function (data) {
         console.log(data);
         var totalFavourite = document.querySelector('.totalFavourite');
         totalFavourite.innerHTML = data;

         $('.fav-text').empty().html(fav_text);

         }
         });

         });*/


        document.querySelector('#btn-pay-start').addEventListener('click', function () {
            document.querySelector('.order-view-addon tbody').innerHTML = "";
            var radio = document.querySelectorAll('.radio-btn-addon');
            var gigAmount = parseFloat(document.querySelector('.gig-amount').textContent);
            var totalAddonsAmount = 0;

            if (radio.length > 0) {
                var select = document.querySelectorAll('select.select-addon');
                var addonName = document.querySelectorAll('.addon-name');


                [].forEach.call(radio, function (elem, index, arr) {
                    if (elem.checked) {
                        if (select[index].value != "") {
                            select[index].name = 'addon[' + select[index].getAttribute('data-addon-id') + ']';


                            var row = document.createElement('tr');
                            var col1 = document.createElement('td');
                            col1.textContent = addonName[index].textContent;
                            var col2 = document.createElement('td');
                            col2.innerHTML = currencyType + "<span>" + parseFloat(select[index].firstElementChild.getAttribute('data-amount')).toFixed(2) + "</span>";
                            var col3 = document.createElement('td');
                            col3.textContent = (parseInt(select[index].selectedIndex) + 1);
                            var col4 = document.createElement('td');
                            var totalAddonAmount = (parseFloat(col2.firstElementChild.textContent) * parseFloat(col3.textContent));
//                            console.log(totalAddonAmount);
                            col4.textContent = currencyType + totalAddonAmount;
                            totalAddonsAmount += (totalAddonAmount);
                            row.appendChild(col1);
                            row.appendChild(col2);
                            row.appendChild(col3);
                            row.appendChild(col4);

                            document.querySelector('.order-view-addon tbody').appendChild(row);
                        }
                    }
                });

            }
            var totalOrderAmount = parseFloat(totalAddonsAmount + gigAmount);
//            console.log(totalAddonsAmount);
            var processingFees = parseFloat((totalOrderAmount * 5.50) / 100).toPrecision(3);
            var netTotal = parseFloat(Math.round(totalOrderAmount) / (1 + 19 / 100)).toFixed(2);
//                console.log(netTotal);
            var taxIncluded = (parseFloat(totalOrderAmount) - parseFloat(netTotal)).toPrecision(4);
            document.querySelector('#GigTotal').textContent = currencyType + parseFloat(totalOrderAmount).toFixed(2);
            document.querySelector('.total-grand-order-amount').textContent = currencyType + parseFloat(totalOrderAmount).toFixed(2);
            document.querySelector('#NetTotal').textContent = currencyType + parseFloat(netTotal).toFixed(2);
            document.querySelector('#taxIncluded').textContent = currencyType + parseFloat(taxIncluded).toFixed(2);
            document.querySelector('#processingFees').textContent = currencyType + parseFloat(processingFees).toFixed(2);
            document.querySelector('#FinalAmount').textContent = currencyType + parseFloat(parseFloat(totalOrderAmount) + parseFloat(processingFees)).toFixed(2);


        });

        document.querySelector('.addons').addEventListener('click', function (e) {
            var radio = document.querySelectorAll('.radio-btn-addon');
            if (radio.length > 0) {
                var select = document.querySelectorAll('select.select-addon');
                var gigAmount = parseFloat(document.querySelector('.gig-amount').textContent);
                var totalAddonsAmount = 0;

                [].forEach.call(radio, function (elem, index, arr) {
                    if (elem.checked) {
                        if (select[index].value != undefined) {
                            var addonAmount = select[index].firstElementChild.getAttribute('data-amount');
                            var addonQuantity = (parseInt(select[index].selectedIndex) + 1);
                            var totalAddonAmount = (parseFloat(addonAmount) * parseFloat(addonQuantity));
                            totalAddonsAmount += totalAddonAmount;
                        }
                    }
                });

                document.querySelector('.gig-final-cost-amount').textContent = parseFloat(parseFloat(totalAddonsAmount) + parseFloat(gigAmount)).toFixed(2);
            }
        });

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
            arrows: true
        });
    })();
</script>
<script>
    $(document).ready(function(){
        $('.show-contact-form').click(function () {
            $('.modal-body').slideToggle();
        });

    })
</script>
<!-- FlexSlider -->
<script type="text/javascript" src="{{ asset('js/jquery.flexslider.js') }}"></script>

<script type="text/javascript">
    $(function(){
        SyntaxHighlighter.all();
    });
    $(window).load(function(){
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false
        });
    });
</script>
<script type="text/javascript">
    $(".tooltipper").popover({
        'trigger': 'hover'
    })
</script>
</body>
</html>