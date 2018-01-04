@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Agencies</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <ul class="nav nav-tabs" role="tablist">
                    {{--<li role="presentation" class="@if(!empty($_GET['agency'])){{ ($_GET['agency']=="review")? 'active':'' }}@else active @endif">
                        @if(!empty($agenciesRequest_count > 0))
                            <span class="badge count_request" style="position: absolute; right: 4px; bottom: 28px; z-index: 1;">{{ $agenciesRequest_count }}</span>
                        @endif
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Request
                            </a>
                    </li>--}}
                    <li role="presentation" class="@if(!empty($_GET['agency'])){{ ($_GET['agency']=="all")? 'active':'' }}@endif">
                        @if($agenciesRegistration_count > 0)
                            <span class="badge count_active" style="position: absolute; right: 4px; bottom: 28px; z-index: 1;">{{ $agenciesRegistration_count }}</span>
                        @endif
                        <a href="#application" class="@if(!empty($_GET['agency'])){{ ($_GET['agency']=="all")? 'active':'' }}@endif" aria-controls="application" role="tab" data-toggle="tab">Agency Applications
                        </a>
                    </li>
                    <li role="presentation" class="@if(!empty($_GET['agency'])){{ ($_GET['agency']=="active")? 'active':'' }}@endif">
                        @if($newagencycount > 0)
                        <span class="badge count_active" style="position: absolute; right: 4px; bottom: 28px; z-index: 1;">{{ $newagencycount }}</span>
                        @endif
                        <a href="#home" class="@if(!empty($_GET['agency'])){{ ($_GET['agency']=="active")? 'active':'' }}@endif" aria-controls="home" role="tab"
                                                              data-toggle="tab">Active Agencies
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane @if(!empty($_GET['agency'])){{ ($_GET['agency']=="active")? 'active':'' }}@endif" id="home">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Active Agencies</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                </div>
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Details</th>
                                        <th>Current Jobs</th>
                                        <th>Completed Jobs</th>
                                        {{--<th>Email</th>
                                        <th>Date of Joining</th>--}}
                                        <th>Percentage</th>
                                        <th>Mother Agency / %</th>
                                        <th>Favors / Packages</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($agencies as $agency)
                                        <tr>
                                            <td>{{ $agency->id }}</td>
                                            <td>
                                                <span>Name :{{ $agency->username }}</span><br>
                                                <span>Email :{{ $agency->email }}</span><br>
                                                <span>Joining Date :{{ $agency->updated_at }}</span><br>
                                                <span>Country :{{ !empty($agency['agency_additional']->country) ?  $agency['agency_additional']->country : '' }}</span><br>
                                                <span>Rating :
                                                        @if($agency['total'] > 0)
                                                            @if($agency['rating'] <= 1)
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                             @elseif($agency['rating'] >1 && $agency['rating'] <=2 )
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($agency['rating'] >2 && $agency['rating'] <=3 )
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($agency['rating'] >3 && $agency['rating'] <=4 )
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($agency['rating'] >4 && $agency['rating'] <=5 )
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endif
                                                        @else
                                                        <img src="{{ url('/') }}/img/no_rate.png" alt="" width="60px;">
                                                        @endif
                                                </span>
                                            </td>
                                            <td>{{ $agency['pendingOrders'] }}</td>
                                            <td>{{ $agency['completed'] }}</td>
                                            {{--<td>{{ $agency->email }}</td>
                                            <td>{{ $agency->updated_at }}</td>--}}
                                            <td>{{ $agency->agency_percentage }}%</td>
                                            <td>{{ !empty(\App\User::find($agency->referr_agency)->username) ? \App\User::find($agency->referr_agency)->username : '' }} / {{ $agency->refer_percent }}%</td>
                                            <td>{{ $agency['favors'] }} / {{ $agency['packages'] }}</td>
                                            <td>
                                                {{--<button class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></button>--}}
                                                <a href="{{ route('admin.agency', ['agencyMail' => $agency->email]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                <a href="{{ route('agency.update', ['agencyEmail' => $agency->email]) }}" class="btn btn-default btn-xs"><span class="fa fa-pencil"></span></a>
                                                {{--@if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                                                    <button class="btn btn-danger btn-xs btn-del" data-url="{{ route('deleteAgency') }}" data-id="{{ $agency->id }}"><span class="fa fa-trash-o"></span></button>
                                                @endif--}}
                                                <form id="formagencyActivate" method="post" action="{{ route('agency.activate') }}">
                                                    <input type="hidden" name="agency_id" value="{{ $agency->id }}">
                                                    @if(!$agency->active)
                                                        <button type="button" class="btn btn-danger btn-xs btn-agency-activate">Deactivated</button>
                                                    @else
                                                        <button type="button" class="btn btn-success btn-xs btn-agency-activate">Activated</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div><!-- /.box-body -->
                     </div>
                    <div role="tabpanel" class="tab-pane @if(!empty($_GET['agency'])){{ ($_GET['agency']=="review")? 'active':'' }}@endif" id="profile">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Agencies Request</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $l_i = 1; ?>
                                    @foreach($agenciesRequest as $agency)
                                        <tr>
                                            <td>{!! (date('d-m-Y', strtotime($agency->created_at)) == date('d-m-Y')) ? '<i class="fa fa-star" style="color: #157340;"></i>' : '' !!}{{ $l_i++ }}</td>
                                            <td>{{ $agency->name }}</td>
                                            <td>{{ $agency->email }}</td>
                                            <td>{{ $agency->subject }}</td>
                                            <td>{{ $agency->message }}</td>
                                            <td>{{ $agency->created_at}}</td>
                                            <td>
                                                @if($agency->status == 'accepted')
                                                  <button class="btn btn-success btn-xs btn-accept" data-url="{{ route('agency.AcceptRequest', ['agencyEmail' => $agency->email]) }}" data-id="{{ $agency->id }}">Request Accepted </button>
                                                 @else
                                                    <?php
                                                    $date_time = explode(' ', $agency->created_at);
                                                    $date_time = explode('-', $date_time[0]);
                                                    $date_time = $date_time[0].'-'.$date_time[1].'-'.$date_time[2];
                                                        $current_date = date("Y-m-d");
                                                    $diff = abs(strtotime($current_date) - strtotime($date_time));
                                                    $day = 60*60*24;
                                                    $MONTH = $day*30;
                                                    $YEAR = $day*365;

                                                    $years = floor($diff / ($YEAR));
                                                    $months = floor(($diff - $years * $YEAR) / ($MONTH));
                                                    $days = floor(($diff - $years * $YEAR - $months*$MONTH ) / ($day));
                                                    ?>
                                                @if($days > 0)
                                                            <button class="btn btn-danger btn-xs btn-accept" data-url="{{ route('agency.AcceptRequest', ['agencyEmail' => $agency->email]) }}" data-id="{{ $agency->id }}">Accept Request</button>
                                                @else
                                                  <button class="btn btn-primary btn-xs btn-accept" data-url="{{ route('agency.AcceptRequest', ['agencyEmail' => $agency->email]) }}" data-id="{{ $agency->id }}">Accept Request</button>
                                                @endif
                                                @endif
                                                    <button class="btn btn-success btn-xs btn-resend" data-url="{{ route('agency.resend.email') }}" data-id="{{ $agency->email }}">Resend email </button>
                                                    <button class="btn btn-danger btn-xs btn-del" data-url="{{ route('deleteInactiveAgency') }}" data-id="{{ $agency->id }}"><span class="fa fa-trash-o"></span></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane @if(!empty($_GET['agency'])){{ ($_GET['agency']=="all")? 'active':'' }}@endif" id="application">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Registered Agencies</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Skills</th>
                                    <th>Attachments</th>
                                    <th>View form</th>
                                    <th>First Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($agenciesRegistration as $agency)
                                    <tr>
                                        <td>{{ $agency->email }}</td>
                                        <td>{{ $agency->skills }}</td>
                                        <td>{!! $agency->attachment !!}</td>
                                        <td><a href="{{route('agency.datarequest',['agencyEmail' => $agency->email])}}" class="btn btn-primary btn-xs">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                        </td>
                                        <td>{{ $agency->f_name }}</td>
                                        <td>
                                            @if($agency->active == 1)
                                           <button class="btn btn-success btn-xs" data-url="{{ route('agency.AcceptRequest', ['agencyEmail' => $agency->email]) }}" data-id="{{ $agency->id }}">Request Accepted </button>
                                            @else
                                                <button class="btn btn-primary btn-xs btn-accept-agency" data-url="{{ route('agency.Accept.Request')}}" data-id="{{ $agency->agency_id }}">Accept request</button>
                                            @endif
                                            <button class="btn btn-danger btn-xs btn-delete" data-url="{{ route('delete.Agency.additional') }}" data-id="{{ $agency->id }}"><span class="fa fa-trash-o"></span></button>
                                            <button class="btn btn-success btn-xs btn-resend" data-url="{{ route('agency.AcceptRequest', ['agencyEmail' => $agency->email]) }}" data-id="{{ $agency->agency_id }}">Resend email </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                                </div>


                        </div>
                    </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
   </div><!-- /.row -->
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
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": []
            });
            var table2 = $("#example2").DataTable();
            var table3 = $("#example3").DataTable();

            $('#example1 tbody, #example2 tbody').on('click', 'button.btn-del', function() {

                if(!confirm('Are you sure you want to permanently delete this agency?'))
                {
                    return false;
                }
                else {
                var button = $(this);
                var Id = button.data('id');

                    $.ajax({

                        method: 'get',
                        url: button.data('url'),
                        data: {agency_id: Id},
                    }).done(function (data){
                        console.log(data);
                        if(data > 0)
                        {
                            $.notify({
                                // options
                                message: 'Agency Deleted Successfully'

                            }, {
                                // settings
                                placement: {
                                    from: 'bottom',
                                    align: 'right'
                                },
                                type: 'success'
                            });
//                            location.reload();
//                            table.row($(this).parents('tr') ).remove();
                            $(this).parent('tr').hide();
                        }
                        else {
                            //notifyMessage
                            $.notify({
                                // options
                                message: 'Agency have some pending orders cannot delete at this moment!'
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
//                    table.row( $(this).parents('tr') ).remove().draw();
                    if(table2.row( $(this).parents('tr') ).remove().draw()){
                        var val = $(".count_request").text();
                        var new_val = val-1;
                        $(".count_request").empty();
                        $(".count_request").text(new_val);
                    }else{
                        var val = $(".count_active").text();
                        var new_val = val-1;
                        $(".count_active").empty();
                        $(".count_active").text(new_val);
                    }

                }

            });
            $('#example3 tbody').on('click', 'button.btn-delete', function() {
                if(!confirm('Are you sure you want to permanently delete this agency?'))
                {

                    return false;
                }
                else {
                var button = $(this);
                var Id = button.data('id');
                    $.ajax({

                        method: 'get',
                        url: button.data('url'),
                        data: {agency_id: Id},
                    }).done(function (data){
//                        console.log(data);
                        if(data > 0)
                        {
                            $.notify({
                                // options
                                message: 'Agency Deleted Successfully'

                            }, {
                                // settings
                                placement: {
                                    from: 'bottom',
                                    align: 'right'
                                },
                                type: 'success'
                            });
                            location.reload();

                        }
                        else {
                            //notifyMessage
                            $.notify({
                                // options
                                message: 'Agency Deleting failed please try again'
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

            });
            $('#example2 tbody , #example3 tbody').on('click', 'button.btn-accept', function() {
                var button = $(this);
                var url =  button.data('url');
                var Id = button.data('id');
                /*alert(Id);*/
                    $.ajax({

                        method: 'get',
                        url: url,
                        data: {agency_id: Id},
                    }).done(function (data){
                        if(data != 0)
                        {
                            button.addClass('btn-success');
                            button.text('Request Accepted')
                            $.notify({
                                // options
                                message: 'Email Sent Successfully'

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
                                message: 'Failed please try again'
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


            });
            $('#example2 tbody').on('click', 'button.btn-resend', function() {
                var button = $(this);
                var url =  button.data('url');
                var Id = button.data('id');
                $.ajax({

                    method: 'post',
                    url: url,
                    data: {agency_id: Id},
                }).done(function (data){
                    if(data != 0)
                    {
                        button.addClass('btn-success');
                        button.text('Request Accepted');
                        $.notify({
                            // options
                            message: 'Email Sent Successfully'

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
                            message: 'Failed please try again'
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


            });
            $('#example3 tbody').on('click', 'button.btn-accept-agency', function() {
                var button = $(this);
                var url =  button.data('url');
                var Id = button.data('id');
                /*alert(url);*/
                $.ajax({

                    method: 'post',
                    url: url,
                    data: {'agency_id' : Id}
                }).done(function (data){
                    if(data != 0)
                    {
                        button.addClass('btn-success');
                        button.text('Request Accepted');
                        $.notify({
                            // options
                            message: 'Email Sent Successfully'

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
                            message: 'Failed please try again'
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


            });
            $('#example1 tbody').on('click', '.btn-agency-activate', function(e) {
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
                        /*console.log(data);*/
                        if(data == 0){
                            //notifyMessage
                            $.notify({
                                // options
                                message: 'Agency have some pending work cannot delete right now!'
                            }, {
                                // settings
                                placement: {
                                    from: 'bottom',
                                    align: 'right'
                                },
                                type: 'danger'
                            });
                        }else {
                            if (data.status == 1) {
                                $(thisbutton).html("Activated");
                                thisbutton.classList.remove('btn-danger');
                                thisbutton.classList.add('btn-success');
                            } else if (data.status == 0) {
                                $(thisbutton).html("Deactivated");
                                thisbutton.classList.remove('btn-success');
                                thisbutton.classList.add('btn-danger');
                            }
                        }

                        //clickedElement.removeAttribute('disabled');
                    }
                });


            })
        });
    </script>

@endsection
