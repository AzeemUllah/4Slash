@include('includes.header')

<div class="dash-main-content" style="min-height: 900px;">
<!--Content-->
   <div class="container top-gap" style="background-color: transparent !important;">
     @if(\Illuminate\Support\Facades\Session::has('success_settins'))
       <div class="alert alert-success text-center" role="alert">
         <p>{{ \Illuminate\Support\Facades\Session::get('success_settins') }}</p>
       </div>
       {{-- {{ \Illuminate\Support\Facades\Session::forget('successMessage_1') }}
        {{ \Illuminate\Support\Facades\Session::forget('successMessage_2') }}--}}
     @endif
   		<div class="well main">
        	<h1 class="text-primary" style="color:#161d28">My Settings</h1>
            <div class="content-body">
              <hr>
              <div class="select-box">
                <div class="row first-rw">
                  {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Notification</div>--}}
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-3" style="font-size: 18px;">Type</div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3" style="font-size: 18px;">Email</div>
                  {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Push</div>--}}
                </div>
                <div class="row third-rw">
                  {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"></div>--}}
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-3" style="font-size: 18px;">Order Messages</div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                    <div class="switch">
                      <input id="cmn-toggle-3" class="cmn-toggle cmn-toggle-round" type="checkbox" {{ ($user->email_notify) == 1 ? 'checked' :'' }}>
                      <label for="cmn-toggle-3"></label>
                    </div>
                  </div>
                </div>
                <div class="row fourth-rw">
                  {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"></div>--}}
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-3" style="font-size: 18px;">Order status</div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                    <div class="switch">
                      <input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" type="checkbox" {{ ($user->order_notify) == 1 ? 'checked' :'' }}>
                      <label for="cmn-toggle-5"></label>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <form action="{{ route('notify.settings') }}" method="post"> 
                <input type="hidden" name="email_notify" value="{{ $user->email_notify }}" id="email_notify">
                <input type="hidden" name="order_notify" value="{{ $user->order_notify }}" id="order_notify">
                <div class="col-md-11 sav-btn">
                  <button type="submit" style="background: #6a67ce;" class="btn btn-primary pull-right">Save</button>
                </div>
              <div class="clearfix"></div>
              </form>
            </div>
      </div>
  </div>
<!--Footer-->
</div>



       @include('includes.footer')

</body>
</html>