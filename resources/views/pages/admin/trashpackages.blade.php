@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Trash Packages</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category / Favor</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="form-gigs-body-container">
                        @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->title }}</td>
                                <td>{{ !empty($package->packages_types_id) ? \App\Gigtype::find($package->packages_types_id)->name : \App\Gig::find($package->favor_id)->title }}</td>
                                <td>


                                    <button type="button" class="btn btn-success btn-xs fa fa-undo undo-btn" data-toggle="modal" data-id="{{ $package->id }}" data-target="#undoModal"></button>


                                    <button data-id="{{ $package->id }}" data-url="{{ route('adminGigDelete') }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>
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



<!-- Modal -->
<div class="modal fade" id="undoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Revert Back</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure want to restore this package?</h3>
                <input type="hidden" name="gig_id" value="" id="gig_id">
                <!-- select -->
                <div class="row">
                    <div class="col-md-4">Title</div>
                    <div class="col-md-8" id="gig_title"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">Price</div>
                    <div class="col-md-8" id="gig_price"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary" id="yes_gig_undo">Restore</button>
            </div>
        </div>
    </div>
</div>


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
    <script>
        $(function () {
            var table = $("#example1").DataTable({
                "aaSorting": []
            });

            $('#example1 tbody').on('click', 'button.btn-del', function () {

                //var conf = confirm ("Are you sure you want to delete from the database?");
                if (!confirm('Are you sure you want to delete the gig?')) {
                    e.preventDefault();
                    return false;
                }
                else {

                    var button = $(this);
                    var rowId = button.data('id');

                    $.ajax({
                        method: 'DELETE',
                        url: button.data('url'),
                        data: {gig_id: rowId},
                    }).done(function (data) {
                        if (data != 0) {

                            //notifyMessage('Gig Deleted Successfully.', 'success');
                            $.notify({
                                // options
                                message: 'Gig Deleted Successfully'

                            }, {
                                // settings
                                placement: {
                                    from: 'bottom',
                                    align: 'right'
                                },
                                type: 'success'
                            });


//                            button.parent().remove().draw();

                            //table.row(button.parents('tr')).remove().draw();


                        } else {
                            //notifyMessage('Gig Deleting failed please try again.', 'danger')
                            $.notify({
                                // options
                                message: 'Gig Deleting failed please try again'
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
        $('.btn-gig-featured').click(function(e) {

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
        })
        $('.btn-gig-activate').click(function (e) {
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
    </script>
    <script>
        $('#example1 tbody').on('click', 'button.undo-btn', function () {
            var gig_id = $(this).data('id');
            /*alert(gig_id);*/
            $('#gig_id').val(gig_id);

            $.ajax({
                type: 'get',
                data: 'gig_id='+gig_id,
                url: "{{route('adminSinglePackage')}}",
                success: function(res){
                    // alert(res);
                    /*console.log(res);*/
                    $('#gig_title').html(res.title);
                    $('#gig_price').html(res.price);
                }
            })
        });
        $('#undoModal').on('click', '#yes_gig_undo', function () {

            var gig_id = $('#gig_id').val();

            $.ajax({
                type: 'get',
                data: 'gig_id='+gig_id,
                url: "{{ route('adminUndoPackage') }}",
                beforeSend: function(){ $('#yes_gig_undo').empty().html('Please wait...')},
                success: function(res){
                    if(res != 0){
                        location.reload();
                    }
                    else{
                        alert('Ops! some thing goes wrong.. Please try again.')
                    }
                }
            })
        })
    </script>

@endsection