@extends('pages.admin.admin_template')


@section('header_title')

    @if($order->status == 'jobdone')
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Ihr Auftrag ist mit fertig markiert.</h4>
            please wait for the buyer to acknowledge this order.
        </div>
    @elseif($order->status == 'jobdonebyagency')
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> This order mark as Job Done by agency.</h4>
        </div>
    @elseif($order->status == 'complete')
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Ihre Bestellung wurde abgeschlossen.</h4>
        </div>
    @elseif($order->status == 'review')
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>This order is marked for modification .</h4>
        </div>
    @endif

    <h1 class="pull-left">Bestellnummer: {{ $order->order_no }}</h1>



    @if($order->amount > 0)
        @if($order->status != 'cancel')
            @if($order->status == 'pending'  || $order->status == 'jobdonebyagency' || $order->status == 'review')
                @if($order->assigned_to!= 0)
                    <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}/jobdone"
                       class="btn btn-primary pull-right">Job Done</a>
                    {{--<a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}/jobcancel" class="btn btn-warning pull-right" style="margin-right: 5px;">Cancel Job</a>--}}
                    <button class="btn btn-warning pull-right" style="margin-right: 5px;" data-toggle="modal"
                            data-target="#myModal1">Cancel Job
                    </button>
                @endif
                {{--
                    Check whethe this is agency's gig
                    and if the gig is disabled by the agency
                    Disable the button and show the hover message

                --}}
                @if(!empty($gig->user_type) &&  $gig->user_type == 'agency' && $gig->active == 0)
                    <a href="#" data-toggle="tooltip" title='This Agency has maximum number of orders'
                       class="pull-right"><span class="btn btn-primary" disabled>assign to</span></a>
                @elseif(!empty($order->assigned_to) && $order->assigned_to && $order->assigned_to != 0)
                    <button style="margin-right: 5px;" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#myModal">Assigned
                        To {{ \App\User::find($order->assigned_to)->username }}</button>
                @else
                    <button style="margin-right: 5px;" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#myModal">Assign To
                    </button>
                    @endif

                    @endif
                            <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Select an Agency</h4>
                                </div>
                                <form method="post" action="{{ route('adminorderassign') }}">
                                    <div class="modal-body">
                                        @if($gig->auto_assign == 1)
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p>This job is already assign to {{ \App\User::find($order->assigned_to)->username }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="orderuuid" value="{{ $order->uuid }}">
                                            <!-- select -->
                                            <div class="form-group">
                                                {{--<select name="agency" class="form-control">--}}
                                                <div class="row">
                                                    <div class="col-sm-4"><label>Agency</label></div>
                                                    <div class="col-sm-4"><label>Pending Orders</label></div>
                                                    <div class="col-sm-4"><label>Completed Orders</label></div>
                                                </div>

                                                @if(!empty($agencies) && count($agencies) > 0)
                                                    @foreach($agencies as $agency)
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="btn-group btn-group-vertical"
                                                                     data-toggle="buttons">
                                                                    <label class="btn">
                                                                        <input type="radio" name='agency'
                                                                               value="{{ $agency->id }}" @if( $order->assigned_to == $agency->id) {{ "checked=checked" }} @endif><i
                                                                                class="fa fa-circle-o fa-2x"></i><i
                                                                                class="fa fa-check-circle-o fa-2x"></i>
                                                                        <span class="chck-bx-p">{{ $agency->username }}</span>
                                                                    </label>

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">

                                                                {{ $agency->pendingOrders->count() }}
                                                            </div>
                                                            <div class="col-sm-4">
                                                                {{ $agency->completedOrders->count() }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        @if($gig->auto_assign == 1)
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary" disabled>Assign</button>
                                        @else
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">Assign</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cancel Job</h4>
                                </div>
                                <div class="modal-body">
                                    <h3>Are you sure you want to cancel the job</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}/jobcancel"
                                       class="btn btn-primary">Yes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif

                            <!-- Offer Modal -->
                    <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Send Custom Offer</h4>
                                </div>
                                <form class="client-chat-form-offer" method="post"
                                      action="{{route('adminordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}">
                                    <div class="modal-body">
                                        <input type="hidden" name="orderuuid" value="{{ $order->uuid }}">

                                        <div class="form-group">
                                            <label>Favor Amount ($)</label>
                                            <input type="text" name="custom_amount" class="form-control custom_amount">
                                            <input type="hidden" name="custom_offer" class="form-control" value="1">
                                        </div>
                                        <div class="form-group">
                                            <label>Dilivery Days</label>
                                            <input type="text" name="total_days" class="form-control total_days">
                                            <input type="hidden" name="custom_offer" class="form-control" value="1">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea rows="5" id="custom_gig_desc" name="message"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-offer">Send Offer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>

@endsection




@section('content')

    <div class="row">
        <div class="col-md-12">


            <div class="box box-primary direct-chat direct-chat-primary">
                {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title">Order Info</h3>--}}
                {{--<div class="box-tools pull-right">--}}
                {{--<span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>--}}
                {{--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                {{--<button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>--}}
                {{--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                {{--</div>--}}
                {{--</div>--}}
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <h4>Bestelldetails</h4>

                        <table class="table">

                            <tbody>
                            @if($order->type != 'custom' AND $order->type != 'package')
                                <tr>
                                    <td><b>Owner name:</b></td>
                                    <td>{{$gig_suggested_by_user_name->username}}</td>
                                </tr>
                                <tr>

                                    <td>
                                        <b>Favor Name</b>
                                    </td>
                                    <td>
                                        {{--@if(!empty($gigtype->name))--}}
                                        {{--{{ $gigtype->name }}--}}
                                        {{--@endif--}}
                                        {{--@if(!empty($subCat->name))--}}
                                        {{--{{ $subCat->name }}--}}
                                        {{--@endif--}}
                                        {{ \App\Gig::find($order->gig_id)->title }}
                                    </td>
                                    <td>
                                        <a href="{{ route ('gigdetail',['gigType' => $gigtype->slug, 'gig' => $gig->slug ]) }}?funnel={{ $gig->uuid }}"
                                           class="btn btn-primary btn-xs" target="_blank"><span
                                                    class="glyphicon glyphicon-eye-open"></span></a></td>
                                </tr>
                                <tr>


                                    <td><b>Favor Addons</b></td>
                                </tr>


                                @foreach($gigAddons as $gigAddon)
                                    @if(count($gigAddon->addon) > 0)
                                        <tr>
                                            <td>
                                                <ul>
                                                    <li>{{ $gigAddon->addon }}</li>
                                                </ul>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach




                                <tr>
                                    <td><b>Beschreibung</b></td>
                                    <td><span class="gig-amount">{{ $gig->short_discription }}</span></td>

                                </tr>
                                <tr>
                                    <td><b>Lieferzeit</b></td>
                                    <td>{{ $gig->delivery_days }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Favor Warenkorb</b></td>
                                <td>{{ config('app.currency') }}<span
                                            class="gig-amount">{{ number_format((float)$gig_amount = (float)$order->amount,2) }}</span>
                                </td>

                            </tr>
                            <tr>
                                <td><b>Netto gesamt</b></td>
                                <td>{{ config('app.currency') }}{{  number_format($order->net_total,2) }}</td>
                            </tr>

                            <tr>
                                <td><b>19% MwSt.</b></td>
                                <td>{{ config('app.currency') }}{{ number_format($order->govt_tax,2)  }}</td>
                            </tr>
                            <tr>

                                <td><b>Bearbeitungsgebühr 5%</b></td>
                                <td>{{ config('app.currency') }}{{number_format((float)$processing_amount = (float)$order->service_charges,2) }} </td>

                            </tr>
                            <tr>
                                <td><b>Gesamtpreis</b></td>
                                <td>{{ config('app.currency') }}{{  number_format((float)$total_amount = (float)$order->amount + $processing_amount,2)  }}</td>
                            </tr>
                            </tr>

                            <tr>
                                <td><b>Bestelldatum</b></td>
                                <td>{{ date('d M y h:i a',strtotime($order->created_at)) }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="info-part gig-details">
                            <h4>More Details...</h4>
                        </div>
                        @if(!empty($user))
                            <div class="info-box" style="display: none;">
                                <h4>User Info</h4>
                                <table class="table">

                                    <tbody>
                                    <tr>
                                        <td style="width:312px;"><b>User-name</b></td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:312px;"><b>E-mail</b></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                                <h4>Projektbeschreibung</h4>
                                <table class="table">

                                    <tbody>

                                    <tr>
                                        <td style="width:312px;"><b>Bemerkung</b></td>
                                        <td>{{ $order->company_discription }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                @if($order->assigned_to && $order->assigned_to != 0)
                                    <h4>Agency</h4>
                                    <table class="table">

                                        <tbody>

                                        <tr>
                                            <td style="width:312px;"><b>Amount</b></td>
                                            <td>{{ config('app.currency') }}{{ number_format($amount = Round(((float)$gig_amount - $order->govt_tax) *( $aggencyamount->agency_percentage)/100,2),2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                                <div>
                                    @foreach($order_questions as $order_ques)
                                        <h4>{{ $order_ques->question }}</h4>
                                        <p>{{ $order_ques->answers }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

            </div>


        </div>

    </div>
    <div class="info-part chat-box">
        <h4>Chatverlauf</h4>
    </div>
    <div class="row chat-section">
        <div class="col-md-6">

            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Order Chat with Client</h3>
                    {{--<div class="box-tools pull-right">--}}
                    {{--<span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>--}}
                    {{--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                    {{--<button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>--}}
                    {{--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages client-direct-chat-messages">
                        <!-- Message. Default to the left -->

                        @foreach($messages as $message)
                            @if($message->user_id == \Illuminate\Support\Facades\Auth::admin()->get()->id)
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">{{ \App\User::find($message->user_id)->username }}</span>
                                        <span class="direct-chat-timestamp pull-right">{{ date("d M y h:i a",strtotime($message->created_at)) }}</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    @if(!empty(\App\User::find($message->user_id)->profile_image))
                                        <img class="direct-chat-img"
                                             src="{{ \App\User::find($message->user_id)->profile_image }}"
                                             alt="message user image"><!-- /.direct-chat-img -->
                                    @else
                                        <div style="background-color:gray;color:white;position:relative;"
                                             class="direct-chat-img">
                                                <span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">
                                                    {{ strtoupper(\App\User::find($message->user_id)->username[0]) }}
                                                </span>
                                        </div>
                                    @endif
                                    <div class="direct-chat-text">
                                        {!! $message->body !!}
                                        @if(!empty($customOrder) && !empty($message->message_status == 'offered'))
                                            @if($customOrder->status == 'offered' && $message->message_status == 'offered')
                                                <div class="row">
                                                    <div class="col-md-12"><p><span class="pull-left"><strong>Amount
                                                                    offered: </strong>{{ $customOrder->amount_offer }}</span>
                                                            <span class="pull-right"><strong>Total
                                                                    Days: </strong>{{ $customOrder->total_days }}</span>
                                                        </p></div>
                                                </div>
                                            @endif
                                        @endif

                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div><!-- /.direct-chat-msg -->
                                @else
                                        <!-- Message to the right -->
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">{{ \App\User::find($message->user_id)->username }}</span>
                                        <span class="direct-chat-timestamp pull-left">{{ date("d M y h:i a",strtotime($message->created_at)) }}</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    @if(!empty(\App\User::find($message->user_id)->profile_image))
                                        <img class="direct-chat-img"
                                             src="{{ \App\User::find($message->user_id)->profile_image }}"
                                             alt="message user image"><!-- /.direct-chat-img -->
                                    @else
                                        <div style="background-color:gray;color:white;position:relative;"
                                             class="direct-chat-img">
                                                <span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">
                                                    {{ strtoupper(\App\User::find($message->user_id)->username[0]) }}
                                                </span>
                                        </div>
                                    @endif
                                    <div class="direct-chat-text">
                                        {!! $message->body !!}
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div><!-- /.direct-chat-msg -->
                            @endif
                        @endforeach


                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    {{--<img class="contacts-list-img"--}}
                                    {{--src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg">--}}

                                    <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date pull-right">2/28/2015</small>
                            </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    @if($order->status!='complete' && $order->status!='cancel')
                        <form class="client-chat-form"
                              action="{{ route('adminordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}"
                              method="post" enctype="multipart/form-data">

                            <div class="row" style="margin-bottom:10px;">
                                <div class="col-md-12 pull-left">
                                    {{--<button type="button" class="btn btn-default"><i class="fa fa-paperclip"></i> Attach
                                        Files
                                    </button>--}}
                                    {{--<span class="box__dragndrop"> or drag it here</span>--}}
                                    <span id="fileAttachmentName"></span><span class="please_wait"
                                                                               style="margin-left: 10px; display: none;"><img
                                                src="data:image/gif;base64,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"/></span>
                                    {{--<input type="file" id="fileAttachment" name="file-attachment"
                                           style="margin-bottom: 5px; width:115px;margin-left:-20px; opacity: 0; position:absolute;margin-top: -42px;padding:20px; cursor: pointer;">
                                    <button id="chat-submit" type="submit" class="btn btn-default btn-flat send-attachment1" style="display: none;">Send attachment</button>--}}
                                </div>
                                {{--<div class="box__uploading">Uploading&hellip;</div>
                                <div class="box__success">Done!</div>
                                <div class="box__error">Error! <span></span>.</div>--}}
                                @if((!empty($order->type) && !empty($customOrder->status)) && ($order->type == 'custom' && $customOrder->status != 'offered'))
                                    <div class="col-md-2 pull-right" style="width:129px;">
                                        <button type="button" name="custom-offer" data-toggle="modal"
                                                data-target="#offerModal" class="form-control btn-offer-btn"
                                                style="background:rgb(239, 186, 4) none repeat scroll 0% 0%; border:2px solid #EFBA04;border-radius: 5px;">
                                            Send Offer
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="clear-fix"></div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <textarea id="chat-admin-message-text-client" name="message" placeholder="Type Message ..."
                                               class="form-control send-message" cols="80" rows="5" draggable="false"></textarea>
                                    {{--<span class="input-group-btn">
                                    <button id="chat-submit" type="submit" class="btn btn-primary btn-flat send-btnn" disabled>Send</button>
                                  </span>--}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="file_upload" id="file_upload_client"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="pre-scrollable">
                                        <div id="queue"></div>
                                        <div id="imageShow"></div>
                                        <input type="hidden" name="queuesize" id="queuesizeClient" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="attachment-bg">
                                        <button id="client_submit" type="submit" class="btn btn-default client-submit" style="float: left"><i class="fa fa-arrow-right" aria-hidden="true"></i> Send </button>

                                        <div id="fileerrorClient" style="float: left; margin-left: 9px; color: red;"></div>
                                        <div id="queueSizeClint" style="float: left; margin-left: 9px;">0.0 MB</div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    @endif
                </div>
                <!-- /.box-footer-->
            </div>


        </div>

        @if($order->assigned_to && $order->assigned_to != 0)
            <div class="col-md-6">


                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Chat with Agency</h3>
                        <h5 style="display: inline-block; float: right; margin: 0px;"><b style="margin-right: 15px;">Preferred Language:</b>{{$agency_details ? $agency_details->language:''}}</h5>
                        {{--<div class="box-tools pull-right">--}}
                        {{--<span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>--}}
                        {{--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                        {{--<button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>--}}
                        {{--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                        {{--</div>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages agency-direct-chat-messages">
                            <!-- Message. Default to the left -->

                            @foreach($agencyMessages as $message)
                                @if($message->user_id == \Illuminate\Support\Facades\Auth::admin()->get()->id)
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left">{{ \App\User::find($message->user_id)->username }}</span>
                                            <span class="direct-chat-timestamp pull-right">{{ date("d M y h:i a",strtotime($message->created_at)) }}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        @if(!empty(\App\User::find($message->user_id)->profile_image))
                                            <img class="direct-chat-img"
                                                 src="{{\App\User::find($message->user_id)->profile_image }}"
                                                 alt="message user image "><!-- /.direct-chat-img -->
                                        @else
                                            <div style="background-color:gray;color:white;position:relative;"
                                                 class="direct-chat-img">
                                                <span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">
                                                    {{ strtoupper(\App\User::find($message->user_id)->username[0]) }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="direct-chat-text">
                                            {!! $message->body !!}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div><!-- /.direct-chat-msg -->
                                    @else
                                            <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">{{ \App\User::find($message->user_id)->username }}</span>
                                            <span class="direct-chat-timestamp pull-left">{{ date("d M y h:i a",strtotime($message->created_at)) }}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        @if(!empty(\App\User::find($message->user_id)->profile_image))
                                            <img class="direct-chat-img"
                                                 src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg"
                                                 alt="message user image"><!-- /.direct-chat-img -->
                                        @else
                                            <div style="background-color:gray;color:white;position:relative;"
                                                 class="direct-chat-img">
                                                <span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">
                                                    {{ strtoupper(\App\User::find($message->user_id)->username[0]) }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="direct-chat-text">
                                            {!! $message->body !!}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div><!-- /.direct-chat-msg -->
                                @endif
                            @endforeach


                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        @if($order->status != 'complete' && $order->status!='cancel')
                            <form class="agency-chat-form"
                                  action="{{ route('adminordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}"
                                  method="post" enctype="multipart/form-data">
                                <div class="col-md-12 pull-left" style="margin-bottom: 10px; padding-left: 0;">
                                    {{--<button type="button" class="btn btn-default"><i class="fa fa-paperclip"></i> Attach
                                        Files
                                    </button>--}}
                                    {{--<span class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">or drag it here</span>--}}
                                    <span id="fileAttachmentName2"></span><span class="please_wait_agency"
                                                                                style="margin-left: 10px; display: none;"><img
                                                src="data:image/gif;base64,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"/></span>
                                    {{--<input type="file" id="fileAttachment2" name="file-attachment"
                                           style="margin-bottom: 5px; width:115px;margin-left:-20px; opacity: 0; position:absolute;margin-top: -42px;padding:20px; cursor: pointer;">--}}
                                    {{--<button id="chat-submit" type="submit" class="btn btn-default btn-flat send-attachment2" style="display: none;">Send attachment</button>--}}
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <textarea id="chat-admin-message-text" name="message" placeholder="Type Message ..."
                                                      class="form-control send-message" cols="80" rows="5" draggable="false"></textarea>
                      {{--<span class="input-group-btn">
                        <button id="chat-submit" type="submit" class="btn btn-primary btn-flat send-btnn1" disabled>Send</button>
                      </span>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="file_upload" id="file_upload" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="pre-scrollable">
                                            <div id="queue"></div>
                                            <div id="imageShow"></div>
                                            <input type="hidden" name="queuesize" id="queuesize" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="attachment-bg">
                                            <button  id="submitbtn" type="submit" class="btn btn-default" style="float: left"><i class="fa fa-arrow-right" aria-hidden="true"></i> Send </button>

                                            <div id="fileerror" style="float: left; margin-left: 9px; color: red;"></div>
                                            <div id="queueSize" style="float: left; margin-left: 9px;">0.0 MB</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                    <!-- /.box-footer-->
                </div>


            </div>
        @endif

    </div>

@endsection



@section('pages_css')

    <style>
        .direct-chat-text a {
            color: white;
        }
    </style>


@endsection



@section('pages_script')
    <script>
        function dragStart(event) {
            event.dataTransfer.setData("text/html", event.target.id);
        }

        function allowDrop(event) {
            event.preventDefault();
        }

        function drop(event) {
            event.preventDefault();
            var data = event.dataTransfer.getData("text/html");
            var href = $(data).attr('href').split('/');

            $("#fileAttachmentName2").html(href[6]);

            $("#fileAttachment2").val(href[6]).replace('C:\\fakepath\\', '');

        }


        //event.target.appendChild(document.getElementById(data));
    </script>
    <script>

        (function () {

            $('.agency-chat-form').submit(function (ev) {
                ev.preventDefault();

                var form = this;
                var formData = new FormData(form);
                formData.append("receiver", "agency");

                $.ajax({
                    method: 'POST',
                    url: form.action,
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function (xhr) {
                        $('.please_wait_agency').show();
                    },
                    success: function (data) {
                        $('.please_wait_agency').hide();
                        $(form).find('input[type=text]').val("");

                        var myChat = '<div class="direct-chat-msg">'
                                + '<div class="direct-chat-info clearfix">'
                                + '<span class="direct-chat-name pull-left">' + data.user.username + '</span>'
                                + '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>'
                                + '</div>'
                                + ((data.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + data.user.username[0] + '</span></div>')
                                + '<div class="direct-chat-text">'
                                + data.message
                                + '</div>'
                                + '</div>';
                        $('.agency-direct-chat-messages').append(myChat);
                        $('#fileAttachment2').val('');
                        $("#fileAttachmentName2").empty();

                        $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);

                    }
                });
            });
            $('.client-chat-form-offer').submit(function (ev) {
                ev.preventDefault();

                var form = this;
                var formData = new FormData(form);
                formData.append("receiver", "client");
                var custom_amount = $(form).find('.custom_amount').val();
                var total_days = $(form).find('.total_days').val();
                $.ajax({
                    method: 'POST',
                    url: form.action,
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function (xhr) {
                        $('.please_wait').show();
                    },
                    success: function (data) {
                        console.log(data);
                        $('.please_wait').hide();
                        //$(form).find('input[type=text]').val("");

                        var myChat = '<div class="direct-chat-msg">'
                                + '<div class="direct-chat-info clearfix">'
                                + '<span class="direct-chat-name pull-left">' + data.user.username + '</span>'
                                + '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>'
                                + '</div>'
                                + ((data.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + data.user.username[0] + '</span></div>')
                                + '<div class="direct-chat-text">'
                                + data.message
                                +'<div class="row">'
                                +'<div class="col-md-12"><p><span class="pull-left"><strong>Amount offered: </strong>'
                                + '€'+custom_amount
                                +'</span>'
                                +'<span class="pull-right"><strong>Total Days: </strong>'
                                +total_days
                                +'</span>'
                                +'</p>'
                                +'</div>'
                                +'</div>'
                                + '</div>'
                                + '</div>';
                        $('.client-direct-chat-messages').append(myChat);

                        $('#fileAttachment').val('');
                        $('#chat-admin-message-text-client').val('');
                        $("#fileAttachmentName").empty();


                        $('.client-direct-chat-messages').scrollTop($('.client-direct-chat-messages')[0].scrollHeight);
                        $('#offerModal').modal('hide');
                        $('.btn-offer-btn').hide();


                    }
                });
            });
            var totalfilesize = 0;
            var swif = '{{ url('uploadify.swf') }}';
            var actionAgency = '{{ route('adminmessageimages', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid, 'user' => 'agency']) }}';
            var actionclient = '{{ route('adminmessageimages', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid, 'user' => 'client']) }}';
            var session = '{{  \Illuminate\Support\Facades\Auth::admin()->get()->id }}';
            var obj = new Object();
            var queueSize = 0;
            var message = '';
            var message_agency = '';
            var new_mes = '';
                 message = $('textarea#chat-admin-message-text-client').val();
            message_agency = $('textarea#chat-admin-message-text').val();
            $("#chat-admin-message-text-client").on('mousedown mouseup click focus blur',function(){
                 message = $(this).val();
                //alert(message);
                if(message != ''){
                    new_mes = message;
                }
                else{
                    new_mes = '';
                }
            });
            $("#chat-admin-message-text").on('mousedown mouseup click focus blur',function(){
                message_agency = $(this).val();
                //alert(message);
                if(message_agency != ''){
                    new_mes = message_agency;
                }
                else{
                    new_mes = '';
                }
            });

            //alert(new_mes);
            $("#file_upload").uploadify({
                'method': 'post',
                'formData': {'session': session},
                'auto'     : false,
                'swf'              : swif,
                'removeCompleted' : false,
                'fileSizeLimit' : 1024*1024*30,
                'uploader'         : actionAgency,
                'multi':true,
                'buttonText' : '<i class="fa fa-paperclip"></i> Attach Files',
                'onSelect' : function(file){
                    queueSize++;
                    $('#queuesize').val(queueSize.toFixed(2));
                    $('#uploadedfiles').val(file.name);
                    totalfilesize = totalfilesize+file.size;
                    chkfilesize(totalfilesize);
                    /* $('#file_upload-button').html('<i class="fa fa-paperclip"></i>  '+queueSize +' File(s) Selected');*/

                },
                'onCancel' : function(file) {
                    queueSize--;
                    $('#queuesize').val(queueSize.toFixed(2));
                    totalfilesize = totalfilesize-file.size;
                    chkfilesize(totalfilesize);
                },
                'onQueueComplete' : function(event,data,file) {
                    //formSubmit();
                    delete obj.length;

                    var array = $.map(obj, function(el) { return el });
                    // alert(array);
                    var url = '{{ route('adminorderFiles')}}';
                    //alert(url);
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {'data': array, 'receiver':'agency','message': new_mes},
                        dataType: "json",
                        beforeSend: function (xhr) {
                            $('.please_wait_agency').show();
                        },
                        success: function (newdata) {
                            $('.please_wait_agency').hide();
                            var myChat = '<div class="direct-chat-msg">'
                                    + '<div class="direct-chat-info clearfix">'
                                    + '<span class="direct-chat-name pull-left">' + newdata.user.username + '</span>'
                                    + '<span class="direct-chat-timestamp pull-right">' + newdata.created_at + '</span>'
                                    + '</div>'
                                    + ((newdata.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + newdata.user.username[0] + '</span></div>')
                                    + '<div class="direct-chat-text">'
                                    + newdata.message
                                    + '</div>'
                                    + '</div>';
                            $('.agency-direct-chat-messages').append(myChat);
                            $('#file_upload-button').html('<i class="fa fa-paperclip"></i>  '+' Attach Files');
                            new_mes = '';
                            $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);
                            $('#queueSize').html('0.0 MB');
                            $('#chat-admin-message-text').val('');
                            $('.uploadify-queue').empty();
                            $('.uploadify-queue-item').empty();
                            $('.fileName').empty();
                            $('#file_upload-queue').empty();
//                            $('#file_upload').uploadify('destroy');
                            var files = $('#file_upload').data('uploadify').queueData.files = [];
                            for (var member in files) delete files[member];
                        }
                    });



                },
                'onUploadSuccess': function(file, data, response){
                    var newData = $.parseJSON(data);
                    // pick_id = newData.id;
                    var myJSONObject = Array.prototype.push.call(obj, newData.id);

                },
                onUploadComplete: function(event, file,queueID, fileObj, reponse, data)
                {



                }
            });
            $("#file_upload_client").uploadify({
                'method': 'post',
                'formData': {'session': session},
                'auto'     : false,
                'swf'              : swif,
                'removeCompleted' : false,
                'fileExt': '*.eps;*.jpg;*.pdf;*.psd;*.mov;*.ai;*.png;*.doc;*.docx;*.ppt;*.pptx;*.indd;*.bmp;*.dwg;*.pct;*.txt;*.wmv',
                'fileSizeLimit' : 1024*1024*30,
                'uploader'         : actionclient,
                'multi':true,
                'buttonText' : '<i class="fa fa-paperclip"></i> Attach Files',
                'onSelect' : function(file){
                    queueSize++;
                    $('#queuesizeClient').val(queueSize.toFixed(2));
                    $('#uploadedfiles').val(file.name);
                    totalfilesize = totalfilesize+file.size;
                    chkfilesizeClient(totalfilesize);
                    /*$('.uploadify-button').html('<i class="fa fa-paperclip"></i>  '+queueSize +' Files Selected');*/

                },
                'onCancel' : function(file) {
                    queueSize--;
                    $('#queuesizeClient').val(queueSize.toFixed(2));
                    totalfilesize = totalfilesize-file.size;
                    chkfilesizeClient(totalfilesize);
                },
                'onQueueComplete' : function(event,data,file) {
                    //formSubmit();
                    delete obj.length;

                    var array = $.map(obj, function(el) { return el });
                    // alert(array);
                    var url = '{{ route('adminorderFiles')}}';

                    //alert(url);
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {'data': array, 'receiver':'client', 'message': new_mes},
                        dataType: "json",
                        beforeSend: function (xhr) {
                            $('.please_wait').show();
                        },
                        success: function (newdata) {
                            $('.please_wait').hide();

                            var myChat = '<div class="direct-chat-msg">'
                                    + '<div class="direct-chat-info clearfix">'
                                    + '<span class="direct-chat-name pull-left">' + newdata.user.username + '</span>'
                                    + '<span class="direct-chat-timestamp pull-right">' + newdata.created_at + '</span>'
                                    + '</div>'
                                    + ((newdata.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + newdata.user.username[0] + '</span></div>')
                                    + '<div class="direct-chat-text">'
                                    + newdata.message
                                    + '</div>'
                                    + '</div>';
                            $('.client-direct-chat-messages').append(myChat);

                            $('#fileAttachment').val('');
                            $('#chat-admin-message-text-client').val('');
                            $('#queuesizeClient').val('');
                            new_mes = '';
                            $("#fileAttachmentName").empty();
                            $('.client-direct-chat-messages').scrollTop($('.client-direct-chat-messages')[0].scrollHeight);
                            $('#offerModal').modal('hide');
                            $('#file_upload-button').html('<i class="fa fa-paperclip"></i>  '+' Attach Files');
                            $('#queueSizeClint').html('0.0 MB');
                            $('.uploadify-queue').empty();
                            $('#file_upload_client-queue').empty();
                            $('.uploadify-queue-item').empty();
                            $('.fileName').empty();
                            // request your stat objects, it contains amongst others the number of files in the queue
                            var stats = $('#file_upload_client').getStats();
                                // while the queue is not empty ...
                            while (stats.files_queued > 0) {
                                // .. cancel the first in the queue (null: take the first found, false: don't trigger an error event)
                                $('#file_upload_client').cancelUpload(null, false);
                                // it is important to reload the stats everytime and not just do a for (i = 0; i < stats.files_queued ...
                                stats = $('#file_upload_client').getStats();
                            }
                            var files = $('#file_upload_client').data('uploadify').queueData.files = [];
                            for (var member in files) delete files[member];
//                            $('#file_upload_client').uploadify('destroy');
                        }
                    });



                },
                'onUploadSuccess': function(file, data, response){
                    var newData = $.parseJSON(data);
                    // pick_id = newData.id;
                    var myJSONObject = Array.prototype.push.call(obj, newData.id);

                    
                },
                onUploadComplete: function(event, file,queueID, fileObj, reponse, data)
                {



                }
            });

            function chkfilesize(totalfilesize){
                $('#queueSize').html(((totalfilesize/1024)/1024).toFixed(2)+'MB');
                if(totalfilesize > 1024*1024*30){
                    $('#fileerror').html('File Size exceeds 30MB');
                    $('#fileerror').show();
                }else{
                    $('#fileerror').html('');
                    $('#fileerror').hide();
                }

            }
            function chkfilesizeClient(totalfilesize){
                $('#queueSizeClint').html(((totalfilesize/1024)/1024).toFixed(2)+'MB');
                if(totalfilesize > 1024*1024*30){
                    $('#fileerrorClient').html('File Size exceeds 30MB');
                    $('#fileerrorClient').show();
                }else{
                    $('#fileerrorClient').html('');
                    $('#fileerrorClient').hide();
                }

            }

            $('#submitbtn').bind('click',function(e){
                e.preventDefault();
                var validatefileresp = validatefile();
                if(new_mes != '' && $("#queuesize").val() != 0) {
                    if (validatefileresp === true) {
                        $('#file_upload').uploadify('upload', '*');

                    }
                }
                else if(new_mes != ''){

                    var action = $(this).closest('form').attr('action');
                    var form = $(this).closest('form');
                    //ev.preventDefault();
                    console.log(new_mes);
                    // var data = 'message='+ new_mes+'&receiver='+ nolibri;
                    $.ajax({
                        method: 'POST',
                        url: action,
                        data: {'message': new_mes,
                            'receiver': 'agency'
                        },
                        dataType: 'json',
                        beforeSend: function (xhr) {
                            $('.please_wait_agency').show();
                        },
                        success: function (data) {
                            $('.please_wait_agency').hide();
                            $(form).find('input[type=text]').val("");

                            var myChat = '<div class="direct-chat-msg">'
                                    + '<div class="direct-chat-info clearfix">'
                                    + '<span class="direct-chat-name pull-left">' + data.user.username + '</span>'
                                    + '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>'
                                    + '</div>'
                                    + ((data.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + data.user.username[0] + '</span></div>')
                                    + '<div class="direct-chat-text">'
                                    + data.message
                                    + '</div>'
                                    + '</div>';
                            $('.agency-direct-chat-messages').append(myChat);
                            $('#fileAttachment2').val('');
                            $("#fileAttachmentName2").empty();
                            $('#chat-admin-message-text').val('');
                            new_mes = '';

                            $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);

                        }
                    });

                }
                else if($("#queuesize").val() != 0 && new_mes == ''){
                    if (validatefileresp === true) {
                        $('#file_upload').uploadify('upload', '*');

                    }
                }
            });
            $('#client_submit').bind('click',function(e){
                e.preventDefault();
                var validatefileresp = validatefileClient();
                if(new_mes != '' && $("#queuesizeClient").val() != 0) {
                    if (validatefileresp === true) {
                        $('#file_upload_client').uploadify('upload', '*');

                    }
                }
                else if(new_mes != ''){

                    var action = $(this).closest('form').attr('action');
                    var form = $(this).closest('form');
                        //ev.preventDefault();
                        console.log(new_mes);
                           // var data = 'message='+ new_mes+'&receiver='+ nolibri;
                        $.ajax({
                            method: 'POST',
                            url: action,
                            data: {'message': new_mes,
                                    'receiver': 'client'
                                },
                            dataType: 'json',
                            beforeSend: function (xhr) {
                                $('.please_wait').show();
                            },
                            success: function (data) {
                                console.log(data);
                                $('.please_wait').hide();
                                //$(form).find('input[type=text]').val("");

                                var myChat = '<div class="direct-chat-msg">'
                                        + '<div class="direct-chat-info clearfix">'
                                        + '<span class="direct-chat-name pull-left">' + data.user.username + '</span>'
                                        + '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>'
                                        + '</div>'
                                        + ((data.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + data.user.username[0] + '</span></div>')
                                        + '<div class="direct-chat-text">'
                                        + data.message
                                        + '</div>'
                                        + '</div>';
                                $('.client-direct-chat-messages').append(myChat);

                                $('#fileAttachment').val('');
                                $('#chat-admin-message-text-client').val('');
                                new_mes = '';
                                $("#fileAttachmentName").empty();


                                $('.client-direct-chat-messages').scrollTop($('.client-direct-chat-messages')[0].scrollHeight);
                                $('#offerModal').modal('hide');


                            }
                        });

                }
                else if($("#queuesizeClient").val() != 0 && new_mes == ''){
                    if (validatefileresp === true) {
                        $('#file_upload_client').uploadify('upload', '*');

                    }
                }
            });


            function validatefile(){
                if ($("#queuesize").val() == 0) {
                    //formSubmit();
                    $('#uploadedfiles').val('');
                    $('#queuesize').val('0');
                }else{
                    if(totalfilesize > 1024*1024*30){
                        $('#fileerror').html('File Size exceeds 30MB');
                        return false;
                    }else{
                        return true;
                    }

                }

            }
            function validatefileClient(){
                if ($("#queuesizeClient").val() == 0) {
                    //formSubmit();
                    $('#uploadedfiles').val('');
                    $('#queuesizeClient').val('0');
                }else{
                    if(totalfilesize > 1024*1024*30){
                        $('#fileerrorClient').html('File Size exceeds 30MB');
                        return false;
                    }else{
                        return true;
                    }

                }

            }


            $('.client-direct-chat-messages').scrollTop($('.client-direct-chat-messages')[0].scrollHeight);
            $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);

//        $('#formJobAssign').submit(function(e) {
//            e.preventDefault();
//
//            MyJSLib.Ajaxifier.submitForm(this, 'Job Assigned Successfully', 'Job Assigning Failed');
//        });
        })();

        function sendAdminOrderMessage() {


            var message = document.querySelector('#chat-admin-message-text').value;


        }

    </script>

    <script>
        $(document).ready(function () {
            $("#chat-admin-message-text").keyup(function(){
                $(".send-btnn").removeAttr('disabled');

            });
            $(".chat-admin-message-text1").keyup(function () {
                $(".send-btnn1").removeAttr('disabled');
            });
        });
    </script>


    <script>
        $("#fileAttachment").change(function () {
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            $("#fileAttachmentName").html(fileName);
            $(".send-attachment1").show();
        });
    </script>

    <script>
        $("#fileAttachment2").change(function () {
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            $("#fileAttachmentName2").html(fileName);
            $(".send-attachment2").show();
        });
        $('.gig-details').click(function () {
            $('.info-box').slideToggle();
        });
        $('.chat-box').click(function () {
            $('.chat-section').slideToggle();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection
