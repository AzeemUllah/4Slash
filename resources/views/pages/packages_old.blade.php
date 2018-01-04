@include('includes.header')

<!--Content-->
<div class="dash-main-content">
    <!--Silder Header-->
    <div class="container">
        <div class="row text-center" style="margin: 40px 0px;">
            <h1 class="dash-heading">{{ $package->title }}</h1>
        </div>
    </div>
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($package_images as $image)
                <div class="swiper-slide" style="background-image:url({{ url('/files/gigs/images') . '/' . $image->image }});width:750px;height:250px;"></div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="container top-gap">
        <div class="container">
            <div class="pricing_table">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pricing-item">
                            <h3><img src="{{ asset('img/bronze.png') }}" style="width: 80px;margin-top: 16px;margin-bottom: 11px;">
                            </h3>
                            <div class="price_body">
                                <div class="price">
                                    {{ $package_bronze->package_name ? $package_bronze->package_name : 'No description available' }}
                                </div>
                            </div>
                            <div class="features">
                                <ul>
                                    <li style="border-bottom: 1px solid #DCDCDC; word-break: break-all;">{{ $package_bronze->desc ? $package_bronze->desc : 'Untitled' }}</li>
                                    <li style="border-bottom: 1px solid #DCDCDC;"><i class="fa fa-clock-o"
                                                                                     aria-hidden="true"
                                                                                     style="color: #367fa9;"></i><br>In {{ $package_bronze->delivery_days }}
                                        Days
                                    </li>
                                    <li style="border-bottom: 1px solid #DCDCDC;">
                                        @if($package_bronze->source_file == 1)
                                            <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #367fa9;"></i>
                                            <br>Source file
                                        @else
                                            -
                                            <br>Source file
                                        @endif
                                    </li>
                                    <li style="border-bottom: 1px solid #DCDCDC;">
                                        @if($package_bronze->revisions > 0)
                                            <strong style="font-size: 30px;color: #367fa9;">{{ $package_bronze->revisions }}</strong>
                                            <br>
                                            Revsions
                                        @else
                                            <strong style="font-size: 30px;color: #367fa9;">-</strong>
                                            <br>
                                            No revisions
                                        @endif
                                    </li>
                                    @foreach($package_option as $option)
                                        <li style="color: #367FA9;border-bottom: 1px solid #DCDCDC;">
                                            @if($option->bronze == 1)
                                                {{ $option->option }}
                                                <i class="fa fa-check-circle-o" aria-hidden="true"
                                                   style="color: #367fa9;"></i>
                                            @else
                                                -
                                            @endif
                                        </li>
                                    @endforeach
                                    <li>
                                        <strong style="font-size: 30px;color: #367FA9;">€{{ $package_bronze->price ? $package_bronze->price : 'No price availabe' }}</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer">
                                <a href="#" class="btn btn-pay-start" data-toggle="modal" data-target="#payment1">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing-item">
                            <h3><img src="{{ asset('img/silver.png') }}" style="width: 80px;margin-top: 16px;margin-bottom: 11px;">
                            </h3>
                            <div class="price_body">
                                <div class="price">
                                    {{ $package_silver->package_name ? $package_silver->package_name : 'No description available' }}
                                </div>
                            </div>
                            <div class="features">
                                <ul>
                                    <li style="border-bottom: 1px solid #DCDCDC; word-break: break-all;">{{ $package_silver->desc ? $package_silver->desc : 'Untitled' }}</li>
                                    <li style="border-bottom: 1px solid #DCDCDC;"><i class="fa fa-clock-o"
                                                                                     aria-hidden="true"
                                                                                     style="color: #367fa9;"></i><br>In {{ $package_silver->delivery_days }}
                                        Days
                                    </li>
                                    <li style="border-bottom: 1px solid #DCDCDC;">
                                        @if($package_silver->source_file == 1)
                                            <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #367fa9;"></i>
                                            <br>Source file
                                        @else
                                            -
                                            <br>
                                            Source file
                                        @endif
                                    </li>
                                    <li style="border-bottom: 1px solid #DCDCDC;">
                                        @if($package_silver->revisions > 0)
                                            <strong style="font-size: 30px;color: #367fa9;">{{ $package_silver->revisions }}</strong>
                                            <br>
                                            Revsions
                                        @else
                                            <strong style="font-size: 30px;color: #367fa9;">-</strong>
                                            <br>
                                            No revisions
                                        @endif
                                    </li>
                                    @foreach($package_option as $option)
                                        <li style="color: #367FA9;border-bottom: 1px solid #DCDCDC;">
                                            @if($option->silver == 1)
                                                {{ $option->option }}
                                                <i class="fa fa-check-circle-o" aria-hidden="true"
                                                   style="color: #367fa9;"></i>
                                            @else
                                                -
                                            @endif
                                        </li>
                                    @endforeach
                                    <li>
                                        <strong style="font-size: 30px;color: #367FA9;">€{{ $package_silver->price ? $package_silver->price : 'No price availabe' }}</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer">
                                <a href="#" class="btn btn-pay-start" data-toggle="modal" data-target="#payment2">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing-item">
                            <h3><img src="{{ asset('img/gold.png') }}" style="width: 80px;margin-top: 16px;margin-bottom: 11px;">
                            </h3>
                            <div class="price_body">
                                <div class="price">
                                    {{ $package_gold->package_name ? $package_gold->package_name : 'No description available' }}
                                </div>
                            </div>
                            <div class="features">
                                <ul>
                                    <li style="border-bottom: 1px solid #DCDCDC; word-break: break-all">{{ $package_gold->desc ? $package_gold->desc : 'Untitled' }}</li>
                                    <li style="border-bottom: 1px solid #DCDCDC;"><i class="fa fa-clock-o"
                                                                                     aria-hidden="true"
                                                                                     style="color: #367fa9;"></i><br>In {{ $package_gold->delivery_days }}
                                        Days
                                    </li>
                                    <li style="border-bottom: 1px solid #DCDCDC;">
                                        @if($package_gold->source_file == 1)
                                            <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #367fa9;"></i>
                                            <br>Source file
                                        @else
                                            <span>-</span>
                                            <br>Source file
                                        @endif
                                    </li>
                                    <li style="border-bottom: 1px solid #DCDCDC;">
                                        @if($package_gold->revisions > 0)
                                            <strong style="font-size: 30px;color: #367fa9;">{{ $package_gold->revisions }}</strong>
                                            <br>
                                            Revsions
                                        @else
                                            <strong style="font-size: 30px;color: #367fa9;">-</strong>
                                            <br>
                                            No revisions
                                        @endif
                                    </li>
                                    @foreach($package_option as $option)
                                        <li style="color: #367FA9;border-bottom: 1px solid #DCDCDC;">
                                            @if($option->bronze == 1)
                                                {{ $option->option }}
                                                <i class="fa fa-check-circle-o" aria-hidden="true"
                                                   style="color: #367fa9;"></i>
                                            @else
                                                -
                                            @endif
                                        </li>
                                    @endforeach
                                    <li>
                                        <strong style="font-size: 30px;color: #367FA9;">€{{ $package_gold->price ? $package_gold->price : 'No price availabe' }}</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer">
                                <a href="#" class="btn btn-pay-start" data-toggle="modal" data-target="#payment3">Purchase</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div id="payment1" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <table class="order-view">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="4"><b></b></th>
                        </tr>
                        <tr>

                            <th>packages</th>
                            <th></th>
                            <th></th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>

                            <td>{{ $package_bronze->package_name }}</td>

                            <td></td>
                            <td></td>
                            <td>{{ config('app.currency') }}<span class="package-amount">{{ $package_bronze->price }}</span></td>
                        </tr>

                        </tbody>
                    </table>

                    <br>

                    <br>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td>
                                Total packages

                            </td>
                            <td>
                                <span id="NetTotal" class="pull-right">{{ config('app.currency') }}{{ $package_bronze->price }}
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td>Net</td>
                            <td>
                                <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                    <?php $net = number_format($package_bronze->price / (1+9 / 100),2) ?>
                                    {{ $net }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>19% VAT.</td>
                            <td><span id="taxIncluded" class="pull-right">{{ config('app.currency') }}{{ number_format(($package_bronze->price - $net),2)  }}</span></td>
                        </tr>
                        <tr>
                            <td><b>shopping cart</b></td>
                            <td><span class="pull-right total-grand-order-amount">{{ config('app.currency') }}{{ $package_bronze->price }}</span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Paypal fee 5.50%</td>
                            <td>
                                <span id="processingFees" class="pull-right">
                                    <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                        <?php $net_paypal = number_format(($package_bronze->price * 5.50) / 100,2) ?>
                                        {{ $net_paypal }}
                                </span>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td><h5>total price
                                </h5></td>
                            <td><h5><span id="FinalAmount" class="pull-right">
                                         <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                             {{ number_format($package_bronze->price + $net_paypal,2) }}
                                </span>
                                    </span>
                                </h5></td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>

                <a href="{{ route('order.package', ['package_id' =>$package_bronze->id ,'package_name' => 'bronze']) }}"  style="border-radius: 6px; margin-bottom:40px; background: #367FA9;"  class="btn btn-primary">jetzt bezahlen mit Paypal</a>
                {{--<button  type="submit" class="btn btn-primary btn-lg" style="border-radius: 6px; margin-bottom:40px;">Pay with PayPal--}}
                {{--</button>--}}

                {{--<a href="{{ route('order.package') }}?package-id={{ $package->packages_id }}"  style="border-radius: 6px; margin-bottom:40px;" type="submit" class="btn btn-primary">Pay with PayPal</a>--}}
            </div>

        </div>
    </div> <!-- modal -->
    <div id="payment2" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <table class="order-view">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="4"><b></b></th>
                        </tr>
                        <tr>

                            <th>packages
                            </th>
                            <th></th>
                            <th></th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>

                            <td>{{ $package_silver->package_name }}</td>

                            <td></td>
                            <td></td>
                            <td>{{ config('app.currency') }}<span class="package-amount">{{ $package_silver->price }}</span></td>
                        </tr>

                        </tbody>
                    </table>

                    <br>

                    <br>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td>
                                Total packages

                            </td>
                            <td>
                                <span id="NetTotal" class="pull-right">{{ config('app.currency') }}{{ $package_silver->price }}
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td>Netto</td>
                            <td>
                                <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                    <?php $net = number_format($package_silver->price / (1+9 / 100),2) ?>
                                    {{ $net }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>19% VAT
                                .</td>
                            <td><span id="taxIncluded" class="pull-right">{{ config('app.currency') }}{{ number_format(($package_silver->price - $net),2)  }}</span></td>
                        </tr>
                        <tr>
                            <td><b>shopping cart</b></td>
                            <td><span class="pull-right total-grand-order-amount">{{ config('app.currency') }}{{ $package_silver->price }}</span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td>Paypal fee 5.50%</td>
                            <td>
                                <span id="processingFees" class="pull-right">
                                    <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                        <?php $net_paypal = number_format(($package_silver->price * 5.50) / 100,2) ?>
                                        {{ $net_paypal }}
                                </span>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td><h5>total price
                                </h5></td>
                            <td><h5><span id="FinalAmount" class="pull-right">
                                         <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                             {{ number_format($package_silver->price + $net_paypal,2) }}
                                </span>
                                    </span>
                                </h5></td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>

                <a href="{{ route('order.package', ['package_id' =>$package_silver->id ,'package_name' => 'bronze']) }}"  style="border-radius: 6px; margin-bottom:40px; background: #367FA9;"  class="btn btn-primary">jetzt bezahlen mit Paypal</a>
                {{--<button  type="submit" class="btn btn-primary btn-lg" style="border-radius: 6px; margin-bottom:40px;">Pay with PayPal--}}
                {{--</button>--}}

                {{--<a href="{{ route('order.package') }}?package-id={{ $package->packages_id }}"  style="border-radius: 6px; margin-bottom:40px;" type="submit" class="btn btn-primary">Pay with PayPal</a>--}}
            </div>

        </div>
    </div> <!-- modal -->
    <div id="payment3" class="modal fade bs-example-modal-sm paypal" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <table class="order-view">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="4"><b></b></th>
                        </tr>
                        <tr>

                            <th>packages</th>
                            <th></th>
                            <th></th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>

                            <td>{{ $package_gold->package_name }}</td>

                            <td></td>
                            <td></td>
                            <td>{{ config('app.currency') }}<span class="package-amount">{{ $package_gold->price }}</span></td>
                        </tr>

                        </tbody>
                    </table>

                    <br>

                    <br>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td>
                                Total packages

                            </td>
                            <td>
                                <span id="NetTotal" class="pull-right">{{ config('app.currency') }}{{ $package_gold->price }}
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="order-view">
                        <tbody>
                        <tr>
                            <td>Net</td>
                            <td>
                                <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                    <?php $net = number_format($package_gold->price / (1+9 / 100),2) ?>
                                    {{ $net }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>19% MwSt.</td>
                            <td><span id="taxIncluded" class="pull-right">{{ config('app.currency') }}{{ number_format(($package_gold->price - $net),2)  }}</span></td>
                        </tr>
                        <tr>
                            <td><b>shopping cart
                                </b></td>
                            <td><span class="pull-right total-grand-order-amount">{{ config('app.currency') }}{{ $package_gold->price }}</span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Paypal fee 5.50%
                            </td>
                            <td>
                                <span id="processingFees" class="pull-right">
                                    <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                        <?php $net_paypal = number_format(($package_gold->price * 5.50) / 100,2) ?>
                                        {{ $net_paypal }}
                                </span>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td><h5>Total Price
                                </h5></td>
                            <td><h5><span id="FinalAmount" class="pull-right">
                                         <span id="NetTotal" class="pull-right">
                                    {{ config('app.currency') }}
                                             {{ number_format($package_gold->price + $net_paypal,2) }}
                                </span>
                                    </span>
                                </h5></td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>

                <a href="{{ route('order.package', ['package_id' =>$package_gold->id ,'package_name' => 'bronze']) }}"  style="border-radius: 6px; margin-bottom:40px; background: #367FA9;"  class="btn btn-primary">jetzt bezahlen mit Paypal</a>
                {{--<button  type="submit" class="btn btn-primary btn-lg" style="border-radius: 6px; margin-bottom:40px;">Pay with PayPal--}}
                {{--</button>--}}

                {{--<a href="{{ route('order.package') }}?package-id={{ $package->packages_id }}"  style="border-radius: 6px; margin-bottom:40px;" type="submit" class="btn btn-primary">Pay with PayPal</a>--}}
            </div>

        </div>
    </div> <!-- modal -->
</div>
@include('includes.footer')

{{--<script type="text/javascript">
    $(document).ready(function(){
        $(".swiper-slide-active").css({
            'background-size' : 'contain',
            'background-repeat' : ' no-repeat',
            'position' : 'relative',
            'top' : '0px'
        });
       $(".swiper-slide-prev").css({
           'background-size' : 'contain',
           'background-repeat' : ' no-repeat',
           'position' : 'relative',
           'top' : '0px'
       });
        $(".swiper-slide-next").css({
            'background-size' : 'contain',
            'background-repeat' : ' no-repeat',
            'position' : 'relative',
            'top' : '0px'
        });
    });
</script>--}}

<script>
    (function () {
        $('.btn-pay-start').click(function() {
            $('#paymentConfirmationModal').modal('show');

        });

    })();
</script>
