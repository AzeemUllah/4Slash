@include('includes.header')

<!-- content -->
<div class="main-profile" style="background-color:#f1f2f2;padding-top:80px; min-height: 1765px !important;">
    <div class="content">
        <div>
            <div class="header profile-header" style="background-image: url({{ $user->cover_image }}); text-align: right;">


                    <h4 class="text-center" style="color: #848484; margin: 0px; position: absolute; right: 0px; left: 0px;">Profile cover size should be 1140 width by 250 height</h4>

                <form id="profile-cover-img-form" enctype="multipart/form-data" class="form-vertical custom-css-for-positioning">
                    <input name="profile-cover-img" type="file" class="profile-upload-button" id="profile-cover-upload" style="display: none;">
                    <label for="profile-cover-upload" class="btn btn-primary btn-xs btn-profile-cover-upload custom-color-class-for-label" style="margin-right: 5px; position: relative; margin-top: -65px;">Change background
                    </label>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12" style=" margin-bottom:52px;">
                <div class="main-content" id="profile-edit">

                    <div class="profile-img-profile">

                        <form id="profile-img-form" enctype="multipart/form-data">
                            <span>
                                <input name="profile-img" type="file" class="profile-upload-button" id="profile-img-upload-icon">
                                <label for="profile-img-upload-icon" class="profile-img-upload-icon"><i class="fa fa-camera"></i></label>
                                <img style="width:100px;height:100px;" src="" class="img-circle profile-img-circle custom-image-circle-border-color">
                            </span>
                        </form>
                    </div>

                    <div class="profile-detail">
                        <h1 class="heading-responsive custom-color-header-text-color">Welcome<br>

                            Logged in as </h1>
                        {{--<p>--}}
                        {{--Lorem ipsum dolor sit amet, dictum vehicula sed ante, enim sed ipsum lacus ante, neque imperdiet suspendisse penatibus elit, varius cras ut sapien saepe aliquet. Vel taciti nibh, orci porttitor ipsum mattis leo, in at urna augue. Nulla nulla accumsan placerat--}}
                        {{--</p>--}}
                    </div>
                    <div class="profile">


                    </div>
                    <div class="profile user-detail custom-white-color-for-profile-show">

                            <a href=" {{ route('profile.update') }}" class=" pull-right ">
                                <button type="button" class="a-button a-button-override-for-gig btn-get-this-gig custom-positioning-for-button-edit">
                                    <span class="fa fa-pencil custom-span-for-edit-color"></span>
                                </button></a>
                        <!--<a href=" {{ route('profile.update') }}" class="btn btn-primary pull-right"><span class="fa fa-pencil"></span></a>-->

                            <a href=" {{ route('edit.userDetails') }}" class="btn btn-primary pull-right"><span class="fa fa-pencil"></span></a>


                    </div>

                    <div style=" margin-right: 20px;margin-top: 27px;border: 1px solid #ff5071;margin-left: 12px;">
                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">Username: </span>
                                <p style="font-size: 17px;     display: inline-block;"> {{ $userDetail ? $userDetail->company : ''}}</p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">first  name: </span>
                                <p style=" font-size: 17px;     display: inline-block;"> </p>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">Address / Number *: </span>
                                <p style="font-size: 17px;     display: inline-block;"> {{ $userDetail ? $userDetail->postal_address : ''}}</p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">Gender: </span>
                                <p style="font-size: 17px;     display: inline-block;">{{ $userDetail ? $userDetail->gender : ''}}</p>
                            </div>
                        </div>


                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">Land: </span>
                                <p style="font-size: 17px; display: inline-block;"> </p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">ZIP / City: </span>
                                <p style="font-size: 17px; display: inline-block;"> </p>
                            </div>
                        </div>


                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">phone number: </span>
                                <p style="font-size: 17px; display: inline-block;"> </p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">Mobile: </span>
                                <p style="font-size: 17px; display: inline-block;"> </p>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">E-mail: </span>
                                <p style="font-size: 17px; display: inline-block;"> </p>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>








</body>
</html>
