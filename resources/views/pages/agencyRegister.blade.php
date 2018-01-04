@include('includes.header')
<style>
    body{
        background-color: #f1f2f2;
    }
    #bs-example-navbar-collapse-4{
        background-color: white !important;
        border-color: white !important;
    }
    .container-fluid{
        padding: 0px;
    }
</style>
@if($errors->has('others'))
    <div class="container">
        <div class="alert alert-danger" role="alert" style="margin-top: 200px;margin-bottom: 200px;text-align: center;">{{ $errors->first('others') }}</div>
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('ErrorActivation'))
    <div class="container">
        <div class="alert alert-success"
             role="alert" style="margin-top: 200px;margin-bottom: 200px;text-align: center;">{{ \Illuminate\Support\Facades\Session::get('ErrorActivation') }}</div>
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('successMessage'))
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top: 200px;margin-bottom: 200px;text-align: center;">{{ \Illuminate\Support\Facades\Session::get('successMessage') }}</div>
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('errorMessage'))
    <div class="container">
        <div class="alert alert-danger" role="alert" style="margin-top: 200px;margin-bottom: 200px;text-align: center;">{{ \Illuminate\Support\Facades\Session::get('errorMessage') }}</div>
    </div>
    @else
            <!-- content -->
    <div class="dash-main-content" style="min-height: 800px;">
    <div class="container container_new login-modal">

        <div class="row row-centered">
            <div class="form-group form-inline text-center" style="margin-bottom: 3oaaa0px;">
                <label for="">Select language</label>
                <select name="" id="language" class="form-control">
                    <option value="" selected disabled>Select language</option>
                    <option value="eng" {{ (Request::old('sel_lang') == 'eng') ? 'Selected':'selected' }}>English</option>
                    <option value="ger" {{ (Request::old('sel_lang') == 'ger') ? 'Selected':'' }}>German</option>
                </select>
            </div>
            <h3 id="ger-para" class="login-title" style="display: none; text-align: left">You want to become part of the partner network
                ?</h3>
            <h3 id="en-para" class="login-title" style="display: none; text-align: left">You want to be a part of the partner network ?</h3>
            <h4 style="display: none; text-align: left; font-size:14px; color:rgb(111, 111, 111)" id="ger-para">Our partner team will be promptly
                To deal with their concerns. Thank you for your interest.</h4>
            <h4 style="display: none; text-align: left; font-size:14px; color:rgb(111, 111, 111)" id="en-para">Our partner team will immediately
                take care of their concerns . Thanks for LHR interest .</h4>
        </div>
        <div class="modal-signin">
            <div class="kontackt-form">

                <div class="row row-centered">
                    <form style="display: none;" id="ger" method="get" action="{{ route('Agencycontact') }}">


                        <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                             style="positon:relative;margin-bottom:0px !important; padding-left:0px">
                            <div class="" style="margin: 0 auto;">

                <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-user"></i>
                 </span>
                                <input value="{{ Request::old('name') }}" name="name"
                                       type="text" class="form-control em1" id="name" placeholder="Name"
                                       style="height:50px; padding: 6px 45px;">
                                @if($errors->has('name'))
                                    <p class="help-block" style="display: table">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                        </div>
                        <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                             style="positon:relative;margin-bottom:0px !important">
                            <div class="" style="margin: 0 auto;">
                 <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-envelope"></i>
                 </span>
                                <input name="email" value="{{ Request::old('email') }}" type="text" class="form-control em2" id="email"
                                       placeholder="Email adresse"
                                       style="height:50px; padding: 6px 45px;margin-bottom:0px !important">
                                @if($errors->has('email'))
                                    <p class="help-block" style="display: table">Please enter a valid email address</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                             style="positon:relative; padding-left:0px">
                            <div class="" style="margin: 0 auto;">
                         <span style="position:relative; top:35px; left:10px;">
                              <i class="fa fa-pencil"></i>
                         </span>
                                <input name="betreff" value="{{ Request::old('betreff') }}" type="text" class="form-control em2" id="betreff"
                                       placeholder="Betreff" style="height:50px; padding: 6px 45px; ">
                                @if($errors->has('betreff'))
                                    <p class="help-block">This subject field is required</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                             style="positon:relative; padding-left:0px">
                            <div class="" style="margin: 0 auto;">

                                <textarea placeholder="Nachricht" class="form-control" rows="6" cols="5"
                                          name="msg">{{ Request::old('msg') }}</textarea>
                                @if($errors->has('msg'))
                                    <p class="help-block">{{ $errors->first('msg') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                             style="positon:relative">
                            <div id="ger-btn" class="" style="margin: 0 auto; text-align: left;;">
                                <input type="hidden" name="sel_lang" class="sel_lang" value="ger">
                                <input type="submit" name="submit" value="Nachricht senden" class="btn btn-primary"
                                       style="background: #367FA9; border: 0px;">

                            </div>
                        </div>

                        <div>
                        </div>
                    </form>
                    <form style="display: none;" id="eng" method="get" action="{{ route('Agencycontact') }}">


                        <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                             style="positon:relative;margin-bottom:0px !important; padding-left:0px">
                            <div class="" style="margin: 0 auto;">

                <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-user"></i>
                 </span>
                                <input value="{{ Request::old('name') }}" name="name"
                                       type="text" class="form-control em1" id="name" placeholder="Name"
                                       style="height:50px; padding: 6px 45px;">
                                @if($errors->has('name'))
                                    <p class="help-block" style="display: table;">{{ ($errors->has('name')) ? 'This name field is required' : '' }}</p>
                                @endif
                            </div>

                        </div>
                        <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                             style="positon:relative;margin-bottom:0px !important">
                            <div class="" style="margin: 0 auto;">
                 <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-envelope"></i>
                 </span>
                                <input name="email" value="{{ Request::old('email') }}" type="text" class="form-control em2" id="email"
                                       placeholder="Email address"
                                       style="height:50px; padding: 6px 45px;margin-bottom:0px !important">
                                @if($errors->has('email'))
                                    <p class="help-block" style="display: table">Please enter a valid e -mail address</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                             style="positon:relative; padding-left:0px">
                            <div class="" style="margin: 0 auto;">
                         <span style="position:relative; top:35px; left:10px;">
                              <i class="fa fa-pencil"></i>
                         </span>
                                <input name="betreff" type="text" value="{{ Request::old('betreff') }}" class="form-control em2" id="betreff"
                                       placeholder="Subject" style="height:50px; padding: 6px 45px; ">
                                @if($errors->has('betreff'))
                                    <p class="help-block">This field is required concerning</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                             style="positon:relative; padding-left:0px">
                            <div class="" style="margin: 0 auto;">

                                <textarea placeholder="message" class="form-control" rows="6" cols="5"
                                          name="msg">{{ Request::old('msg') }}</textarea>
                                @if($errors->has('msg'))
                                    <p class="help-block">This msg field is required</p>
                                @endif
                            </div>
                        </div>
                        <div class="input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                             style="positon:relative">
                            <div id="ger-btn" class="" style="margin: 0 auto; text-align: left;;">
                                <input type="hidden" name="sel_lang" class="sel_lang" value="eng">
                                <input id="ger-btn" type="submit" name="submit" value="Send message" class="btn btn-primary"
                                       style="background: #367FA9; border: 0px;">

                            </div>
                        </div>

                        <div>
                        </div>
                    </form>
                </div>{{--end of row row-centered--}}
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#language").find("option:selected").each(function () {
                    if ($(this).attr("value") == "eng") {
                        $("#eng").show();
                        $("#ger").hide();
                        $("#en-para").show();
                        $("#ger-para").hide();
                    } else if($(this).attr("value") == "ger"){
                        $('.agency_register').show();
                        $("#eng").hide();
                        $("#ger").show();
                        $("#en-para").hide();
                        $("#ger-para").show();
                    }else{
                        $("#eng").hide();
                        $("#ger").hide();
                    }
                });
                $("#language").change(function () {
                    $(this).find("option:selected").each(function () {
                        if ($(this).attr("value") == "eng") {
                            $("#eng").show();
                            $("#ger").hide();
                            $("#en-para").show();
                            $("#ger-para").hide();
                        }
                        else {
                            $('.agency_register').show();
                            $("#eng").hide();
                            $("#ger").show();
                            $("#en-para").hide();
                            $("#ger-para").show();
                        }
                    });
                });
            });
        </script>
    </div>
    </div>
    @endif
    @include('includes.footer')
    </body>
    </html>