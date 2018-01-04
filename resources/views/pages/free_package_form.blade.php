@include('includes.header')

<div class="container" style="margin-bottom: 337px;">



    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
        @foreach($get_apps as $pack)
            <div class="col-md-4 col-sm-4 col-xs-4" style="padding: 0px;">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding: 0px;">
                    <img src="img/imagesmodule/account.png"/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 0px;">
                    <h3>{{ $pack }}</h3>
                    <p>Instant access.</p>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($errors) > 0)
        <div class="row">
            <div class="col-md-6">
                <ul>
                    @foreach($errors->all as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('posting') }}"  method="POST">
        @foreach($get_apps as $pack)
            <input type="hidden" value="{{ $pack }}" name="apps[]">
        @endforeach
        <div class="col-md-12" style="padding: 0px;">
            <div class="col-md-8 col-md-8 col-md-8" style="padding: 0px;">
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" class="form-control" id="name" name="full_name">
                        </div>
                        @if($errors->has('full_name'))
                            <p class="help-block">{{ $errors->first('full_name') }}</p>
                        @endif
                    </div>
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="email">Admin Email:</label>
                            <input type="email" class="form-control" id="email" name="admin_email">
                            @if($errors->has('admin_email'))
                                <p class="help-block">{{ $errors->first('admin_email') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="compname">Company Name:</label>
                            <input type="text" name="companyname" class="form-control" id="compname">
                            @if($errors->has('companyname'))
                                <p class="help-block">{{ $errors->first('companyname') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="ctry">Country:</label>
                            <input type="text" name="country" class="form-control" id="ctry">
                            @if($errors->has('country'))
                                <p class="help-block">{{ $errors->first('country') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="phonenumber">Phone Number:</label>
                            <input type="text" name="phonenumber" class="form-control" id="phonenumber" style="width: 100%;">
                            @if($errors->has('phonenumber'))
                                <p class="help-block">{{ $errors->first('phonenumber') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="compsize">Company Size:</label>
                            <input type="number" name="companysize" class="form-control" id="compsize" style="width: 100%;">
                            @if($errors->has('companysize'))
                                <p class="help-block">{{ $errors->first('companysize') }}</p>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="pi">Primary Interest:</label>
                            <input type="text" name="primaryinterest" class="form-control" id="pi">
                            @if($errors->has('primaryinterest'))
                                <p class="help-block">{{ $errors->first('primaryinterest') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left: 0px">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>


            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px;padding-left: 0px">
                <button type="submit" class="btn btn-danger" name="submit" id="submit" style="background: rgba(0, 185, 255, 0.95);border-color: rgba(0, 185, 255, 0.95);">Start Now</button>

            </div>
        </div>
    </form>
    <div id='response'></div>
</div>


@include('includes.footer')

<script>

    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId = $selectedGig.data('coll-id');
        var url = $selectedGig.data('url');

        // var className = $('span.favorite-span > i').attr('class');

        //  alert(className);

        if ($(this).find('i').attr('class') == 'fa fa-heart') {
            var action = 'removeFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o"></i></span>');
        }
        else {
            var action = 'addToFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart"></i></span>');
        }


        $.ajax({
            url: url,
            method: 'POST',
            data: {'gig-id': gigId, 'action': action},
            success: function (data) {
                console.log(data);

            }
        });
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*$('.gig-item-default').hover(function(){
         $(this).children('.col-xs-5').removeClass('hover-transition');
         },function(){
         $(this).children('.col-xs-5').addClass('hover-transition');
         });
         $('.gig-item-default').hover(function(){
         $(this).children('.col-xs-4').removeClass('hover-transition');
         },function(){
         $(this).children('.col-xs-4').addClass('hover-transition');
         });*/
        $('.gig-item-default').hover(function(){
            $(this).children('#sold').show();
        },function(){
            $(this).children('#sold').hide();
        });
        $('#custom_offer').click(function(){

            $(".gig-style").toggle();
        });
    });
</script>




</body>
</html>