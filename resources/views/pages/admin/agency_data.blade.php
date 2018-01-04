@extends('pages.admin.admin_template')


@section('header_title')


@endsection




@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active text-center">
                    <h3 class="widget-user-username">{{ $agency_data->agency_name }}</h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                {{--<div class="widget-user-image">
                    <img class="img-circle" src="http://placehold.it/128x128" alt="User Avatar">
                </div>--}}
            </div>
            <!-- /.widget-user -->
            <div style="background: #fff; padding: 10px;">
                <h2 style="margin-left: 10px;">Agency Details</h2>
                <div class="box-info">
                    <table class="table">
                        <tbody>
                        @if(!empty($agency_data))

                            <tr>
                                <td style="border: none;">
                                    Agency name
                                </td>
                                <td style="border: none;">
                                    {{ $agency_data->agency_name }}
                                </td>
                            </tr>

                            <tr>
                                <td style="border: none;">
                                    Agency email
                                </td>
                                <td style="border: none;">{{ $agency_data->email }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>
                                    {{$agency_data->gender}}
                                </td>
                            </tr>
                            <tr>
                                <td>First name</td>
                                <td>
                                    {{$agency_data->f_name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Last name</td>
                                <td>
                                    {{$agency_data->l_name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Street #</td>
                                <td>
                                    {{$agency_data->street_no}}
                                </td>
                            </tr>
                            <tr>
                                <td>Postal code</td>
                                <td>
                                    {{$agency_data->postal_code}}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none;">
                                    City
                                </td>
                                <td style="border: none;">
                                    {{ $agency_data->city }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none;">
                                    Country
                                </td>
                                <td style="border: none;">
                                    {{ $agency_data->country }}
                                </td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>
                                    {{$agency_data->telephone}}
                                </td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>
                                    {{$agency_data->mobile}}
                                </td>
                            </tr>
                            <tr>
                                <td>Company registration #</td>
                                <td>
                                    {{$agency_data->company_ragistraion_no}}
                                </td>
                            </tr>
                            <tr>
                                <td>Number of employees</td>
                                <td>
                                    {{$agency_data->employees}}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none;">
                                    Skills
                                </td>
                                <td style="border: none;">{{ $agency_data->skills }}</td>
                            </tr>
                            <tr>
                                <td>Attachments</td>
                                <td>{!! $agency_data->attachment !!}</td>
                            </tr>
                            <tr>
                                <td>Portfolio</td>
                                <td>
                                    {{$agency_data->protfolio}}
                                </td>
                            </tr>
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
            <div>

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

            $('#example1 tbody').on('click', 'button.btn-del', function () {

                table.row($(this).parents('tr')).remove().draw();

            });

            /*$('#payments_export').click(function(){

             var button = $(this);
             var data = button.data('id');
             var url = button.data('url');
             $.ajax({
             type: 'get',
             data:  'agency_id=' + data,
             url:   url,
             success: function (res) {
             // alert(res);
             console.log(res);
             }
             })
             })*/

        });
    </script>

@endsection