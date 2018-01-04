@include('includes.header')
<div class="well" style="margin-bottom: 0px;">
        <!-- content -->
    <div class="container" style="height:90vh">
        <div class="row" style="margin-top: 65px; margin-bottom: 60px;">

            <div class="col-xs-6 col-xs-push-3" style="text-align:-webkit-center; background: white; padding: 40px;">
                    {{--<form method="POST" action="/password/email">--}}
                    <h3 style="color: #367fa9;" class="text-left">Forgot Password?
                    </h3>
                <p style="color:#367fa9;" class="text-left">No problem. Please enter the e-mail address,
                    With which you have registered and click on "Send" after input.
                </p>
                    <form method="POST" action="{{route('userforgotEmail')}}" class="text-left" style="padding-bottom: 40px;">
                        {!! csrf_field() !!}


                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: 30px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session('success') }}
                            </div>
                        @endif




                        <div class="form-group">
                            <label for="email"></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="jane.doe@example.com" value="{{ old('email') }}">
                        </div>
                        <button type="submit" class="btn btn-primary" style="background: #367fa9;">
                            Send
                        </button>

                    </form>
                {{--<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-th-large" style="margin-right:5px;"></span>View all Gigs</button>--}}
            </div>
        </div>
    </div>
</div>


@include('includes.footer')


</body>
</html>
