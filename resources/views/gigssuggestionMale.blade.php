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
     @if(!empty($type) && $type == 'gig')
        <table border="0" cellpadding="0" cellspacing="0" width="600"
               style="overflow:hidden;border-radius:4px;border-collapse:collapse!important;width: 100%;">
            <tbody>
            <tr>
                <td align="bottom" style="text-align:center!important">
                    <a href="https://www.4slash.com/" style="text-decoration:none" target="_blank"></a>
                </td>
            </tr>
        @if(!empty($status) && $status == 'accepted')
        <tr>
            <td style="padding-top: 20px;">
                <p style="font-size:22px;line-height:28px;margin:40px 0;margin-left: 35px;"><font color="#666666"><b>Dear 4slash Partner, {{ $user }},</b></font></p>

                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        Congratulations. Your submitted Gigs proposal has been checked and confirmed by the 4slash partner team.
                        In a few moments, your favor will be unlocked online. We wish you lots of success and good sales
                    </font>
                </p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Gigs: {{ $gig }}</font></p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Gigs description: {{ $gig_disc }}</font></p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        For more information, you can contact us at any time via our contact form.
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a href=" {{ route('contact') }}" class="btn-primary" style="text-decoration: none; margin-top:
65px;padding: 15px 18px; border-radius: 5px; border: 0px; transition: all 0.8s ease 0s; background: #367fa9; color:white;">Contact</a>
                    </font>
                </p>
            </td>
        </tr>
        <tr>
            <td><p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"><b>======================================================================================================</b></font></p></td>
        </tr>
        <tr>
            <td >
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"><b>Dear 4slash Partner, {{ $user }},</b></font></p>

                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        Congratulations. Your submitted Gigs has been tested and confirmed by 4slashr Partner Team .
                        In a few moments, your Gigs will be activated online . We wish you Good luck and good sales.
                    </font>
                </p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Gigs name: {{ $gig }}</font></p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Gigs discription: {{ $gig_disc }}</font></p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">For more information you can contact us anytime via support@4slash.com or through our contact form.
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a href=" {{ route('contact') }}" class="btn-primary" style="text-decoration: none; margin-top:
65px; background-color: #367fa9; padding: 15px 18px; border-radius: 5px; border: 0px; transition: all 0.8s ease
0s; color:#FFFFFF;">Contact us</a>
                    </font>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">Beste
                        Grüße/regards,</font></p>
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
        @elseif(!empty($status) && $status == 'offered')
            <tr>
                <td>
                    <p style="font-size:22px;line-height:28px;margin:40px 0;margin-left: 35px;"><font color="#666666"><b>Dear 4slash team,</b></font></p>

                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">

                            We have a favor suggestion {{ $gig }} From our partner {{ $user }} Get here to the Gigs suggestion
                            <b>
                                {{--<a href="{{route('agenciesSuggestion')}}"> Hier geht es zum Gigs Vorschlag</a>--}}
                                <a href="{{ route('gigcreate') . '?action=update&funnel=' . $gig_uuid }}">Here is the Gigs suggestion</a>
                            </b>
                        </font>
                    </p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Gigs Name : {{ $gig }}</font></p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Description: {{ $gig_disc }}</font></p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"> Direct link to the Gigs: <a href="{{ route('gigcreate') . '?action=update&funnel=' . $gig_uuid }}"> {{ $gig }} </a></font></p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"> Best regards
                            Your 4slash system</font></p>
            </td>
        </tr>
        @endif
    </table>
    @elseif(!empty($type) && $type == 'package')
        <table border="0" cellpadding="0" cellspacing="0" width="600"
               style="overflow:hidden;border-radius:4px;border-collapse:collapse!important;width: 100%;">
            <tbody>
            <tr>
                <td align="bottom" style="text-align:center!important">
                    <a href="https://www.4slash.com/" style="text-decoration:none" target="_blank"></a>
                </td>
            </tr>
        @if(!empty($status) && $status == 'accepted')
        <tr>
            <td style="padding-top: 20px;">
                <p style="font-size:22px;line-height:28px;margin:40px 0;margin-left: 35px;"><font color="#666666"><b>Dear 4slash partner, {{ $user }},</b></font></p>

                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">

                        Congratulations. Your submitted package proposal has been checked and approved by the 4slash partner team. In a few moments, your package will be unlocked online. We wish you lots of success and good sales.
                    </font>
                </p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Package: {{ $gig }}</font></p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Package Description: {{ $gig }}</font></p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        For further information, please contact us at support@4slash.com or via our contact form.
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a href=" {{ route('contact') }}" class="btn-primary" style="text-decoration: none; margin-top:
65px; background-color: #367fa9; padding: 15px 18px; border-radius: 5px; border: 0px; transition: all 0.8s ease
0s; color:#FFFFFF;">Contact us</a>
                    </font>
                </p>
            </td>
        </tr>
        <tr>
            <td><p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"><b>=================================================================================================================</b></font></p></td>
        </tr>
        <tr>
            <td >
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"><b>Dear 4slash Partner, {{ $user }},</b></font></p>

                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        Congratulations. Your submitted package-suggestion has been tested and confirmed by 4slash Partner Team . In a few moments, your package will be activated online . We wish you good luck and good sales.
                    </font>
                </p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Paket: {{ $gig }}</font></p>
                <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666">Package Description: {{ $gig }}</font></p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">For more information you can contact us anytime via support@4slash.com or through our contact form.
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666"><a href=" {{ route('contact') }}" class="btn-primary" style="text-decoration: none; margin-top:
65px; padding: 15px 18px; border-radius: 5px; border: 0px; transition: all 0.8s ease 0s; background: #367fa9">Contact us</a>
                    </font>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">Best
                        Greetings / regards,</font></p>
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
        @elseif(!empty($status) && $status == 'offered')
            <tr>
                <td>
                    <p style="font-size:22px;line-height:28px;margin:40px 0;margin-left: 35px;"><font color="#666666"><b> Dear 4slash Community,</b></font></p>

                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                            An agency {{ $agency }}
                            Has sent a new package suggestion. Please check the suggestion and confirm with the "Accepted" in "Suggested Package" section in Admin Panel.
                        </font>
                    </p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"> Packages: {{ $package }}</font></p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"> Direct link to the package: <a href="{{ route('packagesSuggestion') }}"> {{ $package }} </a></font></p>
                    <p style="font-size:18px;line-height:28px;margin-left: 35px;"><font color="#666666"> Best regards
                            Your 4slash system</font></p>
            </td>
        </tr>
        @endif
    </table>
    @endif

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