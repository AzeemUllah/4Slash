@extends('pages.agency.agency_template')
@section('header_title')
    <h1>Profile</h1>

@endsection
@section('content')
        <!-- content -->
    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="col-xs-9">
            <div class="container login-modal" style="margin-top:30px; padding-left:0; width:700px">
                @if(\Illuminate\Support\Facades\Session::has('successMessage'))
                    <div class="alert alert-success" role="alert">{{ \Illuminate\Support\Facades\Session::get('successMessage') }}</div>
                @endif
                <div class="row row-centered">
                    <div class="form-group form-inline text-left" style="margin-bottom: 3oaaa0px;">
                        <label for="">Select language</label>
                        <select name="" id="language" class="form-control">
                            <option value="" selected disabled>Select language</option>
                            <option value="eng" {{ (Request::old('sel_lang') == 'eng') ? 'Selected':'selected' }}>English</option>
                            <option value="ger" {{ (Request::old('sel_lang') == 'ger') ? 'Selected':'' }}>German</option>
                        </select>
                    </div>
                    <h3 id="ger-para" class="login-title" style="display: none; text-align: left">Haben Sie weitere Fragen? Schreiben Sie uns gerne eine Nachricht.</h3>
                    <h3 id="en-para" class="login-title" style="display: none; text-align: left">Do you have any further questions? Write us an email .</h3>
                    <h4 style="display: none; text-align: left; font-size:14px; color:rgb(111, 111, 111)" id="ger-para">Unser Partner-Team wird sich umgehend
                        um ihr Anliegen kümmern. Vielen Dank für lhr Interesse.</h4>
                    <h4 style="display: none; text-align: left; font-size:14px; color:rgb(111, 111, 111)" id="en-para">Our partner team will immediately
                        take care of their concerns . Thanks for LHR interest .</h4>
                </div>
                <div class="modal-signin">
                    <div class="container kontackt-form" style="padding-left:0; width:700px">

                        <div class="row row-centered">
                            <form style="display: none;" id="ger" method="get" action="{{ route('Agencycontact') }}">


                                <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                                     style="positon:relative;margin-bottom:0px !important; padding-left:0px">
                                    <div class="" style="margin: 0 auto;">

                <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-user"></i>
                 </span>
                                        <input value="{{ Request::old('name') }}" name="name"
                                               type="text" class="form-control em1" id="name" placeholder="Name"
                                               style="height:50px; padding: 6px 45px;">
                                        @if($errors->has('name'))
                                            <p class="help-block">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                                     style="positon:relative;margin-bottom:0px !important">
                                    {{--<div class="" style="margin: 0 auto;">
                                         <span style="position:relative; top:35px; left:10px;">
                                          <i class="fa fa-envelope"></i>
                                         </span>
                                        <input name="email" value="{{ Request::old('email') }}" type="text"
                                               class="form-control em2" id="email"
                                               placeholder="Email adresse"
                                               style="height:50px; padding: 6px 45px;margin-bottom:0px !important">
                                        @if($errors->has('email'))
                                            <p class="help-block">Bitte geben Sie eine gültige E-Mail Adresse an</p>
                                        @endif
                                    </div>--}}
                                    @if(!empty($email))
                                        <input type="hidden" name="email" value="{{ $email }}">
                                    @endif
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
                                            <p class="help-block">Dieses Betreff-Feld wird benötigt</p>
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
                                <div class="col-xs-12">
                                    <div class="input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                                         style="positon:relative">
                                        <div class="" style="margin: 0 auto; text-align: left;">
                                            <input type="hidden" name="sel_lang" class="sel_lang" value="ger">
                                            <input type="submit" name="submit" value="Nachricht senden"
                                                   class="btn btn-primary"
                                                   style="background: #367FA9; border: 0px;">

                                        </div>
                                    </div>
                                </div>

                                <div>
                                </div>
                            </form>
                            <form style="display: none;" id="eng" method="get" action="{{ route('Agencycontact') }}">


                                <div class="col-xs-12 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                                     style="positon:relative;margin-bottom:0px !important; padding-left:0px">
                                    <div class="" style="margin: 0 auto;">

                <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-user"></i>
                 </span>
                                        <input value="{{ Request::old('name') }}" name="name"
                                               type="text" class="form-control em1" id="name" placeholder="Name"
                                               style="height:50px; padding: 6px 45px;">
                                        @if($errors->has('name'))
                                            <p class="help-block">{{ ($errors->has('name')) ? 'This name field is required' : '' }}</p>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-xs-6 col-centered input form-group<?php echo $errors->has('email') ? ' has-error' : '' ?> input-new"
                                     style="positon:relative;margin-bottom:0px !important">
                                    {{--<div class="" style="margin: 0 auto;">
                 <span style="position:relative; top:35px; left:10px;">
                  <i class="fa fa-envelope"></i>
                 </span>
                                        <input name="email" value="{{ Request::old('email') }}" type="text" class="form-control em2" id="email"
                                               placeholder="Email address"
                                               style="height:50px; padding: 6px 45px;margin-bottom:0px !important">
                                        @if($errors->has('email'))
                                            <p class="help-block">Please enter a valid e -mail address</p>
                                        @endif
                                    </div>--}}
                                    @if(!empty($email))
                                        <input type="hidden" name="email" value="{{ $email }}">
                                    @endif
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
                                <div class="col-xs-12">
                                    <div class="input form-group<?php echo $errors->has('betreff') ? ' has-error' : '' ?> input-new"
                                         style="positon:relative">
                                        <div class="" style="margin: 0 auto; text-align: left;">
                                            <input type="hidden" name="sel_lang" class="sel_lang" value="eng">
                                            <input type="submit" name="submit" value="Send message"
                                                   class="btn btn-primary"
                                                   style="background: #367FA9; border: 0px;">

                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </form>
                        </div>{{--end of row row-centered--}}
                    </div>
                </div>
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
    </div>
@endsection

</body>
</html>
