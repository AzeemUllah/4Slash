@extends('pages.admin.admin_template')


@section('header_title')


@endsection




@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active text-center" style="height:70px;">
                    <h3 class="widget-user-username">{{ $agency->name }}</h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                {{--<div class="widget-user-image">
                    <img class="img-circle" src="http://placehold.it/128x128" alt="User Avatar">
                </div>--}}
                @if(\Illuminate\Support\Facades\Auth::admin()->get()->type != 'subadmin')
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text"></span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Wallet Amount</h5>

                                <span class="description-text">{{config('app.currency')}}{{ number_format($agency->wallet,2) }}</span>

                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">
                                                                        <!-- Modal -->
                                </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                @endif
            </div>
            <!-- /.widget-user -->
            <div style="background: #fff; padding: 10px;">
                <h2 style="margin-left: 10px;">Agency Details</h2>
                <div class="box-info">
                    <table class="table">
                        <tbody>
                        @if(!empty($agencyDetails))
                            <tr>
                                <td style="border: none;">
                                    {{ $agencyDetails->agency_name }}
                                </td>
                                </tr>
                                {{--<td>{{ $agency->username }}</td>--}}
                                <tr>
                                    <td style="border: none;">{{ $agency->email }}</td>
                                </tr>
                            <tr>

                                <td style="border: none;">{{ $agencyDetails->skills }}</td>
                            </tr>
                            <tr>
                                <td style="border: none;">
                                    {{ $agencyDetails->postal_code }}
                                </td>
                            </tr>
                                {{--<td>
                                    {{ $agencyDetails->billing_address}}

                                </td>--}}
                            <tr>
                                <td style="border: none;">
                                    {{ $agencyDetails->city }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none;">
                                    {{ $agencyDetails->country }}
                                </td>
                            </tr>
                                {{-- <td>
                                     {{ $userDetails->gender }}
                                 </td>--}}
                        @endif
                        </tbody>

                    </table>
                </div>
                <h2 style="margin-left: 10px;">Payment Details</h2>
                <div class="box-info2">
                    <table class="table">
                        <tbody>
                        @if(!empty($get_agency_pay_details))
                            <tr>
                                <td><b>Bank Name:</b></td>
                                <td>{{ $get_agency_pay_details->bank_name }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Account number:</b></td>
                                <td>{{ $get_agency_pay_details->acct_number }}</td>
                            </tr>
                            <tr>
                                <td><b>Account type:</b></td>
                                <td>{{ $get_agency_pay_details->acct_type }}</td>
                            </tr>
                            <tr>
                                <td><b>Bank address:</b></td>
                                <td>{{ $get_agency_pay_details->bank_address }}</td>
                            </tr>
                            <tr>
                                <td><b>City:</b></td>
                                <td>{{ $get_agency_pay_details->city }}</td>
                            </tr>
                            <tr>
                                <td><b>Country:</b></td>
                                <td>{{ $get_agency_pay_details->country }}</td>
                            </tr>
                            <tr>
                                <td><b>Postal code:</b></td>
                                <td>{{ $get_agency_pay_details->postal_code }}</td>
                            </tr>
                            <tr>
                                <td><b>Paypal account:</b></td>
                                <td>{{ $get_agency_pay_details->paypal_acct }}</td>
                            </tr>
                            <tr>
                                <td><b>IBAN number:</b></td>
                                <td>{{ $get_agency_pay_details->iban_number }}</td>
                            </tr>
                            <tr>
                                <td><b>Swift code:</b></td>
                                <td>{{ $get_agency_pay_details->swiss_code }}</td>
                            </tr>
                        @else
                            <p>Inform agency for complete his payment details</p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <h2>Orders</h2>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Pending Orders
                            ({{ $agency['pendingOrders']->count() }})</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Completed
                            Orders ({{ $agency['completedOrders']->count() }})</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Pending Orders ({{ $agency['pendingOrders']->count() }})</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>Order No</th>
                                            {{--<th>Gig</th>--}}
                                            <th>Company Name</th>
                                            <th>Expire Date</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($agency['pendingOrders'] as $pendingOrder)
                                            <?php

                                                    $expiry= explode(' ', $pendingOrder->expiry);
                                                    $dateExpiry = explode('-', $expiry[0]);
                                                    $dateExpiry = $dateExpiry[2].'-'.$dateExpiry[1].'-'.$dateExpiry[0];
                                                    $date = new DateTime();
                                                    $match_date = new DateTime($dateExpiry);
                                                    $interval = $date->diff($match_date);



                                            ?>
                                            <tr>
                                                @if($interval->days == 0 || !($interval->invert == 0))
                                                {{--@if(strtotime($dateExpiry) <= strtotime($day))--}}
                                                    <td style="color: red;">{{ $pendingOrder->order_no }}</td>
                                                @else
                                                    <td>{{ $pendingOrder->order_no }}</td>
                                                @endif

                                                {{--<td>{{ $pendingOrder->gig->title }}</td>--}}
                                                <td>{{ $pendingOrder->company_name }}</td>
                                                <td>{{date("d.m.Y",strtotime($pendingOrder->expiry))}}
                                                    @if($interval->days == 0 || !($interval->invert == 0))
                                                        <span class="text-right" style="font-size:10px"><b style="color:#ff0000">fällig bis: </b>{{ $dateExpiry }}</span>
                                                    @else
                                                        <span class="text-right" style="font-size:10px"><b style="color:#ccc">fällig bis: </b>{{ $dateExpiry }}</span>

                                                    @endif
                                                </td>
                                                <td>{{ config('app.currency') }}{{ number_format($pendingOrder->amount,2) }}</td>
                                                <td>
                                                    <a href="{{ route('adminorder', [$pendingOrder->order_no, $pendingOrder->uuid]) }}"
                                                       class="btn btn-primary btn-xs"><span
                                                                class="glyphicon glyphicon-eye-open"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                {{--<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>--}}
                                {{--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>--}}
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Completed Orders ({{ $agency['completedOrders']->count() }})</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Favor</th>
                                            <th>Company Name</th>
                                            <th>Expire Date</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($agency['completedOrders'] as $completedOrder)
                                            <?php
                                            $expiry = explode(' ', $completedOrder->expiry );
                                            $dateExpiry = explode('-', $expiry[0]);
                                            $dateExpiry = $dateExpiry[2].'-'.$dateExpiry[1].'-'.$dateExpiry[0];
                                            $date = new DateTime();
                                            $match_date = new DateTime($dateExpiry);
                                            $interval = $date->diff($match_date);
                                            $day = date('d-m-Y');

                                            ?>

                                            <tr>
                                                {{--@if(strtotime($dateExpiry) <= strtotime($day))--}}
                                                    @if($interval->days == 0 || !($interval->invert == 0))
                                                <td style="color: red;">{{ $completedOrder->order_no }}  </td>
                                                    @else
                                                    <td>{{ $completedOrder->order_no }}</td>
                                                @endif
                                                @if($completedOrder->gig)
                                                <td>{{ $completedOrder->gig->title }}</td>
                                                @elseif($completedOrder->package)
                                                <td>{{ $completedOrder->package->title }}</td>
                                                @else
                                                <td>{{ $completedOrder->custom}}</td>
                                                @endif
                                                <td>{{ $completedOrder->company_name }}</td>
                                                <td>{{ date('d.m.Y',strtotime($completedOrder->expiry)) }}@if($interval->days == 0 || !($interval->invert == 0))
                                                        <span class="text-right" style="font-size:10px"><b style="color:#ff0000">fällig bis: </b>{{ $dateExpiry }}</span>
                                                    @else
                                                        <span class="text-right" style="font-size:10px"><b style="color:#ccc">fällig bis: </b>{{ $dateExpiry }}</span>

                                                    @endif</td>
                                                <td>{{ config('app.currency') }}{{ number_format($completedOrder->amount,2) }}</td>
                                                <td>
                                                    <a href="{{ route('adminorder', [$completedOrder->order_no, $completedOrder->uuid]) }}"
                                                       class="btn btn-primary btn-xs"><span
                                                                class="glyphicon glyphicon-eye-open"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                {{--<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>--}}
                                {{--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>--}}
                            </div>
                            <!-- /.box-footer -->
                        </div>

                    </div>
                </div>

            </div>

            @if(\Illuminate\Support\Facades\Auth::admin()->get()->type != 'subadmin')
            <div>
                <h2>Payment History</h2>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Payment History</h3>

                        <div class="box-tools pull-right">
                            <a  class="btn btn-primary"  href="{{ route('agencyPaymentsExport') }}?agency_id={{$agency->id}}" id="payments_export">Export CSV</a>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    
                    <div class="box-body agency_invoice">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                    <th>Invoice Number</th>
                                    <th>Payable</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 
                                @foreach($agency['agencyInvoices'] as $agencyInvoice)
                                    <tr>
                                        <td>{{ $agencyInvoice->id }}</td>
                                        <td>{{ date('d.m.Y',strtotime($agencyInvoice->created_at)) }}</td>
                                        <td>{{ $agencyInvoice->detail }}</td>
                                        @if(empty($agencyInvoice->order_no))
                                            <td><a href="{{ route('admin.invoice',['invoiceNo'=>$agencyInvoice->invoiceno]) }}" target="_blank">{{ $agencyInvoice->invoiceno }}</a></td>
                                        @else
                                        <td>{{$agencyInvoice->invoiceno}}</td>
                                        @endif
                                        <td>{{ config('app.currency') }}{{ number_format($agencyInvoice->payable,2) }}</td>
                                        <td class="append-pointer">{{ config('app.currency') }}{{ number_format($agencyInvoice->paid,2) }}@if($agencyInvoice->invoice_status == "Transferred")<em></em>@endif</td>
                                        <td>{{ config('app.currency') }}{{ number_format($agencyInvoice->balance,2) }}</td>
                                        @if(empty($agencyInvoice->order_no) && !empty($agencyInvoice->invoiceno))
                                        <td>
                                            <div class="form-group">
                                                <select name="status" class="status form-control">
                                                    {{--@if($agency->request_withdraw == 1)--}}
                                                    {{--<option value="Paypable">Paypable</option>--}}
                                                    {{--@endif--}}
                                                    <option value="" disabled {{$agencyInvoice->invoice_status!=""? '':'selected'}}>Select status</option>
                                                    <option value="" {{$agencyInvoice->invoice_status==""? 'selected':''}}>Payable</option>
                                                    <option value="In process" {{$agencyInvoice->invoice_status=="In process"? 'selected':''}}>In process</option>
                                                    <option value="Transferred" {{$agencyInvoice->invoice_status=="Transferred"? 'selected':''}}>Transferred</option>
                                                </select>
                                                <input type="hidden" name="invoice_number" value="{{ $agencyInvoice->invoiceno }}" class="number">
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>
                                        @if($agency->request_withdraw > 0 && $agencyInvoice->invoice_status == "payable" || $agencyInvoice->invoice_status == "In Process")
                                            <!-- Button trigger modal -->
                                            @if(!empty($get_agency_pay_details))
                                                <button type="button" {{$agency->wallet > 0 ? '':'disabled'}} class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                                    Transfer Amount
                                                </button>
                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                                                                </div>
                                                                @if($agency->wallet > 25)
                                                                    <div class="modal-body">
                                                                        Are you sure you want to release the fund to the agency?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form method="post" action="{{ route('agency.amount.withdraw') }}">
                                                                            <input type="hidden" name="agencyId" value="{{ $agency->id }}">
                                                                            <input type="hidden" name="with_amnt" value="{{ number_format($agencyInvoice->paid,2) }}">
                                                                            <input type="hidden" name="invno" value="{{$agencyInvoice->invoiceno}}">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                                                        </form>
                                                                    </div>
                                                                @else
                                                                    <div class="box">
                                                                        <p style="color:red; font-size:40px;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>
                                                                        <p>You can not proceed withdrawal, agency balance in less than {{ config('app.currency') }}25.00.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-primary" disabled>Confirm</button>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                            @else
                                                <button type="button" class="btn btn-primary btn-sm" id="pay-details-restrict">
                                                    Request Withdraw
                                                </button>
                                            @endif
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{--<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>--}}
                        {{--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>--}}
                    </div>
                    <!-- /.box-footer -->
                </div>

            </div>
            <div>


                </div>
            @endif
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
            var table2 = $("#example2").DataTable();
            $('#example1 tbody').on('click', 'button.btn-del', function () {

                table.row($(this).parents('tr')).remove().draw();

            });

            /*$('#payments_export').click(function(){

                var button = $(this);
                var data = button.data('id');
                var url = button.data('url');
                $.ajax({
                    type: 'get',
                    data:  'agency_id=' + data,
                    url:   url,
                    success: function (res) {
                        // alert(res);
                        console.log(res);
                    }
                })
            })*/

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#pay-details-restrict").click(function () {
                alert("Inform agency to complete his payment details first!");
            });
            $("#example1 tbody").on('change',".status", function(){
                var status = $(this).val();
                var invoice = $(this).parent().find(".number").val();
                var url = "<?php echo route('status.changed'); ?>";

                var self = $(this).parent().parent().parent().find(".append-pointer");
                console.log(self);
                var data = {
                    'status': status,
                    'invoice_number': invoice

                };
                $.ajax({
                    method:'post',
                    url:url,
                    data:data,
                    success:function(data){
                        if(status == "Transferred") {
                            self.append("<em></em>");
                        }else{
                            self.find("em").remove();
                        }
                        console.log(data);
                    }
                });
            });
        })
    </script>
@endsection