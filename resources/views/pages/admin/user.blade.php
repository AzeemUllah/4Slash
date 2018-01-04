@extends('pages.admin.admin_template')
        <!-- Content -->

@section('header_title')


@endsection
@section('content')






    <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
            <h3 class="widget-user-username">{{ $user->username }}</h3>
            <h5 class="widget-user-desc"></h5>
        </div>
        <div class="widget-user-image">
            @if(!empty($user->profile_image))
                <img class="img-circle" src="{{ $user->profile_image }}" alt="User Avatar">
            @else
                <img class="img-circle" src="http://placehold.it/128x128" alt="User Avatar">
            @endif
        </div>
        <div>
            <h2 style=" margin-left: 9px;">User Details</h2>
            <div class="box-info" style="padding: 13px">
                <table class="table">
                    <tbody>
                    @if(!empty($userDetails))
                            <tr>
                                <td style="border: none; padding: 2px;">{{ $userDetails->company }}</td>
                                </tr>
                            <tr>

                                <td  style="border: none; padding: 2px;">{{ $user->name }}</td>

                            </tr>
                               <tr>
                                   <td  style="border: none; padding: 2px;">
                                       {{ $userDetails->postal_address }}
                                   </td>
                               </tr>

                               <tr>
                                   <td  style="border: none; padding: 2px;">
                                       {{ $userDetails->zip }}
                                   </td>
                               </tr>
                            <tr>

                                <td  style="border: none; padding: 2px;">
                                    {{ $userDetails->country}}

                                </td>
                            </tr>
                    @endif
                    </tbody>

                </table>

            </div>


        </div>
        <div>
            <h2>Order History</h2>

            <div class="box box-info">
                <div class="box-header with-border">

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                    </div>
                </div>

                <div class="box-body">
                    <table class="table table-striped new table-payment-transactions">
                        <thead>
                        <tr>
                            <th>Completed Orders</th>
                            <th>Pending Orders</th>
                        </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>{{ config('app.currency') . number_format($completedOrdersAmount + $completedOrdersServiceCharges,2)  }}</td>
                                <td>{{config('app.currency') .number_format($pendingOrdersAmount + $pendingOrdersServiceCharges,2)}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                    <!-- /.box-body -->
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        <div>
            <h2>Transfers</h2>

            <div class="box box-info">
                <div class="box-header with-border">
            <h3 class="box-title">
                Transfers</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-minus"></i>
                </button>
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
            </div>
        </div>
         <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th style="text-align:right;">Sum</th>
                    </tr>

                    </thead>
                    <tbody>
                    @if(count($completedOrders) > 0)
                        @foreach($completedOrders as $completedOrder)
                            <tr>
                                <td>{{ date("M d, Y", strtotime($completedOrder->updated_at)) }}</td>
                                <td>{{ $completedOrder->gig ?  $completedOrder->gig->title : $completedOrder->package->title  }} <a href="{{ route('orderinvoice', ['orderno' => $completedOrder->order_no, 'invoiceno' => $completedOrder->invoice->invoice_no]) }}">(Bill)</a></td>
                                <td style="text-align:right; color:#33a5dd">{{ config('app.currency') . number_format($completedOrder->amount,2) }}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
        </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('pages_css')

        <!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">


@endsection
@section('pages_script')

        <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            var table = $("#example1").DataTable();

            $('#example1 tbody').on('click', 'button.btn-del', function () {

                table.row($(this).parents('tr')).remove().draw();

            });

        });
    </script>

    @endsection

</body>
</html>