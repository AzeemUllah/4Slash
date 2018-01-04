@extends('pages.admin.admin_template')


@section('header_title')

    <h1> <span style="" ><?php echo $_GET['status']; ?></span> orders </h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    @if(!empty($total_complete_orders ) && $total_complete_orders > 0)
                    <a href="{{ route('orders_csv') }}?type=gig" class="btn btn-primary">Export CSV</a>
                    @endif
                   {{-- <a href="/admin/gigs/create" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>--}}
                </div><!-- /.box-header -->
                <div class="box-body">
                    {{--@if($_GET['status'] == "complete" || $_GET['status'] == "cancel")
                    <div class="col-xs-12 text-center">
                        <label for="agency">Search by Agency</label>
                        <select name="" id="agency">
                            <option value="all">All</option>
                            @foreach($agent as $agency)
                                <option value="{{$agency->id}}">{{$agency->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if($_GET['status'] == "pending")
                        <div class="col-xs-12 text-center">
                            <label for="orders">Search by Agency</label>
                            <select name="" id="orders">
                                <option value="all">All</option>
                                @foreach($agent as $agency)
                                    <option value="{{$agency->username}}">{{$agency->username}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif--}}
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                        <tr>

                            <th>Order No</th>
                            <th>Gig</th>
                            <th>Assigned to</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Expire Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($total_pending_orders > 0)
                        @foreach($pendingorders as $order)
                        @if($order->type != 'custom' && $order->type != 'package' )
                            <tr>
                                @if(date('d.m.Y',strtotime($order->created_at)) == date('d.m.Y') )
                                <td><i class="fa fa-star" style="color: #157340;"></i> {{ $order->order_no }}
                                    @if($order->status == 'review')<span class="job_reviewed"><i class="icon fa fa-check"></i>Reviewed</span>
                                    @elseif($order->status == 'jobdonebyagency')
                                        <span class="badge job_reviewed"><i class="icon fa fa-check"></i>Done by agency</span>
                                    @endif
                                </td>
                                @else
                                <td>{{ $order->order_no }} @if($order->status == 'review')<span class="job_reviewed"><i class="icon fa fa-check"></i>Reviewed</span>@endif</td>
                                @endif
                                @if(!empty($order->gig->title ))
                                    <td>{{ $order->gig->title }}</td>
                                @else
                                    <td>&nbsp;</td>
                                @endif
                                @if(!empty($order->agency))
                                    <td  style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                @else
                                    <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                @endif
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ date('d.m.Y',strtotime($order->created_at)) }}</td>
                                    <td>{{ date('d.m.Y',strtotime($order->expiry))}}</td>
                                    <td>{{ number_format($order->amount,2) . config('app.currency') }}</td>
                                <td>
                                    @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                        <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    @else
                                    @if($order->user_active == null)
                                    <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    @else
                                    <a class='btn btn-primary btn-xs alrady-working' disabled style='font-size:11px; margin-bottom: 2px;'><span class='glyphicon glyphicon-eye-open'></span><br>admin working</a>
                                    <button type='button' data-order="{{$order->order_no}}" data-funnel="{{$order->uuid}}" class='btn btn-info btn-xs leave_request'>Leave request</button>
                                    @endif
                                    @endif
                                    @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $order->order_no}}"  data-target="#myModal"></button>

                                </td>
                            </tr>
                            @endif
                           @endif
                        @endforeach
                        @elseif(!empty($total_complete_orders ) && $total_complete_orders > 0)
                        @foreach($completedorders as $corder)

                                <tr>
                                    <td>{{ $corder->order_no }}</td>
                                    @if(!empty($corder->gig->title ))
                                        <td>{{ $corder->gig->title }}</td>
                                    @endif
                                    @if(!empty($corder->agency))
                                        <td  style="background-color:#157340; color: #ffffff; ">{{ $corder->agency->username }}</td>
                                    @else
                                        <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                    @endif
                                    <td>{{ $corder->company_name }}</td>
                                    <td>{{ date('d.m.Y',strtotime($corder->created_at)) }}</td>
                                    <td>{{ date('d.m.Y',strtotime($corder->expiry))}}</td>
                                    <td>{{ number_format($corder->amount,2) . config('app.currency') }}</td>
                                    <td>
                                        <a href="{{ route('adminorder', [$corder->order_no, $corder->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        {{--<button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"  data-target="#myModal"><span class="fa fa-trash-o"></span></button>--}}
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $corder->id}}"  data-target="#myModal"></button>
                                        @endif
                                    </td>
                                </tr>

                        @endforeach
                        @elseif(!empty($total_cancel_orders ) && $total_cancel_orders > 0)
                            @foreach($canceledorders as $corder)

                                <tr>
                                    <td>{{ $corder->order_no }}</td>
                                    @if(!empty($corder->gig->title ))
                                        <td>{{ $corder->gig->title }}</td>
                                    @endif
                                    @if(!empty($order->agency))
                                        <td  style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                    @else
                                        <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                    @endif
                                    <td>{{ $corder->company_name }}</td>
                                    <td>{{ date('d.m.Y',strtotime($corder->created_at)) }}</td>
                                    <td>{{ date('d.m.Y',strtotime($corder->expiry))}}</td>
                                    <td>{{ number_format($corder->amount,2) . config('app.currency') }}</td>
                                    <td>
                                        <a href="{{ route('adminorder', [$corder->order_no, $corder->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        {{--<button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"  data-target="#myModal"><span class="fa fa-trash-o"></span></button>--}}
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $corder->id}}"  data-target="#myModal"></button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    @endsection


            <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <h3>Are you sure want to delete this order?</h3>
                    <input type="hidden" name="order_id" value="" id="order_id">
                    <!-- select -->
                    <div class="row">
                        <div class="col-md-4">Order</div>
                        <div class="col-md-8" id="order"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">Order Date</div>
                        <div class="col-md-8" id="order_date"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Expire Date</div>
                        <div class="col-md-8" id="expire_date"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Amount</div>
                        <div class="col-md-8" id="order_amount"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" id="yes_order_delete">Yes</button>
                </div>
            </div>
        </div>
    </div>


    @section('pages_css')

            <!-- DataTables -->

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    @endsection





    @section('pages_script')

            <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->


    <script>
//        $(function () {
//            var table = $("#example1").DataTable({
//                "aaSorting": []
//            });
//        });
        $(function () {
            var table = $("#example1").DataTable({

                "aaSorting": [],
                "aLengthMenu": [100]
            });
            $('#orders').on('change',function(){
                var cat = $(this);
                var catId = cat.val();
                if(catId != '') {
                    $('.data-row').hide();
                    $('.data-row').each(function () {
                        if ($(this).data('id') == catId) {
                            $(this).show();
                        }
                    });
                }else{
                    $('.data-row').show();
                }
            });
            {{--//--}}
            {{--$(document).ready(function() {--}}
            {{--$('.trash-btn').click(function () {--}}
            {{--alert('test');--}}
            {{--var button = $(this);--}}

            {{--var rowId = button.data('id');--}}

            {{--$.ajax({--}}
            {{--method: 'DELETE',--}}
            {{--url: "{{ route('orderdelete') }}",--}}
            {{--data: {order_id: rowId},--}}
            {{--}).done(function (data) {--}}
            {{--if (data != 0) {--}}
            {{--notifyMessage('Order Deleted Successfully.', 'success');--}}

            {{--table.row(button.parents('tr')).remove().draw();--}}

            {{--} else {--}}
            {{--notifyMessage('Order Deleting failed please try again.', 'danger')--}}
            {{--}--}}
            {{--});--}}

            {{--})--}}
            {{--});--}}

            {{--//    });--}}
            @if($_GET['status'] == 'pending')
            $(document).ready(function(){
                var table = $("#example1 tbody");
                $.ajaxSetup({cache : false});
                <?php $status =  $_GET['status']; ?>
                setInterval(function(){
                    $.get("{{ route('get.gig.order.block',[$status]) }}" , function(data, status){
                        table.empty();
                        var html = "";
                        data.forEach(function(res){
                            var created_date = new Date(res.created_at);
                            var d = created_date.getDate();
                            var m = created_date.getMonth()+1;
                            var y = created_date.getFullYear();
                            var date_match = d+m+y;
                            var match_date = new Date();
                            var m_d = match_date.getDate();
                            var m_m = match_date.getMonth()+1;
                            var m_y = match_date.getFullYear();
                            var date_match_to = m_d+m_m+m_y;
                            var expiry = new Date(res.expiry);
                            var d1 = expiry.getDate();
                            var m1 = expiry.getMonth()+1;
                            var y1 = expiry.getFullYear();
                            /*console.log(res);*/
                            html += "<tr class='data-row' data-id='"+res.username+"'>";
                            html += "<td>";
                            if(date_match == date_match_to) {
                                html += "<i class='fa fa-star' style='color: #157340;'></i>";
                                html += res.order_no;
                                if (res.status == "review") {
                                    html += "<span class='job_reviewed badge'><i class='icon fa fa-check'></i>Reviewed</span>";
                                } else if (res.status == 'jobdone') {
                                    html += "<span class='job_reviewed badge'><i class='icon fa fa-check'></i>Done by agency</span>";
                                }
                            }else{
                                html += res.order_no;
                                if (res.status == "review") {
                                    html += "<span class='job_reviewed badge'><i class='icon fa fa-check'></i>Reviewed</span>";
                                } else if (res.status == 'jobdone') {
                                    html += "<span class='job_reviewed badge'><i class='icon fa fa-check'></i>Done by agency</span>";
                                }
                            }
                            html +=  "</td>";
                            html += "<td>"+res.title+"</td>";
                            if(res.assigned_to) {
                                html += "<td style='background-color: #157340;color:white;'>" + res.username + "</td>";
                            }else{
                                html += "<td style='background-color: #FBDD0A;color:black'>" + res.username + "</td>";
                            }
                            html += "<td>"+res.company_name+"</td>";
                            html += "<td>" + (d<10 ? '0' : '') + "" + d + "." + (m<10 ? '0' : '') + m + "." + y + "</td>";
                            html += "<td>" + (d1<10 ? '0' : '') + "" + d1 + "." + (m1<10 ? '0' : '') + m1 + "." + y1 + "</td>";
                            html += "<td>"+res.amount+".00€"+"</td>";
                            html += "<td>";
                            if(res.user_active) {
                                @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    html += "<form action='{{ route('adminorderajax') }}' style='margin:0px;'>";
                                html += "<input type='hidden' name='orderno' value='"+res.order_no+"'>";
                                html += "<input type='hidden' name='uuid' value='"+res.uuid+"'>";
                                html += "<button type='submit' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-eye-open'></span></button>";
                                @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    html += "<button style='margin-left:3px;' type='button' class='btn btn-danger btn-xs fa fa-trash-o trash-btn' data-toggle='modal' data-id='"+res.id+"'  data-target='#myModal'></button>";
                                @endif
                                    html += "</form>"
                                @else
                                html += "<a class='btn btn-primary btn-xs alrady-working' disabled style='font-size:11px; margin-bottom: 2px;'><span class='glyphicon glyphicon-eye-open'></span><br>admin working</a>";
                                /*html += "<button type='button' class='btn btn-info btn-xs' id='leave_request' onclick='leave_request()'>Leave request</button>"*/
                                html += "<button type='button' data-order='"+res.order_no+"' data-funnel='"+res.uuid+"' class='btn btn-info btn-xs leave_request'>Leave request</button>";
                                @endif
                            }else{

                                html += "<form action='{{ route('adminorderajax') }}' style='margin:0px;'>";
                                html += "<input type='hidden' name='orderno' value='"+res.order_no+"'>";
                                html += "<input type='hidden' name='uuid' value='"+res.uuid+"'>";
                                html += "<button type='submit' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-eye-open'></span></button>";
                                @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    html += "<button style='margin-left:3px;' type='button' class='btn btn-danger btn-xs fa fa-trash-o trash-btn' data-toggle='modal' data-id='"+res.order_no+"'  data-target='#myModal'></button>";
                                @endif
                                html += "</form>"
                            }
                            if(res.leave_request){
                                $(".leave_request").html("Leave request");

                            }else{
                                $(".leave_request").html("Request sent");
                            }
                            html += "</td>";
                            html += "</tr>"

                        });
                        table.append(html);
                    });
                },1000);
            });
            @endif
            $(document).ready(function(){
                $("#agency").on('change',function(){
                    var val = $(this).val();
                    var table = $("#example1 tbody");
                    var status = "{{$_GET['status']}}";
                    $.ajax({
                        method : "post",
                        url    : "{{ route('filter.search.order.all') }}",
                        data   : {status : status, order_no : val},
                        dataType : "json",
                        success : function(res){
                            table.empty();
                            /*console.log(res);*/
                            res.forEach(function (object) {
                                var created_date = new Date(object.created_at);
                                var d = created_date.getDate();
                                var m = created_date.getMonth()+1;
                                var y = created_date.getFullYear();
                                var date_match = d+m+y;
                                var expiry = new Date(object.expiry);
                                var d1 = expiry.getDate();
                                var m1 = expiry.getMonth()+1;
                                var y1 = expiry.getFullYear();
                                var html = "<tr><td>"+object.order_no+"</td>";
                                    html += "<td>"+object.title+"</td>";
                                    html += "<td style='background-color: #157340;color:white;'>"+object.username+"</td>";
                                    html += "<td>"+object.company_name+"</td>";
                                    html += "<td>" + (d<10 ? '0' : '') + "" + d + "." + (m<10 ? '0' : '') + m + "." + y + "</td>";
                                    html += "<td>" + (d1<10 ? '0' : '') + "" + d1 + "." + (m1<10 ? '0' : '') + m1 + "." + y1 + "</td>";
                                    html += "<td>"+object.amount+".00€"+"</td>";
                                    html += "<td>";
                                    html += "<form action='{{ route('adminorderajax') }}' style='margin:0px;'>";
                                    html += "<input type='hidden' name='orderno' value='"+object.order_no+"'>";
                                    html += "<input type='hidden' name='uuid' value='"+object.uuid+"'>";
                                    html += "<button type='submit' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-eye-open'></span></button>";
                                @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    html += "<button style='margin-left:3px;' type='button' class='btn btn-danger btn-xs fa fa-trash-o trash-btn' data-toggle='modal' data-id='"+object.id+"'  data-target='#myModal'></button>";
                                @endif
                                    html += "</form>";
                                    html += "</td>";
                                table.append(html);
                            });
                        }

                    });
                });
            });
        });
        $(document).on('click','.leave_request', function(){
                var order_no = $(this).data('order');
                var funnel = $(this).data('funnel');
                $.ajax({
                    method : "post",
                    url   : "{{route('leave.request')}}",
                    data  : {order_no:order_no,funnel:funnel},
                    success : function(res){
                        $(".leave_request").html("Request sent");
                        console.log(res);
                    }
                });
        });
$(document).on('click', '.trash-btn', function () {
    var order_id = $(this).data('id');
    $('#order_id').val(order_id);
    $.ajax({
        type: 'get',
        data: 'order_id=' + order_id,
        url: "{{route('pendingOrder')}}",
        success: function (res) {
            // alert(res);
            console.log(res);
            $('#order').html(res.order_no);
            $('#order_date').html(res.created_at);
            $('#expire_date').html(res.expiry);
            $('#order_amount').html(res.amount);
        }
    })
});
order_id
    </script>

@endsection