@include('includes.header')



<!-- begin::Body -->
<section>
    <div class="col-md-12" style="margin-top: 90px;">
        <!--begin:: Widgets/Application Sales-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            My payments
                        </h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <h1 class="upper text-center"><?php $total_amount = ($pendingOrdersAmount + $pendingOrdersServiceCharges); $total_amount = number_format($total_amount, 2)?>{{ config('app.currency') . $total_amount }}</h1>
                    <h1 style="color:black; font-size:14px; text-align: center">Current orders</h1>
                </div>

                <div class="col-md-4">
                    <h1 class="upper text-center"><?php $total_complete_amount = ($completedOrdersAmount + $completedOrdersServiceCharges); $total_complete_amount = number_format($total_complete_amount, 2)?>{{ config('app.currency') . $total_complete_amount }}</h1>
                    <h1 style="color:black; font-size:14px; text-align: center">Finished orders
                    </h1>
                </div>

            </div>

        </div>
        <!--end:: Widgets/Application Sales-->
    </div>
    <div class="container-fluid" style="width: 80%;">

        <table id="myTable" class="table table-hover">
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
                        <td style="text-align:right; color:#33a5dd"><?php $amount = number_format($completedOrder->amount + $completedOrder->service_charges, 2)?> {{ config('app.currency') . $amount }}</td>
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
</section>
<!-- end::Body -->

@include('includes.footer')



