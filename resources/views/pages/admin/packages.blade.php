@extends('pages.admin.admin_template')


@section('header_title')
    @if(Request::segment(2) == "agencies")
        <h1>Suggested Packages</h1>
    @else
    <h1>Packages</h1>
    @endif

@endsection




@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="row zero-margg">
                <div class="col-xs-4 text-center zero-padd border">
                    <p style="color: #12c112;font-size: 50px;line-height: 0.8em;margin:0px;">{{ $get_activated }}</p>
                    <p>Activated</p>
                </div>
                <div class="col-xs-4 text-center zero-padd border">
                    <p style="color:#5cb85c; font-size: 50px; line-height: 0.8em; margin:0px;">{{ $get_deactivated }}</p>
                    <p>Deactivated</p>
                </div>
                <div class="col-xs-4 text-center zero-padd border">
                    <p style="color:#3c8dbc; font-size: 50px; line-height: 0.8em; margin:0px;">{{ $get_featured }}</p>
                    <p>Featured</p>
                </div>
            </div>
            <div class="box">
               {{-- <div class="box-header text-right">
                    <a href="{{ route('adminpackagescreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->--}}
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Suggested by</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($packages as $package)
                            <tr>
                                    <td>{!! (date('d-m-Y', strtotime($package->created_at)) == date('d-m-Y')) ? '<i class="fa fa-star" style="color: #157340;"></i>' : '' !!} {{ $package->id }}</td>
                                    <td>{{ $package->created_at }}</td>
                                    <td>{{ $package->title }}</td>
                                    <td>{{ \App\User::find($package->suggested_by)['username'] }}</td>
                                    <td>
                                        <a href="{{ route('adminpackageUpdate',['packageId' => $package->packages_id]) }}"
                                           class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>

                                        <button class="btn btn-danger btn-xs pakage-delete" data-id="{{ $package->packages_id }}"
                                                data-url="{{ route('adminpakagedelete') }}">
                                            Trash
                                        </button>
                                        <form id="formpackageActivate" method="post" action="{{ route('package.activate') }}">
                                            <input type="hidden" name="package-id" value="{{ $package->id }}">
                                            @if(!$package->active)
                                                <button type="button" class="btn btn-danger btn-xs btn-package-activate">Deactivated</button>
                                            @else
                                                <button type="button" class="btn btn-success btn-xs btn-package-activate">Activated</button>
                                            @endif
                                        </form>
                                        <form id="formpackageFeatured" method="post" action="{{ route('package.featured') }}">
                                            <input type="hidden" name="package-id" value="{{ $package->id }}">
                                            @if(!$package->featured)
                                                <button type="button" class="btn btn-primary btn-xs btn-package-featured">Featured</button>
                                            @else
                                                <button type="button" class="btn btn-success btn-xs btn-package-featured">Featured</button>
                                            @endif
                                        </form>
                                        {{--<a href="{{ route('admin.single.package',['packageId' => $package->id]) }}" class="btn btn-primary btn-xs" target="_blank">
                                            <i class="fa fa-eye"></i>
                                        </a>--}}
                                            <form action="{{ route('single.package') }}" target="_blank" method="post" style="display: inline-block;">
                                                <input type="hidden" name="package_name" value="{{ $package->title }}">
                                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                <button class="btn btn-primary btn-xs" type="submit">
                                                    <i class="fa fa-eye btn btn-primary btn-xs"></i>
                                                </button>
                                            </form>
                                    </td>
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


@endsection

@section('pages_script')

        <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
<script>

    $(function () {
        var table = $("#example1").DataTable({

            "aaSorting": []
        });

       /* $('#example1 tbody').on('click', '.btn-package-activate', function(e) {
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


        });*/


            $('#example1 tbody').on('click','.pakage-delete',function(e){
                if (!confirm('Are you sure you want to move this package to trash?')) {
                    e.preventDefault();
                    return false;
                }
                else{

                var button = $(this);
                var rowId = button.data('id');

                $.ajax({

                    method: 'post',
                    url: button.data('url'),
                    data: {package_id: rowId},
                }).done(function (data){
                    if(data.has_pending){
                        //notifyMessage
                        $.notify({
                            // options
                            message: 'Package has pending orders!'
                        }, {
                            // settings
                            placement: {
                                from: 'bottom',
                                align: 'right'
                            },
                            type: 'danger'
                        });
                    }
                  else if(data > 0)
                  {
                      $.notify({
                          // options
                          message: 'Package moved to trash'

                      }, {
                          // settings
                          placement: {
                              from: 'bottom',
                              align: 'right'
                          },
                          type: 'success'
                      });
//                      table.row($(this).parents('tr') ).remove().draw();
                        window.location.reload();
                  }
                  else {
                      //notifyMessage
                      $.notify({
                          // options
                          message: 'Package Deleting failed please try again'
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


                }
            });
        $('#example1 tbody').on('click', '.btn-package-featured', function(e) {

            var form = e.target.parentNode;
            var formData = new FormData(form);
            var thisbutton = this;
            // clickedElement.setAttribute('disabled', 'disable');
            $.ajax({
                url: form.action,
                method: form.method,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if(data.status == 1) {

                        thisbutton.classList.remove('btn-primary');
                        thisbutton.classList.add('btn-success');
                    } else if(data.status == 0) {
                        thisbutton.classList.remove('btn-success');
                        thisbutton.classList.add('btn-primary');
                    }

                    //clickedElement.removeAttribute('disabled');
                }
            });
        });
        $('#example1 tbody').on('click', '.btn-package-activate', function(e) {
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


        });



    });


</script>
@endsection