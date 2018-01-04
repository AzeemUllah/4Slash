@extends('pages.agency.agency_template')
<style>
    .zero-padd{
        padding: 10px 0px !important;
        font-size: 12px;
        color: #3c8dbc;
        font-weight: 600;
    }
    .zero-margg{
        margin: 0px !important;
        background: white;
    }
    .border{
       /* border-top: 1px solid #3c8dbc;
        border-left: 1px solid #3c8dbc;*/
        border-right: 2px solid #d2d6de;
    }
    #gig_desc{
        overflow: hidden;
    }
    #gig_desc p{
        overflow: hidden;
    }
    /*.border-right{
        border-left: 1px solid #3c8dbc;
        border-top: 1px solid #3c8dbc;
        border-right: 1px solid #3c8dbc;
    }*/
</style>
@section('header_title')

    <h1 style="padding: 0px 10px;">Dashboard</h1>

@endsection
@section('content')
    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="col-sm-9 col-xs-12">
            @if(!empty($gigs) && $gigs)
                <div class="row zero-margg">
                    <div class="col-md-2 col-xs-12 text-center zero-padd border">
                        <p style="color:#fbd22a; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_saved }}</p>
                        <p>Drafted</p>
                    </div>
                    <div class="col-md-6 col-xs-12 text-center zero-padd border">
                        <p style="color:grey; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_admin_approval_waiting }}</p>
                        <p>Waiting for admin approval / In process by admin</p>
                    </div>
                    <div class="col-md-2 col-xs-12 text-center zero-padd border">
                        <p style="color:red; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_rejected }}</p>
                        <p>Rejected</p>
                    </div>
                    {{--<div class="col-md-2 col-xs-12 text-center zero-padd border">
                        <p style="color:orange;">{{ $get_online_soon }}</p>
                        <p>Online soon</p>
                    </div>--}}
                    <div class="col-md-2 col-xs-12 text-center zero-padd border-right">
                        <p style="color:#12c112; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_activated }}</p>
                        <p>Activated</p>
                    </div>
                </div>
            @endif
            @if(!empty($packages) && $packages)
                <div class="row zero-margg">
                    <div class="col-md-2 col-xs-12 text-center zero-padd border">
                        <p style="color:#fbd22a; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_saved_package }}</p>
                        <p>Drafted</p>
                    </div>
                    <div class="col-md-6 col-xs-12 text-center zero-padd border">
                        <p style="color:grey; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_admin_approval_waiting_package }}</p>
                        <p>Waiting for admin approval / In process by admin</p>
                    </div>
                    <div class="col-md-2 col-xs-12 text-center zero-padd border">
                        <p style="color:red; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_rejected_package }}</p>
                        <p>Rejected</p>
                    </div>
                    {{--<div class="col-md-2 col-xs-12 text-center zero-padd border">
                        <p style="color:orange;">{{ $get_online_soon }}</p>
                        <p>Online soon</p>
                    </div>--}}
                    <div class="col-md-2 col-xs-12 text-center zero-padd border-right">
                        <p style="color:#12c112; font-size: 50px;line-height: 0.8em; margin: 0px;">{{ $get_activated_package }}</p>
                        <p>Activated</p>
                    </div>
                </div>
            @endif
            <div class="box box-primary table-responsive" id="boxMain">
                <div class="box-header with-border">
                    @if (\Illuminate\Support\Facades\Session::has('succ_msg'))
                        <p class="alert alert-success">
                            {{ \Illuminate\Support\Facades\Session::get('succ_msg') }}<br/>Thank you for your favor
                            proposal ! We will consider your offer !
                        </p>
                    @endif

                    @if (\Illuminate\Support\Facades\Session::has('succ_msg_pack'))
                        <p class="alert alert-success">
                            {{ \Illuminate\Support\Facades\Session::get('succ_msg_pack') }}<br/>Thank you for your
                            package proposal ! We will consider your offer !
                        </p>
                    @endif

                    @if (\Illuminate\Support\Facades\Session::has('gig_deletion_failed'))
                        <p class="alert alert-danger">
                            {{ \Illuminate\Support\Facades\Session::get('gig_deletion_failed') }}
                         <?php \Illuminate\Support\Facades\Session::forget('gig_deletion_failed');?>
                        </p>
                    @endif

                    <h3 class="box-title">Suggestion</h3>
                </div>
                <div class="box-body">
                    @if(!empty($gigs) && $gigs)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Favor Id</th>
                                <th>Title</th>
                                {{--<th>Short Discription</th>--}}
                                {{--<th>Discription</th>--}}
                                <th>Category<br>(Subcategory)</th>
                                <th>Delivery Days</th>
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Sale</th>
                            </tr>
                            </thead>
                            <tbody class="form-gigs-body-container">
                            @foreach($gigs as $gig)
                                <tr>
                                    <td>{!! (date('d-m-Y', strtotime($gig->created_at)) == date('d-m-Y')) ? '<i class="fa fa-star" style="color: #157340;"></i>' : '' !!}  {{ $gig->id }}</td>
                                    <td>{{ $gig->title }}</td>
{{--                                    <td>{{ $gig->short_discription }}</td>--}}
                                    <?php
/*                                        $desc = explode('<p></p>', $gig->discription );
                                        foreach ($desc as $discription){
                                            echo "<td>$discription</td>";
                                        }
                                    */?>
                                    <td>{{ \App\Gigtype::find($gig->gigtype_id)->name }}<br>@if(!empty($gig['subcat']->name))({{ $gig['subcat']->name}})@endif</td>
                                    <td>{{ $gig->delivery_days }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-xs fa fa-trash-o trash-btn"
                                                data-toggle="modal" data-id="{{ $gig->id }}"
                                                data-target="#myModal" {{$gig->status == 'enabled' ? 'disabled':''}}></button>

                                        <form style="display: inline-block;" method="get"
                                              action="{{ route('gigsuggestion') }}">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="gigUUID" value="{{ $gig->uuid }}">
                                            <button type="submit" class="btn btn-default btn-xs"
                                                    {{$gig->status == 'enabled' ? 'disabled':''}} data-id="{{ $gig->id }}"><span
                                                        class="fa fa-pencil"></span></button>
                                        </form>
                                        @if($gig->status == 'enabled')
                                            <i class="fa fa-lock" aria-hidden="true" style="color: #00dd00;"></i>
                                        @endif
                                        @if($gig->active != 0)
                                            <div class="fb-share-button"
                                                 data-href="{{ route ('gigdetail',['gigType' => \App\Gigtype::find($gig->gigtype_id)->slug, 'gig' => $gig->slug ]) }}?funnel={{ $gig->uuid }}"
                                                 data-layout="button" data-mobile-iframe="true"><a
                                                        class="fb-xfbml-parse-ignore" target="_blank"
                                                        href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <form id="formGigActivate" method="post" action="{{ route('gig.activate') }}">
                                            <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                            @if($gig->status == "saved")
                                                    Drafted
                                            @else
                                                @if($gig->rejection == 1)
                                                    Rejected
                                                @if(!empty($gig['reason']->reason))
                                                    <i class="fa fa-exclamation-circle" style="color:red;" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ $gig['reason']->reason }}"></i>
                                                @endif
                                                @else
                                                    @if($gig->active == 0)
                                                        Waiting for admin approval<br>
                                                        @if($gig->active == 0)
                                                            @if($gig->status == "enabled")
                                                            (Online soon)
                                                            @endif
                                                        @endif
                                                    @else
                                                        Activated
                                                    @endif
                                                @endif
                                            @endif
                                        </form>
                                        @if($gig->active != 0)
                                            <a style="background: #367fa9;" target="_blank" href="{{ route ('gigdetail',['gigType' => \App\Gigtype::find($gig->gigtype_id)->slug, 'gig' => $gig->slug ]) }}?funnel={{ $gig->uuid }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($gig->active != 0)
                                        <form>

                                            <div class="radio">

                                                <label><input type="radio" data-id="{{ $gig->id }}" name="auto_assign"
                                                              class="auto_agency_yes"
                                                              value="1" @if($gig->auto_assign == 1)  {{ 'checked' }} @endif>
                                                    Yes</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" data-id="{{ $gig->id }}" name="auto_assign"
                                                              class="auto_agency_yes"
                                                              value="0" @if($gig->auto_assign == 0)  {{ 'checked' }} @endif>
                                                    No</label>
                                            </div>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    @elseif(!empty($packages) && $packages)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($packages as $package)
                                <tr>
                                    @if(!empty($package))
                                        <td>{{ $package->id }}</td>
                                        <td>{{ $package->title }}</td>
                                        <td>
                                            @if($package->save == 1 && $package->status == "disabled" && $package->active == 0)
                                                Drafted
                                            @endif
                                            @if(($package->status) == "disabled" && $package->save == 0)
                                                Waiting for admin approval
                                            @else
                                                @if($package->active == 0 && $package->status == "enabled")
                                                Accepted(Online soon)
                                                @endif
                                                @if($package->active == 1 && $package->status == "enabled")
                                                    Activated
                                                @endif
                                            @endif
                                            @if(($package->status) == "rejected")
                                                Rejected
                                                    @if(!empty($package['reason']->reason))
                                                        <i class="fa fa-exclamation-circle" style="color:red;" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ $package['reason']->reason }}"></i>
                                                    @endif
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{($package->status) == "enabled" ? 'javascript:void(0)': route('agencypackageUpdate',['packageId' => $package->packages_id]) }}"
                                               class="btn btn-default btn-xs" {{$package->status == "enabled" ? 'disabled' : ''}} data-id="{{ $package->id }}">
                                                <span class="fa fa-pencil"></span>
                                            </a>

                                                <button class="btn btn-danger btn-xs pakage-delete" data-toggle="modal"
                                                        data-target="{{ $package->status == "enabled" ? 'disabled' : '#myModal1' }}" {{ $package->status == "enabled" ? 'disabled' : '' }} data-id="{{ $package->id }}"><span
                                                            class="fa fa-trash-o"></span>
                                                </button>
                                            @if($package->status == 'enabled')
                                                <i class="fa fa-lock" aria-hidden="true" style="color: #00dd00;"></i>
                                            @endif
                                            @if(!empty($package))
                                                <form action="{{ route('single.package') }}" target="_blank" method="post" style="display: inline-block;">
                                                    <input type="hidden" name="package_name" value="{{ $package->title }}">
                                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                    <button class="btn btn-primary btn-xs" type="submit">
                                                        <i class="fa fa-eye btn btn-primary btn-xs"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($package->active != 0)
                                                <div class="fb-share-button"
                                                     data-href="{{ route('fb.single.package',['packageId' => $package->id]) }}"
                                                     data-layout="button" data-mobile-iframe="true"><a
                                                            class="fb-xfbml-parse-ignore" target="_blank"
                                                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
                                                </div>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                </div><!-- /.box-body -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    @endsection

            <!-- Modal -->
    @if(!empty($gig->id))
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
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
                        <button type="submit" class="btn btn-primary" id="yes_gig_delete" data-id=""
                                data-url="{{ route('agencyDeleteGig') }}">Yes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @elseif (!empty($package->id))
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel1">Delete</h4>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure want to delete this package?</h3>
                        <input type="hidden" name="gig_id" value="" id="gig_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" id="yes_gig_delete1" data-id="{{ $package->id }}"
                                data-url="{{ route('agencypakagedelete') }}">Yes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

        @section('pages_css')

                <!-- DataTables -->
        <link rel="stylesheet"
              href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
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

        <!-- page script -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#example1 tbody').on('click', '.trash-btn', function (e) {
                    var gig_id = $(this).data('id');

                    $('#gig_id').val(gig_id);
                    /*$("#yes_gig_delete").data('id',gig_id);*/
                    $('#yes_gig_delete').attr('data-id', gig_id);
                    $.ajax({
                        type: 'post',
                        url: "{{route('agencySingleGig')}}",
                        data: {gig_id : gig_id},
                        success: function (res) {
                            $('#gig_title').html(res.title);
                            $('#gig_desc').html(res.discription);
                            $('#gig_time').html(res.delivery_days);
                            $('#gig_price').html(res.price);
                        }
                    })
                });
                $('#myModal').on('click', '#yes_gig_delete', function (e) {

                    //var conf = confirm ("Are you sure you want to delete from the database?");
                    if (!confirm('Are you sure you want to delete the favor?')) {
                        e.preventDefault();
                        return false;
                    }
                    else {

                        var button = $(this);
                        var rowId = $('#gig_id').val();
                        $.ajax({
                            method: 'DELETE',
                            url: button.data('url'),
                            data: {gig_id: rowId}
                        }).done(function (data) {
                            if (data != 0) {

                                //notifyMessage('Gig Deleted Successfully.', 'success');
                                location.reload();


//                            button.parent().remove().draw();

                                //table.row(button.parents('tr')).remove().draw();


                            } else {
                                //notifyMessage('Gig Deleting failed please try again.', 'danger')
                                $.notify({
                                    // options
                                    message: 'favor Deleting failed please try again'
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
                        table.row($(this).parents('tr')).remove().draw();

                    }

                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#example1 tbody').on('click', '.btn-gig-featured', function (e) {

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
                        success: function (data) {
                            if (data.status == 1) {

                                thisbutton.classList.remove('btn-primary');
                                thisbutton.classList.add('btn-success');
                            } else if (data.status == 0) {
                                thisbutton.classList.remove('btn-success');
                                thisbutton.classList.add('btn-primary');
                            }

                            //clickedElement.removeAttribute('disabled');
                        }
                    });
                });
                $('#example1 tbody').on('click', '.btn-gig-activate', function (e) {
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
                        success: function (data) {
                            console.log(data);
                            if (data.status == 1) {
                                $(thisbutton).html("Activated");
                                thisbutton.classList.remove('btn-danger');
                                thisbutton.classList.add('btn-success');
                            } else if (data.status == 0) {
                                $(thisbutton).html("Deactivated");
                                thisbutton.classList.remove('btn-success');
                                thisbutton.classList.add('btn-danger');
                            }

                            //clickedElement.removeAttribute('disabled');
                        }
                    });


                });
                $('#myModal1').on('click', '#yes_gig_delete1', function (e) {

                    //var conf = confirm ("Are you sure you want to delete from the database?");
                    if (!confirm('Are you sure you want to delete the package?')) {
                        e.preventDefault();
                        return false;
                    }
                    else {

                        var button = $(this);
                        var rowId = button.data('id');
                        var url = button.data('url');
                        $.ajax({
                            method: 'POST',
                            url: url,
                            data: {package_id: rowId}
                        }).done(function (data) {
                            if (data > 0) {
                                $(this).hide();
                                location.reload();
                            } else {
                                alert("Package can not delete!");
                            }
                        });
                        /*table.row($(this).parents('tr')).remove().draw();*/

                    }

                });
            });
        </script>
        <script>


            $(document).ready(function () {
                /*$('#example1 tbody').on('click', '.trash-btn', function (e) {
                    var gig_id = $(this).data('id');

                    $('#gig_id').val(gig_id);

                    $.ajax({
                        type: 'get',
                        data: 'gig_id=' + gig_id,
                        url: "{{route('adminSingleGig')}}",
                        success: function (res) {
                            // alert(res);
                            //console.log(res);
                            $('#gig_title').html(res.title);
                            $('#gig_desc').html(res.discription);
                            $('#gig_time').html(res.delivery_days);
                            $('#gig_price').html(res.price);
                        }
                    })
                });*/




                setInterval(function(){

                    $.get('/agency/checkGigsStatus', function(res){


                        $.each(res, function(key, data){

                            if(data.status == 'enabled'){
                                $('button[data-id="'+data.id+'"]').attr('disabled', 'disabled');

                            } else {
                                $('button[data-id="'+data.id+'"]').removeAttr('disabled', 'disabled');
                            }
                        });
                    });

                    $.get('/agency/checkPackagesStatus', function(res){


                        $.each(res, function(key, data){

                            if(data.status == 'enabled'){
                                $('button[data-id="'+data.id+'"]').attr('disabled', 'disabled');
                                $('a[data-id="'+data.id+'"]').attr('disabled', 'disabled');

                            } else {
                                $('button[data-id="'+data.id+'"]').removeAttr('disabled', 'disabled');
                                $('a[data-id="'+data.id+'"]').removeAttr('disabled', 'disabled');
                            }
                        });
                    })

                }, 1000);

            });

        </script>
@endsection