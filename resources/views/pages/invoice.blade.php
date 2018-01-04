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
    <img src="img/4slash-logo.png" style="width: 150px;">
  </div>
</header>
  <main>
    <div id="details" class="clearfix">
      <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $user->username }}</h2>
          <div class="address"></div>
          <div class="email"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
        <div>Invoice No: {{ $invoice->invoice_no }}</div>
        <div> {{ $userInfo->postal_address }}</div>
        <div> {{ $userInfo->zip }}</div>
        <div>User:{{ $userInfo->company }}</div>
      <table class="client-info">
        <tr>
          <td>Invoice No:</td><td>153190723</td>
        </tr>
        <tr>
          <td class="date">Date:</td><td>{{date('d.m.Y',strtotime($order->created_at)) }}</td>
        </tr>
      </table>
        <div class="address">
          <p>Bill DE153190723</p>
        </div>
      </div>
      <div>
        <p>The performance took place in the month of the accounting position
        </p>
      </div>
        <table>
          <thead>
          <tr>
            <th>Description</th>
            <th>Date</th>
            <th colspan="2">amount</th>
            <th>amount</th>
            {{--<th>amount</th>--}}
          </tr>
          </thead>
          <tbody>
          <tr>
            @if(!empty( $order->gig->title))
            <td> {{  $order->gig->title }}</td>
            @elseif(!empty($completedOrder->package->title))
              <td> {{  $order->package->title }}</td>
            @else
              <td> {{  $order->custom }}</td>
            @endif
            <td>{{date('d.m.Y',strtotime($order->created_at)) }}</td>
            <td colspan="2">
              {{ config('app.currency') . number_format($order->amount,2) }}
            </td>
            <td>{{ config('app.currency') . number_format($order->amount,2) }}</td>
            {{--<td>{{ config('app.currency') . number_format($order->amount,2) }}</td>--}}
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2">
            @if(!empty( $order->gig->title))
              <p> {{  $order->gig->title }}</p>
            @elseif(!empty($order->package->title))
              <p> {{  $order->package->title }}</p>
            @else
              <p> {{  $order->custom }}</p>
            @endif
            </td>
            <td>
              <p>{{ config('app.currency') . number_format($order->amount,2) }}</p>

            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2">Service Charges (5%)</td>
            <td>{{config('app.currency'). number_format(($order->service_charges),2) }}</td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2">
              @if(!empty( $order->gig->title))
                <p> {{  $order->gig->title }}</p>
              @elseif(!empty($order->package->title))
                <p> {{  $order->package->title }}</p>
              @else
                <p> {{  $order->custom }}</p>
              @endif
            </td>
            <td>
              <p>{{config('app.currency'). number_format(($order->govt_tax),2) }}</p>
              </td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4" class="text-right">Total net</td>
            <td>{{ config('app.currency').number_format($order->net_total,2) }}</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4" class="text-right">
              <p></p>
              <p>Mwst. (19%)</p>
              <p>Total Amount</p></td>
            <td>
              <p></p>
              <p>{{config('app.currency'). number_format(($order->govt_tax),2) }}</p>
              <p>{{ config('app.currency'). ( number_format($order->amount  + $order->service_charges,2)) }}</p>
            </td>
            <td></td>
          </tr>
          </tbody>
        </table>
      <div>
        <p>The amount will be paid for acceptance by our logistical partner </p>
      </div>
      <div class="box">

        <div class="box2">
          <p><strong>Phone:</strong> (021) 34010384</p>
          {{--<p><strong>Email:</strong> <a href="mailto:hello@5marks.co">info@gmail.com</a></p>--}}
          <p><strong>Website:</strong> <a href="https://4slash.com">4slash.com</a></p>
        </div>

      </div>
  </div>
    </main>
</body>
</html>

