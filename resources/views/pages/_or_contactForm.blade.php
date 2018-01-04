@include('includes.header')

<div class="dash-main-content">
<!-- content -->
  <div class="container login-modal">

      <div class="row row-centered">
                    <h4 class="login-title" style="text-align: left">Contact us.</h4>
                    <h4 style="text-align: left; font-size:25px; color:rgb(111, 111, 111)">Contact us about anything related to services, our company.</h4>
          <a href="https://4slash.zendesk.com"</a>
      </div>
    <div class="modal-signin">
      <div class="kontackt-form">

          <div class="row row-centered">
        <form method="get" action="{{ route('contact') }}">

            @if($errors->has('others'))
            <div class="alert alert-danger" role="alert">{{ $errors->first('others') }}</div>
            @endif

            @if(\Illuminate\Support\Facades\Session::has('successMessage'))
                    <div class="alert alert-success" role="alert">{{ \Illuminate\Support\Facades\Session::get('successMessage') }}</div>
            @endif

                @if(\Illuminate\Support\Facades\Session::has('errorMessage'))
                    <div class="alert alert-danger" role="alert">{{ \Illuminate\Support\Facades\Session::get('errorMessage') }}</div>
                @endif


            <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new" style="positon:relative;margin-bottom:0px !important; padding-left:0px">
                <div class="" style="margin: 0 auto;">

                <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-user"></i>
                 </span>
                <input value="{{ \Illuminate\Support\Facades\Input::old('name') }}" name="name" type="text" class="form-control em1" id="name" placeholder="Name" style="height:50px; padding: 6px 45px;">
                    @if($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                    @endif
                </div>

            </div>
            <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new" style="float: right ;positon:relative;margin-bottom:0px !important">
                <div class="" style="margin: 0 auto;">
                 <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-envelope"></i>
                 </span>
                <input name="email" type="text" class="form-control em2" id="email" placeholder="Email Address" style="height:50px; padding: 6px 45px;margin-bottom:0px !important">
                    @if($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>
                <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new" style="positon:relative; padding-left:0px">
                    <div class="" style="margin: 0 auto;">
                         <span style="position:relative; top:35px; left:10px;">
                              <i class="fa fa-pencil"></i>
                         </span>
                        <input name="betreff" type="text" class="form-control em2" id="betreff" placeholder="Subject" style="height:50px; padding: 6px 45px; ">
                        @if($errors->has('betreff'))
                            <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new" style="positon:relative; padding-left:0px">
                    <div class="" style="margin: 0 auto;">

                        <textarea placeholder="Message " class="form-control" rows="6" cols="5" name="msg">{{ \Illuminate\Support\Facades\Input::old('msg') }}</textarea>
                        @if($errors->has('betreff'))
                            <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>
                <div class="input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new" style="positon:relative">
                    <div id="ger-btn" class="" style="margin: 0 auto; text-align: left;;">

                        <input type="submit" name="submit" value="Send" class="btn btn-primary con_btn" style="background: /*#367FA9;*/ border: 0px;"> 

                    </div>
                </div>

            <div>
            </div>

        </form>
          </div>{{--end of row row-centered--}}
      </div>
    </div>

  </div>

</div>
@include('includes.footer')

</body>
</html>
