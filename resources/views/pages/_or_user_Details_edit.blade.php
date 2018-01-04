@include('includes.header')

        <!-- content -->

<div class="main-profile" style="background-color:#f1f2f2;padding-top:80px; min-height: 1500px;">
    <div class="content">
        <div>
            <div class="header profile-header" style="background-image: url({{ $user->cover_image }}); text-align: right;">

                {{--<h1 class="heading2">My Profile’s Tagline Here.</h1>--}}
                <form id="profile-cover-img-form" enctype="multipart/form-data">
                    <input name="profile-cover-img" type="file" class="profile-upload-button" id="profile-cover-upload">
                    <label for="profile-cover-upload" class="btn btn-primary btn-xs btn-profile-cover-upload" style="margin-right: 5px; position: relative; top: 15px;">Change background</label>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12" style=" margin-bottom:52px;">
                <div class="main-content" id="profile-edit">

                    <div class="profile-img-profile">

                        <form class="form-horizontal" enctype="multipart/form-data">
                            <span>
                                <input name="profile-img" type="file" class="profile-upload-button" id="profile-img-upload-icon">
                                <label for="profile-img-upload-icon" class="profile-img-upload-icon"><i class="fa fa-camera"></i></label>
                                <img style="width:100px;height:100px;" src="{{ $user->profile_image }}" class="img-circle profile-img-circle">
                            </span>
                        </form>
                    </div>

                    <div class="profile-detail">

                        {{--<p>--}}
                        {{--Lorem ipsum dolor sit amet, dictum vehicula sed ante, enim sed ipsum lacus ante, neque imperdiet suspendisse penatibus elit, varius cras ut sapien saepe aliquet. Vel taciti nibh, orci porttitor ipsum mattis leo, in at urna augue. Nulla nulla accumsan placerat--}}
                        {{--</p>--}}
                    </div>
                    <div class="profile">
                        <h1>Edit Profile</h1>
                    </div>
                    <div class="profile user-detail">
                        <form action="{{ route('profile.PutUpdate') }}" method="post" class="form-vertical">
                            <fieldset>

                            <div class="username form-group">
                                <label for="company">company</label>
                                <input name="company" type="text" class="form-control em"
                                                    value="{{ !empty($userDetail) ? $userDetail->company : ''  }}" placeholder="Firma"
                                                   style="height:50px;">
                            </div>
                            <div class="form-group">
                                                <label style="margin-bottom: 0px;">Gender:</label>
                                <br>
                                <span for="male" style="font-size: 17px;">Male</span>
                                <input type="radio" name="gender" value="Herr" @if(!empty($userDetail))@if($userDetail->gender=='Herr'){{"checked=checked"}} @endif @endif>

                                <span for="female" style="font-size: 17px;">Female</span>

                                <input type="radio" name="gender" value="Frau" @if(!empty($userDetail))@if($userDetail->gender=='Frau'){{"checked=checked"}} @endif @endif>

                             </div>
                            <div class="username form-group">
                                <label for="name">Name*</label>
                                <input name="name" type="text" class="form-control em"
                                                   value="{{  $user->name }}" placeholder="Name"
                                                   style="height:50px;">
                                <?php echo $errors->first('name', '<span class="errors">:message</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="surname">Surname*</label>
                                <input name="surname" type="text" class="form-control em"
                                                  value="{{!empty($userDetail) ? $userDetail->surname : ''  }}" placeholder="
Surname"
                                                   style="height:50px;">
                                <?php echo $errors->first('surname', '<span class="errors">:message</span>'); ?>
                                <input type="hidden" class="form-control em"
                                                   value="{{ !empty($userDetail) ? $userDetail->id : ''}}" placeholder="Surname"
                                                   style="height:50px;" name="id">
                            </div>
                            <div class="form-group">

                                <input name="user_id" type="hidden" class="form-control em"
                                                   value="{{  $user->id }}" placeholder="E-mail"
                                                   style="height:50px;">

                            </div>
                            <div class="form-group">
                                <label for="post_add">Address / house number*</label>
                                <input name="post_add" value="{{ !empty($userDetail) ? $userDetail->postal_address : '' }}" type="text" class="form-control em" id="user" placeholder="Address" style="height:50px;">
                                <?php echo $errors->first('post_add', '<span class="errors">:message</span>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="mobile">ZIP / City*</label>

                                <input name="zip" type="text" class="form-control em form-inline"  value="{{ !empty($userDetail) ? $userDetail->zip : '' }}" style="height:50px;">

                            </div>
                                <div class="form-group">

                                    <label for="country">Country</label>
                                    <input name="country" value="{{ !empty($userDetail) ? $userDetail->country : ''}}" type="text" class="form-control em"  placeholder="Land" style="height:50px;">

                                </div>
                            <div class="form-group">

                                <label for="email_adress">phone number
                                    *</label>

                                <input name="phone" type="text" class="form-control em"
                                                   value="{{ !empty($userDetail) ? $userDetail->phone : '' }}" placeholder="Phone"
                                                   style="height:50px;">
                                <?php echo $errors->first('phone', '<span class="errors">:message</span>'); ?>
                            </div>
                            <div class="form-group">

                                            <label for="mobile">Mobile</label>

                                            <input name="mobile" type="text" value="{{ !empty($userDetail) ? $userDetail->mobile : ''  }}" class="form-control em"placeholder="Mobile" style="height:50px;">

                            </div>
                           {{-- <div class="pass form-group form-inline">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="pass">Passwort</label>
                                        </td>
                                        <td>
                                            <input  type="password" class="form-control em" name="Pass" placeholder="Passwort" style="height:50px;">
                                           --}}{{-- @if($errors->has('password'))
                                                <p class="help-block">{{ $errors->first('password') }}</p>
                                            @endif--}}{{--
                                        </td>

                                    </tr>
                                </table>
                            </div>--}}
                              {{--  <div class="pass form-group form-inline">
                                    <table>
                                        <tr>
                                            <td>
                                                <label for="password_confirmation">Confirm Passwort</label>
                                            </td>
                                            <td>
                                                <input name="password_confirmation" type="password" class="form-control em"  placeholder="Confirm Passwort" style="height:50px;">
                                            </td>
                                        </tr>
                                    </table>
                                </div>--}}
                            <div class="row">
                                <div class="col-lg-8">
                                        <input type="submit" class="btn btn-primary" value="Update" style="margin-bottom: 25px;">
                                </div><!-- /.col-lg-8 -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>*Input required</span>
                                </div>
                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include("includes.footer")



<script>
    (function() {

        var input = document.querySelector('#profile-img-upload-icon');
        var coverPhoto = document.querySelector('#profile-cover-upload');

        input.addEventListener('change', change_profile_image);
        coverPhoto.addEventListener('change', change_profile_cover_image);

    })();

</script>
</body>
</html>