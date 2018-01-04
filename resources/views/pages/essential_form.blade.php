

@include('includes.header')

<div class="container" style="margin-bottom: 29%;    margin-top: 100px;">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding: 0px;">
        <h2>Buy Sprout Essential</h2>
    </div>

    @if((\Illuminate\Support\Facades\Auth::user()->check()))
        <form action="essential" method="POST" >
            @else
                <form action="{{ route('login2') }}" method="POST" >
                    @endif
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding:0px">
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name:</label>
                                        <input type="text" class="form-control" id="name" name="fullname">
                                    </div>
                                    @if($errors->has('fullname'))
                                        <p class="help-block">{{ $errors->first('fullname') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Admin Email:</label>
                                        <input type="email" class="form-control" id="email" name="admin_email">
                                    </div>
                                    @if($errors->has('admin_email'))
                                        <p class="help-block">{{ $errors->first('admin_email') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="compname">Company Name:</label>
                                        <input type="text" class="form-control" id="compname" name="companyname">
                                    </div>
                                    @if($errors->has('companyname'))
                                        <p class="help-block">{{ $errors->first('companyname') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ctry">Country:</label>
                                        <input type="text" class="form-control" id="ctry" name="country">
                                    </div>
                                    @if($errors->has('country'))
                                        <p class="help-block">{{ $errors->first('country') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noofuser">Number of Users:</label>
                                        <input type="number" class="form-control" id="noofuser" value="{{$qty2}}" name="usernumber" style="width: 100%;" >
                                    </div>
                                    @if($errors->has('usernumber'))
                                        <p class="help-block">{{ $errors->first('usernumber') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number:</label>
                                        <input type="text" class="form-control" id="phone" name="phonenumber">
                                    </div>
                                    @if($errors->has('phonenumber'))
                                        <p class="help-block">{{ $errors->first('phonenumber') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    @if($errors->has('password'))
                                        <p class="help-block">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>




                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 mainrightsidebar" style="padding:0px">
                            <div>
                                <h4 class="rightsidebar">Monthly</h4>
                            </div>

                            <div style="    padding-bottom: 5px;border-bottom: 1px solid;">
                                <h4 class="rightbarsubs">Subscription</h4>
                            </div>




                            <div class="col-md-12" style="padding:0px;padding-bottom: 13px;background-color: rgba(235, 235, 235, 0.61)">
                                <div class="col-md-6" style="padding:0px;padding-left: 10px;">
                                    Total / Month
                                </div>
                                <div class="col-md-6" style="padding:0px;">

                                    {{$essentialpack}}<p style="    display: initial;padding-left: 4px;">USD</p>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:0px;">
                                <h4 style="padding-top: 35px;">Implementation Service</h4>
                            </div>
                            <div class="col-md-12" style="padding:0px;padding-bottom: 13px;background-color: rgba(235, 235, 235, 0.61)">
                                <div class="col-md-6" style="padding:0px;padding-left: 10px;">
                                    Success Pack <br> basic(25h)
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <br>
                                    2,380 USD
                                </div>
                            </div>

                            <input type="hidden" name="totalamount" value="{{$essentialpack}}">
                            <input type="hidden" name="essentialpack" value="{{$essentialpack}}">
                            <div class="col-md-12" style="padding: 0px;padding-top: 15px;">
                                <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit" style="position: relative; overflow: hidden;background-color: rgba(11, 142, 242, 0.79);">
                <span class="o_ripple" style="height: 263px; width: 263px; top: -105.5px; left: -31.5px;">
                </span>Buy now </button></div>
                        </div>
                    </div>
                </form>




</div>

{{--<form >--}}
{{--<div><input type='text' name='firstname' placeholder='Firstname' /></div>--}}
{{--<div><input type='text' name='lastname' placeholder='Lastname' /></div>--}}
{{--<div><input type='text' name='email' placeholder='Email' /></div>--}}
{{--<div><input type='submit' value='Submit' /></div>--}}
{{--</form>--}}

<!-- where the response will be displayed -->
<div id='response'></div>



@include('includes.footer')

<script>
    $(document).ready(function(){
        $('#userForm').submit(function(){

            // show that something is loading
            $('#response').html("<b>Loading response...</b>");

            var url = "{{URL::to('posting')}}";

            $.post('https://4slash.com/posting4', $(this).serialize(), function(data){

                // show the response
                $('#response').html(data);

            }).fail(function() {

                // just in case posting your form failed
                alert( "Posting failed." );

            });

            // to prevent refreshing the whole page page
            return false;

        });
    });
</script>

<script>

    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(