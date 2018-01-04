@include('includes.header')

<!-- content -->






<section>
<div class="m-grid m-grid--hor m-grid--root m-page">

    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(assets/app/media/img/blog/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container" style="padding-top: 55px">
                
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Register </h3>
                    </div>


                    <form method="post" action="register">
                        <div class="username1 form-group<?php echo $errors->has('email') ? ' has-error' : '' ?>">
                            <label for="email_adress" class="sr-only">Email_address</label>
                            <span style="position:relative; top:38px; left:10px;">

                 </span>
                            <input name="email" value="{{ \Illuminate\Support\Facades\Input::old('email') }}" type="email" class="form-control em" id="email_adress" placeholder="Email" style="height:50px; padding: 6px 45px;border-radius: 40px;   background: #f7f6f9;">
                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="user1 form-group<?php echo $errors->has('username') ? ' has-error' : '' ?>">
                            <label for="user" class="sr-only">User Name</label>
                            <span style="position:relative; top:38px; left:10px;">

                </span>
                            <input name="username" value="{{ \Illuminate\Support\Facades\Input::old('username') }}" type="text" class="form-control em" id="user" placeholder="User Name" style="height:50px; padding: 6px 45px;border-radius: 40px;    background: #f7f6f9;">
                            @if($errors->has('username'))
                                <p class="help-block">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
                        <div class="pass1 form-group<?php echo $errors->has('password') ? ' has-error' : '' ?>">
                            <label for="pass" class="sr-only">Password</label>
                            <span style="position:relative; top:40px; left:10px;">

                </span>
                            <input name="password" type="password" class="form-control em" id="Pass" placeholder="password" style="height:50px; padding: 6px 45px;border-radius: 40px;    background: #f7f6f9;">
                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="con_pass1 form-group">
                <span style="position:relative; top:40px; left:10px;">

                </span>
                            <label for="con_pass" class="sr-only">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control em" id="con_pass" placeholder="Confirm Password" style="height:50px; padding: 6px 45px;border-radius: 40px;    background: #f7f6f9;">
                        </div>
                        <div class="row form-group m-form__group m-login__form-sub">


                                    <input type="checkbox" name="agree" style="    width: 15px; margin-top: -5px;margin-right: 10px;margin-left: 30px;">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
                                    <span></span>

                                <span class="m-form__help"></span>

                        </div>
                        <div class="row">
                            <div class="m-login__form-action" style=" width: 100%;text-align: center;">
                                <button type="submit" class="btn btn-primary" value="">Sign Up</button>

                            </div>
                        </div><!-- /.row -->
                    </form>
                </div>
                <div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Sign Up</h3>
                        <div class="m-login__desc">Enter your details to create your account:</div>
                    </div>
                    <form class="m-login__form m-form" action="#">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                        </div>
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
                            <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Sign Up</button>&nbsp;&nbsp;
                            <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">Cancel</button>
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
</section>

@include('includes.footer');


