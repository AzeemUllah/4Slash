@extends('pages.admin.admin_template')


@section('header_title')
        <h1>Suggested Packages</h1>
@endsection




@section('content')

    <div class="row">
        <div class="col-xs-12">
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
                                @if(!empty($package))
                                    <td>{!! (date('d-m-Y', strtotime($package->created_at)) == date('d-m-Y')) ? '<i class="fa fa-star" style="color: #157340;"></i>' : '' !!} {{ $package->id }}</td>
                                    <td>{{ $package->created_at }}</td>
                                    <td>{{ $package->title }}</td>
                                    <td>{{ \App\Agency::find($package->suggested_by)->username }}</td>
                                    <td>
                                        <a href="{{ route('adminpackageUpdate',['packageId' => $package->packages_id])}}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>

                                        <a href="{{ route('accept.package', ['packageId' => $package->id]) }}" class="btn btn-success btn-xs">
                                            Accept
                                        </a>
                                        <a href="" data-toggle="modal" data-target="#rejectModal2" class="btn btn-danger btn-xs reject-package-id" data-id="{{ $package->id }}">
                                            Reject
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="modal fade bs-example-modal-sm" id="rejectModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post" id="package-rejection-form1">
                    <div class="modal-header"
                         style="background-color:#367fa9;">
                        <button style="color:white;" type="button"
                                class="close" data-dismiss="modal"
                                aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h4 style="color:white;" class="modal-title"
                            id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h4>Reason for Rejection</h4>
                            <textarea class="form-control" id="rejection_reason" cols="38"
                                      rows="5" name="rejection_reason"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">Close
                        </button>
                        <input type="hidden" class="reject-gig-id-jquery" id="reject-package-id1" name="package-id" value="">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
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
            var table = $("#example1").DataTable({

                "aaSorting": []
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


            $('#example1 tbody').on('click','.pakage-delete',function(e){
                if (!confirm('Are you sure you want to delete this package?')) {
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
                        if(data > 0)
                        {
                            $.notify({
                                // options
                                message: 'Package Deleted Successfully'

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
                    table.row( $(this).parents('tr') ).remove().draw();

                }
            })



        });

    $(".reject-package-id").click(function(){
       var id = $(this).data("id");
       $(".reject-gig-id-jquery").val(id);
    });
        $("#package-rejection-form1").on('submit', function(e){
            var reject_reason = $("textarea#rejection_reason").val();
            var package_id = $("#reject-package-id1").val();
            e.preventDefault();
            $.ajax({
                method : "post",
                url   : "{{ route('reject.package') }}",
                data  : {package_id : package_id, reject_reason : reject_reason},
                dataType : "json",
                success : function(res){
                    $('#rejectModal').modal('hide');
                    $('#rejectModal2').modal('hide');
                    //notifyMessage('Gig Deleting failed please try again.', 'danger')
                    $.notify({
                        // options
                        message: 'Information sent successfully'
                    },{
                        // settings
                        placement: {
                            from: 'bottom',
                            align: 'right'
                        },
                        type: 'info'
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        });
    </script>
@endsection