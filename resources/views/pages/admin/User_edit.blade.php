@extends('pages.admin.admin_template')


@section('header_title')


        <h1>Update User</h1>



@endsection




@section('content')

    <form method="post" action="{{ route('adminUserUpdate') }}">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group<?= $errors->has('name') || $errors->has('username') ? ' has-error' : '' ?>">
                            <label>First given name</label>
                            <input name="name" type="text" value="{{ $user->name  }}" class="form-control" placeholder="Enter  Name...">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                            @if($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>company</label>
                            <input name="company" type="text" value="{{ $userDetail ? $userDetail->company : ''  }}" class="form-control" placeholder="Enter User City...">
                            <input name="info_id" type="hidden" value="{{ $userDetail ? $userDetail->id : ''  }}" class="form-control">
                        </div>
                        <div class="form-group<?= $errors->has('name') || $errors->has('username') ? ' has-error' : '' ?>">
                            <label>Surname</label>
                            <input name="user_name" type="text" value="{{ $user->username  }}" class="form-control" placeholder="Enter User Name...">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                            @if($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                            <label>E-mail</label>
                            <input name="email" type="email" value="{{  $user->email  }}" class="form-control" placeholder="Enter User Email...">
                            @if($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Address / house number</label>
                            <input name="post_add" type="text" value="{{ $userDetail ? $userDetail->postal_address : ''  }}" class="form-control" placeholder="Enter User Postal Address...">
                        </div>



                        <div class="form-group">
                            <label>PLZ, Ort</label>
                            <input name="zip" type="text" value="{{ $userDetail ? $userDetail->zip : ''  }}" class="form-control" placeholder="Enter City Zip Code...">
                        </div>
                        <div class="form-group">
                            <label>Land</label>
                            <input name="country" type="text" value="{{ $userDetail ? $userDetail->country : ''  }}" class="form-control" placeholder="Enter User Billing Address...">
                        </div>
                        <div class="form-group">
                            <label>phone number</label>
                            <input name="phone" type="text" value="{{ $userDetail ? $userDetail->phone : ''  }}" class="form-control" placeholder="Enter User Phone...">
                        </div>

                        <div class="form-group">
                            <label>Mobile</label>
                            <input name="mobile" type="text" value="{{ $userDetail ? $userDetail->mobile : ''  }}" class="form-control" placeholder="Enter User Mobile...">
                        </div>

                        <div class="text-center">
                            {{--@if(isset($update) && $update)--}}
                                <button type="submit" class="btn btn-primary btn-lg" type="submit">Update</button>
                            {{--@else--}}
                                {{--<button type="submit" class="btn btn-primary btn-lg" type="submit">Create and send Email</button>--}}
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