
@include('includes.header')

<div class="modal-body loggin">
    <h2 class="modal-title signup-title">Sign Up</h2>
    <div class="container">
        <form method="post" action="/register">
            <div class="username1 form-group<?php echo $errors->has('email') ? ' has-error' : '' ?>">
                <label for="email_adress" class="sr-only">Email_address</label>
                <span style="position:relative; top:38px; left:10px;">
                  <i class="fa fa-envelope-o"></i>
                 </span>
                <input name="email" value="{{ \Illuminate\Support\Facades\Input::old('email') }}" type="email" class="form-control em" id="email_adress" placeholder="Email" style="height:50px; padding: 6px 45px;">
                @if($errors->has('email'))
                    <p class="help-block">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="user1 form-group<?php echo $errors->has('username') ? ' has-error' : '' ?>">
                <label for="user" class="sr-only">User Name</label>
                <span style="position:relative; top:38px; left:10px;">
                    <img src="img/lg-men.png" style="height:25px;">
                </span>
                <input name="username" value="{{ \Illuminate\Support\Facades\Input::old('username') }}" type="text" class="form-control em" id="user" placeholder="User Name" style="height:50px; padding: 6px 45px;">
                @if($errors->has('username'))
                    <p class="help-block">{{ $errors->first('username') }}</p>
                @endif
            </div>
            <div class="pass1 form-group<?php echo $errors->has('password') ? ' has-error' : '' ?>">
                <label for="pass" class="sr-only">Password</label>
                <span style="position:relative; top:40px; left:10px;">
                    <img src="img/lg-key.png" style="height:25px;">
                </span>
                <input name="password" type="password" class="form-control em" id="Pass" placeholder="password" style="height:50px; padding: 6px 45px;">
                @if($errors->has('password'))
                    <p class="help-block">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="con_pass1 form-group">
                <span style="position:relative; top:40px; left:10px;">
                    <img src="img/lg-key.png" style="height:25px;">
                </span>
                <label for="con_pass" class="sr-only">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control em" id="con_pass" placeholder="Confirm Password" style="height:50px; padding: 6px 45px;">
            </div>
            <div class="row">
                <div class="signup">
                    <input type="submit" class="btn btn-primary" value="Sign Up">
                </div>
            </div><!-- /.row -->
        </form>
    </div>
</div>
<div class="modal-footer login-footer">
    <p class="footer-p">Already have saaaaaaaad  an account? <a href="/login">Sign In</a></p>
</div>
@include('includes.footer');