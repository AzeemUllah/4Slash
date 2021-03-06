
@include('includes.header')

<style>
    .cnerr-footer-background-color{
        position: relative !important;
    }
    .dash-main-content{
        min-height: auto;
    }
</style>

<div class="m-grid m-grid--hor m-grid--root m-page">

    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(assets/app/media/img/blog/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper" style="">
                <div class="m-login__container" style="padding-top: 55px">

                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Sign In </h3>
                    </div>
                    <form class="m-login__form m-form" method="post" action="{{ route('postUserlogin') }}">

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

                        <div class="form-group m-form__group">
                            <input class="form-control m-input"  value="{{ \Illuminate\Support\Facades\Input::old('email') }}" name="email" type="email" id="emailadress" placeholder="E-mail">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="row m-login__form-sub">


                                    <input type="checkbox" name="remember" style="width: 15px;margin-top: -5px;margin-right: 10px;"> Remember me
                                    <br>
                            <p class="forgt-pass"><a class="a-custom-color" href="/password/email">Forgot Password?
                                </a></p>
                                    <span></span>


                        @endif

                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>
                <div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Sign Up</h3>
                        <div class="m-login__desc">Enter your details to create your account:</div>
                    </div>
                    <form class="m-login__form m-form" method="post" action="register">
                        <div class="form-group m-form__group <?php echo $errors->has('email') ? ' has-error' : '' ?>">
                            <input class="form-control m-input" value="{{ \Illuminate\Support\Facades\Input::old('email') }}" type="email" placeholder="email" name="email" >
                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group m-form__group <?php echo $errors->has('username') ? ' has-error' : '' ?>">
                            <input class="form-control m-input" value="{{ \Illuminate\Support\Facades\Input::old('username') }}" type="text" placeholder="username" name="username" autocomplete="off">
                            @if($errors->has('username'))
                                <p class="help-block">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
                        <div class="form-group m-form__group <?php echo $errors->has('password') ? ' has-error' : '' ?>">
                            <input class="form-control m-input"  type="password" placeholder="Password" name="password">
                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="form-group m-form__group <?php echo $errors->has('password_confirmation') ? ' has-error' : '' ?>">
                            <input class="form-control m-input"  type="password" placeholder="Password" name="password_confirmation">
                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                        {{--<div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                        </div>--}}
                        <div class="row form-group m-form__group m-login__form-sub">
                            <div class="col m--align-left">
                                <label class="m-checkbox m-checkbox--focus">
                                    <input type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
                                    <span></span>
                                </label>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn" value="">Sign Up</button>

                        </div>
                    </form>
                </div>
                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Forgotten Password ?</h3>
                        <div class="m-login__desc">Enter your email to reset your password:</div>
                    </div>
                    <form class="m-login__form m-form" action="#">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Request</button>&nbsp;&nbsp;
                            <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</div>



<!-- content -->



<style>
    .site-footer{

        margin-top: 745px !important;
    }

</style>

@include('includes.footer')









