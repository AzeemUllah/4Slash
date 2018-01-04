

@include('includes.header')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        {{--<div class="mr-auto">--}}
            {{--<h3 class="m-subheader__title " style="padding-left: 25px;">--}}
                {{--Edit Profile--}}
            {{--</h3>--}}
        {{--</div>--}}

    </div>
</div>
<!-- END: Subheader -->
<div class="m-content">
    <form  action="{{ route('profile.PutUpdate') }}" method="post" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">


        <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <h3 class="edit1"> Edit Profile</h3>

                            <div class="m-card-profile__pic">

                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{ $user->profile_image }}" alt=""/>
                                </div>

                                <label type="button" id="files-upload"  class="btn btn-primary" style="display: inline-block;margin-top: 165px;margin-left: -136px;">
                                    <input id="files-upload" type="file" multiple style="display: none" name="profile-img">
                                    Choose File
                                </label>



                            </div>

                            <div class="m-card-profile__details">
												<span class="m-card-profile__name">
													{{  $user->username }}
												</span>
                                <a href="#" class="m-card-profile__email m-link">

                                </a>
                            </div>
                        </div>


                        <div class="m-portlet__body-separator"></div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="m-portlet__head">

                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="m_user_profile_tab_1">

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 m--hide">
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section" style="display: inline-block;">
                                            1. Personal Details
                                        </h3>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        company
                                    </label>
                                    <div class="col-7">
                                        <input name="company" class="form-control m-input" type="text" value="{{ !empty($userDetail) ? $userDetail->company : ''  }}"placeholder="company">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-2 col-form-label" style="margin-bottom: 0px;">Gender:</label>

                                    <label class="m-radio col-form-label" style=" margin-left: 35px;padding-top: 0px;padding-right: 10px;">
                                        <input type="radio" name="gender" checked value="Male" @if(!empty($userDetail))@if($userDetail->gender=='Herr'){{"checked=checked"}} @endif @endif  />
                                        Male
                                        <span></span>
                                    </label>
                                    <label class="m-radio col-form-label" style="padding-top: 0px;">
                                        <input type="radio" name="gender" checked value="Female" @if(!empty($userDetail))@if($userDetail->gender=='Frau'){{"checked=checked"}} @endif @endif  />
                                        Female
                                        <span></span>
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Name
                                    </label>
                                    <div class="col-7">
                                        <input name="name" class="form-control m-input" type="text" value="{{  $user->name }}">
                                        <?php echo $errors->first('name', '<span class="errors">:message</span>'); ?>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Surname*
                                    </label>
                                    <div class="col-7">
                                        <input name="surname" class="form-control m-input" type="text" value="{{!empty($userDetail) ? $userDetail->surname : ''  }}">
                                        <?php echo $errors->first('surname', '<span class="errors">:message</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Address / house number*
                                    </label>
                                    <div class="col-7">
                                        <input name="post_add" class="form-control m-input" type="text" value="{{ !empty($userDetail) ? $userDetail->postal_address : '' }}">
                                        <?php echo $errors->first('post_add', '<span class="errors">:message</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        ZIP / City*
                                    </label>
                                    <div class="col-7">
                                        <input name="zip" class="form-control m-input" type="text" value="{{ !empty($userDetail) ? $userDetail->zip : '' }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Country
                                    </label>
                                    <div class="col-7">
                                        <input name="country" class="form-control m-input" type="text" value="{{ !empty($userDetail) ? $userDetail->country : ''}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        phone number
                                    </label>
                                    <div class="col-7">
                                        <input  name="phone" class="form-control m-input" type="text" value="{{ !empty($userDetail) ? $userDetail->phone : '' }}">
                                        <?php echo $errors->first('phone', '<span class="errors">:message</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Mobile
                                    </label>
                                    <div class="col-7">
                                        <input name="mobile" class="form-control m-input" type="text" value="{{ !empty($userDetail) ? $userDetail->mobile : ''  }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Email
                                    </label>
                                    <div class="col-7">
                                        <input name="email" class="form-control m-input" type="text" value="{{ !empty($user) ? $user->email : ''  }}">
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                    </label>
                                    <div class="col-7" style="text-align: right;">
                                        <input type="submit" class="btn btn-primary" value="Update" style="margin-left: 75px;">
                                    </div>
                                </div>
                            </div>




                    </div>
                    <div class="tab-pane active" id="m_user_profile_tab_2"></div>
                </div>
            </div>
            </div>
        </div>
    </form>
</div>



@include('includes.footer')


{{--<script>--}}
    {{--(function() {--}}

        {{--var input = document.querySelector('#profile-img-upload-icon');--}}
        {{--var coverPhoto = document.querySelector('#profile-cover-upload');--}}

        {{--input.addEventListener('change', change_profile_image);--}}
        {{--coverPhoto.addEventListener('change', change_profile_cover_image);--}}

    {{--})();--}}

{{--</script>--}}


