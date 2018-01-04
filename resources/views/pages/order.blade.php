@extends('pages.admin.admin_template')


@section('header_title')

    @if($order->status == 'jobdone')
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> This order mark as Job Done.</h4>
        please wait for the buyer to acknowledge this order.
    </div>
    @endif
    <h1 class="pull-left">Order: {{ $order->order_no }}</h1>



    @if($order->type != 'custom')
        @if($order->status == 'pending')
            <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}/jobdone" class="btn btn-primary pull-right">Job Done</a>
            @if($order->assigned_to && $order->assigned_to != 0)
                <button style="margin-right: 5px;" href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Assigned To {{ \App\User::find($order->assigned_to)->username }}</button>
            @else
                <button style="margin-right: 5px;" href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Assign To</button>
            @endif

                <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Select an Agency</h4>
                        </div>
                        <form method="post" action="{{ route('adminorderassign') }}">
                            <div class="modal-body">
                                <input type="hidden" name="orderuuid" value="{{ $order->uuid }}">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Agency</label>
                                    <select name="agency" class="form-control">
                                        @foreach($agencies as $agency)
                                            <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif




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


                            <h4>Order Info</h4>
                            <table class="table">

                                <tbody>
                                  <tr>
                                    <td><b>GIG Amount</b></td><td>{{ $order->amount }}</td>

                                    <td><b>Processing Fees</b></td><td>5%</td>
                                 
                                  </tr>
                                  
                                <tr>
                                    <td><b>Discription</b></td><td>{{ $order->created_at }}</td>
                                </tr>
                                </tbody>
                            </table>







                            <h4>Company Info </h4>
                            <table class="table">

                                <tbody>

                                <tr>
                                    <td><b>Discription</b></td><td>{{ $order->company_discription }}</td>
                                </tr>
                                </tbody>
                            </table>




                            <h4>User Info</h4>
                            <table class="table">

                                <tbody>
                                <tr>
                                    <td><b>UserName</b></td><td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td><td>{{ $user->email }}</td>
                                </tr>

                                </tbody>
                            </table>




                            <div>
                                @foreach($order_questions as $order_ques)
                                <h4>{{ $order_ques->question }}</h4>
                                <p>{{ $order_ques->answers }}</p>
                                    @endforeach
                            </div>
                        </div>

                    </div>

                </div>


            </div>

        </div>
        <div class="row">
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
                                            <img class="direct-chat-img" src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                        @else
                                            <div style="background-color:gray;color:white;position:relative;" class="direct-chat-img">
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
                                            <img class="direct-chat-img" src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                        @else
                                            <div style="background-color:gray;color:white;position:relative;" class="direct-chat-img">
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
                                        <img class="contacts-list-img"
                                             src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg">

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
                        <form class="client-chat-form" action="{{ route('adminordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}" method="post" enctype="multipart/form-data">
                            <input type="file" name="file-attachment" style="margin-bottom: 5px;">
                            <div class="input-group">
                                <input id="chat-admin-message-text" name="message" placeholder="Type Message ..." class="form-control" type="text" required>
                      <span class="input-group-btn">
                        <button id="chat-submit" type="submit" class="btn btn-primary btn-flat">Send</button>
                      </span>
                            </div> 
                        </form>
                    </div>
                    <!-- /.box-footer-->
                </div>


            </div>
            @if($order->assigned_to && $order->assigned_to != 0)
                <div class="col-md-6">


                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Chat with Agency</h3>
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
                                            <img class="direct-chat-img" src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                        @else
                                            <div style="background-color:gray;color:white;position:relative;" class="direct-chat-img">
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
                                            <img class="direct-chat-img" src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                        @else
                                            <div style="background-color:gray;color:white;position:relative;" class="direct-chat-img">
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
                                        <img class="contacts-list-img"
                                             src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg">

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
                        <form class="agency-chat-form" action="{{ route('adminordermessage', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) }}" method="post" enctype="multipart/form-data">
                            <input type="file" name="file-attachment" style="margin-bottom: 5px;">
                            <div class="input-group">
                                <input id="chat-admin-message-text" name="message" placeholder="Type Message ..." class="form-control" type="text">
                      <span class="input-group-btn">
                        <button id="chat-submit" type="submit" class="btn btn-primary btn-flat">Send</button>
                      </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-footer-->
                </div>


            </div>
            @endif

        </div>

@endsection



@section('pages_css')

<style>
    .direct-chat-text a
    {
        color: white;
    }
</style>


@endsection



@section('pages_script')
<script>

    (function() {

        $('.client-chat-form').submit(function(ev) {
            ev.preventDefault();

            var form = this;
            var formData = new FormData(form);
            formData.append("receiver", "client");

            $.ajax({
                method: 'POST',
                url: form.action,
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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
                    $('.client-direct-chat-messages').append(myChat);

                    $('.client-direct-chat-messages').scrollTop($('.client-direct-chat-messages')[0].scrollHeight);

                }
            });
        });

        $('.agency-chat-form').submit(function(ev) {
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
                success: function(data) {
                    console.log(data);
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

                    $('.agency-direct-chat-messages').scrollTop($('.agency-direct-chat-messages')[0].scrollHeight);

                }
            });
        });











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

@endsection


































