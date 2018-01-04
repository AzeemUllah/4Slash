@include('includes.header')

<!-- Content -->
        <div class="notify-main-content top-gap" style="max-height: 1350px ;min-height: 1080px;">
            <div class="container">
                <div class="well">
                    <div class="col-md-4">
                        <h1 style="padding:34px 52px;color: #161d28;">My payments</h1>
                    </div>
                    <div class="upper-pay col-md-8">
                        <div class="well pay-box" style="background-color:white;">
                            <div class="row text-center pay-sect">
                                <div class="col-xs-4 " style="border-right: 1px solid #ccc;">
                                <h1 class="upper text-center"><?php $total_amount = ($pendingOrdersAmount + $pendingOrdersServiceCharges); $total_amount = str_replace('.', ',', number_format($total_amount, 2))?>{{ config('app.currency') . $total_amount }}</h1>
                                <h1 style="color:black; font-size:14px; text-align: center">Current orders</h1>
                                </div>
                                <div class="col-xs-4">
                                <h1 class="upper text-center"><?php $total_complete_amount = ($completedOrdersAmount + $completedOrdersServiceCharges); $total_complete_amount = str_replace('.', ',', number_format($total_complete_amount, 2))?>{{ config('app.currency') . $total_complete_amount }}</h1>
                                    <h1 style="color:black; font-size:14px; text-align: center">Finished orders
                                    </h1>
                                </div>
                                <div class="col-xs-4">
                                    <h1 class="upper text-center">{{ config('app.currency') . $wallet }}</h1>
                                    <h1 style="color:black; font-size:14px; text-align: center">Wallet
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="upper-pay" style="min-height: 330px; max-height: 340px; overflow-y: auto;">
        <div class="table-content">
        <table id="example1" class="table table-bordered table-striped table-payment-transactions">
    <thead>
      <tr>
        <th>Date</th>
        <th>Description</th>
        <th>Order number</th>
        <th>Bill number</th>
        <th style="text-align:right;">total</th>
      </tr>

    </thead>
    <tbody>
        @if(count($completedOrders) > 0)
            @foreach($completedOrders as $completedOrder)
              <tr>
                  <td>{{ date("M d, Y", strtotime($completedOrder->updated_at)) }}</td>
                  @if(!empty($completedOrder->gig->title) )
                  <td>{{  $completedOrder->gig->title }} </td>
                  @elseif(!empty($completedOrder->package->title))
                  <td>{{ $completedOrder->package->title }} </td>
                  @else
                      <td>{{ $completedOrder->custom }} </td>
                  @endif
                  <td>{{ $completedOrder->order_no  }}</td>
                  <td><a href="{{ route('orderinvoice', ['orderno' => $completedOrder->order_no, 'invoiceno' => $completedOrder->invoice->invoice_no]) }}" target="_blank">{{$completedOrder->invoice->invoice_no}}</a></td>
                  <td style="text-align:right; color:#33a5dd"><?php $amount = str_replace('.', ',', number_format($completedOrder->amount + $completedOrder->service_charges, 2))?> {{ config('app.currency') . $amount }}</td>
              </tr>
            @endforeach
        @endif
      
      {{--<tr>--}}
        {{--<td class="text-center" colspan="3">You have no transactions.</td>--}}
        {{----}}
      {{--</tr>--}}
      
    </tbody>
  </table>
    </div>
    </div>
                </div>
            </div>
        </div>
<!-- DataTables -->

<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">

 @include('includes.footer');

<!-- DataTables -->
<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- page script -->
<script>
$(function () {
    var table = $("#example1").DataTable({

        "aaSorting": [],
        "oLanguage": {
            "sSearch": "Search"
        }
    });
    $("#example1").parent().addClass("overFlow_auto");
})
</script>
      
    </body>
</html>