@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Packages Categories</h1>

@endsection




@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    <a href="{{ route('adminpackagestypescreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="table-package-type" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($packagesTypes as $packagesType)
                                <tr>
                                    <td>{{ $packagesType->name }}</td>
                                    <td>
                                        <a href="{{ route('packageTypeUpdate',['packageTypeId' => $packagesType->id]) }}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>
                                        <form id="formGigActivate" method="post" action="{{ route('packageType.activate') }}" style="padding-bottom: 10px; padding-top: 10px;">
                                            <input type="hidden" name="packagetype-id" value="{{ $packagesType->id }}">
                                            @if(!$packagesType->active)
                                                <button type="button" class="btn btn-danger btn-xs btn-packagetype-activate">Deactivated</button>
                                            @else
                                                <button type="button" class="btn btn-success btn-xs btn-packagetype-activate">Activated</button>
                                            @endif
                                        </form>
                                        @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                        <form class="form-gig-category-delete" method="delete" action="{{ route('adminpackagestypesdelete') }}">
                                            <input type="hidden" name="package-type-id" value="{{ $packagesType->id }}">
                                            <button type="button" class="btn btn-danger pakagetype_delete btn-xs fa fa-trash-o"></button>
                                        </form>
                                        @endif
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
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    @endsection





    @section('pages_script')

            <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            var table = $("#table-package-type").DataTable({

                "aaSorting": []
            });
              $('#table-package-type tbody').on('click', '.btn-packagetype-activate', function(e) {
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

            $('#table-package-type').on('click', '.pakagetype_delete' ,function (e) {
                if(!confirm('Are you sure you want to dalete the pakage catagory?'))
                {
                    return false;
                }
                else
                {
                    var form = e.target.parentNode;
                    var formData = new FormData(form);
                    var thisbutton = this;


                    $.ajax({
                        url: form.action,
                        method: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        complete: function (data) {
                            if (JSON.parse(data.responseText).deleted) {
                                $(form).parent().parent().remove();
                                $.notify({
                                    // options
                                    message: 'Package Type Delete Successfully.'
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
                                $.notify({
                                    // options
                                    message: 'Package Type Deleting failed please try later.'
                                }, {
                                    // settings
                                    placement: {
                                        from: 'bottom',
                                        align: 'right'
                                    },
                                    type: 'danger'
                                });
                            }
                        }
                    });
                }
            })

        });
    </script>
@endsection