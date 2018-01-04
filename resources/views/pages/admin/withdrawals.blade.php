@extends('pages.admin.admin_template')


@section('header_title')

    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3>Withdraw Requests</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="examplezero" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id#</th>
                        <th>User Name</th>
                        <th>Amount</th>
                        <th>Payment method</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->agency_name }}</td>
                            <td>{{ $request->amount }}</td>
                            <td>{{ $request->payment_method }}</td>
                            <td>{{ $request->created_at}}</td>
                            <td><a href="{{ route('admin.agency', ['agencyMail' => $request->agency_email]) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

@endsection

@section('pages_script')
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function(){
            var table = $("#examplezero").DataTable();
        });
    </script>
@endsection