@extends('pages.agency.agency_template')
<style>
    @media(max-width: 450px){
        .dropbox-btn{
            width: 100% !important;
            padding-left: 15px !important;
            padding-right: 30px !important;
        }
        .dropbox-btn a{
            width: 100% !important;
            margin-top: 10px;
        }
        #chat-admin-message-text, #content{
            width: 100% !important;
        }
        .text-area-group{
            width: 100% !important;
        }
    }
</style>
@section('header_title')


    @if($order->status == 'jobdone')
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>
                <span>This order is marked as „Job Done“ by you</span>
                <br>
                <span>Dieser Auftrag wurde von Ihnen „fertig“ markiert</span>
            </h4>
        </div>
    @elseif($order->status == 'complete')
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>
                <span>This order has been completed.</span>
                <br>
                <span style="position: relative; left: 33px;top: 10px;">
                Die Bestellung wurde ausgeliefert und abgeschlossen.
                    </span>
            </h4>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <h3 class="pull-left" style="margin:0px;">Order: {{ $order->order_no }}</h3>
        </div>
        <div class="col-md-9" style="text-align:right;">
            <div class="text" style="display:inline-block; padding-right:25px; line-height:1.1em;">
                <p style="color:red; margin:0px;">Do not forget to select your Language to chat with admin!</p>
                <p style="color:red;">Wählen Sie die Sprache aus um mit dem Admin zu chatten!</p>
            </div>
            <div id="google_translate_element" style="float:right;"></div>
            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'de',
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    }, 'google_translate_element');
                }
            </script>
            <script type="text/javascript"
                    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


            @if($order->amount > 0)
                @if($order->status == 'pending' || $order->status == 'review')
                    <a href="{{ route('agencyorderjobdone', [$order->order_no, $order->uuid]) }}"
                       class="btn btn-default" style="float:left; background:#5cb85c;border:0px; color:#fff;">Job
                        Done</a>
                @endif
            @endif

            <div class="clearfix"></div>
        </div>
    </div>
@endsection




@section('content')
    @if(!empty($order))
        <div class="row">
            @include('pages.agency.partials.side_menue')
            <div class="col-md-9">


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
                    <div class="info-part gig-details">
                        <h4>Bestelldetails / Order Details</h4>
                    </div>
                    <div class="box-body info-box" style="display: none">
                        <div class="col-md-12">
                            <table class="table">

                                <tbody>
                                @if($order->type != 'custom' AND $order->type != 'package')
                                    <tr>

                                        <td><b>Favor Name</b></td>
                                        <td>{{ $gig->title }}</td>
                                        <td>
                                            <a href="{{ route ('gigdetail',['gigType' => $gigtype->slug, 'gig' => $gig->slug ]) }}?funnel={{ $gig->uuid }}"
                                               class="btn btn-primary btn-xs" target="_blank"><span
                                                        class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td><b>Beschreibung / Description</b></td>
                                        <td><span class="gig-amount">{{ $gig->short_discription }}</span></td>

                                    </tr>
                                    <tr>
                                        <td><b>Lieferzeit / Delivery Days</b></td>
                                        <td>{{ $gig->delivery_days }}</td>
                                    </tr>
                                @else
                                    <tr>

                                        <td><b>Package Name</b></td>
                                        <td>{{ $package->title }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Beschreibung / Description</b></td>
                                        <td><span class="gig-amount">{{ $order->sub_package_desc }}</span></td>

                                    </tr>
                                    <tr>
                                        <td><b>Sub Package Name</b></td>
                                        <td><span class="gig-amount">{{ $order->sub_package_name }}</span></td>

                                    </tr>
                                    <tr>
                                        <td><b>Lieferzeit / Delivery Days</b></td>
                                        <td>{{ $order->package_days }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Lieferzeit / Source file</b></td>
                                        <td>{{ $order->pack_source != "" ? $order->pack_source : "null"  }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Lieferzeit / Revisions</b></td>
                                        <td>{{ $order->pack_revisions > 0 ? $order->pack_revisions : "no revisions"  }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td><b>Favor Warenkorb / Amount </b></td>
                                    <td>{{ config('app.currency') }}{{  number_format($order->net_total * ($aggencyamount->agency_percentage/100),2) }}</td>
                                </tr>


                                <tr>
                                    <td><b>Bestelldatum / Date Created</b></td>
                                    <td>{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
                                </tr>
                                @if($order->type != 'custom' AND $order->type != 'package')
                                    @if(!empty($order_addons))
                                        <tr>
                                            <td style="color:#008fd5;">Order Addons</td>
                                        </tr>
                                        @foreach($order_addons as $addons)
                                            <tr>
                                                <td style="width:200px"><b>{{$addons->addon}}</b></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>
                            <h4>Firmendetails / Company Info </h4>
                            <table class="table">

                                <tbody>

                                <tr>
                                    <td style="width:200px"><b>Beschreibung / Description</b></td>
                                    <td>{{ $order->company_discription }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <h4>Client Feedback</h4>
                            <div class="col-xs-12" id="rate-show-finish" style="padding: 10px 0px;">
                                @if(!empty($order_feedback))
                                    @if($order_feedback->order_feedback == 1)
                                        <img src="{{ url() }}/img/cnerr-rating/angry.png" alt="">
                                    @elseif($order_feedback->order_feedback == 2)
                                        <img src="{{ url() }}/img/cnerr-rating/sad.png" alt="">
                                    @elseif($order_feedback->order_feedback == 3)
                                        <img src="{{ url() }}/img/cnerr-rating/confused.png" alt="">
                                    @elseif($order_feedback->order_feedback == 4)
                                        <img src="{{ url() }}/img/cnerr-rating/happy.png" alt="">
                                    @elseif($order_feedback->order_feedback == 5)
                                        <img src="{{ url() }}/img/cnerr-rating/heart.png" alt="">
                                    @endif
                                @endif
                            </div>
                            <div>
                                @foreach($order_questions as $order_ques)
                                    <h4>{{ $order_ques->question }}</h4>
                                    <p>{{ $order_ques->answers }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                <div class="info-part chat-box">
                    <h4>Chatverlauf / Chat History</h4>
                </div>
                <div class="row chat-section">

                    @if($order->assigned_to && $order->assigned_to != 0 && $order->assigned_to == \Illuminate\Support\Facades\Auth::agency()->get()->id)
                        <div class="col-md-6">


                            <div class="box box-primary direct-chat direct-chat-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Chat with Admin</h3>
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
                                        @if(!empty($agencyMessages))
                                            @foreach($agencyMessages as $message)
                                                @if($message->user_id == $agencies->id)
                                                    <div class="direct-chat-msg">
                                                        <div class="direct-chat-info clearfix">
                                                            <span class="direct-chat-name pull-left">{{ $agencies->username }}</span>
                                                            <span class="direct-chat-timestamp pull-right">{{ date("d M y h:i a",strtotime($message->created_at)) }}</span>
                                                        </div>
                                                        <!-- /.direct-chat-info -->
                                                        @if(!empty(\App\User::find($message->user_id)->profile_image))
                                                            <img class="direct-chat-img"
                                                                 src="{{url('photos/mini').'/'.$agencies->profile_image}}"
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
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    {!! $message->body !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <form action="{{ route('agency.delete.message') }}"
                                                                          method="post"
                                                                          class="mess-delete  pull-right margin-top"
                                                                          style="display: none;">
                                                                        <input type="hidden" name="message_id"
                                                                               class="message_class"
                                                                               value="{!! $message->id !!}">
                                                                        <div class="dropdown">
                                                                            <button class="dropdown-toggle message_delete"
                                                                                    type="button"
                                                                                    data-toggle="dropdown">
                                                                                <i class="fa fa-cog"
                                                                                   aria-hidden="true"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu"
                                                                                style="position: relative;top: 20px;left: 17px;">
                                                                                <li><input type="submit"
                                                                                           class="message_delete"
                                                                                           name="Delete_message"
                                                                                           value="Delete">
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
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
                                                                 src="{{\App\User::find($message->user_id)->profile_image}}"
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
                                        @endif


                                    </div>
                                    <!--/.direct-chat-messages-->

                                    <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img"
                                                         src="{{ asset('bower_components/AdminLTE/dist/img/user2-160x160.jpg') }}">

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
                                    @if($order->status != 'complete')
                                        <form class="agency-chat-form"
                                              action="{{ route('agencyordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}"
                                              method="post" enctype="multipart/form-data">

                                            <div class="clear-fix"></div>
                                            <span class="please_wait_agency"
                                                  style="float: right; margin-right: 217px; display: none;"><img
                                                        src="data:image/gif;base64,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"/></span>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group text-area-group">
                                                        {{--<input id="chat-admin-message-text" name="message" placeholder="Type Message ..." class="form-control send-message" type="text">--}}
                                                        <textarea name="message" id="chat-admin-message-text" cols="100"
                                                                  rows="6" placeholder="Type Message ..."
                                                                  class="form-control send-message" draggable="false"
                                                                  style="height: 135px;"></textarea>
                                                    </div>
                                                    <div id="content">
                                                        <!-- Example 2 -->
                                                        <input type="file" name="files[]" id="filer_input2">
                                                        <!-- end of Example 2 -->
                                                    </div>
                                                    <div id="error_show"></div>
                                                    {{--                                        <span class="input-group-btn" style="padding-top: 10px;">
                                              <button id="chat-submit" type="submit" class="btn btn-primary btn-flat send-btnn pull-right" disabled>Send</button>
                                            </span>--}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button id="submitbtn" type="submit" class="btn btn-success"
                                                            style="width:100% ;background: #3c8dbc;border: 0px; margin-right: 15px;">
                                                        {{--<i class="fa fa-arrow-right" aria-hidden="true"></i>--}} Send
                                                    </button>
                                                </div>
                                                <div class="col-md-4 dropbox-btn" style="padding:0px;">

                                                </div>
                                                <div class="col-md-5"></div>
                                            </div>

                                        </form>
                                    @endif
                                </div>
                                <!-- /.box-footer-->
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary direct-chat direct-chat-primary admin-with-client-agency">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Chat with Client</h3>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">


                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages client-direct-chat-messages" style="height:363px;">
                                        <!-- Message. Default to the left -->

                                        @foreach($messages as $message)
                                            @if($message->user_id == \App\Admin::find($message->user_id)->first()->id)
                                                <div class="direct-chat-msg">
                                                    <div class="direct-chat-info clearfix">
                                                        <span class="direct-chat-name pull-left">{{ \App\User::find($message->user_id)->username }}</span>
                                                        <span class="direct-chat-timestamp pull-right">{{ date("d M y h:i a",strtotime($message->created_at)) }}</span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    @if(!empty(\App\User::find($message->user_id)->profile_image))
                                                        <img class="direct-chat-img"
                                                             src="{{\App\User::find($message->user_id)->profile_image }}"
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
                                                        @if(!empty($customOrder) && !empty($message->message_status == 'offered') || !empty($message->message_status == 'offer_accepted'))
                                                            @if($customOrder->status == 'offered' && $message->message_status == 'offered' || !empty($message->message_status == 'offer_accepted'))
                                                                <div class="row">
                                                                    <div class="col-md-12"><p><span
                                                                                    class="pull-left"><strong>Amount
                                                                                    offered: </strong>{{ $customOrder->amount_offer }}</span>
                                                            <span class="pull-right"><strong>Total
                                                                    Days: </strong>{{ $customOrder->total_days }}</span>
                                                                        </p>
                                                                    </div>
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
                                <!-- /.box-footer-->
                                @if($order->status != "complete")
                                    <div class="box-footer">
                                        <form class="agency-chat-form2"
                                              action="{{ route('agencyordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}"
                                              method="post" enctype="multipart/form-data">
                                            <div class="form-group col-sm-9 col-xs-12">
                                                <label for="agency_instant"></label>
                                                <select name="message" id="agency_instant" class="form-control">
                                                    <option value="" disabled selected>Select any message</option>
                                                    <option value="" disabled class="disabled-heading">Further
                                                        Information
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir benötigen weitere Details zu Ihrer Bestellung. Listen Sie kurz Ihre genauen Vorstellungen auf. Vielen Dank. ">
                                                        Please provide some
                                                        info
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir benötigen noch weitere, detaillierte Angaben zu ihren Wünschen. Vielen Dank für die Zusendung.">
                                                        Need more information.
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, können Sie mir die Quell- / Originaldaten /-dateien zur Verfügung stellen. Ich benötige diese um mit Ihrem Projekt voranzukommen. Vielen Dank.">
                                                        Give me source file.
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, ich werde Ihnen in den nächsten Tagen die ersten Vorschläge/ Ideen zu kommen lassen. Vielen Dank.">
                                                        Delivery somthing in the next days.
                                                    </option>
                                                    <option value="" disabled class="disabled-heading">Timeline</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, das machen wir sehr gerne für Sie. In Kürze melden wir uns zurück. Vielen Dank.">
                                                        Confirm. I am on your project and come back to you.
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, ich bin zur Zeit mit Ihrem Projekt beschäftigt. Ich melde mich bei Ihnen in Kürze  zurück. Vielen Dank. ">
                                                        I am Busy now with your project.
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, im Bezug auf Ihr Projekt benötigen wir noch ein wenig Zeit. Unsere Überlegungen werden wir umsetzen und Sie in Kürze informieren. Vielen Dank. ">
                                                        We are thinking about how we can make your ideas even better.
                                                    </option>
                                                    <option value="" disabled class="disabled-heading">Project
                                                        finalizing
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir stehen kurz vor der Fertigstellung Iher Bestellung. Bitte überprüfen Sie unsere Lieferung und geben uns ein Feedback. Vielen Dank. ">
                                                        Project is in finilize status - almost ready. Please check.
                                                    </option>
                                                    <option value="" disabled class="disabled-heading">Delivery</option>
                                                    <option value="Liebe/r {{ $order->company_name }},  herzlichen Glückwunsch! Ihre Bestellung ist fertiggestellt. Bitte prüfen Sie die Lieferung markieren Sie den Auftrag mit `fertig`.  Vielen Dank, ">
                                                        Your Order is done! Here is the Delivery.
                                                    </option>
                                                    <option value="" disabled class="disabled-heading">Thank you
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }},  vielen Dank für die freundliche Zusammenarbeit. Es hat viel Spaß gemacht mit Ihnen das Projekt zu erarbeiten. Vielleicht empfehlen Sie uns weiter und denken weiterhin ans uns. :-) Bis bald, dein Cnerr Team">
                                                        Thanks for the kind cooperation.
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }}, das freut uns sehr. Bis bald, ihr Cnerr Team.">
                                                        Response, thank you too.
                                                    </option>
                                                    <option value="" disabled class="disabled-heading">Problems</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, gerne leiten wir diesen Fall an unsere Geschäftleitung weiter, damit hier eine Entscheidung getroffen werden kann. Wir melden uns bei Ihnen zurück. Vielen Dank.">
                                                        Problems with Customer. We will forward the process to the
                                                        management.
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }},  wir möchten Sie darauf hinweisen, dass Sie bereits mit dieser Änderung Ihr Limit der Änderungswünsche erreicht haben. Bitte teilen Sie uns die letzten genauen Änderungen mit. Vielen Dank. ">
                                                        Problems with Reviews/Limits
                                                    </option>
                                                    <option value="Liebe/r {{ $order->company_name }},  leider habne wir bislang noch keine vollständigen Informationen/Wünsche für diese Projekt erhalten. Bitte teilen Sie uns dieses kurzfristig mit, damit wir Ihr Projekt erfolgreich und innerhalb der gewünschten Frist abarbeiten können. Vielen Dank.">
                                                        Problems with needed Information.
                                                    </option>
                                                    <option value="" disabled class="disabled-heading">Need more for work</option>
                                                    <option value="Liebe/r {{ $order->company_name }},  wir benötigen die von Ihnen gewünschten Schriftarten/Fonts. Bitte laden Sie uns diese per Chat-Box hoch. Bis bald, dein Cnerr Team">Need related fonts</option>
                                                    <option value="Liebe/r {{ $order->company_name }},  wir benötigen die von Ihnen gewünschten Schriftarten, umgewandelt in Pfade.  Bitte laden Sie uns diese per Chat-Box hoch. Bis bald, dein Cnerr Team">Convert fonts into curves</option>
                                                    <option value="Liebe/r {{ $order->company_name }},  wir benötigen die Fotos hochaufgelöst als große Datei. Bitte stellen Sie uns diese zur Verfügung. Bis bald, dein Cnerr Team">Need hight resolution images</option>
                                                    <option value="Liebe/r {{ $order->company_name }},  wir benötigen die von Ihnen eine .pdf Datei.  Bitte laden Sie uns diese per Chat-Box hoch. Bis bald, dein Cnerr Team">Need pdf</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, große Dateien können via Dropbox geliefert werden. Bis bald, dein Cnerr Team">Send bigger files via Dropbox</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, haben Sie eine bessere Qualität, die sie uns als Datei zur Verfügung stellen können?  Bitte laden Sie uns diese per Chat-Box hoch. Bis bald, dein Cnerr Team">Have you a better file?</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir benötigen die FTP Zugangsdaten von Ihnen. Bis bald, dein Cnerr Team">Need FTP Login</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir benötigen ihre Webadresse/Domain Namen.  Bitte teilen Sie uns diesen mit. Bis bald, dein Cnerr Team">Need URL</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir benötigen mehr Informationen, z.B. eine detaillierte Skizze nach Ihrer Vorstellungen.  Bitte stellen Sie uns diese Informationen zur Verfügung. Bis bald, dein Cnerr Team">Need a sketch</option>
                                                    <option value="Liebe/r {{ $order->company_name }}, wir benötigen ihre Webadresse/Website-Url/ Domainnamen (www.mustermann.de) und die Zugangsdaten zu ihrem Backend. Bitte teilen Sie uns diese mit.  Bis bald, dein Cnerr Team">Need C-Panel and URL</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-3 col-xs-12 text-right">
                                                <button type="submit" class="btn btn-info"
                                                        style="width:100%; position: relative;top:20px;background: #3c8dbc;border: 0px; color:white;">
                                                    {{--<i class="fa fa-arrow-right" aria-hidden="true"
                                                       style="color: white;"></i>--}}
                                                    Send
                                                </button>
                                            </div>
                                            <input type="hidden" name="agency-to-client" value="yes">
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection



@section('pages_css')

    <style>
        .direct-chat-text a {
            color: white;
        }
    </style>


@endsection



@section('pages_script')
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs"
            data-app-key="fmc6sdzhio1nf6i"></script>
    <script>
        $(document).ready(function () {
//            $('.admin-with-client-agency .client-direct-chat-messages').scrollTop($('.admin-with-client-agency .client-direct-chat-messages')[0].scrollHeight);
            $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);
        });
    </script>
    <script src="{{ asset('js/jquery.uploadify.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        (function ($) {
            var drop_file = new Array();
            $('.agency-chat-form2').submit(function (ev) {
                ev.preventDefault();
                var form = this;
                var formData = new FormData(form);
                formData.append("receiver", "admin");
                formData.append("agency-to-client","Yes");
                $.ajax({
                    method: 'POST',
                    url: form.action,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var myChat = '<div class="direct-chat-msg">'
                                + '<div class="direct-chat-info clearfix">'
                                + '<span class="direct-chat-name pull-left">' + data.user.username + '</span>'
                                + '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>'
                                + '</div>'
                                + ((data.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + data.user.username[0] + '</span></div>')
                                + '<div class="direct-chat-text">'
                                + '<div class="row">'
                                + '<div class="col-md-8">'
                                + data.message
                                + '</div>'
                                + '</div>'
                                + '</div>'
                                + '</div>';
                        $('.admin-with-client-agency .box-body .client-direct-chat-messages').append(myChat);
                        /*$(".direct-chat-text").mouseover(function () {
                         $(this).find(".mess-delete").show();
                         });
                         $(".direct-chat-text").mouseout(function () {
                         $(this).find(".mess-delete").hide();
                         });*/
                        $('.admin-with-client-agency .box-body').scrollTop($('.admin-with-client-agency .box-body')[0].scrollHeight);

                    }
                });
            });
            var button = Dropbox.createChooseButton(
                    options = {

                        // Required. Called when a user selects an item in the Chooser.
                        success: function (files) {
//                    drop_file = files[0].link;
//                    $(".dropfiles").val(files[0].link)
                            files.forEach(function (data) {
                                drop_file.push(data.link);
                            })
                        },

                        // Optional. Called when the user closes the dialog without selecting a file
                        // and does not include any parameters.
                        cancel: function () {

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
                        extensions: ['.pdf', '.doc', '.docx', '.png', '.jpeg', '.ai', '.txt', '.gif', '.zip', '.rar', '.psd', '.xlsx', '.xps'],
                    }
            );
            document.getElementsByClassName("dropbox-btn")[0].appendChild(button);
            $('.agency-chat-form').on('submit', function (e) {
                var message = $("#chat-admin-message-text").val();
//                var files = $("#filer_input2").val();
                    $("#error_show").html("");
                    var new_mes = $('#chat-admin-message-text').val();
                    var filerKit = $("#filer_input2").prop("jFiler");
                    var files = new Array();
                    filerKit.files_list.forEach(function (data) {
//                   console.log(data.file.name);
                        files.push(data.file.name);
                    });
                    e.preventDefault();
//                var action = this).closest('form').attr('action');
                if(message == "" && files == "" && drop_file == ""){
                    e.preventDefault();
                    $("#error_show").html("<p style='display:inline-block;color:red;'>Please type any message or select some files!</p>")
                }else {
                    var form = this;
                    var formData = new FormData();
                    formData.append('message', new_mes);
                    formData.append('files', files);
                    formData.append('dropfiles', drop_file);
                    /*console.log(new_mes);*/
                    $.ajax({
                        url: form.action,
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        beforeSend: function (xhr) {
                            $('.please_wait_agency').show();
                        },
                        success: function (data) {
                            $('.please_wait_agency').hide();
                            $(form).find('textarea').val("");
                            filerKit.reset();
                            var myChat = '<div class="direct-chat-msg">'
                                + '<div class="direct-chat-info clearfix">'
                                + '<span class="direct-chat-name pull-left">' + data.user.username + '</span>'
                                + '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>'
                                + '</div>'
                                + ((data.user.profile_image != null) ? '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' : '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">' + data.user.username[0] + '</span></div>')
                                + '<div class="direct-chat-text">'
                                + '<div class="row">'
                                + '<div class="col-md-8">'
                                + data.message
                                + '</div>'
                                + '<div class="col-md-4">'
                                + '<form action="{{ route('agency.delete.message') }}" method="post" class="mess-delete pull-right">'
                                + '<input type="hidden" name="message_id" class="message_class" value="' + data.last_id + '">'
                                + '<div class="dropdown">'
                                + '<button class="dropdown-toggle message_delete" type="button" data-toggle="dropdown">'
                                + '<i class="fa fa-cog" aria-hidden="true"></i>'
                                + '</button>'
                                + '<ul class="dropdown-menu" style="position: relative;top: 20px;left: 17px;">'
                                + '<li>'
                                + '<input type="submit" class="message_delete" name="Delete_message" value="Delete">'
                                + '</li>'
                                + '</ul>'
                                + '</div>'
                                + '</form>'
                                + '</div>'
                                + '</div>'
                                + '</div>'
                                + '</div>';
                            $('.agency-direct-chat-messages').append(myChat);
                            $(".direct-chat-text").mouseover(function () {
                                $(this).find(".mess-delete").show();
                            });
                            $(".direct-chat-text").mouseout(function () {
                                $(this).find(".mess-delete").hide();
                            });
                            messaged();
                            $('#fileAttachment').val('');
                            $('#chat-admin-message-text').val('');
                            $('#fileAttachmentName').empty();
                            new_mes = '';
                            $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);

                        }
                    });
                }

            });

//        $('#formJobAssign').submit(function(e) {
//            e.preventDefault();
//
//            MyJSLib.Ajaxifier.submitForm(this, 'Job Assigned Successfully', 'Job Assigning Failed');
//        });

        })(jQuery);

        function sendAdminOrderMessage() {


            var message = document.querySelector('#chat-admin-message-text').value;


        }

    </script>
    <script>
        $(document).ready(function () {
            $(".send-message").keyup(function () {
                $(".send-btnn").removeAttr("disabled");
            });
        });
    </script>
    <script>
        /*$("#fileAttachment").change(function () {
         var fileName = $(this).val().replace('C:\\fakepath\\', '');
         $("#fileAttachmentName").html(fileName);
         $(".send-attachment1").show();
         });*/
        $('.gig-details').click(function () {
            $('.info-box').slideToggle();
        });
        $('.chat-box').click(function () {
            $('.chat-section').slideToggle();
        });
        $(".direct-chat-text").mouseover(function () {
            $(this).find(".mess-delete").show();
        });
        $(".direct-chat-text").mouseout(function () {
            $(this).find(".mess-delete").hide();
        });
    </script>
    <script>
        $('.mess-delete').submit(function (e) {
            e.preventDefault();
            if (confirm("Are you sure you want to do this?")) {
                var url = $(this).attr('action');
                var message_id = $(this).find(".message_class").val();
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {id: message_id}
                });
                $(this).closest("div.direct-chat-text").html("This message has been removed!");
            }
        });
        function messaged() {
            $('.mess-delete').submit(function (e) {
                e.preventDefault();
                if (confirm("Are you sure you want to do this?")) {
                    var url = $(this).attr('action');
                    var message_id = $(this).find(".message_class").val();
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {id: message_id},
                        success: function (data) {
                            if (data == 1) {
                                $(this).closest("div.direct-chat-msg").fadeOut();
                            }
                        }
                    });
                    $(this).closest("div.direct-chat-text").html("This message has been removed!");
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {

            var count_client_msgs = '<?= $count_cl_msgs; ?>';
            var count_agency_msgs = '<?= $count_agency_msgs; ?>';
            $.ajaxSetup({cache: false}); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
            setInterval(function () {
                $.get("{{ route('get_count_admin_user_msgs', [$order->order_no, $order->uuid]) }}", function (data, status) {

                    if (data.count != count_client_msgs) {
                        count_client_msgs = data.count;
                        $('.client-direct-chat-messages').load("{{ route('get_admin_user_msgs', [$order->order_no, $order->uuid]) }}");
                        $(".client-direct-chat-messages").scrollTop($(".client-direct-chat-messages")[0].scrollHeight);
                    }

                });

            }, 500); // the "5000"


            $.ajaxSetup({cache: false}); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
            setInterval(function () {
                $.get("{{ route('count_agency_msgs', [$order->order_no, $order->uuid]) }}", function (data, status) {

                    if (data.count != count_agency_msgs) {
                        count_agency_msgs = data.count;
                        $('.agency-direct-chat-messages').load("{{ route('get_agency_order_msgs', [$order->order_no, $order->uuid]) }}");
                        $(".agency-direct-chat-messages").scrollTop($(".agency-direct-chat-messages")[0].scrollHeight);
                    }
                });

            }, 500); // the "5000"
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".agency-chat-form2").on('submit', function () {
                var select_valid = $("#agency_instant option:selected").text();
                if (select_valid == "Problems with Customer. We will forward the process to the management.") {
                    if (confirm("Are you sure ??")) {
                        $.ajax({
                            method: "POST",
                            url: "{{route('send.problem.email')}}"
                        });
                    } else {
                        select_valid.removeAttr("selected");
                    }
                } else {
                    console.log(status);
                }
            });
        });
    </script>
    <script src="{{ asset('bower_components/AdminLTE/bootstrap/js/jquery.filer.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/AdminLTE/bootstrap/js/custom.js') }}" type="text/javascript"></script>
@endsection