@extends('pages.agency.agency_template')
@section('header_title')
    @if(\Illuminate\Support\Facades\Session::has('updated'))
        <div class="alert alert-success alert-dismissible">
            <h5><i class="icon fa fa-check"></i><span>Your request for the amount withdraw has been submitted</span>
                <br><span>The accounts department contact you as soon as possible</span>
            </h5>
            <h5><i class="icon fa fa-check"></i><span>Ihre Anfrage zur Übersendung der Provisionen ist eingereicht worden.
</span>
                <br><span>Die Buchhaltung meldet sich in Kürze bei Ihnen zurück.</span>
            </h5>
        </div>
    @endif
    <h1>Profile</h1>

@endsection

@section('content')

    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="col-sm-9 col-xs-12">
            <div style="display: inline-block; float: right;padding: 20px 0px 0px 0px;">
                <div class="description-block">
                    <h5 class="description-header"></h5>
                                <span class="description-text">
                                    <!-- Button trigger modal -->
                                    @if(!empty($get_agency_Detail))
                                        <button type="button" {{$agency->wallet > 0 && $agency->request_withdraw == 0 ? '':'disabled'}} class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" id="sent-request">
                                            @if($agency->request_withdraw == 0)
                                                Request Withdraw
                                            @else
                                                Withdraw request sent
                                            @endif
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary btn-md" id="pay-details-restrict">
                                            Request Withdraw
                                        </button>
                                    @endif
                                    @if(!empty($get_agency_Detail))
                                    <p><a href="{{route('agencyprofile')}}" style="text-transform: initial;" target="_blank">Complete your payment details here</a></p>
                                    @endif
                                                <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                                                    </div>
                                                    <div class="modal-body" style="text-transform: capitalize;">
                                                        @if($agency->wallet > 25)
                                                        Do you really want to withdraw Amount?
                                                        <div class="box" style="box-shadow: none;">
                                                            <div class="form-group text-left av_fund">
                                                                <span>
                                                                    <b>Available Funds</b>
                                                                </span>
                                                                <span class="av_fund_amt">
                                                                    {{ config('app.currency').number_format($agency->wallet,2)}}
                                                                </span>
                                                            </div>
                                                            @if(!empty($get_agency_Detail->paypal_acct))
                                                            <div class="form-group text-left" style="margin-top: 10px;">
                                                                <h6><b>Select a Withdrawal Type</b></h6>
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <label for="amount1">
                                                                    <input type="radio" id="amount1" name="amount" value="{{ $service->paypal_services }}">
                                                                </label>
                                                                            </td>
                                                                            <td class="gap_adjust">
                                                                                <img style="max-width: 100px;" src="/img/Paypal_logo.png" alt="paypal">
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                $total = $agency->wallet - $service->paypal_services;
                                                                                $net = number_format($total,2);
                                                                                ?>
                                                                                {{$get_agency_Detail->paypal_acct}}<br>
                                                                        Paypal services charges are ({{ config('app.currency') }}{{ number_format($service->paypal_services,2) }}
                                                                                )
                                                                                <span class="pmnt-info">
                                                                                    <i class="fa fa-info" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ config('app.currency').$net}} will be transferred to your account"></i>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @endif
                                                            @if(!empty($get_agency_Detail->acct_number) && !empty($get_agency_Detail->acct_type && !empty($get_agency_Detail->bank_address)))
                                                            <div class="form-group text-left">
                                                                <table>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <label for="amount2">
                                                                    <input type="radio" id="amount2" name="amount" value="{{ $service->bank_services }}">
                                                                </label>
                                                                        </td>
                                                                        <td>
                                                                            <img style="max-width: 120px;" src="/img/bank.png" alt="paypal">
                                                                        </td>
                                                                        <td>
                                                                                <?php
                                                                            $total = $agency->wallet - $service->bank_services;
                                                                            $net = number_format($total,2);
                                                                            ?>
                                                                            {{$get_agency_Detail->bank_name}}<br>
                                                                        Bank services charges are ({{ config('app.currency') }}{{ number_format($service->bank_services,2) }}
                                                                            )
                                                                                <span class="pmnt-info">
                                                                                    <i class="fa fa-info" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ config('app.currency').$net}} will be transferred to your account"></i>
                                                                                </span>
                                                                            </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @else
                                                                <p>Please complete your payment details first!</p>
                                                            @endif
                                                        </div>
                                                        @else
                                                            <div class="box">
                                                                <p style="color:red; font-size:40px;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>
                                                                {{--<p>You can not send withdrawal request, your balance in less than {{ config('app.currency') }}25.00.</p>--}}
                                                                <p>Sie können zur Zeit keine Wiederrufsanfrage senden, da Ihr Guthaben weniger als € 25 beträgt.<br>
                                                                    You have Balance less than €25"</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{ route('request.amount.withdraw') }}" id="amountWithdraw">
                                                            <input type="hidden" name="agencyId" value="{{ $agency->id }}">
                                                            <input type="hidden" name="amount" class="amount" value="">
                                                            <input type="hidden" name="pay-method" class="pay-method" value="">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary confirmRequest" disabled>Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </span>
                </div>
                <!-- /.description-block -->
            </div>
            <div>
                <h2>Orders  / Bestellungen</h2>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Pending Orders
                        @if(!empty($pendingOrders) || $pendingOrders->count()!=0)
                                ({{ $pendingOrders->count() }})
                        @endif
                        </a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Completed
                            Orders
                            @if(!empty($completedOrders) || $completedOrders->count()!=0)
                            ({{ $completedOrders->count() }})
                            @endif
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Pending Orders

                                    @if(!empty($pendingOrders) || $pendingOrders->count()!=0)
                                        ({{ $pendingOrders->count() }})
                                    @endif</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>Order No / Bestellnummer</th>
                                            <th>Favor</th>
                                            <th>Company Name / Firmenname</th>
                                            <th>Expiry Date / Ablaufdatum</th>
                                            <th>Amount / Menge</th>
                                            <th>See</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        {{--{{ $pendingOrders }}
                                        {{ exit }}--}}
                                        @if(count($pendingOrders) > 0)
                                            @foreach($pendingOrders as $pendingOrder)
                                                <?php

                                                $expiry = explode(' ', $pendingOrder->expiry);
                                                $dateExpiry = explode('-', $expiry[0]);
                                                $dateExpiry = $dateExpiry[2] . '-' . $dateExpiry[1] . '-' . $dateExpiry[0];
                                                $date = new DateTime();
                                                $match_date = new DateTime($dateExpiry);
                                                $interval = $date->diff($match_date);
                                                $day = date('d-m-Y');


                                                ?>
                                                <tr>

{{--
                                                    @if($interval->days == 0 || ($interval->invert != 0))
--}}
                                                        @if(strtotime($dateExpiry) <= strtotime($day))
                                                            <td><span class="pull-left">{{ $pendingOrder->order_no }}</span> <span class="badge" style="background: red; font-size: 10px; margin-left: 5px;">Late Delivery</span></td>
                                                        @else
                                                            <td>{{ $pendingOrder->order_no }}</td>
                                                        @endif

                                                        @if($pendingOrder->gig != null)
                                                            <td>{{ $pendingOrder->gig->title }}</td>
                                                        @elseif($pendingOrder->package)
                                                            <td>{{ $pendingOrder->package->title }}</td>
                                                        @elseif( $pendingOrder->custom)
                                                            @if($pendingOrder->custom == "gig")
                                                                <td>Favor</td>
                                                            @elseif($pendingOrder->custom == "custom")
                                                                `<td>custom</td>
                                                            @else
                                                                <td>Package</td>
                                                            @endif
                                                        @else
                                                            <td></td>
                                                        @endif

                                                        {{--
                                                                                                                <td>{{ $pendingOrder->gig->title }}</td>
                                                        --}}
                                                        <td>{{ $pendingOrder->company_name }}</td>
                                                        <td>{{date("d.m.Y", strtotime($pendingOrder->expiry))}}
                                                            @if($interval->days == 0 || !($interval->invert == 0))
                                                                <span class="text-right" style="font-size:10px"><b
                                                                            style="color:#ff0000">fällig
                                                                        bis: </b>{{ $dateExpiry }}</span>
                                                            @else
                                                                <span class="text-right" style="font-size:10px"><b
                                                                            style="color:#ccc">fällig
                                                                        bis: </b>{{ $dateExpiry }}</span>

                                                            @endif
                                                        </td>
                                                        <td>{{ config('app.currency') }}{{ number_format($pendingOrder->amount,2) }}</td>
                                                        <td>
                                                            <a href="{{ route('agencySingleOrder', [$pendingOrder->order_no, $pendingOrder->uuid]) }}"
                                                               class="btn btn-primary btn-xs"><span
                                                                        class="glyphicon glyphicon-eye-open"></span></a>
                                                        </td>
                                                </tr>
{{--
                                                @endif
--}}
                                            @endforeach
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix" style="display: none">
                                {{--<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New--}}
                                    {{--Order</a>--}}
                                {{--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All--}}
                                    {{--Orders</a>--}}
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Completed Orders ({{ $completedOrders->count() }})</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Order No / Bestellnummer</th>
                                            <th>Favor</th>
                                            <th>Company Name / Firmenname</th>
                                            <th>Expiry Date / Ablaufdatum</th>
                                            <th>Amount / Menge</th>
                                            <th>See</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($completedOrders)!= 0)
                                        @foreach($completedOrders as $completedOrder)
                                            <?php
                                            $expiry = explode(' ', $completedOrder->expiry);
                                            $dateExpiry = explode('-', $expiry[0]);
                                            $dateExpiry = $dateExpiry[2] . '-' . $dateExpiry[1] . '-' . $dateExpiry[0];
                                            $date = new DateTime();
                                            $match_date = new DateTime($dateExpiry);
                                            $interval = $date->diff($match_date);
                                            $day = date('d-m-Y');

                                            ?>

                                            <tr>
{{--
                                                @if(strtotime($dateExpiry) <= strtotime($day))
--}}
                                                    @if($interval->days == 0 || !($interval->invert == 0))
                                                        <td><span class="pull-left">{{ $completedOrder->order_no }}</span> <span class="badge" style="background: red; font-size: 10px; margin-left: 5px;">Late Delivered</span></td>
                                                    @else
                                                        <td><span class="pull-left">{{ $completedOrder->order_no }}</span> <span class="badge" style="background: green; font-size: 10px; margin-left: 5px;">Completed</span></td>
                                                    @endif

                                                    @if($completedOrder->gig)
                                                        @if($completedOrder->gig->title == "gig")
                                                            <td>Favor</td>
                                                        @else
                                                        <td>{{ $completedOrder->gig->title }}</td>
                                                        @endif
                                                    @elseif($completedOrder->package)
                                                        <td>{{ $completedOrder->package->title }}</td>
                                                    @else
                                                        @if($completedOrder->custom == "gig")
                                                        <td>Favor</td>
                                                        @else
                                                        <td>{{ $completedOrder->custom}}</td>
                                                        @endif
                                                    @endif

                                                    <td>{{ $completedOrder->company_name }}</td>
                                                    <td>{{ date('d.m.Y',strtotime($completedOrder->expiry)) }}@if($interval->days == 0 || !($interval->invert == 0))
                                                            <span class="text-right" style="font-size:10px"><b
                                                                        style="color:#ff0000">fällig
                                                                    bis: </b>{{ $dateExpiry }}</span>
                                                        @else
                                                            <span class="text-right" style="font-size:10px"><b
                                                                        style="color:#ccc">fällig
                                                                    bis: </b>{{ $dateExpiry }}</span>

                                                        @endif</td>
                                                    <td>{{ config('app.currency') }}{{ number_format($completedOrder->amount,2) }}</td>
                                                    <td>
                                                        <a href="{{ route('agencySingleOrder', [$completedOrder->order_no, $completedOrder->uuid]) }}"
                                                           class="btn btn-primary btn-xs"><span
                                                                    class="glyphicon glyphicon-eye-open"></span></a>
                                                    </td>
                                            </tr>
{{--
                                            @endif
--}}
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                {{--<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New--}}
                                    {{--Order</a>--}}
                                {{--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All--}}
                                    {{--Orders</a>--}}
                            </div>
                            <!-- /.box-footer -->
                        </div>

                    </div>
                </div>

            </div>
            <div>
                <h2>Payment History / Zahlungshistorie</h2>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Payment History</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <a href="{{ route('agencyPayments') }}?agency_id={{ $agency->id }}" class="btn btn-primary">Export
                                CSV</a>
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                        </div>
                    </div>

                    <div class="box-body agency_invoice table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>Id</th>--}}
                                <th width="20%">Date</th>
                                <th width="60%">Details</th>
                                <th width="20%" class="text-right">Amount</th>
                                {{--<th>Order No. / Bestell-Nr.</th>--}}
                                {{--<th>Details</th>
                                <th>Invoice Number / Rechnungsnummer</th>
                                <th>Receivable / Forderung</th>
                                <th>Fee (Bank/Paypal)</th>
                                <th>Received / Empfangen</th>
                                <th>Balance / Summe</th>
                                <th>Status</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($agencyInvoices)!=0)
                            @foreach($agencyInvoices as $agencyInvoice)
                                <tr>
                                    <td width="20%">{{ date('d.m.Y',strtotime($agencyInvoice->created_at)) }}</td>
                                    <td width="60%">
                                        @if(\Illuminate\Support\Facades\Auth::get()->id == $agencyInvoice->refer_agency_id)
                                            <span>{{ $agencyInvoice->detail }}</span> <span style="color: #337ab7;font-weight: bold;">(Commission)</span>
                                        @else
                                            {{ $agencyInvoice->detail }}
                                            @if(!empty($agencyInvoice->invoice_status))
                                                <span class="badge" style="background: #337ab7;">{{$agencyInvoice->invoice_status}}</span>
                                            @endif
                                        @endif
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::get()->id == $agencyInvoice->refer_agency_id)
                                        <td width="20%" class="text-right" style="color:#006700;">{{ config('app.currency').number_format($agencyInvoice->refer_agency_amount,2) }}</td>
                                    @else
                                        @if($agencyInvoice->reference_invoice == "unpaid" || $agencyInvoice->reference_invoice == "paid")
                                        <td width="20%" class="text-right" style="color:#006700;">{{ config('app.currency').number_format($agencyInvoice->balance,2) }}</td>
                                        @endif
                                        @if($agencyInvoice->reference_invoice == null)
                                        <td width="20%" class="text-right" style="color:red;">-{{ config('app.currency').number_format($agencyInvoice->paid,2) }}</td>
                                        @endif
                                    @endif
                                    {{--<td>{{ $agencyInvoice->id }}</td>
                                    <td>{{ date('d.m.Y',strtotime($agencyInvoice->created_at)) }}</td>
                                    <td>{{ $agencyInvoice->detail }}</td>
                                    <td>{{ $agencyInvoice->invoiceno }}</td>
                                    <td>{{ config('app.currency') }}{{ number_format($agencyInvoice->payable,2) }}</td>
                                    <td></td>
                                    <td>{{ config('app.currency') }}{{ number_format($agencyInvoice->paid,2) }}@if($agencyInvoice->invoice_status=="Transferred")
                                            <em></em>@endif</td>
                                    <td>{{ config('app.currency') }}{{ number_format($agencyInvoice->balance,2) }}</td>
                                    @if(empty($agencyInvoice->order_no))
                                    @if(empty($agencyInvoice->invoice_status))
                                        <td>Request Sent</td>
                                    @else

                                        <td>{{ $agencyInvoice->invoice_status }}</td>
                                    @endif
                                    @else
                                        <td></td>
                                    @endif--}}
                                </tr>
                            @endforeach
                            @endif
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

                    <h2>Commission History / Provisionhistorie</h2>
                    <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Commission History</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <a href="{{ route('agencyPayments') }}?agency_id={{ $agency->id }}" class="btn btn-primary">Export
                                CSV</a>
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                        </div>
                    </div>

                    <div class="box-body agency_invoice table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Order No / Bestell-Nr.</th>
                                <th>Invoice Number / Rechnungsnummer</th>
                                <th>Receivable</th>
                                <th>Received</th>
                                <th>Summe</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($comissionInvoices)!=0)
                            @foreach($comissionInvoices as $comissionInvoice)
                                <tr>
                                    <td>{{ $comissionInvoice->id }}</td>
                                    <td>{{ date('d.m.Y',strtotime($comissionInvoice->created_at)) }}</td>
                                    <td>{{ $comissionInvoice->order_no }}</td>
                                    <td>{{ $comissionInvoice->invoiceno }}</td>
                                    <td>{{ config('app.currency') }}{{ number_format($comissionInvoice->refer_agency_amount,2) }}</td>
                                    <td>{{ config('app.currency') }}{{ number_format($comissionInvoice->paid,2) }}@if(!empty($comissionInvoice->paid))
                                            <em></em>@endif</td>
                                    <td>{{ config('app.currency') }}{{ number_format($comissionInvoice->refer_agency_bal,2) }}</td>
                                </tr>
                            @endforeach
                            @endif
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
        </div>
    </div><!-- /.row -->

    @endsection
    @section('pages_css')

            <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">

    @endsection
    @section('pages_script')
            <!-- DataTables -->
    <!-- page script -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sent-request").click(function () {
                $(this).html("Withdraw request sent");
            });
            $("#amount1").click(function () {
                var amount = $(this).val();
                $(".amount").val(amount);
                $(".pay-method").val("Paypal");
                $(".confirmRequest").removeAttr("disabled");
                var data_place = $(this).parent().parent().parent();
                {{--@if(!empty($get_agency_Detail->paypal_acct))
                var total = "{{ $agency->wallet - $service->paypal_services }}";
                var append ="<i id='amt_nt_shw' class='fa fa-info' aria-hidden='true' data-toggle='tooltip' title='\u20ac"+total+" will be transferred to your account'></i>";
//                var append = "<p id='nt_pp'>\u20ac"+total+" will be transferred to your account</p>";
                data_place.append(append);
                @endif--}}
            });
            $("#amount2").click(function () {
                var amount = $(this).val();
                $(".amount").val(amount);
                $(".pay-method").val("Bank");
                $(".confirmRequest").removeAttr("disabled");
            });
            $("#pay-details-restrict").click(function(){
                alert("Complete your payments details first");
            })
        });
    </script>
    <script>

        $(function () {
            $('#amountWithdraw').on('click', ('.confirmRequest'), function (e) {
                e.preventDefault();
                var form = e.target.parentNode;
                var formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    method: form.method,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function (data) {
                    console.log(data);
                    if (data > 0) {
                        location.reload();
                    }
                    else {
                        //notifyMessage
                        $.notify({
                            // options
                            message: 'Request submission failed please try again'
                        }, {
                            // settings
                            placement: {
                                from: 'bottom',
                                align: 'right'
                            },
                            type: 'danger'
                        });
                    }
                });

            });
        });


    </script>
            <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            var table = $("#example1").DataTable();
            var table = $("#example2").DataTable();
            var table = $("#example3").DataTable();
            var table = $("#example4").DataTable();
        });
    </script>

@endsection