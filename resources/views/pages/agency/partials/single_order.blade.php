<div class="box-header with-border">
    <h3 class="box-title">Order {{ $order->order_no }}</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary">Job Done</button>
    </div>
</div><!-- /.box-header -->
<div class="box-body no-padding">

    <div class="col-md-12">


        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Order Chat with Cnerr</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">


                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->

                    @foreach($messages as $message)
                        @if($message->user_id == \Illuminate\Support\Facades\Auth::agency()->get()->id)
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    {!! $message->body !!}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
                            @else
                                    <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img"
                                     src="http://localhost:8000/bower_components/AdminLTE/dist/img/user2-160x160.jpg"
                                     alt="message user image"><!-- /.direct-chat-img -->
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
                <form class="chat-form" action="{{ route('agencyordermessage') }}?orderuuid={{ $order->uuid }}" method="post" enctype="multipart/form-data">
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

</div><!-- /.box-body -->
<div class="box-footer no-padding">

</div>

<script>
    (function() {
        $('.chat-form').submit(function(ev) {
            ev.preventDefault();

            var form = this;
            var formData = new FormData(form);

            $.ajax({
                method: 'POST',
                url: form.action,
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);

                    var myChat = '<div class="direct-chat-msg">' +
                            '<div class="direct-chat-info clearfix">' +
                            '<span class="direct-chat-name pull-left">' + $(".user-menu a span").html() + '</span>' +
                            '<span class="direct-chat-timestamp pull-right">' + data.created_at + '</span>' +
                            '</div>' +
                            '<img class="direct-chat-img" src="' + $(".user-menu img").attr("src") + '" alt="message user image">' +
                            '<div class="direct-chat-text">' +
                            data.message +
                            '</div>' +
                            '</div>';
                    $('.direct-chat-messages').append(myChat);

                    $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
                }
            });
        });
    })();
</script>