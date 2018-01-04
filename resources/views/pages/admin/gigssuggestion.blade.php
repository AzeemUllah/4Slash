@extends('pages.admin.admin_template')


@section('header_title')

    @if(!empty($gigs) && $gigs)
        <h1>Suggested favors</h1>
    @elseif(!empty($packages) && $packages)
        <h1>Suggested Packages</h1>
    @endif


@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header text-right">
                    <a href="{{ route('gigcreate') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    @if(!empty($gigs) && $gigs)
                        <div class="col-xs-12 text-center">
                            <label for="agency">Search by Agency</label>
                            <select name="" id="agency">
                                <option value="all">All</option>
                                @foreach($agent as $agency)
                                    <option value="{{$agency->id}}">{{$agency->username}}</option>
                                @endforeach
                            </select>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Suggest</th>
                                <th>Suggested by</th>
                                {{--<th>Short Discription</th>--}}
                                <th>Category</th>
                                <th>Delivery Days</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="form-gigs-body-container">
                            @foreach($gigs as $gig)
                                <tr class="data-row" data-agname="{{ $gig->agency['username'] }}">
                                    <td>{!! (date('d-m-Y', strtotime($gig->created_at)) == date('d-m-Y')) ? '<i class="fa fa-star" style="color: #157340;"></i>' : '' !!} {{ $gig->id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($gig->created_at)) }}<br> {{ date('h:m:i', strtotime($gig->created_at)) }}</td>
                                    <td>{{ $gig->title }}</td>
                                    @if($gig->auto_assign == 0)
                                        <td style="background-color: rgb(251, 221, 10); color: black;">Not assigned</td>
                                    @else
                                        <td style="background-color: rgb(21, 115, 64); color: black;">Assigned</td>
                                    @endif
                                    @if(!empty($gig->agency))
                                        <td>{{ $gig->agency->username }}</td>
                                    @else
                                        <td>No one</td>
                                    @endif
                                    {{--<td>{{ $gig->short_discription }}</td>--}}
                                    <td>{{ $gig->type->name}}
                                        {{--<br>({{ $gig->subtype->name  }})--}}
                                    </td>
                                    <td>{{ $gig->delivery_days }}</td>
                                    <td>

                                        <form style="display: inline-block;" method="get" action="{{ route('gigcreate') }}">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="favors" value="suggestfavor">
                                            <input type="hidden" name="funnel" value="{{ $gig->uuid }}">
                                            <button type="submit" class="btn btn-default btn-xs" {{$gig->status == 'enabled' ? 'disabled':''}}><span class="fa fa-pencil"></span></button>
                                        </form>
                                        <form id="formGigActivate1" method="post" action="{{ route('gig.accept') }}">
                                            <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                            @if($gig->status == 'enabled')
                                                <button type="button" class="btn btn-success btn-xs btn-gig-activate1" {{$gig->status == 'enabled' ? 'disabled':''}}>Accepted</button>
                                            @elseif($gig->status == 'disabled')
                                                <button type="button" class="btn btn-success btn-xs btn-gig-activate1">Accept</button>
                                            @if($gig->rejection == 0)
                                                <button style="margin-top:10px;" type="button" data-toggle="modal" data-target="#rejectModal" class="btn btn-danger btn-xs btn-gig-reject-btn">Reject</button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-xs rejected-btn">Rejected</button>
                                            @endif
                                                    <!-- Modal -->
                                                <!--End Modal-->
                                            @endif
                                            @if($gig->status == 'enabled')
                                                <i class="fa fa-lock" aria-hidden="true" style="color: #00dd00;"></i>
                                            @endif
                                        </form>
                                        <form id="formGigActivate" method="post" action="{{ route('gig.activate') }}">
                                            <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                            @if($gig->status == 'enabled')
                                                @if($gig->active != 4)
                                                    @if(!$gig->active)
                                                        <button type="button" class="btn btn-danger btn-xs btn-gig-activate">Make it live</button>
                                                    @else
                                                        <button type="button" class="btn btn-success btn-xs btn-gig-activate" disabled>Online</button>
                                                    @endif
                                                @else
                                                    <button type="button" class="btn btn-danger btn-xs" id="agency-offline">Offline by Agency</button>
                                                @endif
                                            @endif
                                        </form>
                                        <div class="modal fade bs-example-modal-sm" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <form action="" method="post" id="gig-rejection-form">
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
                                                                          rows="5" style="width: 100%;"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <input type="hidden" id="reject-gig-id" name="gig-id" value="{{ $gig->id }}">
                                                            <button type="submit" class="btn btn-primary">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <form id="formGigFeatured" method="post" action="{{ route('gig.featured') }}">
                                             <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                             @if(!$gig->featured)
                                                 <button type="button" class="btn btn-primary btn-xs btn-gig-featured">Featured</button>
                                             @else
                                                 <button type="button" class="btn btn-success btn-xs btn-gig-featured">Featured</button>
                                             @endif
                                         </form>--}}
                                        {{--@if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                            <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn" data-toggle="modal" data-id="{{ $gig->id }}" data-target="#myModal"></button>
                                        @endif--}}
                                        {{--<button data-id="{{ $gig->id }}" data-url="{{ route('adminGigDelete') }}" class="btn btn-danger btn-xs btn-del"><span class="fa fa-trash-o"></span></button>--}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    @elseif(!empty($packages) && $packages)
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Package Type</th>
                                <th>Suggested By</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($packages as $package)
                                <tr>
                                    @if(!empty($package->type))
                                        <td>{{ $package->title }}</td>
                                        <td>{{ config('app.currency') }}{{ number_format($package->price,2) }}</td>
                                        <td>{{ $package->type->name }}</td>
                                        <td>
                                            @if(!empty($package->agency))
                                                {{ $package->agency->username }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('packageUpdate',['packageId' => $package->packages_id]) }}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>
                                            <form id="formGigAccept" method="post" action="{{ route('package.accept') }}" style="padding-bottom: 10px; padding-top: 10px;">
                                                <input type="hidden" name="package-id" value="{{ $package->id }}">
                                                @if($package->status == 'disabled')
                                                    <button type="button" class="btn btn-danger btn-xs btn-package-accept">Pending</button>
                                                @elseif($package->status == 'enabled')
                                                    <button type="button" class="btn btn-success btn-xs btn-package-accept">Accepted</button>
                                                @endif
                                            </form>
                                            {{--<button class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span></button>--}}
                                            @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                                <button data-id="{{ $package->id }}"  data-url="{{ route('pakagedelete') }}" class="btn btn-danger btn-xs pakage-delete"><span class="fa fa-trash-o"></span></button>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
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
<div class="modal fade bs-example-modal-sm" id="rejectModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="" method="post" id="gig-rejection-form1">
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
                        <textarea class="form-control" id="rejection_reason1" cols="38"
                                  rows="5" style="width: 100%;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                    <input type="hidden" class="reject-gig-id-jquery" id="reject-gig-id1" name="gig-id" value="">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
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
                "aaSorting": [],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                iDisplayLength: -1
            });
            var table = $("#example2").DataTable({
                "aaSorting": [],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                iDisplayLength: -1
            });
//      Button Delete
//            $('#example1 tbody').on('click', 'button.btn-del', function() {
//                //var conf = confirm ("Are you sure you want to delete from the database?");
//                if(!confirm('Are you sure you want to delete the gig?')){
//                    e.preventDefault();
//                    return false;
//                }
//                else{
//
//                var button = $(this);
//
//                var rowId = button.data('id');
//
//                $.ajax({
//                    method: 'DELETE',
//                    url: button.data('url'),
//                    data: { gig_id: rowId },
//                }).done(function(data) {
//                    if(data != 0) {
//                        //notifyMessage('Gig Deleted Successfully.', 'success');
//                        $.notify({
//                            // options
//                            message: 'Gig Deleted Successfully'
//                        }, {
//                            // settings
//                            placement: {
//                                from: 'bottom',
//                                align: 'right'
//                            },
//                            type: 'success'
//                        });
//
//                        table.row(button.parents('tr')).remove().draw();
//
//
//                    } else {
//                        //notifyMessage('Gig Deleting failed please try again.', 'danger')
//                        $.notify({
//                            // options
//                            message: 'Gig Deleting failed please try again'
//                        },{
//                            // settings
//                            placement: {
//                                from: 'bottom',
//                                align: 'right'
//                            },
//                            type: 'danger'
//                        });
//                    }
//                });
//
//            }});


            $('#example2 tbody').on('click', '.btn-package-accept', function(e) {
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
                        if(data.status != 0) {
                            $(thisbutton).html("Accepted");
                            thisbutton.classList.remove('btn-danger');
                            thisbutton.classList.add('btn-success');
                        } else {
                            $(thisbutton).html("Pending");
                            thisbutton.classList.remove('btn-success');
                            thisbutton.classList.add('btn-danger');
                        }

                        //clickedElement.removeAttribute('disabled');
                    }
                });


            })


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
            $('#example1 tbody').on('click', '.btn-gig-activate1', function(e) {

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
                        if(data.status == 'enabled') {
                            $(thisbutton).html("Accepted");
                            thisbutton.classList.remove('btn-danger');
                            thisbutton.classList.add('btn-success');
                        } else if(data.status == 'disabled') {
                            $(thisbutton).html("Pending");
                            thisbutton.classList.remove('btn-success');
                            thisbutton.classList.add('btn-danger');
                        }
                        location.reload();
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
            $('#example1 tbody').on('click', '#yes_gig_delete', function(){

                var gig_id = $('#gig_id').val();

                $.ajax({
                    type: 'get',
                    data: 'gig_id='+gig_id,
                    url: "{{ route('adminTrashGig') }}",
                    beforeSend: function(){ $('#yes_gig_delete').empty().html('Please wait...')},
                    success: function(res){
                        console.log(res);
                        if(res > 0){
                            location.reload();
                        }
                        else{
                            alert('Ops! some thing goes wrong.. Please try again.')
                        }
                    }
                })
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
                            $(thisbutton).html("Online");
                            thisbutton.classList.remove('btn-danger');
                            thisbutton.classList.add('btn-success');
                        } else if(data.status == 0) {
                            $(thisbutton).html("Make it live");
                            thisbutton.classList.remove('btn-success');
                            thisbutton.classList.add('btn-danger');
                        }

                        //clickedElement.removeAttribute('disabled');
                    }
                });


            });
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
//            $('#agency-offline').click(function(){
//                alert("normaly an admin is not allowed to do that but you want to do anyway?");
//            });
//            $('.agency-offline').click(function(){
//                alert("normaly an admin is not allowed to do that but you want to do anyway?");
//            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            function my_call() {
                $(".reject-btn-jquery").click(function () {
                    var id = $(this).data("id");
                    $(".reject-gig-id-jquery").val(id);
                });
            }
           $("#gig-rejection-form").on('submit', function(e){
               var reject_reason = $("textarea#rejection_reason").val();
               var gig_id = $("#reject-gig-id").val();
               e.preventDefault();
              $.ajax({
                 method : "post",
                  url   : "{{ route('gigrejection.admin') }}",
                  data  : {gig_id : gig_id, reject_reason : reject_reason},
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
            $("#gig-rejection-form1").on('submit', function(e){
                var reject_reason = $("textarea#rejection_reason1").val();
                var gig_id = $("#reject-gig-id1").val();
                e.preventDefault();
                $.ajax({
                    method : "post",
                    url   : "{{ route('gigrejection.admin') }}",
                    data  : {gig_id : gig_id, reject_reason : reject_reason},
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
        $(".rejected-btn").click(function(){
            alert("This gig was already rejected!");
        });
        $("#agency").on('change',function(){
           var val = $(this).val();
           var table = $("#example1 tbody.form-gigs-body-container");
           $.ajax({
               method : "post",
               url    : "{{ route('filter.search') }}",
               data   : 'gig-id='+val,
               dataType : "json",
               success : function(res){
                   table.empty();
                   var link = "{{ route('gigcreate') }}";
                   var gig_accept_link = "{{ route('gig.accept') }}";
                   res.forEach(function(object){
                        var _html = "<tr><td>"+object.id+"</td>"
                            _html += "<td>"+object.created_at+"</td>"
                            _html += "<td>"+object.title+"</td>"
                       if(object.auto_assign != 0) {
                           _html += "<td style='background-color: rgb(21, 115, 64); color: black;'>Assigned</td>"
                       }else{
                           _html += "<td style='background-color: rgb(251, 221, 10); color: black;'>Not assigned</td>"
                       }
                           _html += "<td>"+object.username+"</td>"
                           /*_html += "<td>"+object.short_discription+"</td>"*/
                           _html += "<td>"+object.name+"</td>"
                           _html += "<td>"+object.delivery_days+"</td>"
                            if(object.status == "enabled") {
                                _html += "<td>" +
                                    "<form style='display: inline-block;' method='get' action='" + link + "'>" +
                                    "<input type='hidden' name='action' value='update'>" +
                                    "<input type='hidden' name='favors' value='suggestfavor'>" +
                                    "<input type='hidden' name='funnel' value='" + object.uuid + "'>" +
                                    "<button type='submit' class='btn btn-default btn-xs' disabled><span class='fa fa-pencil'></span></button>" +
                                    "</form>" +
                                    "<button type='button' class='btn btn-success btn-xs btn-gig-activate1' disabled>Accepted</button>"+
                                    "<i class='fa fa-lock' aria-hidden='true' style='color: #00dd00;'></i>"
                                if(object.active != 4){
                                _html +="<form id='formGigActivate' method='post' action='{{ route('gig.activate') }}'>"
                                _html +="<input type='hidden' name='gig-id' value='"+object.id+"'>"
                                    if(!object.active){
                                        _html +="<button type='button' style='margin-top:10px;' class='btn btn-danger btn-xs btn-gig-activate'>Make it live</button>"
                                    }else{
                                        _html +="<button type='button' class='btn btn-success btn-xs btn-gig-activate' disabled>Online</button>"
                                    }
                                }else{
                                    _html += "<button type='button' class='btn btn-danger btn-xs' id='agency-offline'>Offline by Agency</button>"
                                }
                                    _html +="</td></tr>"
                            }else{
                                _html += "<td>" +
                                    "<form style='display: inline-block;' method='get' action='" + link + "'>" +
                                    "<input type='hidden' name='action' value='update'>" +
                                    "<input type='hidden' name='favors' value='suggestfavor'>" +
                                    "<input type='hidden' name='funnel' value='" + object.uuid + "'>" +
                                    "<button type='submit' class='btn btn-default btn-xs'><span class='fa fa-pencil'></span></button>" +
                                    "</form>" +
                                    "<form id='formGigActivate1' style='margin:0px;' method='post' action='"+gig_accept_link+"'>"+
                                    "<input type='hidden' name='gig-id' value='"+object.id+"'>"+
                                    "<button type='button' class='btn btn-success btn-xs btn-gig-activate1'>Accept</button>"+
                                    "</form>";
                                if(object.rejection == 0){
                                    _html +="<button style='margin-top:10px;' onclick='"+my_call()+"' type='button' data-toggle='modal' data-target='#rejectModal2' data-id='"+object.id+"' class='btn btn-danger btn-xs btn-gig-reject-btn reject-btn-jquery'>Reject</button>"
                                }else{
                                    _html +="<button type='button' class='btn btn-danger btn-xs rejected-btn'>Rejected</button>"
                                }
                                _html +="</td></tr>"
                            }

                           table.append(_html);
                      /*console.log(object);*/
                   });
               }
           });
        });
        $(document).on('click','.reject-btn-jquery', function(){
           var id = $(this).data('id');
           $("#reject-gig-id1").val(id);
        });
        });
    </script>

@endsection