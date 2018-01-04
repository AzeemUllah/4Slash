@include('includes.header')

{{-- Paypal Modal--}}
<div id="paymentConfirmationModal" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <form id="gigPurchaseForm" method="post" action="{{ route('payment') }}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="order-view">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="4">Custom Order</th>
                        </tr>
                        <tr>

                            <th>Order Products</th>
                            <th></th>
                            <th></th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="custom_order_products"></span></td>
                            <td></td>
                            <td></td>
                            <td><span class="gig-amount"></span></td>
                            <input type="hidden" class="total_order_amount" name="total_amount">
                            <input type="hidden" name="type" value="custom_order">
                            <input type="hidden" name="message_id" class="message_id">
                            <input type="hidden" name="custom_order_products" class="custom_order_products">
                            <input type="hidden" name="orde_uuid" class="order_uuid">
                            <input type="hidden" name="total_days" class="total_days">
                        </tr>
                        </tbody>
                    </table>

                    <br>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td><b>Order Total</b></td>
                            <td><span id="OrderTotal" class="gig-amount pull-right"></span></td>
                        </tr>
                        <tr>
                            <td>Net Total</td>
                            <td><span id="NetTotal" class="pull-right">&euro; 0</span></td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="order-view">
                        <tbody>

                        <tr>
                            <td>Taxes Included 19%</td>
                            <td><span id="taxIncluded" class="pull-right">&euro; 0</span></td>
                        </tr>
                        <tr>
                            <td><b>Order Total</b></td>
                            <td><span class="pull-right total-grand-order-amount gig-amount">&euro; 0</span></td>
                        </tr>
                        <tr>
                            <td>Processing Fees 5.5%</td>
                            <td><span id="processingFees" class="pull-right">&euro; 0</span></td>
                        </tr>

                        <tr>
                            <td><h5>Total Amount</h5></td>
                            <td><h5><span id="FinalAmount" class="pull-right">0</span></h5></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <button type="submit" class="btn btn-primary btn-lg"
                        style="border-radius: 6px; margin-bottom:40px;">Pay now with Paypal

                </button>
            </div>
        </div>
    </form>
</div> <!-- modal -->


<!--content-->
<div class="container-fluid" ng-app="cnerr" ng-controller="MyOrdersController" style="background: #ffffff !important; padding: 0px; margin-bottom: 0px;">
    {{--<div class="row">--}}
        {{--<div class="col-lg-5">--}}
            {{--<h1 class="text-primary heading-responsive2">Kundenbereich</h1>--}}
            {{--</div>--}}
        {{--</div>--}}

    @if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="alert" role="alert" style="text-align: center; width: 100%;">
        <p style="font-size: 16px;
                        font-weight: bold;
    color: white;
    display: inline-block;
    background-color: #3a80a7;
    padding: 5px 30px;">{{ \Illuminate\Support\Facades\Session::get('success') }}</p>
        {{ \Illuminate\Support\Facades\Session::forget('success') }}
    </div>
    {{-- {{ \Illuminate\Support\Facades\Session::forget('successMessage_1') }}
    {{ \Illuminate\Support\Facades\Session::forget('successMessage_2') }}--}}
    @endif
    <div class="col-xs-12 mobile-alert">
        @if(Session::has('status') OR Session::has('order'))
        <div class="alert alert-success" style="text-align: center;">
            {{ Session::get('status') }} <br>

            Ihre Bestellnummer: {{Session::get('order')}}
        </div>
        @endif
        @if(Session::has('complete') OR Session::has('ordercomplete'))
        <div class="alert alert-success desktop-alert"
             style="width: 512px; float: right; margin-right: 202px; text-align: center;">
            {{ Session::get('complete') }} <br>

            {{Session::get('ordercomplete')}}
        </div>
        @endif
    </div>
    <div class="row" style="margin: 0px;">
        <div class="col-xs-12 zero-padd">
            <!-- Modal -->
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form action="" id="snd_compl">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel1">Subject / Text
                                </h4>
                            </div>
                            <div class="modal-body">
                                <textarea name="complt_txt" id="complt_txt" cols="10" rows="6" class="form-control"></textarea>
                                <input type="hidden" name="order_no" id="order_number" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary cnerr_btn">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row wrk-strm-chat" style="margin-left:0px; margin-right:0px;">
        <div class="col-md-3 col-xs-12 left-ubox">

            <!-- Nav tabs -->
            @if($status)
            <div class="head">
                <p>Cancellations</p>
            </div>
            <div class="list-group left-pane">


                <div>
                    <ul class="nav nav-tabs order_tab" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                  data-toggle="tab" style="display: none"><i
                                        class="fa fa-times"></i> Cancel </a></li>
                    </ul>
                    <div class="search col-md-12"
                         style="float:none;margin:0; padding:0;  margin-bottom: 8px; margin-top: 9px;">
                        {{--<form action="{{ route('orders.search') }}" method="post">--}}
                            <input type="text" name="keyword" id="search_orders" class="form-control"
                                   placeholder="Search" style="border-radius:0;">
                            <span class="showAll"
                                  style="position:absolute; cursor:pointer; z-index: 999999; margin-top: -26px;right: 0;display:none;margin-right: 10px;"><i
                                        class="fa fa-close"></i> </span>
                            {{-- </form>--}}
                    </div>
                    @else
                    <div class="head heading-responsive">
                        <h4 class="custom-link-color">My project</h4>
                    </div>
                    <div class="list-group left-pane">


                        <div>
                            <div class="search col-md-12"
                                 style="float:none;margin:0; margin-bottom: 8px; margin-top: 9px; border-radius: 4px;">
                                {{--<form action="{{ route('orders.search') }}" method="post">--}}
                                    <input type="text" name="keyword" id="search_orders" class="form-control "
                                           placeholder="Order number"
                                           style="border-radius:17px; border: 2px solid #ffb3c1  !important; color: #7b7b7b; ">
                                    <span class="showAll"
                                          style="position:absolute; cursor:pointer; z-index: 999999; margin-top: -26px;right: 0;display:none;margin-right: 24px;"><i
                                                class="fa fa-close"></i> </span>
                                    {{-- </form>--}}
                            </div>
                            <div class="row">
                                <div class="col-xs-2 order_tab_column">
                                    <ul class="nav nav-tabs order_tab" role="tablist">
                                        <li role="presentation" class="active" data-toggle="tooltip" data-placement="right" title="In Process"><a href="#home" aria-controls="home"
                                                                                                                                                  role="tab" data-toggle="tab"><i id="spinner"
                                                                                                                                                                                  class="fa fa-spinner spinner-active-color"></i>
                                            </a></li>
                                        <li role="presentation" data-toggle="tooltip" data-placement="right" title="Custom Orders"><a href="#custom" aria-controls="custom" role="tab"
                                                                                                                                      data-toggle="tab"><i class="fa fa-cog" id="cogwheel"></i>
                                            </a></li>
                                        <li role="presentation" data-toggle="tooltip" data-placement="right" title="Finish Orders"><a href="#profile" aria-controls="profile"
                                                                                                                                      role="tab"
                                                                                                                                      data-toggle="tab"><i
                                                        class="fa fa-flag-checkered" id="flag"></i></a></li>
                                    </ul>
                                </div>
                                @endif
                                <!-- Tab panes -->
                                <div class="col-xs-10 myorder_tab_content">
                                    <div class="tab-content myorder-links-items"
                                         style="max-height: 351px;;overflow-y: auto;">
                                        @if(!empty($canceledOrders) && count($canceledOrders) > 0 && $status)
                                        <div role="tabpanel" class="tab-pane active" id="home">

                                            @foreach($canceledOrders as $order)
                                            <a href="{{ route('getmyorder', [$order->order_no]) }}"
                                               class="list-group-item">
                                                {{ (($order->type == 'gig') ? $order->order_no : (($order->type == 'package') ? $order->order_no :($order->type == 'custom') ? $order->order_no : '' ))  }}
                                                <?php
                                                $expiry = explode(' ', $order->expiry);
                                                $dateExpiry = explode('-', $expiry[0]);
                                                $dateExpiry = $dateExpiry[2] . '-' . $dateExpiry[1] . '-' . $dateExpiry[0];
                                                $day = date('d-m-Y');

                                                ?>
                                                @if(strtotime($dateExpiry) <= strtotime($day) && $order->type != 'package')
                                                <span class="text-right"
                                                      style="font-size:10px">{{ $dateExpiry }}</span>
                                                @else
                                                <span class="text-right"
                                                      style="font-size:10px">{{ $dateExpiry }}</span>

                                                @endif
                                                <br>
                                                @if(!empty($order['gig']) OR !empty($order['package']) OR $order['custom'])
                                                <span style="font-size: 14px">{{ (($order->type == 'gig') ? $order['gig']->title : (($order->type == 'package') ? $order['package']->title : ($order->type == 'custom') ? "Your individual inquiry" : ''))}}</span>
                                                @endif
                                            </a>
                                            @endforeach
                                        </div>
                                        @else
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                            @if(!empty(count($pendingOrders)) && count($pendingOrders) > 0 && !$status)
                                            @foreach($pendingOrders as $order)


                                            <a href="{{ route('getmyorder', [$order->order_no]) }}"
                                               class="list-group-item">
                                                @if($order->status == 'jobdone')
                                                <span class="myorders-list-item-status job-done-assets two">Finished</span>
                                                @elseif($order->status == 'review')
                                                <span class="myorders-list-item-status job-done-assets two">Change desired</span>
                                                @endif


                                                @if(!empty($order['gig']) OR !empty($order['package']) )
                                                {{ (($order->type == 'gig') ? $order->order_no : (($order->type == 'package') ? $order->order_no : '' ))  }}
                                                @endif
                                                <?php
                                                $expiry = explode(' ', $order->expiry);
                                                $dateExpiry = explode('-', $expiry[0]);
                                                $dateExpiry = $dateExpiry[2] . '-' . $dateExpiry[1] . '-' . $dateExpiry[0];
                                                $day = date('d-m-Y');

                                                ?>
                                                @if(strtotime($dateExpiry) <= strtotime($day) && $order->type != 'package')
                                                <span class="text-right" style="font-size:10px"><b
                                                            style="color:#ff0000">valid till: </b>{{ $dateExpiry }}</span>
                                                @else
                                                <span class="text-right" style="font-size:10px"><b
                                                            style="color:#ccc">valid till: </b>{{ $dateExpiry }}</span>

                                                @endif
                                                @if(!empty($order['gig']) OR !empty($order['package']) )
                                                <br>
                                                <span style="font-size: 14px">{{ (($order->type == 'gig') ? $order['gig']->title : (($order->type == 'package') ? $order['package']->title : '' ))  }}</span>
                                                @endif
                                                <input type="hidden" class="hidd-order"
                                                       value="{{ $order->order_no }}">
                                            </a>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                            @if(!empty($completedOrders) && count($completedOrders) > 0 && !$status)
                                            @foreach($completedOrders as $order)


                                            <a href="{{ route('getmyorder', [$order->order_no]) }}"
                                               class="list-group-item">
                                                {{ (($order->type == 'gig') ? $order->order_no : (($order->type == 'package') ? $order->order_no  : ($order->type == 'custom') ? $order->order_no : ''))  }}

                                                <?php
                                                $expiry = explode(' ', $order->expiry);
                                                $dateExpiry = explode('-', $expiry[0]);
                                                $dateExpiry = $dateExpiry[2] . '-' . $dateExpiry[1] . '-' . $dateExpiry[0];
                                                $day = date('d-m-Y');

                                                ?>
                                                @if(strtotime($dateExpiry) >= strtotime($day) && $order->status != 'complete' && $order->type != 'package')

                                                <span class="text-right" style="font-size:10px"><b
                                                            style="color:#ff0000">valid till: </b>{{ $dateExpiry }}</span>
                                                @else
                                                <span class="text-right" style="font-size:10px"><b
                                                            style="color:#ccc">valid till: </b>{{ $dateExpiry }}</span>

                                                @endif
                                                <br>
                                                @if(!empty($order['gig']) OR !empty($order['package']) OR $order['custom'])
                                                <span style="font-size: 14px">{{ (($order->type == 'gig') ? $order['gig']->title : (($order->type == 'package') ? $order['package']->title : ($order->type == 'custom') ? "Your individual inquiry" : ''))}}</span>
                                                @endif
                                            </a>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="custom">
                                            @if(!empty($customOrders) && !$status)
                                            @foreach($customOrders as $order)


                                            <?php
                                            $expiry = explode(' ', $order->created_at);
                                            $dateExpiry = explode('-', $expiry[0]);
                                            $dateExpiry = $dateExpiry[2] . '-' . $dateExpiry[1] . '-' . $dateExpiry[0];
                                            $day = date('d-m-Y');

                                            ?>
                                            <a href="{{ route('getmyorder', [$order->order_no]) }}"
                                               class="list-group-item">
                                                @if($order->status == 'jobdone')
                                                <span class="myorders-list-item-status job-done-assets one">Finished</span>
                                                @elseif($order->status == 'review')
                                                <span class="myorders-list-item-status job-done-assets one">modification</span>
                                                @elseif($order->orderStatus->status == 'offered')
                                                <span class="myorders-list-item-status job-done-assets">offer!</span>
                                                @endif
                                                {{ $order->order_no }}
                                                <span class="text-right" style="font-size:10px"><b
                                                            style="color:#ccc">valid till:</b>{{ $dateExpiry }}</span><br>
                                                <span style="font-size: 14px">@if($order->type == 'custom')
                                                                    Your individual inquiry
                                                                @endif</span>
                                            </a>
                                            @endforeach
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xs-12" id="workstream-right_pannel">
                    @if(Session::has('status') OR Session::has('order'))
                    <div class="alert alert-success desktop-alert" style="text-align: center;">
                        {{ Session::get('status') }} <br>

                        Your reference number:
                        {{Session::get('order')}}
                    </div>
                    @endif
                    @if(Session::has('complete') OR Session::has('ordercomplete'))
                    <div class="alert alert-success desktop-alert"
                         style="width: 512px; float: right; margin-right: 202px; text-align: center;">
                        {{ Session::get('complete') }} <br>

                        {{Session::get('ordercomplete')}}
                    </div>
                    @endif
                    <div class="col-md-12 col-xs-12 text-center" id="right-ubox-img">
                        <img src="img/please.png" alt="">
                    </div>
                    <div class="col-md-8 col-xs-12 right-ubox" id="chat-conversation">
                        <div class="pane-head col-md-12 text-center">
                            <span class="badge liferung-badge"></span>
                            <div class="upr-wind">
                                <div class="days" style="color: #ffb3c1 !important;">
                                    <div class="dy" style="color: #ffb3c1 !important;">
                                        00
                                    </div>
                                    days
                                </div>
                                <div class="hours">
                                    <div class="hr">
                                        00
                                    </div>
                                    HOURS
                                </div>
                                <div class="minutes">
                                    <div class="mint">
                                        00
                                    </div>
                                    Minutes
                                </div>
                                <div class="seconds">
                                    <div class="sec">
                                        00
                                    </div>
                                    Second
                                </div>
                            </div>
                            <span class="badge danger red" id="late-order" style="display:none;">Late order</span>
                        </div>
                        <div class="col-md-12 rating-box-container"><input class="rating" type="text" data-min="0"
                                                                           data-max="5" data-step="1"></div>
                        <div class="chat-window col-md-12">
                            <div class="alert alert-success alert-dismissible job-done-wrapper">
                                <h4 id="message"><i class="icon fa fa-check"></i> Your order is with status
                                    "finish"
                                    Has been marked!</h4>
                                <span style="margin-bottom: 15px" id="message2">If you want a change click on "Change wanted" or confirm the order as "finish"
</span>
                                <span style="margin-bottom: 15px; display:none;"
                                      id="message3">"Change wanted"
</span>
                                <br>
                                <div>
                                    <form class="message-alert-box" method="post"
                                          action="{{ route('order.acknowledge') }}" id="completeorder">
                                        <input type="hidden" name="order-no" class="input-order-no">
                                        <button type="submit" class="btn btn-primary">finish</button>
                                    </form>
                                    <form class="message-alert-box" id="formAskForModification" method="post"
                                          action="{{ route('order.askformodification') }}">
                                        <input type="hidden" name="order-no" class="input-order-no">
                                        <button type="submit" name="askForModification" class="btn btn-primary">
                                            Change desired
                                        </button>
                                    </form>
                                    <p style="display: none;" id="request">
                                        Your request for amendment has been
                                        Posted</p>
                                </div>
                            </div>
                            {{-- <div class="alert alert-success alert-dismissible custom-order-wrapper">
                                <h4><i class="icon fa fa-check"></i> Angebot für Ihre individuelle Anfrage!</h4>
                                <br>
                                <div>
                                    <button id="paypal-btn" type="button" name="pay-now" class="btn btn-primary" data-toggle="modal" data-target="#paymentConfirmationModal">jetzt bezahlen mit Paypal</button>
                                </div>
                            </div>--}}
                            {{--<div class="upr-wind text-center">
                                <div class="days">
                                    <div class="dy">
                                        00
                                    </div>
                                    TAGE
                                </div>
                                <div class="hours">
                                    <div class="hr">
                                        00
                                    </div>
                                    STUNDEN
                                </div>
                                <div class="minutes">
                                    <div class="mint">
                                        00
                                    </div>
                                    MINUTEN
                                </div>
                                <div class="seconds">
                                    <div class="sec">
                                        00
                                    </div>
                                    SEKUNDEN
                                </div>
                            </div>--}}

                            <div class="zg-chat-box-list">
                            </div>


                        </div>
                        <div class="modal fade" id="progressDialog" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Please wait while we update your topic. You will be redirected
                                            automatically!</p>

                                        <div class="progress progress-striped active">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div class="col-xs-12 chat-text-box-block form-control">
                            <form method="post" id="order-messaging-form"
                                  action="{{ route('order.post.message') }}">
                                <div class="col-md-12 col-xs-12 zero-padd">
                                    <input type="hidden" name="order-no" class="input-order-no">
                                    <input type="file" name="dropfiles[]" class="dropfiles" style="display: none;">
                                    <textarea name="message" id="chat-admin-message-text" cols="100" rows="8"
                                              placeholder="Please enter your message here......"
                                              class="orm-control send-message pull-left txtMessage input-shadowy"
                                              draggable="false"></textarea>

                                    <button  type="submit" value="Send" id="submitbtn" class="custom-margin-top-for-pakage-btn a-button a-button-override-for-gig btn-get-this-gig custom-css-for-send-btn">
                                        <i style="font-size:24px; " class="fa">&#xf1d9;</i> Send
                                    </button>

                                    <div class="col-md-3 dropbox-btn" style="text-align: right;">

                                    </div>

                                    <div id="content">
                                        <!-- Example 2 -->
                                        <div class="testDrive">
                                            <input type="file" name="files[]" id="filer_input2">
                                            <!-- end of Example 2 -->
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="{{  \Illuminate\Support\Facades\Auth::user()->get()->id }}">
                                <div class="row buttons-row">
                                    <div class="col-md-4 pull-right text-left " style="padding:0px;     bottom: 70px;">

                                        <!-- <button type="submit" id="submitbtn" class="btn btn-primary" value="Send" style="width: 15%;">
                                             <i style="font-size:24px" class="fa">&#xf1d9;</i>
                                         </button> -->
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-4 col-xs-12" id="details-box" style="display:none;">
                        <div class="chat-box">
                            <div class="info-part gig_info">
                                <h4 class="custom-link-color">Order detail</h4>
                            </div>
                            <div class="chat">

                                <h4 style="font-size: 16px;">Your Order
                                </h4>
                                <table style="border:none;">
                                    <tr>
                                        <td class="left">Order number
                                            :</td>
                                        <td class="right" colspan="2"><span class="innertext-order-no"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="left">order:</td>
                                        <td class="right" colspan="2" id="orderAmout"></td>
                                    </tr>
                                    <tr>
                                        <td class="left">order date
                                            :</td>
                                        <td class="right" colspan="2">
                                            <div id="orderDate"></div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="gigAddon">
                                    <h4 style="font-size: 16px;">Gigs description</h4>
                                    <table style="border:none;">
                                        <tr>
                                            <td class="left">Gigs Title:</td>
                                            <td class="right" colspan="2" id="gigName"></td>
                                        </tr>
                                        <tr>
                                            <td class="left">Addons:</td>
                                            <td class="right">
                                                <div id="gigAddons"></div>
                                            </td>
                                            <td class="right" colspan="2">
                                                <div id="hello"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="package" style="word-break: break-all;">
                                    <h4 style="font-size: 16px;"><span>Package Info</span></h4>
                                    <table class="table">
                                        <tr>
                                            <td class="left">Package Name:</td>
                                            <td class="right" colspan="2"><span id="packageName"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="left">Sub Package Name:</td>
                                            <td class="right" colspan="2"><span id="subpackageName"></span></td>
                                        </tr>
                                    </table>
                                    <h4 style="font-size: 16px;"><span>description</span></h4>
                                    <table class="table">
                                        <tr>
                                            <td class="right"><span id="packagedesc"></span></td>
                                        </tr>
                                    </table>
                                    <h4 style="font-size: 16px;"><span>details</span></h4>
                                    <table class="table">
                                        <tr>
                                            <td class="left"><span><i class="fa fa-clock-o" aria-hidden="true" style="color: #367fa9; margin-right: 5px;"></i></span>days:</td>
                                            <td class="right" colspan="2"><span id="packagedays"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><span><i class="fa fa-pencil" aria-hidden="true" style="color: #367fa9; margin-right: 5px;"></i></span>amendments:</td>
                                            <td class="right" colspan="2"><span id="packagerevision"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><span><i class="fa fa-check-circle-o" aria-hidden="true" style="color: #367fa9; margin-right: 5px;"></i></span>source file:</td>
                                            <td class="right" colspan="2"><span id="packagesource"></span></td>
                                        </tr>
                                    </table>
                                    <hr>
                                </div>
                                <div class="otherOrder">
                                    <h4 style="font-size: 16px;"><span>Description</span></h4>
                                    <table style="border:none;">
                                        <tr style="display:none;">
                                            <td class="left">Company Name:</td>
                                            <td class="right" id="companyName" colspan="2"></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td class="left">Tagline:</td>
                                            <td class="right" id="companyTagline" colspan="2"></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td class="left">Industry:</td>
                                            <td class="right" id="companyIndustry" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="left">Description:</td>
                                            <td class="right" id="companyDescription" colspan="2"></td>
                                        </tr>
                                    </table>
                                    <hr>
                                </div>


                                <div ng-repeat="question in order.ques_ans">
                                    <h4><?= '{{ question.question }}' ?></h4>

                                    <p style="font-size:16px;color:#7b7b7b;"><?= '{{ question.answers }}' ?></p>
                                    <hr>
                                </div>
                                <div class="col-xs-12" id="rate-show-finish" style="display:none;">
                                    <h4>Your application</h4>
                                    <a href="" class="order-rating" data-id="1">
                                        <img src="img/cnerr-rating/angry1.png" alt="" width="15%"
                                             onmouseover="this.src='img/cnerr-rating/angry.png';"
                                             onmouseout="this.src='img/cnerr-rating/angry1.png';">
                                    </a>
                                    <a href="" class="order-rating" data-id="2">
                                        <img src="img/cnerr-rating/sad1.png" alt="" width="15%"
                                             onmouseover="this.src='img/cnerr-rating/sad.png';"
                                             onmouseout="this.src='img/cnerr-rating/sad1.png';">
                                    </a>
                                    <a href="" class="order-rating" data-id="3">
                                        <img src="img/cnerr-rating/confused1.png" alt="" width="15%"
                                             onmouseover="this.src='img/cnerr-rating/confused.png';"
                                             onmouseout="this.src='img/cnerr-rating/confused1.png';">
                                    </a>
                                    <a href="" class="order-rating" data-id="4">
                                        <img src="img/cnerr-rating/happy1.png" alt="" width="15%"
                                             onmouseover="this.src='img/cnerr-rating/happy.png';"
                                             onmouseout="this.src='img/cnerr-rating/happy1.png';">
                                    </a>
                                    <a href="" class="order-rating" data-id="5">
                                        <img src="img/cnerr-rating/heart1.png" alt="" width="15%"
                                             onmouseover="this.src='img/cnerr-rating/heart.png';"
                                             onmouseout="this.src='img/cnerr-rating/heart1.png';">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('includes.footer')
    </div>
</div>
<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="m5skdtt16r6y8lh"></script>

<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
<script src="{{ asset('bower_components/jquery.countdown/dist/jquery.countdown.js') }}"></script>


<script type="text/javascript">
    $('#ex1').bootstrapSlider({
        tooltip: 'hide'
    });

    $('#ex2').bootstrapSlider({
        tooltip: 'hide'
    });
    $('#ex3').bootstrapSlider({
        tooltip: 'hide'
    });
    $('#ex4').bootstrapSlider({
        tooltip: 'hide'
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        /*$(".gig_info").click(function () {
         $(".chat").slideToggle();
         });*/
        /*$('.chat-box-toggle').click(function(){
         $('.zg-chat-box-list').slideToggle();
         });*/
        $('#paypal-btn').click(function () {
            $('#paymentConfirmationModal').modal('show');
        });
        $('.txtMessage').keyup(function () {
            $('.senden-btnn').removeAttr("disabled");
        });
        $("#snd_compl").on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            var formdata = new FormData();
            var ordernumber = $("#order_number").val();
            var com_txt = $("#complt_txt").val();
            formdata.append("complt_txt",com_txt);
            formdata.append("order_no",ordernumber);
            $.ajax({
                url: "{{ route('order.complaint') }}",
                method: 'post',
                data: formdata,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success : function(data){
                    $("#myModal1").modal('hide');
                    $.notify({
                        // options
                        message: '"Many Thanks. We have received your message. We will immediately look into it.'
                    }, {
                        // settings
                        placement: {
                            from: 'top',
                            align: 'center'
                        },
                        type: 'success'
                    });
                }
            })
        });
    });
</script>
<script>

    var count = 0;
    var global_order_no = 0;
    var drop_file = new Array();

    (function () {

        $('#search_orders').on('keydown', function () {

            if ($(this).val().length > 0) {
                $('.showAll').css('display', 'block');
            }
            else {
                $('.showAll').css('display', 'none');
            }
        });

        $('.showAll').on('click', function () {

            var tab = $('ul.nav-tabs li.active').text();

            var currentTab = $('.myorder-links-items').find('.active').attr('id');

            $.ajax({
                type: 'get',
                url: 'https://www.4slash.com/showSelectedOrders',
                data: 'type=' + tab,
                success: function (res) {

                    if (res.length > 0) {


                        var _html = '';
                        for (var i = 0; i < res.length; i++) {

                            _html += '<a href="https://www.4slash.com/order/' + res[i].order_no + '" class="list-group-item active">';

                            if (res[i].status == 'jobdone') {
                                $('.job-done-assets').show();
                            }
                            else
                                $('.job-done-assets').hide();
                            /*if (res[i].status == 'jobDone') {

                             _html += '<span class="myorders-list-item-status job-done-assets"><i class="icon fa fa-check"></i> job done</span>';

                             }*/
                            _html += res[i].order_no;
                            _html += '</a>';

                        }

                        $('#' + currentTab).empty().html(_html);

                    }


                },
            });

            $('#search_orders').val('');
            $(this).css('display', 'none');


        });


    })();


</script>


<script>
    (function () {
        $('#search_orders').on('keyup', function (e) {
            var key = e.which || e.keyCode;
            e.preventDefault();

            if (key === 13) {

                var keyword = $(this).val();

                var tab = $('ul.nav-tabs li.active a').attr('href');
                var url = $(this).closest('form').attr('action');

                var currentTab = $('.myorder-links-items').find('.active').attr('id');

                $.ajax({
                    type: 'post',
                    url: "{{ route('orders.search') }}",
                    data: {keyword : keyword, type:tab},
                    success: function (res) {
                        if (res.length > 0) {

                            var _html = '<a href="https://www.4slash.com/order/' + res[0].order_no + '" class="list-group-item">';


                            if (res.status == 'jobdone')
                                $('.myorders-list-item-status').show();
                            else
                                $('.myorders-list-item-status').hide();


                            _html += res[0].order_no;
                            _html += '</a>';

                            $('#' + currentTab).empty().html(_html);
                        }
                        else {
                            alert('Sorry! no record found');
                        }


                    },
                });
                return false;
            }

            return false;
        });
    })();
</script>
<script src="{{ asset('js/jquery.filer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
<script>
    (function () {
        $("#saveButton").click(function () {
            $('#progressDialog').modal('show');

            var updateForm = document.querySelector('form');
            var request = new XMLHttpRequest();

            request.upload.addEventListener('progress', function (e) {
                var percent = Math.round((e.loaded / e.total) * 100);

                $('.progress-bar').css('width', percent + '%');
                $('.sr-only').html(percent + '%');


            }, false);

            request.addEventListener('load', function (e) {
                var jsonResponse = JSON.parse(e.target.responseText);
                if (jsonResponse.errors) {
                    console.log(jsonResponse.errors);
                }
                else {
                    $('#progressDialog').modal('hide');
                }
            }, false);
        });
        var button = Dropbox.createChooseButton(
            options = {

                // Required. Called when a user selects an item in the Chooser.
                success: function(files) {
//                    drop_file = files[0].link;
//                    $(".dropfiles").val(files[0].link)
                    files.forEach(function(data){
                        drop_file.push(data.link);
                    })
                },

                // Optional. Called when the user closes the dialog without selecting a file
                // and does not include any parameters.
                cancel: function() {

                },

                // Optional. "preview" (default) is a preview link to the document for sharing,
                // "direct" is an expiring link to download the contents of the file. For more
                // information about link types, see Link types below.
                linkType: "preview", // or "direct"

                // Optional. A value of false (default) limits selection to a single file, while
                // true enables multiple file selection.
                multiselect: true, // or true

                // Optional. This is a list of file extensions. If specified, the user will
                // only be able to select files with these extensions. You may also specify
                // file types, such as "video" or "images" in the list. For more information,
                // see File types below. By default, all extensions are allowed.
                extensions: ['.pdf', '.doc', '.docx','.png','.jpeg','.ai','.txt','.gif','.zip','.rar','.psd','.xlsx','.xps'],
            }
        );
        document.getElementsByClassName("dropbox-btn")[0].appendChild(button);
        $('#order-messaging-form').on('submit', function (event) {
            var filerKit = $("#filer_input2").prop("jFiler");
            var file_name = [];
            //console.log(filerKit.files_list[0]);
            var files = new Array();
            filerKit.files_list.forEach(function (data) {
//                   console.log(data.file.name);
                files.push(data.file.name);
            });
            event.preventDefault();
            var btnSubmit = $(this).find('button[type=submit]');
            var form = this;
            btnSubmit.attr('disabled', 'disabled');
            var order_no = $(".input-order-no").val();
            var txtMessage = $('.txtMessage').val();
            /*var drop_files = $('.dropfiles').val();*/
            var formData = new FormData();
            formData.append('order-no',order_no);
            formData.append('message',txtMessage);
            formData.append('files', files);
            formData.append('dropfiles', drop_file);
            $.ajax({
                url: form.action,
                method: 'post',
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                beforeSend: function (xhr) {
                    $('.loading').show();
                },
                success: function (data) {
                    $('.selected-file').empty();
                    $('#order-message-file-selector').val('');
                    $('.txtMessage').val('');
                    $('.loading').hide();
                    filerKit.reset();
                    var user_img = $('.header-user img').attr('src');
                    if (!user_img) {
                        var user_char = $('.user_icon').text();
                        user_img = '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;">' +
                            '<span style="position:absolute;left:50%;top:58%;transform:translate(-50%, -50%);font-size:30px;color:white; text-transform:capitalize">' + user_char + '</span></div>';
                    }
                    else {
                        user_img = '<img src="' + $('.header-user img').attr('src') + '" class="img-circle">';
                    }
                    /*console.log(data);*/
                    var elem = $('<div class="chat-box3">' + user_img +
                        '<div class="chat3"><p><strong>' + data.user + '</strong></p><p></p>' +'<pre>'+ data.message +'</pre><p></p>'+ '</div>' +
                        '</div>');

                    $('.zg-chat-box-list').append(elem);
                    txtMessage.value = "";

                    btnSubmit.removeAttr('disabled');
                    $(".zg-chat-box-list").scrollTop($(".zg-chat-box-list")[0].scrollHeight);
                },
                error: function () {
                    btnSubmit.removeAttr('disabled');
                    btnSubmit.value = "";
                }

            });
        });

        document.getElementById('formAskForModification').addEventListener('submit', function (e) {
            e.preventDefault();

            var form = this;
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {

                    if (data.status) {

                        notifyMessage(data.msg, 'success');

                    }
                },
                error: function () {
                    console.log('something went wrong please try again later.');
                }
            });
            $(form).hide();
            $("#completeorder").hide();
            $("#request").html('Change desired');
            $("#message").hide();
            $("#message2").hide();
            $("#message3").show();
            $(".one").html("Change desired");
            $(".two").html("Change desired");

        });
        $('#order-message-file-selector').on('change', function (e) {

            if (e.target.files.length > 0 || e.srcElement.files.lenght > 0) {

                $('.selected-file').html(e.target.files[0].name);
                $('.file_icon').show();
                $('.send-btnn').show();
            }
            else {

                $('.selected-file').html('');
                $('.send-btnn').hide();
            }
        });


        $(document).on('click','.list-group-item', function (e) {
            e.preventDefault();
            // var link = e.srcElement || e.target;
            //alert(link.href);

            $('html, body').animate({
                scrollTop: $("#chat-conversation").offset().top
            }, 1000);

            var link = $(this).attr('href');

            if ($(this).attr("href") == link || $(this).attr("href") == '') {

                $('.tab-pane').find('.active').removeClass('active');

                $(this).addClass("active");
            }

            $.ajax({
                url: link,
                method: 'get',
                success: function (data) {
                    count = data.message_count;
                    $('#right-ubox-img').hide();
                    $("#details-box").show();
                    $('.right-ubox').show();
                    $('.left-ubox').css('border', 'none');
                    if (data.status == 'jobdone')
                        $('.job-done-wrapper').show();
                    else
                        $('.job-done-wrapper').hide();

                    /* if(data.customOrder.status == 'offered')
                     $('.custom-order-wrapper').show();

                     else
                     $('.custom-order-wrapper').hide();*/

                    var order_no = document.querySelectorAll('.input-order-no');

                    [].forEach.call(order_no, function (orderNoInput) {
                        orderNoInput.value = data.order_no;
                        global_order_no = data.order_no;
                    });

                    var orderNoInnerTextList = document.querySelectorAll('.innertext-order-no');
                    $('.innertext-order-no').text(data.order_no);
                    [].forEach.call(orderNoInnerTextList, function (orderNoInnerText) {
                        orderNoInnerText.innerText = data.order_no;
                    });
                    var gigamount = data.amount;
                    var service_charges = data.service_charges;
                    var amounttotal = (parseFloat(gigamount));

                    if (data.type == 'package') {
                        $('.package').show();
                        $('.otherOrder').hide();
                        $('#packageName').html(data.package.title);
                        $('#subpackageName').html(data.sub_package_name);
                        $('#packagedesc').html(data.sub_package_desc);
                        if(data.package_days > 0) {
                            $('#packagedays').html(data.package_days);
                        }else{
                            $('#packagedays').html();
                        }
                        if(data.pack_revisions > 0){
                            $('#packagerevision').html(data.pack_revisions);
                        }else{
                            $('#packagerevision').html("No changes");
                        }

                        if(data.pack_source == null){
                            $('#packagesource').html("-");
                        }else {
                            $('#packagesource').html(data.pack_source);
                        }
                    }
                    else {
                        $('.package').hide();
                        $('.otherOrder').show();
                    }
                    $('#companyName').html(data.company_name);
                    if (data.type != 'custom' && data.type != 'package') {
                        $('.gigAddon').show();
                        $('#gigName').html(data.gig.title);
                        var gigAddons = '';
                        var totaladdons = data.orderAddon.length;

                        data.orderAddon.forEach(function (element, index, araay) {

                            var addon = '<p>' + data.orderAddon[(parseInt(totaladdons) - (parseInt(index) + 1))].addon + '</p>';
                            gigAddons += addon;
                        });
                        $('#gigAddons').html(gigAddons);
                    }
                    else {
                        $('.gigAddon').hide();
                    }
                    $('#companyTagline').html(data.company_tagline);
                    $('#companyIndustry').html(data.company_industry);
                    $('#orderAmout').html("&euro;" + parseFloat(amounttotal).toFixed(2));
                    var comp_desc = "<div style='width:140px;height:85px;overflow:auto;word-break: break-all;'>"+data.company_discription+"</div>";
                    $('#companyDescription').html(comp_desc);
                    $('#orderDate').html(data.date);
                    $("#order_number").val(data.order_no);
                    var messages = '';
                    var totalMessages = data.messages.length;

                    data.messages.forEach(function (element, index, array) {

                        var msg_status = data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].message_status;

                        if (msg_status == 'offered' || msg_status == 'offer_accepted') {
                            var offerClass = 'chat-box-offer';
                        }
                        else {
                            var offerClass = '';
                        }

                        if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me')) {
                            var message = '<div class="chat-box3" style="margin:10px;">'
                                + ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image != null) ? '<img src="' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image + '" class="img-circle">' : '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;"><span style="position:absolute;left:50%;top:58%;transform:translate(-50%, -50%);font-size:30px;color:white;">' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from_user_name_first_char + '</span></div>')
                                + ('<div class="chat3" style="word-wrap: break-word">');
                        }
                        else if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'him')) {
                            var message = ('<div class="chat-box2 ">')
                                + ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image != null) ? '<img src="' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image + '" class="img-circle">' : '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;"><span style="position:absolute;left:50%;top:58%;transform:translate(-50%, -50%);font-size:30px;color:white;">' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from_user_name_first_char + '</span></div>')
                                + ('<div class="chat2 ' + offerClass + '">');

                        }
                        if (msg_status == 'offered') {
                            $('.custom-order-wrapper').append(element);
                            message += '<h3 class="text-center">Offer for your individual inquiry</h3>'
                                + '<div class="row"><div class="col-md-12"><p><strong>Description:</strong>'
                                + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>'
                                + '<p><span class="pull-left"><strong>Price: </strong><span class="custom_amount">' + data.customOrder.amount_offer + '</span></span>'
                                + '<span class="pull-right"><strong>Delivery time: </strong>' + data.customOrder.total_days + '</p></div>'
                                + '<div class="col-md-12"><p class="text-center"><button id="paypal-btn" type="button" name="pay-now" class="btn btn-primary" data-toggle="modal" data-target="#paymentConfirmationModal">Pay now with Paypal</button></p></div></div>'

                            $('.gig-amount').html(currencyType + data.customOrder.amount_offer);
                            $('.message_id').val(data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].id);
                            $('.total_order_amount').val(data.customOrder.amount_offer);
                            $('.custom_order_products').html(data.custom_order_products);
                            $('.custom_order_products').val(data.custom_order_products);
                            $('.order_uuid').val(data.uuid);
                            $('.total_days').val(data.customOrder.total_days);
                            var processingFees = parseFloat((data.customOrder.amount_offer * 5.5) / 100).toPrecision(3);
                            var netTotal = parseFloat(Math.round(data.customOrder.amount_offer) / (1 + 19 / 100)).toFixed(2);
                            var taxIncluded = (parseFloat(data.customOrder.amount_offer) - parseFloat(netTotal)).toPrecision(4);

                            document.querySelector('#NetTotal').textContent = currencyType + parseFloat(netTotal).toFixed(2);
                            document.querySelector('#taxIncluded').textContent = currencyType + parseFloat(taxIncluded).toFixed(2);
                            document.querySelector('#processingFees').textContent = currencyType + parseFloat(processingFees).toFixed(2);
                            document.querySelector('#FinalAmount').textContent = currencyType + parseFloat(parseFloat(data.customOrder.amount_offer) + parseFloat(processingFees)).toFixed(2);
                        }
                        else if (msg_status == 'offer_accepted') {
                            message += '<h3 class="text-center">You have accepted the Offer</h3>'
                                + '<div class="row"><div class="col-md-12"><p><strong>Description: </strong>'
                                + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>'
                                + '<p><span class="pull-left"><strong>Price: </strong><span class="custom_amount">' + data.customOrder.amount_offer + '</span></span>'
                                + '<span class="pull-right"><strong>Delivery time </strong>' + data.customOrder.total_days + '</p></div>'
                        } else {
                            if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me')) {
//                                    console.log(data.messages);
                                message += '<p><strong>' + data.user + '</strong></p>'

                            }
                            else if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'him')) {
                                /*message += '<p><strong>' + data.admin + '</strong></p>'*/
                                message += '<p><strong>4slash Team</strong></p>'
                            }
                            message += '<p>' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>';
                        }

                        message += '</div>'
                            + '</div>';

                        messages += message;
                    });


//                        console.log(data.message_count);
//                    console.log(data.messages);
                    document.querySelector('.zg-chat-box-list').innerHTML = messages;
                    $(".zg-chat-box-list").scrollTop($(".zg-chat-box-list")[0].scrollHeight);
                    if (data.status == 'complete' || data.status == 'cancel') {
                        $('.chat-text-box-block').hide();
                        //alert(data.order_details[0].);
                        var feedback = data.order_details;
                        if (feedback === null) {
                            $("#rate-show-finish").show();
                            // alert(data.order_details[0]);
                        } else {
                            $("#rate-show-finish").hide();
                        }
                        $(".chat-window").css("min-height","755px");

                    }
                    else {
                        $('.chat-text-box-block').show();
                        $("#rate-show-finish").hide();
                        $(".chat-window").css("min-height","562px");

                    }

                    if (data.status != 'cancel' && data.status != 'complete') {
                        $('.upr-wind').show();
                        //console.log(data);
                        var no_of_days = 0;
                        if('gigAddon' in data){
                            data.gigAddon.forEach(function(element,index,array){
                                if(element.addon == "Expresslieferung") {
                                    no_of_days = element.day;
                                }else{
                                    no_of_days = 0;
                                }
                            });
                        }
                        if(data.type != "package" && data.type !="custom") {
                            if(data.orderAddon.length > 0) {
                                //console.log("here");
                                data.orderAddon.forEach(function (element, index, array) {
                                    //console.log(no_of_days);
                                    if (no_of_days > 0) {
                                        var someDate = new Date(data.created_at);
                                        someDate.setDate(someDate.getDate() + no_of_days);
                                        var dd = someDate.getDate();
                                        var mm = ( '0' + (someDate.getMonth()+1) ).slice( -2 );
                                        var y = someDate.getFullYear();
                                        var dt = data.expiry;
                                        var t = data.expiry.split(/[- :]/);
                                        var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                                        var time = t[3] + ":" + t[4] + ":" + t[5];
                                        var expiry = y + '-' + mm + '-' + dd +" "+ time;
                                        var diff = 360 - (new Date().getTimezoneOffset());
                                        var expiry = moment.tz(expiry, "Europe/Berlin");
                                        $('.upr-wind').countdown(expiry.toDate(), {elapse: true}).on('update.countdown', function (event) {

                                            var $this = $(this);
                                            if (event.elapsed) {
                                                $this.html(event.strftime('<div class="days expire-date"><div class="dy">%D</div>days</div><div class="hours expire-date"><div class="hr">%H</div>hours</div><div class="minutes expire-date"><div class="mint">%M</div>minutes</div><div class="seconds expire-date"><div class="sec">%S</div>Sekunden</div>'));
                                                $("#late-order").show();
                                            } else {
                                                $this.html(event.strftime('<div class="days"><div class="dy">%D</div>days</div><div class="hours"><div class="hr">%H</div>hours</div><div class="minutes"><div class="mint">%M</div>minutes</div><div class="seconds"><div class="sec">%S</div>Second</div>'));
                                                $("#late-order").hide();
                                            }
                                        });
                                    }
                                });
                            }else{
                                var expiry = moment.tz(data.expiry, "Europe/Berlin");
                                $('.upr-wind').countdown(expiry.toDate(), {elapse: true}).on('update.countdown', function (event) {
                                    var $this = $(this);
                                    if (event.elapsed) {
                                        $this.html(event.strftime('<div class="days expire-date"><div class="dy">%D</div>days</div><div class="hours expire-date"><div class="hr">%H</div>hours</div><div class="minutes expire-date"><div class="mint">%M</div>minutes</div><div class="seconds expire-date"><div class="sec">%S</div>Second</div>'));
                                        $("#late-order").show();
                                    } else {
                                        $this.html(event.strftime('<div class="days"><div class="dy">%D</div>days</div><div class="hours"><div class="hr">%H</div>hours</div><div class="minutes"><div class="mint">%M</div>minutes</div><div class="seconds"><div class="sec">%S</div>Second</div>'));
                                        $("#late-order").hide();
                                    }
                                });
                            }
                        }else{
                            var expiry = moment.tz(data.expiry, "Europe/Berlin");
                            $('.upr-wind').countdown(expiry.toDate(), {elapse: true}).on('update.countdown', function (event) {
                                var $this = $(this);
                                if (event.elapsed) {
                                    $this.html(event.strftime('<div class="days expire-date"><div class="dy">%D</div>days</div><div class="hours expire-date"><div class="hr">%H</div>hours</div><div class="minutes expire-date"><div class="mint">%M</div>minutes</div><div class="seconds expire-date"><div class="sec">%S</div>Second</div>'));
                                    $("#late-order").show();
                                } else {
                                    $this.html(event.strftime('<div class="days"><div class="dy">%D</div>days</div><div class="hours"><div class="hr">%H</div>hours</div><div class="minutes"><div class="mint">%M</div>minutes</div><div class="seconds"><div class="sec">%S</div>Second</div>'));
                                    $("#late-order").hide();
                                }
                            });
                        }
                        $(".liferung-badge").html("Delivery in:");
                    }
                    else {
                        $('.upr-wind').hide();
                        $(".liferung-badge").html("");
                    }
                }

            });
        });



        var totalfilesize = 0;
        var swif = '{{ url('uploadify.swf') }}';
        var action = '{{ route('usermessageimages') }}';
        var obj = new Object();
        //var orderno = $(this).find('input').val();
        //var orderno = '2016102831DD';
        var session = '{{  \Illuminate\Support\Facades\Auth::user()->get()->id }}';
        var message = '';
        var new_mes = '';
        var _validFileExtensions = ['.jpg', '.jpeg', '.gif', '.png', '.doc', '.pdf', '.zip', '.eps'];
        message = $('textarea#chat-admin-message-text').val();

        $("#chat-admin-message-text").on('mousedown mouseup click focus blur', function () {
            message = $(this).val();

            //alert(message);
            if (message != '') {
                new_mes = message;
            }
            else {
                new_mes = '';
            }
        });

        function chkfilesize(totalfilesize) {
            $('#queueSize').html(((totalfilesize / 1024) / 1024).toFixed(2) + 'MB');
            if (totalfilesize > 1024 * 1024 * 30) {
                $('#fileerror').html('File Size exceeds 30MB');
                $('#fileerror').show();
                $('#submitbtn').attr("disabled", 'disabled');
            } else {
                $('#fileerror').html('');
                $('#fileerror').hide();
                $('#submitbtn').prop("disabled", false);
            }

        }

        /*$('#submitbtn').bind('click', function (e) {
            e.preventDefault();
            global_order_no = $('.innertext-order-no').text();
            var validatefileresp = validatefile();
            if (new_mes != '' && $("#queuesize").val() != 0) {
                if (validatefileresp === true) {
                    $('#file_upload').uploadify('upload', '*');

                }
            }
            else if (new_mes != '') {

                var action = $(this).closest('form').attr('action');
                var form = $(this).closest('form');
                //ev.preventDefault();
//                                console.log(new_mes);
                // var data = 'message='+ new_mes+'&receiver='+ nolibri;
                $.ajax({
                    url: action,
                    method: 'post',
                    data: {'message': new_mes, 'order-no': global_order_no},
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        $('.loading').show();
                    },
                    success: function (data) {
                        $('.selected-file').empty();
                        $('#order-message-file-selector').val('');
                        $('.txtMessage').val('');

                        $('.loading').hide();

                        var user_img = $('.header-user img').attr('src');

                        if (!user_img) {
                            var user_char = $('.user_icon').text();
                            user_img = '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;">' +
                                    '<span style="position:absolute;left:50%;top:58%;transform:translate(-50%, -50%);font-size:30px;color:white; text-transform:capitalize">' + user_char + '</span></div>';
                        }
                        else {
                            user_img = '<img src="' + $('.header-user img').attr('src') + '" class="img-circle">';
                        }

                        var elem = $('<div class="chat-box3" style="margin:10px;">' + user_img +
                                '<div class="ng-binding chat3" style="word-wrap: break-word"><p><strong>' + data.user + '</strong></p>' + data.message + '</div>' +
                                '</div>');

                        $('.zg-chat-box-list').append(elem);
                        $('#fileAttachment').val('');
                        $('#chat-admin-message-text').val('');
                        $('#fileAttachmentName').empty();
                        new_mes = '';
                    },
                    error: function () {

                    }

                });

            }
            else if ($("#queuesize").val() != 0 && new_mes == '') {
                if (validatefileresp === true) {
                    $('#file_upload').uploadify('upload', '*');

                }
            }
        });*/


        function validatefile() {
            if ($("#queuesize").val() == 0) {
                //formSubmit();
                $('#uploadedfiles').val('');
                $('#queuesize').val('0');
            } else {
                if (totalfilesize > 1024 * 1024 * 30) {
                    $('#fileerror').html('File Size exceeds 30MB');
                    return false;
                } else {
                    return true;
                }

            }

        }

        $('.left-ubox').addClass('left-ubox-width');


    })();
</script>


<script>
    $(document).ready(function () {
        var orderno = "{{ !empty($singleorder) ? $singleorder : '' }}";
        var link = '/order/' + orderno;
        $.ajax({
            url: link,
            method: 'get',
            success: function (data) {
                count = data.message_count;
                $('#right-ubox-img').hide();
                $("#details-box").show();
                $('.right-ubox').show();
                $("#order_number").val(orderno);
                $('.left-ubox').css('border', 'none');
                if (data.status == 'jobdone')
                    $('.job-done-wrapper').show();
                else
                    $('.job-done-wrapper').hide();

                /* if(data.customOrder.status == 'offered')
                 $('.custom-order-wrapper').show();

                 else
                 $('.custom-order-wrapper').hide();*/

                var order_no = document.querySelectorAll('.input-order-no');

                [].forEach.call(order_no, function (orderNoInput) {
                    orderNoInput.value = data.order_no;
                    global_order_no = data.order_no;
                });

                var orderNoInnerTextList = document.querySelectorAll('.innertext-order-no');
                $('.innertext-order-no').text(data.order_no);
                [].forEach.call(orderNoInnerTextList, function (orderNoInnerText) {
                    orderNoInnerText.innerText = data.order_no;
                });
                var gigamount = data.amount;
                var service_charges = data.service_charges;
                var amounttotal = (parseFloat(gigamount));

                if (data.type == 'package') {
                    $('.package').show();
                    $('.otherOrder').hide();
                    $('#packageName').html(data.package.title);
                    $('#subpackageName').html(data.sub_package_name);
                    $('#packagedesc').html(data.sub_package_desc);
                    if(data.package_days > 0) {
                        $('#packagedays').html(data.package_days);
                    }else{
                        $('#packagedays').html();
                    }
                    if(data.pack_revisions > 0){
                        $('#packagerevision').html(data.pack_revisions);
                    }else{
                        $('#packagerevision').html("No changes");
                    }

                    if(data.pack_source == null){
                        $('#packagesource').html("-");
                    }else {
                        $('#packagesource').html(data.pack_source);
                    }
                }
                else {
                    $('.package').hide();
                    $('.otherOrder').show();
                }
                $('#companyName').html(data.company_name);
                if (data.type != 'custom' && data.type != 'package') {
                    $('.gigAddon').show();
                    $('#gigName').html(data.gig.title);
                    var gigAddons = '';
                    var totaladdons = data.orderAddon.length;

                    data.orderAddon.forEach(function (element, index, araay) {

                        var addon = '<p>' + data.orderAddon[(parseInt(totaladdons) - (parseInt(index) + 1))].addon + '</p>';
                        gigAddons += addon;
                    });
                    $('#gigAddons').html(gigAddons);
                }
                else {
                    $('.gigAddon').hide();
                }
                $('#companyTagline').html(data.company_tagline);
                $('#companyIndustry').html(data.company_industry);
                $('#orderAmout').html("&euro;" + parseFloat(amounttotal).toFixed(2));
                var comp_desc = "<div style='width:140px;height:85px;overflow:auto;word-break: break-all;'>"+data.company_discription+"</div>";
                $('#companyDescription').html(comp_desc);
                $('#orderDate').html(data.date);

                var messages = '';
                var totalMessages = data.messages.length;

                data.messages.forEach(function (element, index, array) {

                    var msg_status = data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].message_status;

                    if (msg_status == 'offered' || msg_status == 'offer_accepted') {
                        var offerClass = 'chat-box-offer';
                    }
                    else {
                        var offerClass = '';
                    }

                    if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me')) {
                        var message = '<div class="chat-box3" style="margin:10px;">'
                            + ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image != null) ? '<img src="' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image + '" class="img-circle">' : '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;"><span style="position:absolute;left:50%;top:58%;transform:translate(-50%, -50%);font-size:30px;color:white;">' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from_user_name_first_char + '</span></div>')
                            + ('<div class="chat3" style="word-wrap: break-word">');
                    }
                    else if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'him')) {
                        var message = ('<div class="chat-box2 ">')
                            + ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image != null) ? '<img src="' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image + '" class="img-circle">' : '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;"><span style="position:absolute;left:50%;top:58%;transform:translate(-50%, -50%);font-size:30px;color:white;">' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from_user_name_first_char + '</span></div>')
                            + ('<div class="chat2 ' + offerClass + '">');

                    }
                    if (msg_status == 'offered') {
                        $('.custom-order-wrapper').append(element);
                        message += '<h3 class="text-center">Offer for your individual inquiry</h3>'
                            + '<div class="row"><div class="col-md-12"><p><strong>Description: </strong>'
                            + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>'
                            + '<p><span class="pull-left"><strong>Price: </strong><span class="custom_amount">' + data.customOrder.amount_offer + '</span></span>'
                            + '<span class="pull-right"><strong>Delivery time: </strong>' + data.customOrder.total_days + '</p></div>'
                            + '<div class="col-md-12"><p class="text-center"><button id="paypal-btn" type="button" name="pay-now" class="btn btn-primary" data-toggle="modal" data-target="#paymentConfirmationModal">Pay now with Paypal</button></p></div></div>'

                        $('.gig-amount').html(currencyType + data.customOrder.amount_offer);
                        $('.message_id').val(data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].id);
                        $('.total_order_amount').val(data.customOrder.amount_offer);
                        $('.custom_order_products').html(data.custom_order_products);
                        $('.custom_order_products').val(data.custom_order_products);
                        $('.order_uuid').val(data.uuid);
                        $('.total_days').val(data.customOrder.total_days);
                        var processingFees = parseFloat((data.customOrder.amount_offer * 5.5) / 100).toPrecision(3);
                        var netTotal = parseFloat(Math.round(data.customOrder.amount_offer) / (1 + 19 / 100)).toFixed(2);
                        var taxIncluded = (parseFloat(data.customOrder.amount_offer) - parseFloat(netTotal)).toPrecision(4);

                        document.querySelector('#NetTotal').textContent = currencyType + parseFloat(netTotal).toFixed(2);
                        document.querySelector('#taxIncluded').textContent = currencyType + parseFloat(taxIncluded).toFixed(2);
                        document.querySelector('#processingFees').textContent = currencyType + parseFloat(processingFees).toFixed(2);
                        document.querySelector('#FinalAmount').textContent = currencyType + parseFloat(parseFloat(data.customOrder.amount_offer) + parseFloat(processingFees)).toFixed(2);
                    }
                    else if (msg_status == 'offer_accepted') {
                        message += '<h3 class="text-center">You have accepted the Offer</h3>'
                            + '<div class="row"><div class="col-md-12"><p><strong>Description: </strong>'
                            + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>'
                            + '<p><span class="pull-left"><strong>Price: </strong><span class="custom_amount">' + data.customOrder.amount_offer + '</span></span>'
                            + '<span class="pull-right"><strong>Delivery time: </strong>' + data.customOrder.total_days + '</p></div>'
                    } else {
                        if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me')) {
//                                    console.log(data.messages);
                            message += '<p><strong>' + data.user + '</strong></p>'

                        }
                        else if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'him')) {
                            /*message += '<p><strong>' + data.admin + '</strong></p>'*/
                            message += '<p><strong>4slash Team</strong></p>'
                        }
                        message += '<p>' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>';
                    }

                    message += '</div>'
                        + '</div>';

                    messages += message;
                });


//                        console.log(data.message_count);
//                    console.log(data.messages);
                document.querySelector('.zg-chat-box-list').innerHTML = messages;
                $(".zg-chat-box-list").scrollTop($(".zg-chat-box-list")[0].scrollHeight);
                if (data.status == 'complete' || data.status == 'cancel') {
                    $('.chat-text-box-block').hide();
                    //alert(data.order_details[0].);
                    var feedback = data.order_details;
                    if (feedback === null) {
                        $("#rate-show-finish").show();
                        // alert(data.order_details[0]);
                    } else {
                        $("#rate-show-finish").hide();
                    }
                    $(".chat-window").css("min-height","755px");
                }
                else {
                    $('.chat-text-box-block').show();
                    $("#rate-show-finish").hide();
                    $(".chat-window").css("min-height","562px");
                }

                if (data.status != 'cancel' && data.status != 'complete') {

                    $('.upr-wind').show();
                    //console.log(data);
                    var no_of_days = 0;
                    if('gigAddon' in data){
                        data.gigAddon.forEach(function(element,index,array){
                            if(element.addon == "Expresslieferung") {
                                no_of_days = element.day;
                            }else{
                                no_of_days = 0;
                            }
                        });
                    }
                    if(data.type != "custom" && data.type!="package") {
                        if (data.orderAddon.length > 0) {
                            //console.log("here");
                            data.orderAddon.forEach(function (element, index, array) {
                                //console.log(no_of_days);
                                if (no_of_days > 0) {
                                    var someDate = new Date(data.created_at);
                                    someDate.setDate(someDate.getDate() + no_of_days);
                                    var dd = someDate.getDate();
                                    var mm = ( '0' + (someDate.getMonth()+1) ).slice( -2 );
                                    var y = someDate.getFullYear();
                                    var dt = data.expiry;
                                    var t = data.expiry.split(/[- :]/);
                                    var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                                    var time = t[3] + ":" + t[4] + ":" + t[5];
                                    var expiry = y + '-' + mm + '-' + dd +" "+ time;
                                    var diff = 360 - (new Date().getTimezoneOffset());
                                    var expiry = moment.tz(expiry, "Europe/Berlin");
                                    $('.upr-wind').countdown(expiry.toDate(), {elapse: true}).on('update.countdown', function (event) {
                                        var $this = $(this);
                                        if (event.elapsed) {
                                            $this.html(event.strftime('<div class="days expire-date"><div class="dy">%D</div>days</div><div class="hours expire-date"><div class="hr">%H</div>Hours</div><div class="minutes expire-date"><div class="mint">%M</div>minutes</div><div class="seconds expire-date"><div class="sec">%S</div>seconds</div>'));
                                        } else {
                                            $this.html(event.strftime('<div class="days"><div class="dy">%D</div>days</div><div class="hours"><div class="hr">%H</div>hours</div><div class="minutes"><div class="mint">%M</div>minutes</div><div class="seconds"><div class="sec">%S</div>seconds</div>'));
                                        }
                                    });
                                }
                            });
                        } else {
                            var expiry = moment.tz(data.expiry, "Europe/Berlin");
                            console.log(expiry.toDate());
                            $('.upr-wind').countdown(expiry.toDate(), {elapse: true}).on('update.countdown', function (event) {
                                var $this = $(this);
                                if (event.elapsed) {
                                    $this.html(event.strftime('<div class="days expire-date"><div class="dy">%D</div>days</div><div class="hours expire-date"><div class="hr">%H</div>hours</div><div class="minutes expire-date"><div class="mint">%M</div>minutes</div><div class="seconds expire-date"><div class="sec">%S</div>seconds</div>'));
                                } else {
                                    $this.html(event.strftime('<div class="days"><div class="dy">%D</div>days</div><div class="hours"><div class="hr">%H</div>hours</div><div class="minutes"><div class="mint">%M</div>minutes</div><div class="seconds"><div class="sec">%S</div>seconds</div>'));
                                }
                            });
                        }
                    }else{
                        var expiry = moment.tz(data.expiry, "Europe/Berlin");
                        $('.upr-wind').countdown(expiry.toDate(), {elapse: true}).on('update.countdown', function (event) {
                            var $this = $(this);
                            if (event.elapsed) {
                                $this.html(event.strftime('<div class="days expire-date"><div class="dy">%D</div>days</div><div class="hours expire-date"><div class="hr">%H</div>hours</div><div class="minutes expire-date"><div class="mint">%M</div>minutes</div><div class="seconds expire-date"><div class="sec">%S</div>seconds</div>'));
                            } else {
                                $this.html(event.strftime('<div class="days"><div class="dy">%D</div>days</div><div class="hours"><div class="hr">%H</div>hours</div><div class="minutes"><div class="mint">%M</div>minutes</div><div class="seconds"><div class="sec">%S</div>seconds</div>'));
                            }
                        });
                    }
                    $(".liferung-badge").html("Delivery in:");
                } else if (data.type == 'package') {
                    $('.upr-wind').hide();
                }
                else {

                    $('.upr-wind').hide();
                    $(".liferung-badge").html("");
                }
            }

        });

    });
    $(document).ready(function () {
        $(".ssk-sticky").hide();
    });


    function generate_msg_output(data) {

        var messages = '';
        var totalMessages = data.messages.length;
        data.messages.forEach(function (element, index, array) {

            var msg_status = data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].message_status;

            if (msg_status == 'offered') {
                var offerClass = 'chat-box-offer';
            }
            else {
                var offerClass = '';
            }

            var message = ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me') ? '<div class="chat-box3">' : '<div class="chat-box2 ">')
                + ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image != null) ? '<img src="' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].profile_image + '" class="img-circle">' : '<div style="border-radius:50%;width:50px;height:50px;background-color:gray;display:inline-block;position:relative;"><span style="position:absolute;left:50%;top:50%;transform:translate(-50%, -50%);font-size:30px;color:white;">' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from_user_name_first_char + '</span></div>')
                + ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me') ? '<div class="chat3">' : '<div class="chat2 ' + offerClass + '">');


            if (msg_status == 'offered') {
                message += '<h3 class="text-center">Offer for your individual inquiry</h3>'
                    + '<div class="row"><div class="col-md-12"><p><strong>Description: </strong>'
                    + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>'
                    + '<p><span class="pull-left"><strong>Price: </strong>' + data.customOrder.amount_offer + '</span>'
                    + '<span class="pull-right"><strong>Delivery time: </strong>' + data.customOrder.total_days + '</p></div>'
                    + '<div class="col-md-12"><p class="text-center"><button id="paypal-btn" type="submit" name="pay-now" class="btn btn-primary" data-toggle="modal" data-target="#paymentConfirmationModal">Pay now with Paypal</button></p></div></div>'

                $('.gig-amount').html(currencyType + data.customOrder.amount_offer);
                $('.message_id').val(data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].id);
                $('.total_order_amount').val(data.customOrder.amount_offer);
                $('.custom_order_products').html(data.custom_order_products);
                $('.custom_order_products').val(data.custom_order_products);
                $('.order_uuid').val(data.uuid);
                $('.total_days').val(data.customOrder.total_days);
                var processingFees = parseFloat((data.customOrder.amount_offer * 5) / 100).toPrecision(3);
                var netTotal = parseFloat(Math.round(data.customOrder.amount_offer) / (1 + 19 / 100)).toFixed(2);
                var taxIncluded = (parseFloat(data.customOrder.amount_offer) - parseFloat(netTotal)).toPrecision(4);

                document.querySelector('#NetTotal').textContent = currencyType + parseFloat(netTotal).toFixed(2);
                document.querySelector('#taxIncluded').textContent = currencyType + parseFloat(taxIncluded).toFixed(2);
                document.querySelector('#processingFees').textContent = currencyType + parseFloat(processingFees).toFixed(2);
                document.querySelector('#FinalAmount').textContent = currencyType + parseFloat(parseFloat(data.customOrder.amount_offer) + parseFloat(processingFees)).toFixed(2);
            }
            else if (msg_status == 'offer_accepted') {
                message += '<h3 class="text-center">You have accepted the Offer</h3>'
                    + '<div class="row"><div class="col-md-12"><p><strong>Discription: </strong>'
                    + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>'
                    + '<p><span class="pull-left"><strong>Amount: </strong><span class="custom_amount">' + data.customOrder.amount_offer + '</span></span>'
                    + '<span class="pull-right"><strong>Total Days: </strong>' + data.customOrder.total_days + '</p></div>'
            }
            else {
                if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'me')) {
                    message += '<p><strong>' + data.user + '</strong></p>'

                }
                else if ((data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].from == 'him')) {
                    /*message += '<p><strong>' + data.admin + '</strong></p>'*/
                    message += '<p><strong>4slash Team</strong></p>'
                }
                message += '<p>' + data.messages[(parseInt(totalMessages) - (parseInt(index) + 1))].body + '</p>';
            }

            message += '</div>'
                + '</div>';

            messages += message;
        });

        return messages;
    }
</script>
<script>
    $(document).ready(function () {

        setInterval(function () {

            if(global_order_no !== 0) {
                $.get('/countMsgs/' + global_order_no, function (data, status) {
                    var total_msgs = data;

                    if (count != total_msgs) {

                        $.get('/order/' + global_order_no, function (data, status) {

                            count = data.message_count;
                            var messages = generate_msg_output(data);
                            document.querySelector('.zg-chat-box-list').innerHTML = messages;
                            $(".zg-chat-box-list").scrollTop($(".zg-chat-box-list")[0].scrollHeight);

                        });
                    }
                });
            }

        }, 3000);



    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".order-rating").click(function () {
            var feed_id = $(this).data("id");
            var order_id = $(".innertext-order-no").text();
            $.ajax({
                method: "post",
                url: "{{ route('order.feedback') }}",
                data: {'feed_id': feed_id, 'order_id': order_id},
//                dataType : "json",
                success: function (data) {
                    $(".order-rating").hide();
                    $("#rate-show-finish").empty();
                    var feedback = "<div class='callout callout-success'>"
                    feedback += "<i class='icon fa fa-check'></i>"
                    feedback += "<p>Thanks for your review</p>"
                    feedback += "</div>";
                    $("#rate-show-finish").append(feedback);
                }

            });
        });

        $("#spinner").click(function(){
            $("#spinner").addClass("spinner-active-color");
            $("#cogwheel").removeClass("spinner-active-color");
            $("#flag").removeClass("spinner-active-color");
        });

        $("#cogwheel").click(function(){
            $("#cogwheel").addClass("spinner-active-color");
            $("#spinner").removeClass("spinner-active-color");
            $("#flag").removeClass("spinner-active-color");
        });

        $("#flag").click(function(){
            $("#flag").addClass("spinner-active-color");
            $("#spinner").removeClass("spinner-active-color");
            $("#cogwheel").removeClass("spinner-active-color");
        });



    });
    
</script>


