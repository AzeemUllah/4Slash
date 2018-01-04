@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Users</h1>

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
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($news))
                            @foreach($news as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
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
            $("#example1").DataTable();
        });
    </script>

@endsection