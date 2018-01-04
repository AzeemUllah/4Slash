@extends('pages.admin.admin_template')


@section('header_title')
@if(!$update)
    <h1>Create a new Agency</h1>
    @else
    <h1>Update Agency</h1>
@endif


@endsection




@section('content')

    <form id="percent" method="post" action="{{ (($update) ? route('adminAgenciesUpdate') : route('adminagenciesPostcreate') ) }}">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group<?= $errors->has('name') || $errors->has('username') ? ' has-error' : '' ?>">
                            <label>Agency Name</label>
                            <input name="agency_id" value="{{ $update ? $agency->id : '' }}" type="hidden">
                            <input name="name" type="text" value="{{ (($update) ? $agency->username : '') }}" class="form-control" placeholder="Enter Agency Name...">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                           {{-- @if($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif--}}
                        </div>

                        <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                            <label>Agency Email</label>
                            <input name="email" type="email" value="{{ (($update) ? $agency->email : '') }}" class="form-control" placeholder="Enter Agency Email...">
                             @if($update)
                            <?php echo $errors->first('email', '<span class="help-block">:message</span>'); ?>
                            @elseif(!($update) && $errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group<?= $errors->has('password') ? ' has-error' : '' ?>">
                            <label>Agency Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter Agency Password..." value="{{ Request::old('password') }}">
                            @if($update)
                                <?php echo $errors->first('password', '<span class="help-block">:message</span>'); ?>
                            @elseif(!($update) && $errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>


                        <div class="form-group<?= $errors->has('password_confirmation') ? ' has-error' : '' ?>">
                            <label>Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Enter Confirm Password..." value="{{ Request::old('password_confirmation') }}">
                            @if($update)
                                <?php echo $errors->first('conf_password', '<span class="help-block">:message</span>'); ?>
                            @elseif(!($update) && $errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Referred by:</label>
                            <select name="parent-agency" id="" class="form-control">
                                <option value="{{($refered_agency)? $refered_agency : ''}}" selected>{{ ($refered_agency) ? $refered_agency->username : 'Select referr agency' }}</option>
                                @foreach($agencies as $agent)
                                    <option value="{{$agent->id}}">{{$agent->username}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label>Set percentage</label>
                        <div class="input-group" style="margin-bottom: 30px;">
                            <div class="col-xs-3">
                                <label style="width: 100%">Cnerr</label>
                                <input name="percent" type="number" value="{{ $agency->master_percent ? $agency->master_percent : '40' }}" class="form-control maths1 calc" style="width: 50%">
                                <span class="input-group-addon" style="width: 50%; padding:9px 5px;">&#37;</span>
                            </div>
                            <div class="col-xs-3">
                                <label style="width: 100%">Agency</label>
                                <input name="percent1" type="number" value="{{ $agency->agency_percentage ? $agency->agency_percentage : '60' }}" class="form-control maths calc" style="width: 50%">
                                <span class="input-group-addon" style="width: 50%; padding:9px 5px;">&#37;</span>
                            </div>
                            <div class="col-xs-3">
                                <label style="width: 100%">Mother agency</label>
                                <input name="percent2" type="number" value="{{ $agency->refer_percent ? $agency->refer_percent : 0 }}" class="form-control maths2 calc" style="width: 50%">
                                <span class="input-group-addon" style="width: 50%; padding:9px 5px;">&#37;</span>
                            </div>
                        </div>

                        <div class="text-center">
                            @if(isset($update) && $update)
                                <button type="submit" class="btn btn-primary btn-lg" type="submit">Update</button>
                            @else
                                <button type="submit" class="btn btn-primary btn-lg" type="submit">Create</button>
                            @endif
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
    <script type="text/javascript">
        $(document).ready(function () {
           /*$('.maths1').keyup(function () {
               var a = parseInt($('.maths').val());
               var b = parseInt($('.maths1').val());
               var c = parseInt($('.maths2').val());
               var total = a+b;
               var net = 100 - total;
               if(total < 100){
                   $('.maths2').val(net);
               }else{
                   if(total >= 100) {
                       $('.maths2').val(0);
                   }
                   console.log("not allowed");
               }
           });*/
            $('.calc').change(function(){
                var a = parseInt($('.maths').val());
                var b = parseInt($('.maths1').val());
                var c = parseInt($('.maths2').val());
                var total = a+b;
                var net = 100 - total;
                if(total < 100){
                    $('.maths2').val(net);
                }else{
                    if(total >= 100) {
                        $('.maths2').val(0);
                        $(this).val(100-a);
                    }
                }
            });
        });
    </script>

@endsection
