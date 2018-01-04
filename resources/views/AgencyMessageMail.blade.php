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

                    <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                            New message from the partner <b>{{$name}}</b>
                        </font>
                    </p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                       " {!! $message !!} "
                    </font>
                </p>

                <p style="font-size:18px;line-height:28px;margin:40px 0;"><font color="#666666">======================================================================================================</font>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">Best regards,</font></p>
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        4slash - Team
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
                <p style="font-size:18px;line-height:28px;margin:20px 0;padding:0 40px"><font color="#666666">
                        4SLASH<br>
                    </font>
                </p>
            </td>
        </tr>
    </table>
        </div>

    </div>
</body>
</html>