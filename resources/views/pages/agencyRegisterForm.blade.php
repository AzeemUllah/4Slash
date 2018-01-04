
@include('includes.header')
<div class="dash-main-content">
<div class="container login-modal">
    <div class="row row-centered">
        <h4 class="login-title" style="text-align: center">Partner-Registrierung / Partner registration</h4>
            <h4 id="ger-para" style="text-align: center; font-size:16px; color:rgb(111, 111, 111); display: none;">Please fill in
                Completion of your
                Please complete this form completely.</h4>
        <h4 id="en-para" style="text-align: center; font-size:16px; color:rgb(111, 111, 111); display: none;">Please fill to complete
            your
            Registration form completely..</h4>

        <div class="form-group form-inline text-center">
            <label for="">Select language</label>
            <select name="" id="language" class="form-control">
                <option value="" selected disabled>Select language</option>
                <option value="eng" {{ (Request::old('sel_lang') == 'eng') ? 'Selected':'' }}>English</option>
                <option value="ger" {{ (Request::old('sel_lang') == 'ger') ? 'Selected':'' }}>German</option>
            </select>
        </div>
    </div>
    @if($errors->has('others'))
        <div class="alert alert-danger" role="alert">{{ $errors->first('others') }}</div>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('errorMessage'))
        <div class="alert alert-danger" role="alert">{{ \Illuminate\Support\Facades\Session::get('errorMessage') }}</div>
    @endif
    <div class="agency_register">
        <form id="eng" style="display: none;" action="{{ route('agency.registerFormSuccess') }}" method="post" role="form" enctype="multipart/form-data">
            <!-- Username -->
            <div class="form-group form-inline">
                <span class="col-xs-4"> <label for="username">Agency Name</label></span>
                <input type="text" id="username" name="username" placeholder="" class="form-control" required
                       value="{{Request::old('username')}}">
                <span class="required">*</span>
                @if($errors->has('username'))
                    <p class="help-block">{{ $errors->first('username') }}</p>
                @endif
            </div>
            <!-- E-mail -->
            <div class="form-group form-inline">
        <span class="col-xs-4">
            <label for="email">E-mail</label>
        </span>
                <input type="text" id="email" name="email" placeholder="" class="form-control"
                       value="{{Request::old('email')}}" required>
                <span class="required">*</span>
                @if($errors->has('email'))
                    <p class="help-block">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <!-- Password-->
            <div class="form-group form-inline">
            <span class="col-xs-4">
                <label for="password">Password</label>
            </span>
                <input type="password" id="password" name="password" placeholder="" class="form-control" required>
                <span class="required">*</span>
                @if($errors->has('password'))
                    <p class="help-block">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <!-- Password -->
            <div class="form-group form-inline">
            <span class="col-xs-4">
                <label for="password_confirmation">Password (Confirm)</label>
            </span>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder=""
                       class="form-control">
                <span class="required">*</span>
                {{--<p class="help-block">Please confirm password</p>--}}
            </div>
            <hr>
            <h2 class="">Contact Details</h2>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Select language:</label>
                <select name="ch-lang" id="" class="form-control" style="width: 202px;">
                    <option value="german">German</option>
                    <option value="english">English</option>
                </select>
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Male|Female</label>
                <select name="gender" id="" class="form-control" style="width: 202px;">
                    <option value="" disabled selected>Male/Female</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">First Name:</label>
                <input type="text" name="fname" id="fname" class="form-control" value="{{Request::old('fname')}}"><span class="required">*</span>
                @if($errors->has('fname'))
                    <p class="help-block">{{ $errors->first('fname') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Last Name:</label>
                <input type="text" name="lname" id="lname" class="form-control" value="{{Request::old('lname')}}"><span class="required">*</span>
                @if($errors->has('lname'))
                    <p class="help-block">{{ $errors->first('lname') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Street Nr:</label>
                <input type="text" name="street" id="street" class="form-control" value="{{Request::old('street')}}"><span class="required">*</span>
                @if($errors->has('street'))
                    <p class="help-block">{{ $errors->first('street') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Postal Code:</label>
                <input type="text" name="post" id="post" class="form-control" value="{{Request::old('post')}}">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{Request::old('city')}}"><span class="required">*</span>
                @if($errors->has('city'))
                    <p class="help-block">{{ $errors->first('city') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Country</label>
                <select name="country" id="country" class="form-control" style="width: 202px;">
                    @foreach($countries as $country)
                        <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Tel:</label>
                <input type="text" name="tel" id="tel" class="form-control" value="{{Request::old('tel')}}"><span class="required">*</span>
                @if($errors->has('tel'))
                    <p class="help-block">{{ $errors->first('tel') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Mobile:</label>
                <input type="text" name="cell" id="cell" class="form-control" value="{{Request::old('cell')}}">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Company Registration Number(Optional):</label>
                <input type="text" name="cnumber" id="cnumber" class="form-control">
            </div>
            <hr>
            <h2 class="">your team strength</h2>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Employees</label>
                <input type="number" name="emp" min="0" class="form-control" value="{{Request::old('emp')}}">
            </div>
            <hr>
            <h2 class="text-left">Skills</h2>
            <h4 class="text-left">Tell us your top skills and main areas of expertise</h4>
            <?php $count = 1; $i = 0; $j = 0; ?>
            <?php $checked = 'checked'; ?>

            @foreach($gigtypes as $gigtype)
                <div class="checkbox checkbox-info checkbox-circle chck-bx3">
                    <input value="{{ $gigtype->name }}" name="types[{{$i}}]" id="checkbox{{ $count }}" class="styled type_check" type="checkbox" @if(isset(Request::old('types')[$i]) && Request::old('types')[$i] == $gigtype->name){{ $checked }} @endif}}>

                    <label for="checkbox{{ $count }}">
                        <p class="chck-bx-p">{{ $gigtype->name }}</p>
                    </label>
                </div>
                <?php $subCatCount = 1;?>
                <div class="form-group text-left form-inline sub_cat" id="link1" style="<?php if(isset(Request::old('subcat')[$i])){ echo 'display:block'; } else { echo 'display: none'; } ?>">
                    @foreach($gigtype['Subcategory'] as $subcat)
                        <div class="checkbox checkbox-info checkbox-circle chck-bx3">
                            <input value="{{ $subcat->name }}" name="subcat[{{$j}}]" id="checkbox{{ $count . $subCatCount }}" class="styled checkbox_subcat" type="checkbox" @if(isset(Request::old('subcat')[$j]) && Request::old('subcat')[$j] == $subcat->name ){{ $checked }} @endif}}>
                            <label for="checkbox{{ $count . $subCatCount }}">
                                <p class="chck-bx-p">{{ $subcat->name }}</p>
                            </label>
                        </div>
                        <?php $subCatCount++; $j++; ?>
                    @endforeach
                </div>
                <?php $count++; $i++; ?>
            @endforeach
            <h3 class="text-left">List other skills you may have (Optional)</h3>
            <textarea name="others" cols="60" rows="5" class="form-control"></textarea>
            {{--<div class="form-group form-inline marg-topp">
                    <span class="col-xs-6"><b>Submit documents that demonstrate you have these skills (eg. CV,
                            certifications, completed courses)</b></span>
                    <span class="col-xs-6 text-right">
                        <input type="file" name="attachment" id="file">
                    </span>
            </div>--}}
            <div class="col-md-12 pull-left" style="margin-bottom: 10px; padding-left: 0;">
            <span class="col-xs-6"><b>Submit documents that demonstrate you have these skills (eg. CV,
                    certifications, completed courses)</b></span>
                <button type="button" class="btn btn-default"><i class="fa fa-paperclip"></i> Attach Files </button>
                <span id="fileAttachmentName2"></span><span class="please_wait_agency" style="margin-left: 10px; display: none;"><img src="data:image/gif;base64,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"/></span>
                <input type="file" id="fileAttachment2" name="file-attachment" style="margin-bottom: 5px; width:121px;    margin-left: 341px; opacity: 0; position:absolute;margin-top: -47px;padding:12px; cursor: pointer;">
                @if($errors->has('file'))
                    <p class="help-block" style="color: red;">{{ $errors->first('file') }}</p>
                @endif
            </div>
            <div class="clearfix"></div>
            <h2 class="text-left">SOCIAL MEDIA/Portfolio</h2>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Facebook:</label>
                <input type="url" name="fbmedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">LinkedIn:</label>
                <input type="url" name="limedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Google Plus:</label>
                <input type="url" name="gmedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Twitter:</label>
                <input type="url" name="timedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Other Link</label>
                <textarea name="" cols="60" rows="5" class="form-control"></textarea>
            </div>

            <hr>
            <h2 class="text-left">Legal Policies and prices</h2>
            <div class="form-group form-inline pull-left marg-right">
                <input type="checkbox" class="privacy" id="pr1">
                <a href="https://4slash.com/AGB" target="_blank" style="position: relative; top: 4px;">Private Policy</a>
            </div>
            {{--<div class="form-group form-inline pull-left">
                <input type="checkbox" class="privacy" id="pr2">
                <span style="position: relative; top: 4px;">I agree with Cnerr prices</span>
            </div>--}}
            <input type="hidden" name="language" value="english">
            <div class="form-group">
                <!-- Button -->
                <div class="col-xs-12 text-center" style="margin-top: 20px">
                    <input type="submit" name="submit" class="btn btn-primary" value="Register" id="sub-form" disabled style="background: #367fa9;">
                    <input type="hidden" name="sel_lang" class="sel_lang" value="eng">
                </div>
            </div>
        </form>

        <form id="ger" style="display: none;" action="{{ route('agency.registerFormSuccess') }}" method="post" role="form" enctype="multipart/form-data">
            <!-- Username -->
            <div class="form-group form-inline">
                <span class="col-sm-4"> <label for="username">Agenturname</label></span>
                <input type="text" id="username" name="username" placeholder="" class="form-control" required value="{{Request::old('username')}}">
                <span class="required">*</span>
                @if($errors->has('username'))
                    <p class="help-block">{{ $errors->first('username') }}</p>
                @endif
            </div>
            <!-- E-mail -->
            <div class="form-group form-inline">
                <span class="col-sm-4"><label for="email">E-mail</label></span>
                <input type="text" id="email" name="email" placeholder="" class="form-control" value="{{Request::old('email')}}" required>
                <span class="required">*</span>
                @if($errors->has('email'))
                    <p class="help-block">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <!-- Password-->
            <div class="form-group form-inline">
                <label  class="col-xs-4" for="password">Passwort</label>
                <input type="password" id="password" name="password" placeholder="" class="form-control" required>
                <span class="required">*</span>
                @if($errors->has('password'))
                    <p class="help-block" style="text-transform: capitalize;">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <!-- Password -->
            <div class="form-group form-inline">
                <label class="col-xs-4" for="password_confirmation">Passwortbestätigung</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="" class="form-control">
                <span class="required">*</span>
                {{--<p class="help-block">Please confirm password</p>--}}
            </div>
            <hr>
            <h2 class="">Kontaktdetails</h2>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Sprache auswählen:</label>
                <select name="ch-lang" id="" class="form-control" style="width: 202px;">
                    <option value="german">German</option>
                    <option value="english">English</option>
                </select>
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Männlich | Weiblich</label>
                <select name="gender" id="" class="form-control" style="width: 202px;">
                    <option value="" disabled selected>Männlich/Weiblich</option>
                    <option value="Male">Männlich</option>
                    <option value="Female">Weiblich</option>
                </select>
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Vorname:</label>
                <input type="text" name="fname" id="fname" class="form-control" value="{{Request::old('fname')}}"><span class="required">*</span>
                @if($errors->has('fname'))
                    <p class="help-block">{{ $errors->first('fname') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Nachname:</label>
                <input type="text" name="lname" id="lname" class="form-control" value="{{Request::old('lname')}}"><span class="required">*</span>
                @if($errors->has('lname'))
                    <p class="help-block">{{ $errors->first('lname') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Straße #:</label>
                <input type="text" name="street" id="street" class="form-control" value="{{Request::old('street')}}"><span class="required">*</span>
                @if($errors->has('street'))
                    <p class="help-block">{{ $errors->first('street') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Postleitzahl:</label>
                <input type="text" name="post" id="post" class="form-control" value="{{Request::old('post')}}">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Stadt</label>
                <input type="text" name="city" id="city" class="form-control" value="{{Request::old('city')}}"><span class="required">*</span>
                @if($errors->has('city'))
                    <p class="help-block">{{ $errors->first('city') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Land</label>
                <select name="country" id="country" class="form-control" style="width: 202px;">
                    @foreach($countries as $country)
                        <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Telefon:</label>
                <input type="text" name="tel" id="tel" class="form-control" value="{{Request::old('tel')}}"><span class="required">*</span>
                @if($errors->has('tel'))
                    <p class="help-block">{{ $errors->first('tel') }}</p>
                @endif
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Mobile:</label>
                <input type="text" name="cell" id="cell" class="form-control" value="{{Request::old('cell')}}">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">USt-IdNr:</label>
                <input type="text" name="cnumber" id="cnumber" class="form-control">
            </div>
            <hr>
            <h2 class="">Ihre Teamstärke</h2>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Mitarbeiter</label>
                <input type="number" name="emp" min="0" class="form-control" value="{{Request::old('emp')}}">
            </div>
            <hr>
            <h2 class="text-left">Fähigkeiten</h2>
            <h4 class="text-left">Sagen Sie uns Ihre Top- Fähigkeiten und Kernkompetenzen</h4>
            <?php $count = 1; $i = 0; ?>

            @foreach($gigtypes as $gigtype)
                <div class="checkbox checkbox-info checkbox-circle chck-bx3">

                    <input value="{{ $gigtype->name }}" name="types[]" id="checkbox{{ $count }}" @if(isset($_POST['types'][$i])){{ 'checked' }} @endif class="styled type_check" type="checkbox">
                    <label for="checkbox{{ $count }}">
                        <p class="chck-bx-p">{{ $gigtype->name }}</p>
                    </label>
                </div>
                <div class="form-group text-left form-inline sub_cat" id="link1" style="display: none">
                    <?php $subCatCount = 1;?>
                    @foreach($gigtype['Subcategory'] as $subcat)
                        <div class="checkbox checkbox-info checkbox-circle chck-bx3">
                            <input value="{{ $subcat->name }}" name="subcat[]" id="checkbox{{ $count . $subCatCount }}"  class="styled checkbox_subcat" type="checkbox">
                            <label for="checkbox{{ $count . $subCatCount }}">
                                <p class="chck-bx-p">{{ $subcat->name }}</p>
                            </label>
                        </div>
                        <?php $subCatCount++ ?>
                    @endforeach
                </div>
                <?php $count++; $i++; ?>
            @endforeach
                <h3 class="text-left">List other skills you may have (optional)</h3>
            <textarea name="others" cols="60" rows="5" class="form-control"></textarea>
            {{--<div class="form-group form-inline marg-topp">
                    <span class="col-xs-6"><b>Submit documents that demonstrate you have these skills (eg. CV,
                            certifications, completed courses)</b></span>
                    <span class="col-xs-6 text-right">
                        <input type="file" name="attachment" id="file">
                    </span>
            </div>--}}
            <div class="col-md-12 pull-left" style="margin-bottom: 10px; padding-left: 0;">
        <span class="col-xs-6"><b>Sending documents that show you have these skills( z. B. CV ,
                    Certifications, completed courses )</b></span>
                <button type="button" class="btn btn-default"><i class="fa fa-paperclip"></i>Attach files </button>
                <span id="fileAttachmentName2"></span><span class="please_wait_agency" style="margin-left: 10px; display: none;"><img src="data:image/gif;base64,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"/></span>
                <input type="file" id="fileAttachment2" name="file-attachment" style="margin-bottom: 5px; width:121px;    margin-left: 341px; opacity: 0; position:absolute;margin-top: -47px;padding:12px; cursor: pointer;">
                @if($errors->has('file'))
                    <p class="help-block" style="color: red;">{{ $errors->first('file') }}</p>
                @endif
            </div>
            <div class="clearfix"></div>
            <h2 class="text-left">Social media / portfolio</h2>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Facebook:</label>
                <input type="url" name="fbmedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">LinkedIn:</label>
                <input type="url" name="limedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Google Plus:</label>
                <input type="url" name="gmedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Twitter:</label>
                <input type="url" name="timedia" class="form-control">
            </div>
            <div class="form-group form-inline">
                <label class="col-xs-4" for="">Andere Links</label>
                <textarea name="" cols="60" rows="5" class="form-control"></textarea>
            </div>

            <hr>
                <h2 class="text-left">Legal guidelines and prices</h2>
            <div class="form-group form-inline pull-left marg-right">
                <input type="checkbox" class="privacy" id="pr3">
                <a href="https://4slash.com/AGB" target="_blank" style="position: relative; top: 4px;">AGB</a>
            </div>
            {{--<div class="form-group form-inline pull-left">
                <input type="checkbox" class="privacy" id="pr4">
                <span style="position: relative; top: 4px;">Ich stimme mit Cnerr Preise</span>
            </div>--}}
            <input type="hidden" name="language" value="germany">
            <div class="form-group">
                <!-- Button -->
                <div class="col-xs-12 text-center" style="margin-top: 20px">
                    <input type="submit" name="submit" class="btn btn-primary" value="registrieren" id="sub-form2" disabled style="background: #367fa9;">
                    <input type="hidden" name="sel_lang" class="sel_lang" value="ger">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container" style="padding-bottom: 260px;">
    <div class="row">
        <div class="col-sm-6 col-xs-12 text-justify" style="padding: 0px 40px;">
            <p><u>General</u><span style="margin-left: 20px;"><img src="img/ger_flag.png" alt="" width="100px;" style="height:54px;"></span></p>
            <p>
                Cnerr.de provides partners in the field of design, graphics, programming, development, freelancing, and more.
                A digital marketplace for creative work. Designers, graphic artists, programmers,
                Developers, freelancers, and more. Sell ​​under 4slash.com small services around the digital,
                Creative market.<a href="https://4slash.com"><b>Cnerr.de</b></a> Works exclusively with selected partners
            </p>
            <p>
                <u>Partnerinformationen</u>
            </p>
            <p>

                As a partner you have the possibility to create your own services around the creative market (design,
                Graphics, programming, animation, 3D, and much more) on the marketplace. Apply now
                Simply use the form and your references and be part of the <b> Cnerr Network </b>.
            </p>
            <p>
                If you are successful, you will receive further detailed information about the business partner model.
            </p>
        </div>
        <div class="col-sm-6 col-xs-12 text-justify" style="padding: 0px 40px;">
            <p><u>General information</u><span style="margin-left: 20px;"><img src="img/eng_flag.png" alt=""
                                                                               width="100px;"></span></p>
            <p>

                The company sells under the market place <a href="http://4slash.com"
                                                                                                 style="color:black;"><b
                            style="color:black;">4slash.com</b></a> small and large services around the digital,
                creative market. <a href="http://4slash.com" style="color:black;"><b style="color:black;">4slash.com</b></a>
                works exclusively with selected and tested partners. Partners of the large
                <a href="http://4slash.com" style="color:black;"><b style="color:black;">4slash.com</b></a> network enjoy
                the advantages in an interesting market under the brand <b style="color:black;">CNERR</b>.
            </p>
            <p style="margin-top:29px;">
                <u>Partner information</u>
            </p>
            <p>
                As a Partner you have the possibility to offer your own services
                around the creative market
                (design, graphics, programming, animation, 3D, etc.). Simply apply with the form and your references and
                be part of the <b style="color:black;">Cnerr network</b>.
            </p>
            <p>
                Upon successful registration, you will receive further detailed information about the business partner model.
            </p>
        </div>
    </div>
</div>
</div>
@include('includes.footer')
<script type="text/javascript">
    $(document).ready(function () {
        $('.privacy').click(function () {
           if($('#pr1').is(':checked')){
                $('#sub-form').removeAttr('disabled');
            }else{
               $('#sub-form').attr('disabled');
           }
        });
        $('.privacy').click(function () {
            if($('#pr3').is(':checked')){
                $('#sub-form2').removeAttr('disabled');
            }else{
                $('#sub-form2').attr('disabled');
            }
        });
    });
</script>
<script>

    $('.type_check').on('click', function () {

        if ($(this).is(':checked')) {
            $(this).parent().next("#link1").show();

        }
        else{
            $(this).parent().next("#link1").hide();
        }
    });
    $("#fileAttachment2").change(function () {
        var fileName = $(this).val().replace('C:\\fakepath\\', '');
        $("#fileAttachmentName2").html(fileName);
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".cnerr-footer-background-color").css({"position": "absolute", "left": "0px","right":"0px","bottom":"0px"});
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
            $(".cnerr-footer-background-color").css({"position":"inherit"});
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "eng") {
                    $("#eng").show();
                    $("#ger").hide();
                    $("#en-para").show();
                    $("#ger-para").hide();
                    $('.agency_register').css({
                        'box-shadow' : 'gray 0px 0px 5px',
                        'padding' : '20px',
                        'display' :'inline-block'
                    });
                }
                else {
                    $('.agency_register').show();
                    $("#eng").hide();
                    $("#ger").show();
                    $("#en-para").hide();
                    $("#ger-para").show();
                    $('.agency_register').css({
                        'box-shadow' : 'gray 0px 0px 5px',
                        'padding' : '20px',
                        'display' :'inline-block'
                    });
                }
            });
        });
    });
</script>
