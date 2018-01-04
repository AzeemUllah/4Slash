@extends('pages.admin.admin_template')


@section('header_title')
    {{--@if(!$update)--}}
        <h1>Create a Sub Admin</h1>
    {{--@else--}}
        {{--<h1>Update Agency</h1>--}}
    {{--@endif--}}

<style>
    .help-block{
        color:#ff0000 !important;
    }
</style>
@endsection




@section('content')

    <form method="post" action="{{ route('subadminPostCreat') }}">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <!-- text input -->
                       {{-- <div class="form-group">
                            <label>Admin Name</label>
                            <input name="agency_id" value="" type="hidden">
                            <input name="name" type="text" value="" class="form-control" placeholder="Enter Subadmin Name...">

                            --}}{{-- @if($errors->has('username'))
                                 <span class="help-block">{{ $errors->first('username') }}</span>
                             @endif--}}{{--
                        </div>--}}
                        <div class="form-group">
                            <label>Admin Username</label>
                            <input name="agency_id" value="" type="hidden">
                            <input name="uname" type="text" class="form-control" placeholder="Enter Sub admin Userame..." value="{{ Request::old('uname') }}">

                             @if($errors->has('uname'))
                                 <span class="help-block">{{ $errors->first('uname') }}</span>
                             @endif
                        </div>

                        <div class="form-group">
                            <label>Subadmin Email</label>
                            <input name="email" type="email"  class="form-control" placeholder="Enter Sub admin Email..." value="{{ Request::old('email') }}">
                            @if($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Admin Phone</label>
                            <input name="phone" type="text"  class="form-control" placeholder="Enter Admin Phone Number...">
                        </div>
                        <div class="form-group">
                            <label>Admin Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter Sub admin Password..." value="{{ Request::old('password') }}">
                            @if($errors->has('username'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Enter Sub admin Password..." value="{{ Request::old('confirm_password') }}">
                            @if($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <div class="text-center">
                            {{--@if(isset($update) && $update)
                                <button type="submit" class="btn btn-primary btn-lg" type="submit">Update</button>
                            @else--}}
                                <button type="submit" class="btn btn-primary btn-lg" type="submit">Create</button>
                            {{--@endif--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>




    </form>

@endsection



@section('pages_css')

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/select2/select2.min.css') }}">

@endsection



@section('pages_script')

    <script src="{{ asset('bower_components/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>

@endsection