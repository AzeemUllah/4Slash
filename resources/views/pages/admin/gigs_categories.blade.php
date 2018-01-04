@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Favors Categories</h1>

@endsection




@section('content')

        <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <h3>Are you sure want to delete this Category?</h3>
                    <input type="hidden" name="gig_id" value="" class="gig_id">
                    <!-- select -->
                    <div class="row">
                        <div class="col-md-4">Title</div>
                        <div class="col-md-8" id="gig_title"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Short Description</div>
                        <div class="col-md-8" id="gig_desc"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary yes_gig_delete" id="yes_gig_delete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    <a href="{{ route('admingigscategoriescreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="table-gig-category" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gigs_categories as $gig_category)
                            <tr>
                                <td>{{ $gig_category->name }}</td>
                                <td>
                                    <form id="formGigDelete" class="form-gig-category-delete" method="post" action="{{ route('admingigscategoriesdelete') }}">
                                        <input type="hidden" name="gig-category-id" value="{{ $gig_category->id }}">
                                        <a href="{{ route('admingigscategoriescreate') . '?id=' . $gig_category->id . '&action=update' }}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>
{{--
                                        <button type="button" class="btn btn-danger category-delete btn-xs fa fa-trash-o"></button>

--}}                                   @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                        <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $gig_category->id }}" data-target="#myModal"></button>
                                       @endif
                                        <!--<button type="button" class="btn btn-warning btn-xs glyphicon glyphicon-remove"></button>-->
                                    </form>
                                    <form id="formGigActivate" method="post" action="{{ route('gigsCategoriesActivate') }}">
                                        <input type="hidden" name="Cat-gig-id" value="{{ $gig_category->id }}">
                                        @if(!$gig_category->active)
                                            <button type="button" class="btn btn-danger btn-xs btn-gig-activate">Deactivated</button>
                                        @else
                                            <button type="button" class="btn btn-success btn-xs btn-gig-activate">Activated</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                    <section class="content-header" style="background-color: #ecf0f5; padding-bottom: 12px;">
                        <h1> Select Featured Category </h1>
                    </section>
                    <?php $j = 1; ?>
                    @for($i = 0; $i<4; $i++)
                    <div class="form-group col-sm-3">

                        <label>Featured {{ $j }}</label>
                        <select id="category{{ $i }}" name="position{{ $i }}" class="form-control">

                            <option value="{{ $featured_gigs[$i]->id }}">{{ $featured_gigs[$i]->name }}</option>
                            @foreach($gigs_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <?php $j++; ?>
                        @endfor

                        <div class="form-group col-md-3">
                        <button type="button" class="btn btn-primary" id="save-features">Save</button>
                        </div>
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
            var table = $("#table-gig-category").DataTable({

                "aaSorting": []
            });

            $('#table-gig-category tbody').on('click', '.btn-gig-activate', function(e) {
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


            $('#save-features').click(function(e) {

                e.preventDefault();

                var cat0 = $('#category0').val();
                var cat1 = $('#category1').val();
                var cat2 = $('#category2').val();
                var cat3 = $('#category3').val();

                $.ajax({
                    type: 'post',
                    data: {'cat1': cat1, 'cat2': cat2, 'cat3': cat3, 'cat0': cat0 },
                    url: '{{ route("category.featured")}}',
                    success: function(res){
                        if(res == 1){
                            alert('featured category updated');
                        }
                        else{
                            alert('nothing changed');
                        }
                    }



                });


            });



        })

        $(function() {
                $('#table-gig-category').on('click','.category-delete', function (e) {
                        if(!confirm('Are you sure you want to delete the gig category?'))
                        {
                            return false;
                        }
                        else {
                        var form = e.target.parentNode;
                        var formData = new FormData(form);

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
                                        message: 'Gig Category Delete Successfully.'
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
                                        message: 'Gig Category Deleting failed please try later.'
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
                });
             })
    </script>

    <script>
        $(document).ready(function(){
            $('.trash-btn').click(function(){


                var gig_id = $(this).data('id');

                $('.gig_id').val(gig_id);

                $.ajax({
                    type: 'get',
                    data: 'gig_id='+gig_id,
                    url: "{{route('adminCatSingleGig')}}",
                    success: function(res){
                        // alert(res);
                        console.log(res);
                        $('#gig_title').html(res.name);
                        $('#gig_desc').html(res.description);

                    }
                })
            });

            $('.yes_gig_delete').click(function(){

                var gig_id = $('.gig_id').val();

                $.ajax({
                    type: 'get',
                    data: 'gig_id='+gig_id,
                    url: "{{ route('adminCatTrashGig') }}",
                    beforeSend: function(){ $(this).empty().html('Please wait...')},
                    success: function(res){
                        console.log(res);
                        if(res > 0){
                            location.reload();
                        }
                        else{
                            alert('Ops! some thing goes wrong.. Please try again.')
                        }
                    }
                });
            })
        })
    </script>


@endsection