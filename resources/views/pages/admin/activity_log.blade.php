@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Activity Logs</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    {{--<a href="{{ route('adminagenciescreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>--}}
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id#</th>
                            <th>User Name</th>
                            <th>Action</th>
                            <th>Page Link</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($logs))
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->log_id }}</td>
                                    <td>{{\App\User::find($log->user_id)->username  }}</td>
                                    <td>{{ $log->message }}</td>
                                    <td><a href="{{ $log->request_uri }}"><span class="glyphicon glyphicon-eye-open"></span></a> </td>
                                    <td>{{ date("d.m.Y",strtotime($log->log_date)) }}</td>
                                    {{--<td>
                                        --}}{{--<button class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></button>--}}{{--
                                        <a href="{{ route('registereduser', ['userEmail' => $user->email]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a href="{{ route('user.update', ['userEmail' => $user->email]) }}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>
                                        <form id="formUserActivate" method="post" action="{{ route('user.activate') }}">
                                            <input type="hidden" name="user-id" value="{{ $user->id }}">
                                            @if(!$user->active)
                                                <button type="button" class="btn btn-danger btn-xs btn-user-activate">Deactivated</button>
                                            @else
                                                <button type="button" class="btn btn-success btn-xs btn-user-activate">Activated</button>
                                            @endif
                                        </form>
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $user->id}}"  data-target="#myModal"></button>
                                        @endif
                                    </td>--}}
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <h3>Are you sure want to delete this user?</h3>
                    <input type="hidden" name="order_id" value="" id="user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" id="yes_user_delete">Yes</button>
                </div>
            </div>
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

//            $('#example1 tbody').on('click', '#yes_user_delete', function() {
//
////                table.row( $(this).parents('tr') ).remove().draw();
//
//            });
            $('#example1 tbody').on('click', '.trash-btn', function() {
                var user_id = $(this).data('id');

                $('#user_id').val(user_id);
            });
            $('#yes_user_delete').click(function(){

                var user_id = $('#user_id').val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('userdelete') }}",
                    data: 'user_id=' + user_id,
                    success: function (res) {
                        console.log(res);
                        if (res != 0) {
                            location.reload();
                        }
                        else {
                            alert('Ops! some thing goes wrong.. Please try again.')
                        }
                    }

                });

            })

            $('#example1 tbody').on('click', '.btn-user-activate', function(e) {
                e.preventDefault();
                var form = e.target.parentNode;
                var formData = new FormData(form);
                var thisbutton = this;
                $.ajax({
                    url: form.action,
                    method: form.method,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        if(data.status == 1) {
                            $(thisbutton).html("Activated");
                            thisbutton.classList.remove('btn-danger');
                            thisbutton.classList.add('btn-success');
                        } else if(data.status == 0) {
                            $(thisbutton).html("Deactivated");
                            thisbutton.classList.remove('btn-success');
                            thisbutton.classList.add('btn-danger');
                        }

                        //clickedElement.removeAttribute('disabled');
                    }
                });


            })

        });
    </script>

@endsection