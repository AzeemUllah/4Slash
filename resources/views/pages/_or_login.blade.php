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
<div class="dash-main-content" style="height:67vh">
    <div class="login-modal">
        @if(\Illuminate\Support\Facades\Session::has('fb_error_message'))
        <div class="alert alert-success" role="alert" style="text-align: center; width: 50%; margin: 20px auto;">
            <p>{{ \Illuminate\Support\Facades\Session::get('fb_error_message') }}</p>
        </div>
        {{-- {{ \Illuminate\Support\Facades\Session::forget('successMessage_1') }}
        {{ \Illuminate\Support\Facades\Session::forget('successMessage_2') }}--}}
        @endif
        @if(\Illuminate\Support\Facades\Session::has('successMessage_1'))
        <div class="alert alert-success" role="alert" style="text-align: center; width: 50%; margin: 80px auto; margin-top: 140px; margin-bottom: 70px;">
            <p>{{ \Illuminate\Support\Facades\Session::get('successMessage_1') }}</p>
            <p>{{ \Illuminate\Support\Facades\Session::get('successMessage_2') }}</p>
        </div>
        {{-- {{ \Illuminate\Support\Facades\Session::forget('successMessage_1') }}
        {{ \Illuminate\Support\Facades\Session::forget('successMessage_2') }}--}}
        @endif
        @if(\Illuminate\Support\Facades\Session::has('exists'))
        <div class="alert alert-success" role="alert" style="text-align: center; width: 100%;margin-top: 10px;">
            <p>{{ \Illuminate\Support\Facades\Session::get('exists') }}</p>
        </div>
        {{-- {{ \Illuminate\Support\Facades\Session::forget('successMessage_1') }}
        {{ \Illuminate\Support\Facades\Session::forget('successMessage_2') }}--}}
        @endif

        @if(!\Illuminate\Support\Facades\Session::has('successMessage_1'))
        <h4 class="login-title">Customer Login</h4>

        <div class="modal-signin">

            <form method="post" action="{{ route('postUserlogin') }}">

                @if($errors->has('auth'))
                <div class="alert alert-danger" role="alert" style="text-align: center; margin-top: 10px;">{{ $errors->first('auth') }}</div>
                @elseif($errors->has('ErrorMessage'))
                <div class="alert alert-danger" role="alert" style="text-align: center; margin-top: 10px;">{{ $errors->first('ErrorMessage') }}</div>
                @endif

                @if(isset($successMessage))
                <div class="alert alert-success" role="alert" style="text-align: center; width: 100%; margin-top: 10px;">{{ $successMessage }}</div>
                @endif



                @if(\Illuminate\Support\Facades\Session::has('emailVerified'))
                <div class="alert alert-success" role="alert" style="text-align: center; width: 100%; margin-top: 10px;">{{ \Illuminate\Support\Facades\Session::get('emailVerified') }}</div>
                {{ \Illuminate\Support\Facades\Session::forget('emailVerified') }}
                @endif
                @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success" role="alert" style="text-align: center; width: 100%; margin-top: 10px;">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>
                {{ \Illuminate\Support\Facades\Session::forget('success') }}
                @endif

                @if(!isset($successMessage))
                <div class="input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new" style="positon:relative">
                    <div class="email" style="margin: 0 auto;">
                        <label for="emailadress" class="sr-only">Email address</label>
                        <span style="position:relative; top:37px; left:15px;">
                      <i class="fa fa-envelope-o fa-custom-color"></i>
                     </span>
                        <input value="{{ \Illuminate\Support\Facades\Input::old('email') }}" name="email" type="email" class="form-control em1" id="emailadress" placeholder="E-mail" style="height:50px; padding: 6px 45px;">
                        {{-- @if($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif--}}
                    </div>
                </div>
                <div class="input form-group<?php echo $errors->has('password') ? ' has-error' : '' ?> input-new" style="positon:relative">
                    <div class="password" style="margin: 0 auto;">
                        <label for="password" class="sr-only">Password</label>
                        <span style="position:relative; top:40px; left:10px;">
                        <i class="fa fa-key fa-custom-color fa-custom-position-password"></i>
                            <!--<img src="img/lg-key.png" style="height:25px;"> -->
                    </span>
                        <input name="password" type="password" class="form-control em2" id="password" placeholder="Password" style="height:50px; padding: 6px 45px;">
                        {{--@if($errors->has('password'))
                        <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif--}}
                    </div>
                </div>
                <div>
                    <input type="hidden" name="type" value="user">
                    <div class="send-box" style="margin: 0 auto;">
                        <div class="sig-btn">

                            <!-- adding divs and p tags around original input tag -->

                            <div class="checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx2 col-md-6">
                                <input id="" class="styled radio-btn-addon" type="checkbox">
                                <label for="">
                                    <span class="span-custom-top remember-css chck-bx-p addon-name remain-signin-span-custom-position">Remain signin</span>
                                </label>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="loginpage-checkbox a-button a-button-override-for-loginpage pull-right" value="log in">Login</button>
                                <br>
                                <p class="forgt-pass"><a class="a-custom-color" href="/password/email">Forgot Password?
                                    </a></p>
                            </div>
                            <!-- <input  type="checkbox"><span class="remember-css">Remain signed in</span>
                            <button type="submit" class="loginpage-checkbox a-button a-button-override-for-loginpage pull-right" value="log in">Login</button> -->
                        </div>
                        <!-- <p class="forgt-pass"><a href="/password/email">Forgot Password? -->
                        </a></p>
                    </div><!--send -->
                </div>
                @endif

                {{--<div class="social-button text-center row" style="position:relative;">
                    <div style="display:inline-block;float:none;" class="col-xs-12 col-sm-4 col-md-3 col-lg-4">
                        <div class="fb">
                            <a class="btn btn-block btn-social btn-facebook" style="box-shadow: 2px 3px 0px #0821A2">
                                <i class="fa fa-facebook"></i>
                                <span style="font-size: smaller;">Connect Facebook</span>
                            </a>
                        </div>
                    </div>
                    <div style="display:inline-block;float:none;" class="col-xs-12 col-sm-4 col-md-3 col-lg-4">
                        <div class="gm">
                            <a class="btn btn-block btn-social btn-google" style="box-shadow: 2px 3px 0px #770D00">
                                <i class="fa fa-google"></i>
                                <span style="font-size: smaller;">Connect Google</span>
                            </a>
                        </div>
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->--}}
            </form>

        </div>
        {{ \Illuminate\Support\Facades\Session::forget('successMessage_1') }}
        {{ \Illuminate\Support\Facades\Session::forget('successMessage_2') }}
        <div class="modal-footer login-footer">
            <p class="footer-p">Register? <a class="a-custom-color" href="#"  data-toggle="modal" data-target="#gridSystemModal1" id="registrieren">Sign Up</a></p>
        </div>
        @endif
    </div>
</div>


@include('includes.footer')


