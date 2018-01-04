@extends('pages.admin.admin_template')


@section('header_title')


@endsection




@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{ $subadmin->username }}</h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                <div class="widget-user-image">
                    @if(!empty($subadmin->profile_image))
                    <img class="img-circle" src="{{ $subadmin->profile_image }}" alt="User Avatar">
                        @else
                        <img class="img-circle" src="http://placehold.it/128x128" alt="User Avatar">
                        @endif
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text"></span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
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

                $('#example1 tbody').on('click', 'button.btn-del', function () {

                 table.row($(this).parents('tr')).remove().draw();

                      });
                  });
     </script>

@endsection