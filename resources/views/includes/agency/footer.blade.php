<!-- Main Footer -->
<footer style="margin-left:0px;" class="main-footer">
    <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/AdminLTE/dist/js/jquery-ui.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $( "#sortable" ).sortable({
                axis : 'x'
            });
            $( "#sortable" ).disableSelection();
        });
    </script>
    
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>

    {{--<script src="{{ asset('js/jquery.uploadify.min.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/fastclick/fastclick.min.js') }}"></script>

    <script src="{{ asset('bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bower_components/AdminLTE/dist/js/app.min.js') }}"></script>


    <!-- iCheck -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">Cnerr</a>.</strong> All rights reserved.
    {{--<script src="{{ asset('bower_components/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>--}}
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myonoffswitch").click(function(){
                var on = "on";
                var off = "off";
                if($('#myonoffswitch').prop('checked')) {
                    $(this).attr('checked','checked');
                    $.ajax({
                        method : "post",
                        url   : "{{ route('vacation.mode') }}",
                        data  : {mode : on},
                        success : function(res){
//                            console.log(res);
                        }
                    });
                } else {
                    $(this).removeAttr('checked','checked');
                    $.ajax({
                        method : "post",
                        url   : "{{ route('vacation.mode') }}",
                        data  : {mode : off},
                        success : function(res){
//                            console.log(res);
                        }
                    });
                }
            });
            $('.auto_agency_yes').click(function () {

                var gig_id = $(this).data('id');
                var auto_assign = $(this).val();

                $.ajax({
                    type: 'post',
                    data: 'gig_id=' + gig_id + '&auto_assign=' + auto_assign,
                    url: '{{ route('update.auto_assign') }}',
                    success: function (res) {
//                        console.log(res);
                    }
                })
            });
            $("#myonoffswitch1").click(function(){
                if($(this).prop('checked')) {
                    $("#email_notify").val(1);
                } else {
                    $("#email_notify").val(2);
                }
            });
            $("#myonoffswitch3").click(function(){
                if($(this).prop('checked')) {
                    $("#order_notify").val(1);
                } else {
                    $("#order_notify").val(2);
                }
            });
        })
    </script>
    <script>
        $(function () {
            var table = $("#example1").DataTable({
                "aaSorting": []
            });
        });
    </script>
    <script type="text/javascript">
        document.querySelector('.notifications-menu a').addEventListener('click', function(e) {
            $('.notifications-menu .dropdown-menu .menu').html('<li class="text-center"><img src="data:image/gif;base64,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"/></li>');

            $.ajax({

                url: '/agency/AgencyNotifications',
                method:'get',
                success: function(data)
                {
                    var notify = '';

                    data.forEach(function(not)
                    {

                        if(not.order_id != 0)
                        {
                        if(not.order.status != 'cancel') {
                            if (not.seen == 0) {
                                notify += '<li class="notification" style="font-weight: bold; padding: 7px 15px; border-bottom: 1px solid #C5C5C5;"><div class="row"><div class="col-xs-12">' + not.message + '<br></div><div class="col-md-4 pull-left" style="font-size: 12px;">' + not.date + '</div><div class="col-md-6 pull-right" style="font-size: 12px;">' + not.time + '</div></div></li>'
                            }
                            else {

                                notify += '<li class="notification" style="padding: 7px 15px; border-bottom: 1px solid #C5C5C5;"><div class="row"><div class="col-xs-12">' + not.message + '<br></div><div class="col-md-4 pull-left" style="font-size: 12px;">' + not.date + '</div><div class="col-md-6 pull-right" style="font-size: 12px;">' + not.time + '</div></div></li>'
                            }
                        }
                        }
                        else {
                            if (not.seen == 0) {
                                notify += '<li class="notification" style="font-weight: bold; padding: 7px 15px; border-bottom: 1px solid #C5C5C5;"><div class="row"><div class="col-xs-12">' + not.message + '<br></div><div class="col-md-4 pull-left" style="font-size: 12px;">' + not.date + '</div><div class="col-md-6 pull-right" style="font-size: 12px;">' + not.time + '</div></div></li>'
                            }
                            else {

                                notify += '<li class="notification" style="padding: 7px 15px; border-bottom: 1px solid #C5C5C5;"><div class="row"><div class="col-xs-12">' + not.message + '<br></div><div class="col-md-4 pull-left" style="font-size: 12px;">' + not.date + '</div><div class="col-md-6 pull-right" style="font-size: 12px;">' + not.time + '</div></div></li>'
                            }
                        }
                    });
                    $('.notifications-menu .dropdown-menu .menu').html(notify);
                },

            });

        });
    </script>
    <script type="text/javascript" src="{{ asset('js/require.js') }}"></script>
    <script>
        require({
            paths: {jquery: "{{ asset('js/jquery') }}"}
        }, ['jquery', "{{ asset('js/jquery.onoff.js') }}"], function ($) {
            $('input#myonoffswitch[type=checkbox]').onoff();
        });
    </script>
</footer>