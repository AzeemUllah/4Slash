@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Payment Withdraw Requests</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Wallet</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th colspan="9" style="text-align:left; display: none" class="no-match">No Record Found</th>
                        </tr>
                        </tfoot>
                        <tbody class="form-gigs-body-container">
                            @foreach($requests as $payment)
                            <tr class="data-row">
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->email }}</td>
                                <td>{{ $payment->wallet }}</td>
                            </tr>
                            @endforeach
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
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <style>
        .btn-gig-activate:hover {
            background-color: #5cb85c;
            border-color: #4cae4c;
        }

    </style>

@endsection





@section('pages_script')
    <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
@endsection