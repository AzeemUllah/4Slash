@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Orders</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    <a href="/admin/gigs/create" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Gig</th>
                            <th>Company Name</th>
                            <th>Expire Date</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_no }}</td>
                                <td>{{ $order->gig->title }}</td>
                                <td>{{ $order->company_name }}</td>
                                <td>{{ $order->expiry}}</td>
                                <td>{{ $order->amount . config('app.currency') }}</td>
                                <td>
                                    <a href="{{ route('adminorder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                    <button data-id="{{ $order->uuid }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
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

            $('#example1 tbody').on('click', 'button.btn-del', function() {

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

            });

        });
    </script>

@endsection