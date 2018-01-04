@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Packages Orders</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    @if(!empty($CountpackagesCompleteOrders) && $CountpackagesCompleteOrders)
                    <a href="{{ route('orders_csv') }}?type=package" class="btn btn-primary">Export CSV</a>
                    @endif
                    {{--<a href="/admin/gigs/create" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>--}}
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Status</th>
                            <th>Package</th>
                            <th>Assigned to</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($pendingordersCount) && $pendingordersCount > 0)
                            @foreach($packagesOrders as $order)
                                
                            <tr>
                                @if(date('d.m.Y', strtotime($order->created_at)) == date('d.m.Y'))
                                <td><i class="fa fa-star" style="color: #157340;"></i> {{ $order->order_no }} @if($order->status == 'review')
                                        <span class="job_reviewed"><i class="icon fa fa-check"></i>Reviewed</span>
                                    @elseif($order->status == 'jobdonebyagency')
                                        <span class="btn-success"><i class="icon fa fa-check"></i>Done by agency</span>
                                    @endif
                                </td>
                                @else
                                <td><i class="fa fa-star" style="color: #157340;"></i> {{ $order->order_no }} @if($order->status == 'review')<span class="job_reviewed"><i class="icon fa fa-check"></i>Reviewed</span>@endif</td>
                                @endif
                                <td>{{ $order->status }}</td>
                                @if(!empty($order['package']))
                                <td>{{ $order['package']->title }}</td>
                                    @if(!empty($order->agency))
                                        <td  style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                    @else
                                        <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                    @endif
                                <td>{{config('app.currency')}}{{ number_format($order['package']->price,2) }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                        <button data-id="{{ $order->order_no }}" class="btn btn-danger btn-xs trash-btn" data-target='#myModal' data-toggle="modal"><span class="fa fa-trash-o"></span></button>
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
                                    @endif
                                </td>
                            </tr>

                            @endforeach
                        @elseif(!empty($CountpackagesCompleteOrders) && $CountpackagesCompleteOrders)
                            @foreach($packagesCompleteOrders as $order)

                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->status }}</td>
                                    @if(!empty($order['package']))
                                        <td>{{ $order['package']->title }}</td>
                                        @if(!empty($order->agency))
                                            <td  style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                        @else
                                            <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                        @endif
                                        <td>{{config('app.currency')}}{{ number_format($order['package']->price,2) }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            @elseif(!empty($total_cancel_orders) && $total_cancel_orders)
                            @foreach($canceledorders as $order)

                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->status }}</td>
                                    @if(!empty($order['package']))
                                        <td>{{ $order['package']->title }}</td>
                                        @if(!empty($order->agency))
                                            <td  style="background-color:#157340; color: #ffffff; ">{{ $order->agency->username }}</td>
                                        @else
                                            <td style="background-color: #FBDD0A; color: black;">Not assigned</td>
                                        @endif
                                        <td>{{config('app.currency')}}{{ number_format($order['package']->price,2) }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>
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
    <!-- Modal -->
    @endsection




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
                "aaSorting": []
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
                        /*console.log(order_id);*/
                        $('#order').html(res.order_no);
                        $('#order_date').html(res.created_at);
                        $('#expire_date').html(res.expiry);
                        $('#order_amount').html(res.amount);
                    }
                })
            });

            /*$('#example1 tbody').on('click', 'button.btn-del', function() {

                var button = $(this);

                var rowId = button.data('uuid');

                $.ajax({
                    method: 'DELETE',
                    url: '/admin/orders',
                    data: { order_id: rowId },
                }).done(function(data) {
                    if(data != 0) {
                        notifyMessage('Order Deleted Successfully.', 'success');

                        table.row( button.parents('tr') ).remove().draw();

                    } else {
                        notifyMessage('Order Deleting failed please try again.', 'danger')
                    }
                });

            });*/
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

        });
    </script>

@endsection