@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Sub Admin</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if(\Illuminate\Support\Facades\Session::has('updated'))
                    <div class="alert alert-success" role="alert" style="text-align: center; width: 50%; margin: 0px auto; margin-top: 10px;">
                        <p>{{ \Illuminate\Support\Facades\Session::get('updated') }}</p>
                    </div>
                @endif
                <div class="box-header text-right">
                    <a href="{{ route('subadminCreat') }}" class="btn btn-primary btn-sm"><span
                                class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subadmin as $subadm)
                            <tr>
                                <td>{{ $subadm->username }}</td>
                                <td>{{ $subadm->email }}</td>
                                <td>
                                    {{--<a href="{{ route('subadminprofile', ['subadminEmail' => $subadm->email]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                                    <a href="" data-id="{{ $subadm->id }}" data-toggle="modal" data-target="#myModal"
                                       class="btn btn-primary btn-xs get-subadmin-data"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    {{--<a href="{{ route('agency.update', ['agencyEmail' => $subadm->email]) }}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>--}}
                                    <button class="btn btn-danger btn-xs btn-del"
                                            data-url="{{ route('subAdminDelete') }}" data-id="{{ $subadm->id }}"><span
                                                class="fa fa-trash-o"></span></button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form method="post" id="subad_update" action="{{ route('subadmin.update.data') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-info">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Admin Username</label>
                                            <input name="agency_id" value="" type="hidden" id="subadmin_id">
                                            <input name="uname" type="text" class="form-control"
                                                   placeholder="Enter Subadmin Userame..."
                                                   value="{{ Request::old('uname') }}" id="subadmin_username">

                                            @if($errors->has('uname'))
                                                <span class="help-block">{{ $errors->first('uname') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Subadmin Email</label>
                                            <input name="email" type="email" class="form-control"
                                                   placeholder="Enter Subadmin Email..."
                                                   value="{{ Request::old('email') }}" id="subadmin_email">
                                            @if($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Admin Phone</label>
                                            <input name="phone" type="text" class="form-control"
                                                   placeholder="Enter Admin Phone Number..." id="subadmin_phone">
                                        </div>
                                        <div class="form-group">
                                            <label>Admin Password</label>
                                            <input name="password" type="password" class="form-control"
                                                   placeholder="Enter Subadmin Password..."
                                                   value="{{ Request::old('password') }}" id="subadmin_password">
                                            @if($errors->has('username'))
                                                <span class="help-block">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection




@section('pages_css')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">

@endsection





@section('pages_script')

    <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            var table = $("#example1").DataTable();
            $('#example1 tbody').on('click', 'button.btn-del', function () {
                if (!confirm('Are you sure you want to permanently delete this sub-admin?')) {

                    return false;
                }
                else {
                    var button = $(this);
                    var Id = button.data('id');
                    $.ajax({

                        method: 'get',
                        url: button.data('url'),
                        data: {user_id: Id},
                    }).done(function (data) {
                        console.log(data);
                        if (data > 0) {
                            $.notify({
                                // options
                                message: 'Sub Admin Deleted Successfully'

                            }, {
                                // settings
                                placement: {
                                    from: 'bottom',
                                    align: 'right'
                                },
                                type: 'success'
                            });

                        }
                        else {
                            //notifyMessage
                            $.notify({
                                // options
                                message: 'Sub Admin Deleting failed please try again'
                            }, {
                                // settings
                                placement: {
                                    from: 'bottom',
                                    align: 'right'
                                },
                                type: 'danger'
                            });
                        }
                    });


                    table.row($(this).parents('tr')).remove().draw();
                }

            });
            $("#example1 tbody").on('click','.get-subadmin-data', function () {
                var url = "{{ route('subadmin.data') }}";
                var form = $("#subad_update");
                var Id = $(this).data('id');
                $.ajax({
                    method : "post",
                    url  : url,
                    data  : {user_id : Id},
                    dataType : "json",
                    success : function(res){
                        res.forEach(function(data){
                           console.log(data);
                           $("#subadmin_id").val(data.id);
                           $("#subadmin_username").val(data.username);
                           $("#subadmin_email").val(data.email);
                           $("#subadmin_phone").val(data.phone_number);
                           $("#subadmin_password").val(data.password);
                        });
                    }
                });
            });
        });
    </script>

@endsection