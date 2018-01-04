<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Order Invoice</title>
    <link rel="stylesheet" type="text/css" href="css/invoice-style.css" media="all" />
    <style>
        body{height:auto !important}
    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <p>
        @if(!empty($user->profile_image))
        <img src="photos/mini/{{$user->profile_image}}" style="max-width: 150px;">
        @else
                <img src="img/medium.gif" style="max-width: 150px;">
        @endif
        </p>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div>Cnerr.deRomero & Malik GbR i.G.</div>
            <div>Webereistrasse 4</div>
                <div>48607 Ochtrup</div>
            <div style="padding-bottom: 40px;">Cnerr.de</div>
            <div class="to">INVOICE FROM:</div>
            <h2 class="name">{{ $user->username }}</h2>
            <div class="address"></div>
            <div class="email"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
            {{--<div>Postal Address: {{ $userInfo->postal_code }}</div>--}}
            {{--<div>Invoice#: {{ $invoice->invoiceno }}</div>--}}
            <table class="client-info">
                <tr>
                    <td class="date">Date:</td><td>{{ date('d.m.Y') }}</td>
                </tr>
            </table>
            {{--<div class="address">--}}
                {{--<p>Rechnung. DE153190723</p>--}}
            {{--</div>--}}
        </div>
        <div>
            <p>
                Dle Lelstung took place in the month of the accounting position (§ 31 UST-DV)</p>
        </div>
        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th colspan="3">Order#</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order_details as $orders)
                @if(!empty($orders->order_no))
            <tr>

                <td>{{date('d.m.Y',strtotime($orders->created_at)) }}</td>
                <td colspan="3">{{$orders->detail}}</td>
                @if($invoice->method == "Paypal")
                    {{--<td>{{ config('app.currency') . number_format($orders->paid+$service->paypal_services,2)}}</td>--}}
                    <td>{{ config('app.currency') . number_format($orders->balance,2)}}</td>
                @else
                    <td>{{ config('app.currency') . number_format($orders->balance,2)}}</td>
                    {{--<td>{{ config('app.currency') . number_format($orders->paid+$service->bank_services,2)}}</td>--}}
                @endif

            </tr>
            @endif
            @endforeach
            <tr>
                <td colspan="4">Total net</td>
                @if($invoice->method == "Paypal")
                <td>{{ config('app.currency') . number_format($invoice->paid+$service->paypal_services,2)}}</td>
                @else
                <td>{{ config('app.currency') . number_format($invoice->paid+$service->bank_services,2)}}</td>
                @endif
            </tr>
            <tr>
                @if($invoice->method == "Paypal")
                    <td colspan="4">Service Charges (Paypal)</td>
                @else
                    <td colspan="4">Service Charges (Bank)</td>
                @endif
                @if($invoice->method == "Paypal")
                    <td>{{config('app.currency').number_format($service->paypal_services,2)}}</td>
                @else
                    <td>{{config('app.currency').number_format($service->bank_services,2)}}</td>
                @endif
            </tr>
            <tr>
                <td colspan="4" class="text-right">Total amount</td>
                @if($invoice->method == "Paypal")
                    <td>{{ config('app.currency') . number_format($invoice->paid,2)}}</td>
                @else
                    <td>{{ config('app.currency') . number_format($invoice->paid,2)}}</td>
                @endif
            </tr>
            </tbody>
        </table>
        <div>
            <p>The amount will be paid for acceptance by our logistical partner</p>
        </div>
        <div class="box">

            <div class="box2">
                <p><strong>Phone:</strong> <a href="tel:555-555-5555">{{$userInfo->telephone}}</a></p>
                <p><strong>Email:</strong> <a href="mailto:hello@5marks.co">{{$user->email}}</a></p>
                <p><strong>Website:</strong> <a href="http://5marks.co">{{$userInfo->protfolio}}</a></p>
            </div>

        </div>
    </div>
</main>
</body>
</html>

