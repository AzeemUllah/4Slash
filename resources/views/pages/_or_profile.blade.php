@include('includes.header')

<!-- content -->
<div class="main-profile" style="background-color:#f1f2f2;padding-top:80px; min-height: 1765px !important;">  
    <div class="content">
        <div>
                <div class="header profile-header" style="background-image: url({{ $user->cover_image }}); text-align: right;">
                    {{--<h1 class="heading1"> {{ $user->username }}</h1>--}}
                    {{--<h1 class="heading2">My Profile’s Tagline Here.</h1>--}}
                    @if(empty($user->cover_image))
                        <h4 class="text-center" style="color: #848484; margin: 0px; position: absolute; right: 0px; left: 0px;">Profile cover size should be 1140 width by 250 height</h4>
                    @endif
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
                                <img style="width:100px;height:100px;" src="{{ $user->profile_image }}" class="img-circle profile-img-circle custom-image-circle-border-color">
                            </span>
                        </form>
                    </div>
                    
                    <div class="profile-detail">
                    <h1 class="heading-responsive custom-color-header-text-color">Welcome<br>

                        Logged in as {{  $user->username }}</h1>
                    {{--<p>--}}
                        {{--Lorem ipsum dolor sit amet, dictum vehicula sed ante, enim sed ipsum lacus ante, neque imperdiet suspendisse penatibus elit, varius cras ut sapien saepe aliquet. Vel taciti nibh, orci porttitor ipsum mattis leo, in at urna augue. Nulla nulla accumsan placerat--}}
                    {{--</p>--}}
                    </div>
                    <div class="profile">


                    </div>
                    <div class="profile user-detail custom-white-color-for-profile-show">
                        @if($userDetail)
                        <a href=" {{ route('profile.update') }}" class=" pull-right ">
                        <button type="button" class="a-button a-button-override-for-gig btn-get-this-gig custom-positioning-for-button-edit">
                            <span class="fa fa-pencil custom-span-for-edit-color"></span>
                        </button></a>
                        <!--<a href=" {{ route('profile.update') }}" class="btn btn-primary pull-right"><span class="fa fa-pencil"></span></a>-->
                        @else
                            <a href=" {{ route('edit.userDetails') }}" class="btn btn-primary pull-right"><span class="fa fa-pencil"></span></a>
                        @endif

                    </div>

                    <div style=" margin-right: 20px;margin-top: 27px;border: 1px solid #ff5071;margin-left: 12px;">
                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">Username: </span>
                                <p style="font-size: 17px;     display: inline-block;"> {{ $userDetail ? $userDetail->company : ''}}</p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">first  name: </span>
                                <p style=" font-size: 17px;     display: inline-block;"> {{ $user ? $user->name : ''}}</p>
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
                                <p style="font-size: 17px; display: inline-block;"> {{$userDetail ? $userDetail->country : '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">ZIP / City: </span>
                                <p style="font-size: 17px; display: inline-block;"> {{ $userDetail ? $userDetail->zip : ''}}</p>
                            </div>
                        </div>


                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">phone number: </span>
                                <p style="font-size: 17px; display: inline-block;"> {{ $userDetail ? $userDetail->phone : '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <span style="color: #000;">Mobile: </span>
                                <p style="font-size: 17px; display: inline-block;"> {{ $userDetail ? $userDetail->mobile : '' }}</p>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 15px; padding-left: 15px;">
                            <div class="col-md-6">
                                <span style="color: #000;">E-mail: </span>
                                <p style="font-size: 17px; display: inline-block;"> {{ $user->email }}</p>
                            </div>

                        </div>


                    </div>

                       <!-- <table class="table dataTable no-footer">

                            <tr>

                                <td>
                                    <span style="color: #000;">Username</span>
                                    <p style="font-size: 17px;"> {{ $userDetail ? $userDetail->company : ''}}</p>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <span style="color: #000;">Gender</span>
                                    <p style="font-size: 17px;">{{ $userDetail ? $userDetail->gender : ''}}</p>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span style="color: #000;">first  name</span>
                                    <p style=" font-size: 17px;"> {{ $user ? $user->name : ''}}</p>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <span style="color: #000;">Address / Number *</span>
                                    <p style="font-size: 17px;"> {{ $userDetail ? $userDetail->postal_address : ''}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                        <span style="color: #000;">ZIP / City</span>
                                    <p style="font-size: 17px;"> {{ $userDetail ? $userDetail->zip : ''}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color: #000;">Land</span>
                                    <p style="font-size: 17px;"> {{$userDetail ? $userDetail->country : '' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color: #000;">phone number</span>
                                    <p style="font-size: 17px;"> {{ $userDetail ? $userDetail->phone : '' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color: #000;">Mobile</span>
                                    <p style="font-size: 17px;"> {{ $userDetail ? $userDetail->mobile : '' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color: #000;">E-mail</span>
                                    <p style="font-size: 17px;"> {{ $user->email }}</p>
                                </td>
                            </tr>
                        </table>




                    </div>
                -->
                </div>
            </div>
        </div>
    </div>
</div>


  
    
    
    
    <script>
        (function() {
            
            var input = document.querySelector('#profile-img-upload-icon'); 
            var coverPhoto = document.querySelector('#profile-cover-upload');
        
            input.addEventListener('change', change_profile_image);
            /*coverPhoto.addEventListener('change', change_profile_cover_image);*/
            var input = document.getElementById('profile-cover-upload');

            input.addEventListener("change", function() {
                var file  = this.files[0];
                var img = new Image();

                img.onload = function() {
                    var sizes = {
                        width:this.width,
                        height: this.height
                    };
                    URL.revokeObjectURL(this.src);
                    if(sizes.width == 1140 && sizes.height == 250){
                        change_profile_cover_image();
                    }else{
                        alert("Image dimensions shoud be 1140 width and 250 height!");
                    }
                    /*console.log('onload sizes', sizes.width);
                    console.log('onload this', this);*/
                };

                var objectURL = URL.createObjectURL(file);

                /*console.log('change: file', file);
                console.log('change: objectURL', objectURL);*/
                img.src = objectURL;
            });
        })();

    </script>
@include('includes.footer')
    </body>
</html>
