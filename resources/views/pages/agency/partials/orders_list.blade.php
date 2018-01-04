@extends('pages.agency.agency_template')
<style>
    .zero-padd{
        padding: 10px 0px !important;
        font-size: 12px;
        color: #3c8dbc;
        font-weight: 600;
    }
    .zero-margg{
        margin: 0px !important;
        background: white;
    }
    .border{
        /* border-top: 1px solid #3c8dbc;
         border-left: 1px solid #3c8dbc;*/
        border-right: 2px solid #d2d6de;
    }
    .border:last-child{
        border: 0px;
    }
</style>
@section('header_title')

    <h1 style="padding: 0px 10px;">Dashboard</h1>
    <div id="google_translate_element" style="position: absolute; right: 15px; bottom: 0px;"></div><script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'de', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

@endsection
@section('content')
    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="col-sm-9 col-xs-12">
            @if($_GET['status'] == "pending")
            <div class="row zero-margg">
                <div class="col-md-4 col-xs-12 text-center zero-padd border">
                    <p style="color:#f0ad4e; font-size: 50px; margin: 0px;line-height: 0.8em;">{{ $get_pending }}</p>
                    <p>In Process</p>
                </div>
                <div class="col-md-4 col-xs-12 text-center zero-padd border">
                    <p style="color:rgb(72,25,118); font-size: 50px; margin: 0px;line-height: 0.8em;">{{ $get_processed }}</p>
                    <p>Waiting for user acknowledgment</p>
                </div>
                <div class="col-md-4 col-xs-12 text-center zero-padd border">
                    <p style="color:rgb(60, 118, 65); font-size: 50px; margin: 0px;line-height: 0.8em;">{{ $get_finsihed }}</p>
                    <p>Finish Jobs</p>
                </div>
            </div>
            @endif
                <div class="box box-primary" id="boxMain">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bestellungen / Orders</h3>
                    </div>
                    {{--<a href="{{ route('gigcreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->--}}
            <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Bestellungnummer / Order #</th>
                <th>Bestellung / Order Name</th>
                <th>Firmenname / Company Name</th>
                <th>fällig bis / Expire Date</th>
                <th>Bestelldatum / Order Date</th>
                <th>Order Amount</th>

            </tr>
            </thead>
            <tbody>
            @if(!empty($pendingdorders) && $pendingdorders > 0)
            @foreach($orders as $order)

                <tr>

                    <td class="mailbox-name" style="width: 233px; font-size: 15px;">
                        <div class="col-xs-6" style="padding: 0px;">
                        <span><img src="{{ url('/').'/img/Untitled-1 copy.PNG' }}" alt="package" width="20px;"></span>
                        <a class="order-link" href="{{ route('agencySingleOrder', [$order->order_no, $order->uuid]) }}" data-href="{{ route('agencyorder') }}?orderno={{ $order->order_no }}">{{ $order->order_no }}</a>
                           {{-- <a href="{{ route('agencySingleOrder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                        </div>
                        <div class="col-xs-6" style="padding: 0px;">
                            @if(date('d.m.Y', strtotime($order->created_at)) == date('d.m.Y'))
                                @if($order->status == 'review')
                                    <span class="label label-warning"><i class="icon fa fa-check"></i>Reviewed<i class="fa fa-star" style="margin: 5px; color: #157340;"></i></span><span class="badge"> {{ $order->order_review }}</span>
                                @elseif($order->status == 'pending')
                                    <span class="label label-danger"><i class="icon fa fa-check"></i>Pending<i class="fa fa-star" style="margin: 5px; color: #157340;"></i></span>
                                @elseif($order->status == 'jobdonebyagency') <span class="label label-info"><i class="icon fa fa-check"></i>Finished agency<i class="fa fa-star" style="color: #157340;"></i></span>
                                @elseif($order->status == 'jobdone') <span class="label label-info"><i class="icon fa fa-check"></i>Finished admin<i class="fa fa-star" style="margin: 5px; color: #157340;"></i></span>@endif
                            @else
                                @if($order->status == 'review')
                                    <span class="label label-warning"><i class="icon fa fa-check"></i>Reviewed</span>
                                    <span class="badge label-warning"> {{ $order->order_review }}</span>
                                @elseif($order->status == 'pending')
                                    <span class="label label-danger"><i class="icon fa fa-check"></i>Pending</span>
                                @elseif($order->status == 'jobdonebyagency') <span class="label label-info"><i class="icon fa fa-check"></i>Finished agency</span>
                                @elseif($order->status == 'jobdone') <span class="label label-info"><i class="icon fa fa-check"></i>Finished admin</span>@endif
                            @endif
                        </div>
                    </td>

                    <td class="mailbox-subject"><b>{{ $order->title }}</b></td>
                    <td class="mailbox-attachment">{{ $order->company_name }}</td>
                    @if($order->type != 'package')
                    <td class="mailbox-date">{{ date('d.m.Y', strtotime($order->expiry)) }}</td>
                    @endif
                    <td class="mailbox-date">{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
                    <td class="mailbox-date">€{{ number_format($order->net_total * ($agencyAmount->agency_percentage/100),2) }}</td>
                </tr>
           
            @endforeach
                @elseif(!empty($count_completedorders) && $count_completedorders > 0)
                    @foreach($completedorders as $order)
                            <tr>

                                <td class="mailbox-name">
                                    @if($order->type == "gig")
                                        <span><img src="{{ url('/').'/img/Untitled-1 copy.PNG' }}" alt="package" width="20px;"></span>
                                    @else
                                        <span><img src="{{ url('/').'/img/packageSuggestion.png' }}" alt="package" width="20px;"></span>
                                    @endif
                                    <a class="order-link" href="{{ route('agencySingleOrder', [$order->order_no, $order->uuid]) }}" data-href="{{ route('agencyorder') }}?orderno={{ $order->order_no }}">{{ $order->order_no }}
                                        {{--<a href="{{ route('agencySingleOrder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                                    </a></td>
                                <td class="mailbox-subject"><b>@if($order->type == 'package')
                                            {{ $order->packagetitle }} @elseif($order->type == 'gig') {{ $order->gigtitle }} @else {{ $order->type }}@endif</b></td>
                                <td class="mailbox-attachment">{{ $order->company_name }}</td>
                                @if($order->type != 'package')
                                <td class="mailbox-date">{{ date('d.m.Y', strtotime($order->expiry)) }}</td>
                                @else
                                <td class="mailbox-date">Not Mentioned</td>
                                @endif
                                <td class="mailbox-date">{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
                                <td class="mailbox-date">€{{ number_format($order->net_total * ($agencyAmount->agency_percentage/100),2) }}</td>

                            </tr>

                            @endforeach
            @elseif(!empty($count_reviewdorders) && $count_reviewdorders > 0)
                @foreach($reviewdorders as $order)
                    <tr>

                        <td class="mailbox-name"><a class="order-link" href="#" data-href="{{ route('agencyorder') }}?orderno={{ $order->order_no }}">{{ $order->order_no }}@if($order->status == 'review')
                                    <span class="btn-danger"><i class="icon fa fa-check"></i>Reviewed</span>@endif</a></td>
                        <td class="mailbox-subject"><b>@if($order->type == 'package')
                                    {{ $order->packagetitle }} @elseif($order->type == 'gig') {{ $order->gigtitle }} @else {{ $order->type }}@endif</b></td>
                        <td class="mailbox-attachment">{{ $order->company_name }}</td>
                        @if($order->type != 'package')
                            <td class="mailbox-date">{{ date('d.m.Y', strtotime($order->expiry)) }}</td>
                        @else
                            <td class="mailbox-date">Not Mentioned</td>
                        @endif
                        <td class="mailbox-date">{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
                        <td class="mailbox-date">€{{ number_format($order->net_total * ($agencyAmount->agency_percentage/100),2) }}</td>
                        <td>
                            {{--<a href="{{ route('agencySingleOrder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                            {{-- <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $order->id}}"  data-target="#myModal"></button>--}}
                        </td>

                    </tr>

                @endforeach
            @endif
                @if(!empty($total_pckage_ordres) && $total_pckage_ordres > 0)
                @foreach($packagesOrder as $porder)

                    <tr>
                        <td class="mailbox-name" style="width: 233px;">
                            <div class="col-xs-6" style="padding: 0px;">
                                <span><img src="{{ url('/').'/img/packageSuggestion.png' }}" alt="package" width="20px;"></span>
                                <a class="order-link" href="{{ route('agencySingleOrder', [$porder->order_no, $porder->uuid]) }}" data-href="{{ route('agencyorder') }}?orderno={{ $porder->order_no }}">{{ $porder->order_no }}</a>
                                {{--<a href="{{ route('agencySingleOrder', [$order->order_no, $order->uuid]) }}" class="btn btn-primary btn-xs" target="_blank">--}}{{--<span class="glyphicon glyphicon-eye-open"></span>--}}{{--</a>--}}
                            </div>
                            <div class="col-xs-6" style="padding: 0px;">
                                @if(date('d.m.Y', strtotime($porder->created_at)) == date('d.m.Y'))
                                    @if($porder->status == 'review')
                                        <span class="label label-warning"><i class="icon fa fa-check"></i>Reviewed<i class="fa fa-star" style="margin: 5px; color: #157340;"></i></span><span class="badge label-warning"> {{ $porder->order_review }}</span>
                                    @elseif($porder->status == 'pending')
                                        <span class="label label-danger"><i class="icon fa fa-check"></i>Pending<i class="fa fa-star" style="margin: 5px; color: #157340;"></i></span>
                                    @elseif($porder->status == 'jobdonebyagency') <span class="label label-info"><i class="icon fa fa-check"></i>Finished agency<i class="fa fa-star" style="color: #157340;"></i></span>
                                    @elseif($porder->status == 'jobdone') <span class="label label-info"><i class="icon fa fa-check"></i>Finished admin<i class="fa fa-star" style="margin: 5px; color: #157340;"></i></span>@endif
                                @else
                                    @if($porder->status == 'review')
                                        <span class="label label-warning"><i class="icon fa fa-check"></i>Reviewed</span>
                                        <span class="badge label-warning"> {{ $porder->order_review }}</span>
                                    @elseif($porder->status == 'pending')
                                        <span class="label label-danger"><i class="icon fa fa-check"></i>Pending</span>
                                    @elseif($porder->status == 'jobdonebyagency') <span class="label label-info"><i class="icon fa fa-check"></i>Finished agency</span>
                                    @elseif($porder->status == 'jobdone') <span class="label label-info"><i class="icon fa fa-check"></i>Finished admin</span>@endif
                                @endif
                            </div>
                        </td>
                        <td class="mailbox-subject"><b>{{ $porder->title }}</b></td>
                        <td class="mailbox-attachment">{{ $porder->company_name }}</td>
                        <td class="mailbox-date">{{ date('d.m.Y', strtotime($porder->expiry)) }}</td>
                        <td class="mailbox-date">{{ date('d.m.Y', strtotime($porder->created_at)) }}</td>
                        <td class="mailbox-date">€{{ number_format($porder->net_total * ($agencyAmount->agency_percentage/100),2)  }}</td>

                    </tr>

                @endforeach
                @endif
                 @if(!empty($total_custom_orders) && $total_custom_orders > 0)
                    @foreach($customorders as $corder)
                        @if($corder->type == 'custom' && $corder->amount > 0)
                            <tr>

                                <td class="mailbox-name" style="width: 233px;"><a class="order-link" href="{{ route('agencySingleOrder', [$corder->order_no, $corder->uuid]) }}" data-href="{{ route('agencyorder') }}?orderno={{ $corder->order_no }}">{{ $corder->order_no }}
                                        {{--<a href="{{ route('agencySingleOrder', [$corder->order_no, $corder->uuid]) }}" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                                        @if(date('d.m.Y', strtotime($corder->created_at)) == date('d.m.Y'))
                                        @if($corder->status == 'review')
                                            <span class="btn-warning"><i class="icon fa fa-check"></i>Reviewed <i class="fa fa-star" style=" margin: 5px; color: #157340;"></i></span> @elseif($corder->status == 'pending')
                                            <span class="btn-danger"><i class="icon fa fa-check"></i>Pending <i class="fa fa-star" style=" margin: 5px; color: #157340;"></i></span>@elseif($corder->status == 'jobdonebyagency') <span class="btn-success"><i class="icon fa fa-check"></i>Finished agency <i class="fa fa-star" style="margin: 5px;  color: #157340;"></i></span>
                                @elseif($corder->status == 'jobdone') <span class="btn-primary"><i class="icon fa fa-check"></i>Finished admin <i class="fa fa-star" style="color: #157340;"></i></span>@endif
                                            @else
                                            @if($corder->status == 'review')
                                                <span class="btn-warning"><i class="icon fa fa-check"></i>Reviewed</span> @elseif($corder->status == 'pending')
                                                <span class="btn-danger"><i class="icon fa fa-check"></i>Pending</span>@elseif($corder->status == 'jobdonebyagency') <span class="btn-success"><i class="icon fa fa-check"></i>Finished agency </span>
                                            @elseif($corder->status == 'jobdone') <span class="btn-primary"><i class="icon fa fa-check"></i>Finished admin</span>@endif
                                        @endif
                                    </a>
                                </td>
                                <td class="mailbox-subject"><b>{{ $corder->type }}</b></td>
                                <td class="mailbox-attachment">{{ $corder->company_name }}</td>
                                <td class="mailbox-date">{{ date('d.m.Y', strtotime($corder->expiry)) }}</td>
                                <td class="mailbox-date">{{ date('d.m.Y', strtotime($corder->created_at)) }}</td>
                                <td class="mailbox-date">€{{ number_format($corder->net_total * ($agencyAmount->agency_percentage/100),2)  }}</td>

                            </tr>
                        @endif
                            @endforeach
                        @endif

            </tbody>
        </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
            </div>
        </div>
    </div>
    @endsection
@section('pages_css')

        <!-- DataTables -->

<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">

@endsection





@section('pages_script')

        <!-- DataTables -->
{{--<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>--}}
<!-- page script -->
{{--<script>
    $(function () {
        var table = $("#example1").DataTable({

            "aaSorting": []
        });
            });
</script>--}}

@endsection