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
            @if($user != 'admin')
                <td style="width:100%; float: left; padding-top: 20px;">
                    @if(!empty($type) && $type == 'accepted' && !empty($user) && $user == 'agency')
                        <p style="font-size:22px;line-height:28px;margin-left: 35px;"><font color="#666666"><b> Lieber
                                    4slash interested, {{ $agency }},</b></font></p>
                        <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                                a lot of
                                Thanks for your interest in a partnership. We have checked your request in advance and
                                You will need the following completed form to complete your registration:
                                <a href="{{route('agency.registerForm')}}?varify={{ $activation_code }}">Click and
                                    Complete the form (link)</a>
                            </font>
                        </p>
                        <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px; color:#666666;">
                            Important partner information can be downloaded here: <a
                                    href="http://www.4slash.com/Partner_Informationen.pdf">
                                Partner Information Contact Us |
                                download</a>
                        </p>
                        <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px; color: #666666;">
                            To open this file, you will need the Adobe Acrobat Reader, which you can click on
                            Following internet address:
                            <a href="http://www.adobe.com/de/products/acrobat/readstep2.html">http://www.adobe.com/de/products/acrobat/readstep2.html</a>
                        </p>
                    @elseif(!empty($type) && $type == 'inquiry' && !empty($user) && $user == 'agency')
                        <p style="font-size:22px;line-height:28px;margin-left: 35px;"><font color="#666666"><b> Dear
                                    4slash interested, {{ $agency }},</b></font></p>
                        <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">a lot of
                                Thanks for your interest in a partnership. Our partner team will be with you soon
                                Contact you.
                            </font>
                        </p>
                    @endif

                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">For
                            For further information, please contact us via
                            Our contact form.
                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a
                                    href=" {{ route('contact') }}" class="btn-primary" style="text-decoration: none; margin-top:
65px; padding: 15px 18px; border-radius: 5px; border: 0px; transition: all 0.8s ease 0s; background: #367fa9; color:white">Contact us</a>
                        </font>
                    </p>
                    <p style="font-size:22px;line-height:28px;margin-left: 35px; margin-top: 50px;"><font
                                color="#666666">======================================================================================================</font></p>
                </td>
        </tr>
        <tr>

            <td style="width:100%; float: left;">
                @if(!empty($type) && $type == 'accepted' && !empty($user) && $user == 'agency')
                    <p style="font-size:22px;line-height:28px;margin-left: 35px;"><font color="#666666"><b> Dear 4slash interested, {{ $agency }},</b></font></p>
                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                            Thank you for your interest in a partnership . We have received your request checked in
                            advance and need to complete your registration following , complete form : .
                            <a href="{{route('agency.registerForm')}}?varify={{ $activation_code }}">
                                Click and Complete the form (link)</a>
                        </font>
                    </p>
                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px; color: #666666;">
                        Important Partner information please download here : <a
                                href="http://www.4slash.com/Partner_Registrierung_en.pdf"> Affiliate Information | FAQ |
                            download</a>
                    </p>
                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px; color: #666666;">
                        To open this file you need Adobe Acrobat Reader , you can download at the following Internet
                        address which free
                        <a href="http://www.adobe.com/de/products/acrobat/readstep2.html">http://www.adobe.com/de/products/acrobat/readstep2.html</a>
                    </p>

                @elseif(!empty($type) && $type == 'inquiry' && !empty($user) && $user == 'agency')
                    <p style="font-size:22px;line-height:28px;margin-left: 35px;"><font color="#666666"><b> Dear 4slash interested, {{ $agency }},</b></font></p>
                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">Thank
                            you for your interest in a partnership . Our Partners team will contact you shortly in
                            connection .
                        </font>
                    </p>
                    {{--<p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#888888"> herzlichen Glückwunsch! Unser Partner Team hat Ihre Anfrage bestätigt. Klicken Sie auf diesen Link um die Registrierung abzuschließen.--}}
                    {{--</font>--}}
                    {{--</p>--}}
                @endif

                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">For more
                        information you can contact us anytime via our contact form .
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a
                                href=" {{ route('contact') }}" class="btn-primary" style="text-decoration: none; margin-top:
65px; padding: 15px 18px; border-radius: 5px; border: 0px; transition: all 0.8s ease
0s; background: #367fa9;color:white;">Contact us</a>
                    </font>
                </p>
            </td>

            @endif
            @if(!empty($type) && $type == 'inquiry' && !empty($user) && $user == 'admin' )
                <td>

                    <p style="font-size:22px;line-height:28px;margin-left: 35px;"><font color="#666666"><b> dear
                                4slash team,</b></font></p>

                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                            we
                            Have received a request for a partnership through the Partner Contact Form. You're welcome
                            Examine the request and thus the interest in a cooperation.
                        </font>
                    </p>
                    <p style="font-size:18px;line-height:28px;margin:40px 0;margin-left: 35px;"><font color="#666666">
                            Many thanks for the quick processing.</font></p>
                    <a href="{{ route('adminagencies') }}"
                       style="font-size:18px;line-height:28px;margin:40px 0;margin-left: 35px;"> <font color="black">Here
                            You find the partner request in the backend!</font> </a>

                </td>

            @elseif(!empty($type) && $type == 'accepted' && !empty($user) && $user == 'admin' )
                <td>

                        <p style="font-size:22px;line-height:28px;margin-left: 35px;"><font color="#666666"><b> dear
                                    4slash team,</b></font></p>

                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                            The partner's request {{$agency}} Has just been confirmed. Of the
                            Registration link has been sent to the prospective customer by mail.
                        </font>
                    </p>
                </td>
            @endif
        </tr>
        <tr>
            <td>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">Best
                         regards,</font></p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        4slash Team
                    </font>
                </p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a
                                href="{{ url() }}">www.4slash.com</a>
                    </font>
                </p>
                {{--<p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                    Kontaktformular:
                </font>
                </p>--}}
            </td>
        </tr>
        </tbody>
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