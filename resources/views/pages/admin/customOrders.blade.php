@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Custom Orders</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    @if(!empty($countorders) && $countorders > 0)
                        <a href="{{ route('orders_csv') }}?type=custom" class="btn btn-primary">Export CSV</a>
                    @endif
                    {{--<a href="/admin/gigs/create" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>--}}
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if($_GET['status'] == "complete" || $_GET['status'] == "cancel")
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
                        @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Created at</th>
                            <th>Order No</th>
                            <th>Company Name</th>
                            <th>Company Email</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                            <th>Products</th>
                            <th>Actions</th>
                            {{--<th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($countpendingorders) && $countpendingorders > 0)
                            @foreach($customOrders as $order)
                                <tr>
                                    <td>{{ date('d.m.Y',strtotime($order->created_at))}}</td>
                                    @if(date('d.m.Y',strtotime($order->created_at)) == date('d.m.Y') )
                                        <td><i class="fa fa-star"
                                               style="color: #157340;"></i> {{ $order->order_no }} @if($order->status == 'review')
                                                <span class="job_reviewed"><i
                                                            class="icon fa fa-check"></i>Reviewed</span>
                                            @elseif($order->status == 'jobdonebyagency')
                                                <span class="btn-success"><i class="icon fa fa-check"></i>Done by agency</span>
                                            @endif
                                        </td>
                                    @else
                                        <td> {{ $order->order_no }} @if($order->status == 'review')<span
                                                    class="job_reviewed"><i
                                                        class="icon fa fa-check"></i>Reviewed</span>@endif</td>
                                    @endif
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ $order->company_email }}</td>
                                    @if(!empty($order->agency))
                                        <td style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                    @else
                                        <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                    @endif
                                    @if($order->amount > 0)
                                        <td><span class="job_accepted"><i class="icon fa fa-check"></i>Accepted</span>
                                        </td>
                                    @else
                                        <td>Pending</td>
                                    @endif
                                    <td>{{ $order->custom_order_products }}</td>
                                    <td>
                                        @if($order->user_active == null)
                                            <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}"
                                               class="btn btn-primary btn-xs"><span
                                                        class="glyphicon glyphicon-eye-open"></span></a>
                                        @else
                                            <a class='btn btn-primary btn-xs alrady-working' disabled
                                               style='font-size:11px; margin-bottom: 2px;'><span
                                                        class='glyphicon glyphicon-eye-open'></span><br>admin
                                                working</a>
                                        @if($order->leave_request == 1)
                                            <button type="button" data-order="{{ $order->order_no }}"
                                                    data-funnel="{{ $order->uuid }}"
                                                    class="btn btn-info btn-xs leave_request">Leave request
                                            </button>
                                        @else
                                                <button type="button" data-order="{{ $order->order_no }}"
                                                        data-funnel="{{ $order->uuid }}"
                                                        class="btn btn-info btn-xs leave_request">Request sent
                                                </button>
                                        @endif
                                        @endif
                                        {{--<button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>--}}
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn"
                                                    data-toggle="modal" data-id="{{ $order->id}}"
                                                    data-target="#myModal"></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @elseif(!empty($countorders) && $countorders > 0)
                            @foreach($completeOrders as $order)
                                <tr>
                                    <td>{{ date('d.m.Y',strtotime($order->created_at))}}</td>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ $order->company_email }}</td>
                                    @if(!empty($order->agency))
                                        <td style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                    @else
                                        <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                    @endif
                                    <td>{{$order->status}}</td>
                                    <td>{{ $order->custom_order_products }}</td>
                                    <td>
                                        <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}"
                                           class="btn btn-primary btn-xs"><span
                                                    class="glyphicon glyphicon-eye-open"></span></a>
                                        {{--<button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>--}}
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn"
                                                    data-toggle="modal" data-id="{{ $order->id}}"
                                                    data-target="#myModal"></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @elseif(!empty($total_cancel_orders) && $total_cancel_orders > 0)
                            @foreach($canceledorders as $order)
                                <tr>
                                    <td>{{ date('d.m.Y',strtotime($order->created_at))}}</td>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ $order->company_email }}</td>
                                    @if(!empty($order->agency))
                                        <td style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                    @else
                                        <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                    @endif
                                    <td>{{$order->status}}</td>
                                    <td>{{ $order->custom_order_products }}</td>
                                    <td>
                                        <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}"
                                           class="btn btn-primary btn-xs"><span
                                                    class="glyphicon glyphicon-eye-open"></span></a>
                                        {{--<button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>--}}
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn"
                                                    data-toggle="modal" data-id="{{ $order->id}}"
                                                    data-target="#myModal"></button>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to delete this order?</h3>
                <input type="hidden" name="order_id" value="" id="order_id">
                <!-- select -->
                <div class="row">
                    <div class="col-md-4">Order No</div>
                    <div class="col-md-8" id="order"></div>
                </div>

                {{--<div class="row">--}}
                {{--<div class="col-md-4">Order Date</div>--}}
                {{--<div class="col-md-8" id="order_date"></div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-4">Expire Date</div>--}}
                {{--<div class="col-md-8" id="expire_date"></div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-4">Amount</div>--}}
                {{--<div class="col-md-8" id="order_amount"></div>--}}
                {{--</div>--}}

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
//        $(function () {
//            var table = $("#example1").DataTable({
//                "aaSorting": []
//            });
//
            $('#example1 tbody').on('click', 'button.btn-del', function () {

                var button = $(this);

                var rowId = button.data('uuid');

                $.ajax({
                    method: 'DELETE',
                    url: '/admin/orders',
                    data: {order_id: rowId},
                }).done(function (data) {
                    if (data != 0) {
                        notifyMessage('Order Deleted Successfully.', 'success');

                        table.row(button.parents('tr')).remove().draw();

                    } else {
                        notifyMessage('Order Deleting failed please try again.', 'danger')
                    }
                });

            });
            @if($_GET['status'] == 'pending')
            $(document).ready(function () {
                var table = $("#example1 tbody");
                $.ajaxSetup({cache: false});
                <?php $status =  $_GET['status']; ?>
                setInterval(function () {
                    $.get("{{ route('get.order.block',[$status]) }}", function (data, status) {
                        table.empty();
                        var html = "";
                        data.forEach(function (res) {
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
                            console.log(res);
                            html += "<tr class='data-row' data-id='"+res.username+"'>";
                            html += "<td>" + (d<10 ? '0' : '') + "" + d +"." + (m<10 ? '0' : '') + m + "." + y + "</td>";
                            html += "<td>";
                            if(date_match == date_match_to) {
                                html += "<i class='fa fa-star' style='color: #157340;'></i>";
                                html +=res.order_no;
                                if (res.status == "review") {
                                    html += "<span class='job_reviewed'><i class='icon fa fa-check'></i>Reviewed</span>";
                                } else if (res.status == 'jobdonebyagency') {
                                    html += "<span class='job_reviewed'><i class='icon fa fa-check'></i>Done by agency</span>";
                                }
                            }else{
                                html += res.order_no;
                                if (res.status == "review") {
                                    html += "<span class='job_reviewed'><i class='icon fa fa-check'></i>Reviewed</span>";
                                } else if (res.status == 'jobdonebyagency') {
                                    html += "<span class='job_reviewed'><i class='icon fa fa-check'></i>Done by agency</span>";
                                }
                            }
                            html +=  "</td>";
                            html += "<td>" + res.company_name + "</td>";
                            html += "<td>" + res.company_email + "</td>";
                            if (res.assigned_to) {
                                html += "<td style='background-color: #157340;color:white;'>" + res.username + "</td>";
                            } else {
                                html += "<td style='background-color: #FBDD0A;color:black'>" + "Not assigned" + "</td>";
                            }
                            if(res.amount > 0) {
                                html += "<td>";
                                html += "<span class='job_accepted'><i class='icon fa fa-check'></i>Accepted</span>"
                                html += "</td>";
                            }else{
                                html += "<td>Pending</td>";
                            }
                            html += "<td>" + res.custom_order_products + "</td>";
                            html += "<td>";
                            if (res.user_active) {
                                html += "<a class='btn btn-primary btn-xs alrady-working' disabled style='font-size:11px; margin-bottom: 2px;'><span class='glyphicon glyphicon-eye-open'></span><br>admin working</a>";
                                html += "<button type='button' data-order='" + res.order_no + "' data-funnel='" + res.uuid + "' class='btn btn-info btn-xs leave_request'>Leave request</button>";
                            } else {

                                html += "<form action='{{ route('adminorderajax') }}' style='margin:0px;'>";
                                html += "<input type='hidden' name='orderno' value='" + res.order_no + "'>";
                                html += "<input type='hidden' name='uuid' value='" + res.uuid + "'>";
                                html += "<button type='submit' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-eye-open'></span></button>";
                                @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    @if(!empty($order))
                                    html += "<button style='margin-left:3px;' type='button' class='btn btn-danger btn-xs fa fa-trash-o trash-btn' data-toggle='modal' data-id='{{ $order->id}}'  data-target='#myModal'></button>";
                                    @endif
                                @endif
                                    html += "</form>"
                            }
                            if (res.leave_request == 1) {
                                $(".leave_request").html("Request sent");

                            } else {
                                $(".leave_request").html("Leave request");
                            }
                            html += "</td>";
                            html += "</tr>"
                        });
                        table.append(html);
                    });
                }, 1000);
            });
            @endif
            $(document).ready(function(){
                $("#agency").on('change',function(){
                    var val = $(this).val();
                    var table = $("#example1 tbody");
                    var status = "{{$_GET['status']}}";
                    $.ajax({
                        method : "post",
                        url    : "{{ route('filter.search.custom.order.all') }}",
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
                                var html = "<tr><td>" + (d<10 ? '0' : '') + "" + d +"." + (m<10 ? '0' : '') + m + "." + y + "</td>";
                                html += "<td>"+object.order_no+"</td>";
                                html += "<td>"+object.company_name+"</td>";
                                html += "<td>"+object.company_email+"</td>";
                                html += "<td style='background-color: #157340;color:white;'>"+object.username+"</td>";
                                html += "<td>"+object.status+"</td>";
                                html += "<td>"+object.custom_order_products+"</td>";
                                html += "<td>";
                                html += "<form action='{{ route('adminorderajax') }}' style='margin:0px;'>";
                                html += "<input type='hidden' name='orderno' value='"+object.order_no+"'>";
                                html += "<input type='hidden' name='uuid' value='"+object.uuid+"'>";
                                html += "<button type='submit' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-eye-open'></span></button>";
                                @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    html += "<button style='margin-left:3px;' type='button' class='btn btn-danger btn-xs fa fa-trash-o trash-btn' data-toggle='modal' data-id='"+object.id+"'  data-target='#myModal'></button>";
                                @endif
                                    html += "</form>";
                                html += "</td></tr>";
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
        $(document).on('click','#yes_order_delete', function () {

            var order_id = $('#order_id').val();

            $.ajax({
                type: 'get',
                data: 'order_id=' + order_id,
                url: "{{ route('orderdelete') }}",
                beforeSend: function () {
                    $('#yes_order_delete').empty().html('Please wait...')
                },
                success: function (res) {
                    console.log(res);
                    if (res > 0) {
                        location.reload();
                    }
                    else {
                        alert('Ops! some thing goes wrong.. Please try again.')
                    }
                }
            });
        });
    </script>
@endsection