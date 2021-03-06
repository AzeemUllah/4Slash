@include('includes.header')

<div class="container" style="margin-bottom: 31%;    margin-top: 85px;">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding: 0px;">
        <h2>Buy Sprout Enterprise</h2>
    </div>

    @if((\Illuminate\Support\Facades\Auth::user()->check()))
        <form action="enterprise" method="POST">
            @else
                <form action="{{ route('login4') }}" method="POST">
                    @endif
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding:0px">
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name:</label>
                                        <input type="text" class="form-control" id="name" name="fullname">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Admin Email:</label>
                                        <input type="email" class="form-control" id="email" name="admin_email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="compname">Company Name:</label>
                                        <input type="text" class="form-control" id="compname" name="companyname">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ctry">Country:</label>
                                        <input type="text" class="form-control" id="ctry" name="country">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noofuser">Number of Users:</label>
                                        <input type="number" class="form-control" name="usernumber" id="noofuser1" value="{{$qty3}}" style="width: 100%;">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phonenumber">Phone Number:</label>
                                        <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
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


                            <div class="col-md-12"
                                 style="padding:0px;padding-bottom: 13px;background-color: rgba(235, 235, 235, 0.61)">
                                <div class="col-md-6" style="padding:0px;padding-left: 10px;">
                                    total / Month
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    {{$enterprisepack}}<p style="display: initial;padding-left: 4px;">USD</p>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:0px;">
                                <h4 style="padding-top: 35px;">Implementation Service</h4>
                            </div>
                            <div class="col-md-12"
                                 style="padding:0px;padding-bottom: 13px;background-color: rgba(235, 235, 235, 0.61)">
                                <div class="col-md-6" style="padding:0px;padding-left: 10px;">
                                    Success Pack <br> basic(25h)
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <br>
                                    2,380 USD
                                </div>
                            </div>
                            <input type="hidden" name="totalamount1" value="{{$enterprisepack}}">
                            <input type="hidden" name="enterprisepack" value="{{$enterprisepack}}">
                            <div class="col-md-12" style="padding: 0px;padding-top: 15px;">
                                <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit"
                                        style="position: relative; overflow: hidden;background-color: rgba(11, 142, 242, 0.79);">
                <span class="o_ripple" style="height: 263px; width: 263px; top: -105.5px; left: -31.5px;">
                </span>Buy now
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
</div>
@include('includes.footer')
<script>

    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(