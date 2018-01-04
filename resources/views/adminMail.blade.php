<!doctype html>
<html>
<head>
    <style>
        * {
            margin: 0px auto;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
    </style>
</head>
<body style="background-color:#eeeeee;">

<div class="container" style="margin-top: 20px;">
    <h3 style="text-align: center; padding-top: 40px;"><img src="https://4slash.com/img/4slashlogo5.png" style="width: 100px;"></h3>
    <div class="col-md-12 col-md-offset-3" style="padding-top: 50px; padding-bottom: 40px;  max-width: 600px;">
        <div class="col-md-10 col-md-offset-1" style="background-color: white;    margin-top: -35px">
    <table border="0" cellpadding="0" cellspacing="0" width="600"
           style="overflow:hidden;border-radius:4px;border-collapse:collapse!important;width: 100%;">
        <tbody>
        <tr>
            <td align="bottom" style="text-align:center!important">
                <a href="https://www.4slash.com/" style="text-decoration:none" target="_blank"></a>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;">
                @if(!empty($type) && $type == 'admin')
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        There was a new order {{ $order_no}}
                        transmitted. Here you will find the <a href="{{route('adminorder', ['orderno' => $order_no, 'orderuuid' => $orderUUID])}}" target="_blank"> job details
                        </a> wie folgt.
                    </font>
                </p>
                @elseif(!empty($type) && $type == 'agency')
                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">

                            It was an order<a href="{{route('agencySingleOrder', ['orderno' => $order_no, 'orderuuid' => $orderUUID])}}" target="_blank"> {{ $order_no}} </a> From agency market
                        </font>
                    </p>
                @endif
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><b>gig Shopping Cart: </b>{{ config('app.currency') }}<span class="gig-amount">{{ (float)$gig_amount }}</span></font>
                </p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><b>user: </b><span class="gig-amount">{{ $user }}</span></font>
                </p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"> <b>order date:</b>{{ $date }}</font>
                </p>
                <p style="font-size:18px;line-height:28px;margin:40px 0;"><font color="#666666">============================================================================</font>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a href="{{ url() }}">www.4slash.com</a>
                    </font>
                </p>
            </td>
        </tr>
    </table>
        </div>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"
               style="max-width:600px; background-color: #3f3f3f; margin-top: 20px;"
               class="m_-3693637217867208194m_-3260673071286083101responsive-table">
            <tbody>
            <tr>
                <td align="center">


                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"
                           style="max-width:600px" class="m_-3693637217867208194m_-3260673071286083101responsive-table">
                        <tbody>
                        <tr>
                            <td align="center" class="m_-3693637217867208194m_-3260673071286083101center"
                                style="text-align:center;padding:20px 10px 20px 10px">

                                <a href="https://twitter.com/4_slash" style="display:inline-block;margin:2px"
                                   target="_blank"><img height="40"
                                                        src="https://4slash.com/img/4slash_Twitter.png"
                                                        width="40" class="CToWUd"></a>

                                <a href="https://www.facebook.com/4Slash" style="display:inline-block;margin:2px"
                                   target="_blank"><img height="40"
                                                        src="https://4slash.com/img/4slash_Facebook.png"
                                                        width="40" class="CToWUd"></a>

                                <a href="https://www.pinterest.com/4Slashcreative/"
                                   style="display:inline-block;margin:2px" target="_blank"><img height="40"
                                                                                                src="https://4slash.com/img/4slash_Pinterest.png"
                                                                                                width="40"
                                                                                                class="CToWUd"></a>

                                <a href="https://www.linkedin.com/company-beta/2931327/"
                                   style="display:inline-block;margin:2px" target="_blank"><img height="40"
                                                                                                src="https://4slash.com/img/4slash_LinkedIn.png"
                                                                                                width="40"
                                                                                                class="CToWUd"></a>

                                <a href="https://www.instagram.com/4slashofficial/"
                                   style="display:inline-block;margin:2px" target="_blank"><img height="40"
                                                                                                src="https://4slash.com/img/4slash_Instagram.png"
                                                                                                width="40"
                                                                                                class="CToWUd"></a>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#999999;font-size:12px;line-height:16px;text-align:center; padding: 10px 20px;">
                                This email was intended for 4slash, because you signed up for 4slash | <span
                                        style="font-family:arial,helvetica neue,helvetica,sans-serif">
                     <a href="" style="color:#00b22d;text-decoration:none" target="_blank">Unsubscribe</a> |
                     The links in this email will always direct to <a href="https://4slash.com"
                                                                      style="color:#00b22d;text-decoration:none">https://4slash.com</a>
                     <br>&copy; 4slash Ltd. 2017
                     </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>