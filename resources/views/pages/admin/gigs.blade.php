@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Favors</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12 has-pending" style="display: none;">
            <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <span class="pending-order"></span>
        </div>
        </div>
        @if(\Illuminate\Support\Facades\Session::get('gig-empty'))
        <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <p>{{\Illuminate\Support\Facades\Session::get('gig-empty')}}</p>
                {{\Illuminate\Support\Facades\Session::forget('gig-empty')}}
            </div>
        </div>
        @endif
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
                <div class="box-header text-right">
                    <a href="{{ route('gigcreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Title</th>
                            {{--<th>Discription</th>--}}
                            {{--<th>Short Discription</th>--}}
                            <th>Category</th>
                            <th>Delivery Days</th>
                            <th>Actions</th>
                            <th>Created by</th>
                            <th>Update at</th>
                            <th>Update By</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th colspan="9" style="text-align:left; display: none" class="no-match">No Record Found</th>
                        </tr>
                        </tfoot>
                        <tbody class="form-gigs-body-container">
                        @foreach($gigs as $gig)
                            <tr class="data-row" data-agname="{{$gig->suggested_by}}">
                                <td>{!! (date('d-m-Y', strtotime($gig->created_at)) == date('d-m-Y')) ? '<i class="fa fa-star" style="color: #157340;"></i>' : '' !!} {{ $gig->id }}</td>
                                <td>{{ date('d-m-Y', strtotime($gig->created_at)) }}<br> {{ date('h:m:i', strtotime($gig->created_at)) }}</td>
                                <td>{{ $gig->title }}</td>
                                {{--<td>{{ $gig->short_discription }}</td>--}}
<!--                                --><?php
//                                $desc = explode('<p></p>', $gig->discription );
//                                foreach ($desc as $discription){
//                                    echo "<td>$discription</td>";
//                                }
//                                ?>
                                <td>{{ \App\Gigtype::find($gig->gigtype_id)->name }}</td>
                                <td>{{ $gig->delivery_days }}</td>
                                <td>
                                    {{--<button class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></button>--}}
                                    <form id="formGigActivate" method="post" action="{{ route('gig.activate') }}">
                                        <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                        @if(!$gig->active)
                                            <button type="button" class="btn btn-danger btn-xs btn-gig-activate">Deactivated</button>
                                        @else
                                            <button type="button" class="btn btn-success btn-xs btn-gig-activate">Activated</button>
                                        @endif
                                    </form>
                                    <form id="formGigFeatured" method="post" action="{{ route('gig.featured') }}">
                                        <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                        @if(!$gig->featured)
                                            <button type="button" class="btn btn-primary btn-xs btn-gig-featured">Featured</button>
                                        @else
                                            <button type="button" class="btn btn-success btn-xs btn-gig-featured">Featured</button>
                                        @endif
                                    </form>
                                    <form style="display: block;" method="get" action="{{ route('gigcreate') }}">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="favors" value="favors">
                                        <input type="hidden" name="funnel" value="{{ $gig->uuid }}">
                                        <button type="submit" class="btn btn-info btn-xs" style="width: 75%; height:20px;"><span class="fa fa-pencil"></span></button>
                                    </form>
                                    <button data-id="{{ $gig->id }}" data-url="{{ route('adminTrashGig') }}" class="btn btn-danger btn-xs btn-del">Trash</button>
                                </td>
                                <td class="created_by">{{ $created_by[$gig->id] }}</td>
                                <td>{{ date('d-m-Y', strtotime($gig->updated_at)) }}<br> {{ date('h:m:i', strtotime($gig->updated_at)) }}</td>
                                <td>{{ \App\user::where(['id' => $gig->update_by])->first()['username'] }}</td>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </div>
                    <div class="modal-body">
                        <h3>Are you sure want to delete this favor?</h3>
                        <input type="hidden" name="gig_id" value="" id="gig_id">
                        <!-- select -->
                      <div class="row">
                          <div class="col-md-4">Title</div>
                          <div class="col-md-8" id="gig_title"></div>
                      </div>
                        <div class="row">
                            <div class="col-md-4">Short Description</div>
                            <div class="col-md-8" id="gig_desc"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Delivery Days</div>
                            <div class="col-md-8" id="gig_time"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Price</div>
                            <div class="col-md-8" id="gig_price"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" id="yes_gig_delete">Yes</button>
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
            $("#example1").DataTable({
                "order": [],
				"bStateSave": true,
                "oLanguage": {
                    "sSearch": "Search Favors"
                },
                "iDisplayLength": -1
            });

            var table = $('#example').dataTable();

            /*$('#agency').on('change',function(){
                var cat = $(this);
                var catId = cat.val();
                if(catId != '') {
                    $('.data-row').hide();
                    $('.data-row').each(function () {
                        if ($(this).data('agname') == catId) {
                            $(this).show();
                        }
                    });
                }else{
                    $('.data-row').show();
                }
            });*/
//      Button Delete
            $('#example1 tbody').on('click', 'button.btn-del', function(e) {
                //var conf = confirm ("Are you sure you want to delete from the database?");
                if(!confirm('Are you sure you want to move this gig to trash?')){
                    e.preventDefault();
                    return false;
                }
                else{

                var button = $(this);

                var rowId = button.data('id');

                $.ajax({
                    method: 'get',
                    url: button.data('url'),
                    data: { gig_id: rowId },
                }).done(function(data) {
                    if(data != 0) {
                        //notifyMessage('Gig Deleted Successfully.', 'success');
                        $.notify({
                            // options
                            message: 'Gig added to trash'
                        }, {
                            // settings
                            placement: {
                                from: 'bottom',
                                align: 'right'
                            },
                            type: 'success'
                        });

                        window.location.reload();


                    } else {
                        //notifyMessage('Gig Deleting failed please try again.', 'danger')
                        $.notify({
                            // options
                            message: 'Gig Deleting failed please try again'
                        },{
                            // settings
                            placement: {
                                from: 'bottom',
                                align: 'right'
                            },
                            type: 'danger'
                        });
                    }
                });

            }});
            $('#example1 tbody').on('click', '.btn-gig-featured', function(e) {

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
                $('#example1 tbody').on('click', '.btn-gig-activate', function(e) {
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

        });
    </script>
    <script>
        $(document).ready(function(){
            $('#example1 tbody').on('click', '.trash-btn', function(e){
                var gig_id = $(this).data('id');

                $('#gig_id').val(gig_id);

                $.ajax({
                    type: 'get',
                    data: 'gig_id='+gig_id,
                    url: "{{route('adminSingleGig')}}",
                    success: function(res){
                      // alert(res);
                        //console.log(res);
                        $('#gig_title').html(res.title);
                        $('#gig_desc').html(res.discription);
                        $('#gig_time').html(res.delivery_days);
                        $('#gig_price').html(res.price);
                    }
                })
            });
            $('#myModal').on('click', '#yes_gig_delete', function(){

                var gig_id = $('#gig_id').val();

                $.ajax({
                    type: 'get',
                    data: 'gig_id='+gig_id,
                    url: "{{ route('adminTrashGig') }}",
                    beforeSend: function(){ $('#yes_gig_delete').empty().html('Please wait...')},
                    success: function(res){
                        if(res.has_pending){
                            $('#myModal').modal('hide');
                            $('.has-pending').show();
                            $('.pending-order').html(res.has_pending)
                        }
                        else if(res > 0){
                            location.reload();
                        }
                        else{
                            $('#myModal').modal('hide');
                            alert('Ops! some thing goes wrong.. Please try again.')
                        }
                    }
                })
            });
            $("#agency").on('change',function(){
                var val = $(this).val();
                var table = $("#example1 tbody.form-gigs-body-container");
                $.ajax({
                    method : "post",
                    url    : "{{ route('filter.search.all') }}",
                    data   : 'gig-id='+val,
                    dataType : "json",
                    success : function(res){
                        table.empty();
                        var link = "{{ route('gig.activate') }}";
                        var gig_accept_link = "{{ route('gig.accept') }}";
                        var featured_link = "{{route('gig.featured')}}";
                        var gig_create = "{{ route('gigcreate') }}";
                        res.forEach(function(object){
                            var _html = "<tr><td>"+object.id+"</td>";
                            _html += "<td>"+object.created_at+"</td>";
                            _html += "<td>"+object.title+"</td>";
                            /*if(object.auto_assign != 0) {
                                _html += "<td style='background-color: rgb(21, 115, 64); color: black;'>Assign</td>"
                            }else{
                                _html += "<td style='background-color: rgb(251, 221, 10); color: black;'>Not assign</td>"
                            }*/
                            /*_html += "<td>"+object.short_discription+"</td>"*/
                            _html += "<td>"+object.name+"</td>";
                            _html += "<td>"+object.delivery_days+"</td>";
                            if(!object.active) {
                                _html += "<td>";
                                _html += "<form id='formGigActivate' style='display: inline-block;' method='post' action='" + link + "'>";
                                _html += "<input type='hidden' name='gig-id' value='"+object.id+"'>";
                                _html += "<button type='button' class='btn btn-danger btn-xs btn-gig-activate'>Deactivated</button>";
                                _html += "</form>"

                            }else{
                                _html += "<td>";
                                _html += "<form id='formGigActivate' style='display: inline-block;' method='post' action='" + link + "'>";
                                _html += "<input type='hidden' name='gig-id' value='"+object.id+"'>";
                                _html += "<button type='button' class='btn btn-success btn-xs btn-gig-activate'>Activated</button>";
                                _html += "</form>"
                            }
                            if(!object.featured){
                                _html +="<form id='formGigFeatured' method='post' action='"+featured_link+"'>";
                                _html +="<input type='hidden' name='gig-id' value='"+object.id+"'>";
                                _html +="<button type='button' class='btn btn-primary btn-xs btn-gig-featured'>Featured</button>";
                                _html +="</form>";
                            }else{
                                _html +="<form id='formGigFeatured' method='post' action='"+featured_link+"'>";
                                _html +="<input type='hidden' name='gig-id' value='"+object.id+"'>";
                                _html +="<button type='button' class='btn btn-success btn-xs btn-gig-featured'>Featured</button>";
                                _html +="</form>";
                            }
                                <?php if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin'){?>
                                _html +="<button type='button' class='btn btn-danger btn-xs fa fa-trash-o trash-btn' data-toggle='modal' data-id='"+object.id+"' data-target='#myModal'></button>"
                                <?php } ?>
                                _html+="<form style='display: inline-block;' method='get' action='"+gig_create+"'>";
                                _html+="<input type='hidden' name='action' value='update'>";
                                _html+="<input type='hidden' name='favors' value='favors'>";
                                _html+="<input type='hidden' name='funnel' value='"+object.uuid+"'>";
                                _html+="<button type='submit' class='btn btn-default btn-xs'><span class='fa fa-pencil'></span></button>";
                                _html+="</form>";
                                _html += "</td>";
                                _html +="<td>Agency:"+object.agency_name+"</td>";
                                _html +="<td>"+object.updated_at+"</td>";
                                _html +="<td>"+object.username+"</td>";
                                _html +="</td></tr>";


                            table.append(_html);
                            /*console.log(object);*/
                        });
                    }

                });
            });
        });
    </script>

@endsection