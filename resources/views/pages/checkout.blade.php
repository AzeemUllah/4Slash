@include('includes.header')

<style>
    .cnerr-footer-background-color{
        position: relative !important;
    }
    .dash-main-content{
        min-height: auto;
    }
</style>

<!-- content -->
<div class="dash-main-content">
    <div class="navbar-row">
        <div class="container">
            <h4 class="text-center"><i class="fa fa-info-circle" aria-hidden="true" style="color: #ff5071;"></i>
                Order Details</h4>
        </div>
    </div>
    <div class="container custom-padding-top">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <table class="table checkout-table">
                <thead>
                <tr>
                    <th colspan="3">Gig</th>
                    <th class="text-right">Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="3">{{ $gig->title }}</td>
                    <td class="text-right">{{ number_format($gig->price, 2) }}</td>
                </tr>
                </tbody>
            </table>
            <br>
            @if(!empty($orderAddons))
                <table>
                    <tbody>
                        <tr>
                            <td class="text-center">Addons</td>
                        </tr>
                    </tbody>
                </table>
                <table class="checkout-table">
                    <thead>
                        <tr>
                            <th>Addon</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Amount</th>
                            <th class="text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderAddons as $addon)
                            <tr>
                                <td>{{ $addon->addon }}</td>
                                <td class="text-center">{{ $addon->quantity }}</td>
                                <td class="text-center">{{ number_format($addon->amount,2) }}</td>
                                <td class="text-right">{{ number_format($addon->quantity*$addon->amount,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <table class="checkout-table">
                <tbody>
                <tr>
                    <td><b>Gross Amount</b></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ number_format(\Illuminate\Support\Facades\Session::get('total_order_amount'),2) }}</td>
                </tr>
                </tbody>
            </table>
            <table class="checkout-table">
                <tbody>
                    <tr>
                        <td><b>Paypal fee 5%</b></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{ number_format(\Illuminate\Support\Facades\Session::get('processing_fee'),2) }}</td>
                    </tr>
                    <tr id="promocode_show">
                        <td><input type="text" name="promocode" placeholder="Enter Promocode" id="check_promo_field"></td>
                        <td class="text-left error" style="color:red; padding-top: 20px; font-size: 12px;"></td>
                        <td></td>
                        <td class="text-right"><a href="#" id="apply_promocode" class="btn btn-default" style="display: none;">Apply</a></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="text-center" id="proceed-with-paypal-tr">
                            <form action="{{ route('payment') }}" method="post">
                                <input type="hidden" name="promocode" class="promocode_hidden_val">
                                <button type="submit" class="a-button">Pay via Paypal <b>(<span id="paypal_amount">{{ number_format(\Illuminate\Support\Facades\Session::get('order_last_amount'),2) }}</span>)</b></button>
                            </form>
                        </td>
                        @if(\Illuminate\Support\Facades\Auth::user()->check())
                        <td class="text-center" id="proceed-with-paypal-tr">
                            @if($user_wallet >= \Illuminate\Support\Facades\Session::get('total_order_amount'))
                            <form action="{{ route('ordercommit') }}">
                                <input type="hidden" name="promocode" class="promocode_hidden_val">
                                <input type="hidden" name="method_type" value="wallet">
                                <button type="submit" class="a-button">Use Wallet <b>(<span id="wallet_amount">{{ number_format(\Illuminate\Support\Facades\Session::get('total_order_amount'),2) }}</span>)</b></button>
                            </form>
                            @else
                                <button type="submit" class="a-button" disabled>Insufficient wallet amount</button>
                            @endif
                        </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-2"></div>
    </div>
</div>

@include('includes.footer')

