@include('includes.header')

        <!-- content -->
<div class="well">
<div class="container" style="height:100vh">
    <div class="row" style="margin-top: 65px; margin-bottom: 60px;">
        <div class="col-xs-6 col-xs-push-3 text-left" style="background: white;">
            <h3 style="color: #367fa9; margin-bottom: 30px;">Change Password
            </h3>
            {{--<form method="POST" action="/password/reset">--}}
            <form method="POST" action="{{route('resetuserPassword')}}" style="padding-bottom: 20px;">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="exampleInputEmail1">Your current e-mail address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email"
                           value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                           placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1"
                           placeholder="Password">
                </div>

                <button type="submit" class="btn btn-default" style="background: #367fa9; color: white;">Reset</button>
            </form>
        </div>
    </div>
</div>
</div>

@include('includes.footer')


</body>
</html>
