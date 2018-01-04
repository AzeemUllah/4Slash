@extends('pages.agency.agency_template')

@section('header_title')

    <h1>Edit Profile</h1>

@endsection

<style>
    .help-block {
        color: #ff0002 !important;
    }
</style>


@section('content')
    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="col-xs-9">
            <form action="{{ route('PutProfile.Update') }}" method="post" class="form-vertical">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Personal Information</h3>
                    </div>
                    <div class="box-body agency_update">
                        <div class="col-xs-6">
                            <div class="username form-group">
                                <label for="company">Firma</label>
                                <input name="company" type="text" class="form-control em"
                                       value="{{  $agencyDetails->agency_name  }}" placeholder="Company"
                                       style="height:50px;">
                            </div>
                            <div class="form-group">
                                <p style="margin-bottom: 0px;">Anrede:</p>
                                <label for="male">Herr</label>
                                <input type="radio" name="gender"
                                       value="Male" @if($agencyDetails->gender=='Male'){{"checked=checked"}} @endif>

                                <label for="female">Frau</label>

                                <input type="radio" name="gender"
                                       value="Female" @if($agencyDetails->gender=='Female'){{"checked=checked"}} @endif>

                            </div>
                            <div class="username form-group">
                                <label for="name">Name*</label>
                                <input name="name" type="text" class="form-control em"
                                       value="{{  $agency->username }}" placeholder="Name"
                                       style="height:50px;">
                                <?php echo $errors->first('name', '<span class="help-block">:message</span>'); ?>
                            </div>
                            <div class="form-group">

                                <input type="hidden" class="form-control em"
                                       value="{{ $agencyDetails->id}}" placeholder="Nachname"
                                       style="height:50px;" name="id">
                            </div>
                            <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                                <label for="email_adress">E-mail*</label>

                                <input name="email" type="email" class="form-control em"
                                       value="{{  $agency->email }}" placeholder="E-mail"
                                       style="height:50px;">
                                <?php echo $errors->first('email', '<span class="errors">:message</span>'); ?>
                                <input name="user_id" type="hidden" class="form-control em"
                                       value="{{  $agency->id }}" placeholder="E-mail"
                                       style="height:50px;">

                            </div>
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" name="fname" id="fname" class="form-control"
                                       value="{{$agencyDetails->f_name}}">
                                @if($errors->has('fname'))
                                    <p class="help-block">{{ $errors->first('fname') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Lase Name:</label>
                                <input type="text" name="lname" id="lname" class="form-control"
                                       value="{{$agencyDetails->l_name}}">
                                @if($errors->has('lname'))
                                    <p class="help-block">{{ $errors->first('lname') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Street Nr:</label>
                                <input type="text" name="street" id="street" class="form-control"
                                       value="{{$agencyDetails->street_no}}">
                                @if($errors->has('street'))
                                    <p class="help-block">{{ $errors->first('street') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="post_add">Adresse/Hausnummer*</label>
                                <input name="post_add" value="{{ $agencyDetails->postal_code }}"
                                       type="text" class="form-control em" id="user"
                                       placeholder="Address" style="height:50px;">
                                <?php echo $errors->first('post_add', '<span class="help-block">:message</span>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" id="city" class="form-control"
                                       value="{{ $agencyDetails->city}}">
                                @if($errors->has('city'))
                                    <p class="help-block">{{ $errors->first('city') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <select name="country" id="country" class="form-control"
                                        style="width: 195px;">
                                    @foreach($countries as $country)
                                        <option {{ (($agencyDetails) ? (($country->country_name == $agencyDetails->country) ? 'selected' : '') : '') }} value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group">
                                 <label for="mobile">PLZ, Ort*</label>

                                 <input name="zip" type="text" class="form-control em form-inline"  value="{{ $agencyDetails->zip }}" style="height:50px;">

                              </div>--}}

                            <div class="form-group">
                                <label for="">Employees</label>
                                <input type="number" name="emp" class="form-control"
                                       value="{{ $agencyDetails->employees }}">
                            </div>

                            <div class="form-group">

                                <label for="email_adress">Telefonnummer*</label>

                                <input name="phone" type="text" class="form-control em"
                                       value="{{ $agencyDetails->telephone }}" placeholder="Phone"
                                       style="height:50px;">
                                <?php echo $errors->first('phone', '<span class="help-block">:message</span>'); ?>
                            </div>
                            <div class="form-group">

                                <label for="mobile">Mobile</label>

                                <input name="mobile" type="text" value="{{ $agencyDetails->mobile  }}"
                                       class="form-control em" placeholder="Mobile"
                                       style="height:50px;">
                                @if($errors->has('mobile'))
                                    <p class="help-block">{{ $errors->first('mobile') }}</p>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-lg-8">
                                    <span>*Eingabe erforderlich</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Skills</h3>
                    </div>
                    <div class="box-body">


                        <?php $count = 1; ?>

                        @foreach($gigtypes as $gigtype)
                            <div class="col-md-4">
                                <h3 class="box-title"
                                    style="padding-left:2px;background: #eee; margin: 0px 5px; padding: 10px; border-radius: 3px 3px 0 0;">{{ $gigtype->name }}</h3>
                                {{--<input value="{{ $gigtype->name }}" name="types[]" id="checkbox{{ $count }}" class="styled type_check" type="checkbox"--}}
                                {{--@foreach($Agency_skills as $skill)--}}
                                {{--{{($skill==$gigtype->name) ? "checked": '' }}--}}
                                {{--@endforeach >--}}
                                {{--<label for="checkbox{{ $count }}" class="cat-btn btn btn-primary">--}}
                                {{--<p class="chck-bx-p">{{ $gigtype->name }}</p>--}}
                                {{--</label>--}}

                                <div class="form-group text-left form-inline sub_cat" id="link1">
                                    <?php $subCatCount = 1;?>
                                    @foreach($gigtype['Subcategory'] as $subcat)
                                        <ul class="list"
                                            style="margin:0 5px; padding: 0; list-style:  none; background-color: rgba(238, 238, 238, 0.46) !important;">
                                            <li style="margin:0; padding: 5px 10px; border-bottom: 1px solid #eee;">
                                                <input value="{{ $subcat->name }}" name="subcat[]"
                                                       id="checkbox{{ $count . $subCatCount }}"
                                                       class="styled checkbox_subcat"
                                                       type="checkbox" @foreach($Agency_skills as $skill)
                                                    {{($skill==$subcat->name) ? "checked": '' }}
                                                        @endforeach >
                                                <label for="checkbox{{ $count . $subCatCount }}">
                                                    <p class="chck-bx-p">{{ $subcat->name }}</p>
                                                </label>
                                            </li>
                                        </ul>

                                        <?php $subCatCount++ ?>
                                    @endforeach
                                </div>
                            </div>
                            <?php $count++; ?>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <div class="col-lg-8">
                            <input type="submit" class="btn btn-primary" value="Update"
                                   style="margin-bottom: 25px;">
                        </div><!-- /.col-lg-8 -->
                    </div>
                </div>

            </form>
        </div>


        @endsection
        @section('pages_script')
            <script>

                $('.cat-btn').on('click', function () {

//        if ($(this).is(':checked')) {
                    $(this).parent().next("#link1").toggle();

                    /*}
                     else{
                     $(this).parent().next("#link1").hide();
                     }*/
                });
                $("#fileAttachment2").change(function () {
                    var fileName = $(this).val().replace('C:\\fakepath\\', '');
                    $("#fileAttachmentName2").html(fileName);
                });
            </script>
@endsection