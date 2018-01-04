@extends('pages.agency.agency_template')

@section('header_title')
    {{--@if($agency->request_withdraw == 1)
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>
                <span>Your request for the amount withdraw has been submitted</span>
                <br>
                <span>The accounts department contact you as soon as possible</span>
            </h4>
            <h4><i class="icon fa fa-check"></i>
                <span>Ihre Anfrage zur Übersendung der Provisionen ist eingereicht worden.</span>
                <br>
                <span>Die Buchhaltung meldet sich in Kürze bei Ihnen zurück.</span>
            </h4>
        </div>
    @endif--}}
    @if(\Illuminate\Support\Facades\Session::has('success_settins'))
        <div class="alert alert-success text-center" role="alert">
            <p>{{ \Illuminate\Support\Facades\Session::get('success_settins') }}</p>
        </div>
    @endif
    <h1>Profile</h1>

@endsection

@section('content')

    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="col-sm-9 col-xs-12">
            <div class="box box-info table-responsive">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user text-center" style="height:70px;margin: 0px;">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active" style="height:auto !important">
                        <h3 class="widget-user-username">
                            <span class="pull-left label label-success">Wallet Amount {{config('app.currency')}}{{ number_format($agency->wallet,2) }}</span>
                            <span>{{ $agency->name }}<br>
                                @if($total > 0)
                                    @if($rating <= 1)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rating >1 && $rating <=2 )
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rating >2 && $rating <=3 )
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rating >3 && $rating <=4 )
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rating >4 && $rating <=5 )
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endif
                                @else
                                    <img src="{{ url('/') }}/img/no_rate.png" alt="" width="70px;">
                                @endif
                                                </span>
                            <a href="{{ route('agencyDetailsUpdate') }}" class="btn btn-danger btn-sm pull-right"><span
                                        class="fa fa-pencil"></span></a>
                        </h3>
                        <h5 class="widget-user-desc"></h5>
                    </div>
                    {{--<div class="widget-user-image">
                        <img class="img-circle" src="http://placehold.it/128x128" alt="User Avatar">
                    </div>--}}
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        {{--<div class="col-sm-4">--}}
                        {{--<div class="description-block">--}}
                        {{--<h5 class="description-header"></h5>--}}
                        {{--<span class="description-text">--}}
                        {{--<!-- Button trigger modal -->--}}
                        {{--@if(!empty($get_agency_Detail))--}}
                        {{--<button type="button" {{$agency->wallet > 0 ? '':'disabled'}} class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
                        {{--Request Withdraw--}}
                        {{--</button>--}}
                        {{--@else--}}
                        {{--<button type="button" class="btn btn-primary btn-lg" id="pay-details-restrict">--}}
                        {{--Request Withdraw--}}
                        {{--</button>--}}
                        {{--@endif--}}

                        {{--<!-- Modal -->--}}
                        {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
                        {{--<div class="modal-dialog" role="document">--}}
                        {{--<div class="modal-content">--}}
                        {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
                        {{--aria-hidden="true">&times;</span></button>--}}
                        {{--<h4 class="modal-title" id="myModalLabel">Confirm</h4>--}}
                        {{--</div>--}}
                        {{--<div class="modal-body">--}}
                        {{--Do you really want to withdraw Amount?--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                        {{--<form method="post" action="{{ route('request.amount.withdraw') }}" id="amountWithdraw">--}}
                        {{--<input type="hidden" name="agencyId" value="{{ $agency->id }}">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
                        {{--<button type="submit" class="btn btn-primary confirmRequest">Confirm</button>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</span>--}}
                        {{--</div>--}}
                        {{--<!-- /.description-block -->--}}
                        {{--</div>--}}
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
                <div class="box" style="position: static !important;">

                    <div class="box-body">


                        <table class="table table-striped" style="position: relative;top: 5px;">
                            <tr>
                                <td colspan="2">Upload your logo here</td>
                            </tr>
                            <tr>
                                <td>
                                    @if($agency->profile_image)
                                        <img src="{{ url().'/photos/mini/'.$agency->profile_image }}"
                                             style="min-width: 140px; max-width: 140px;">
                                    @endif
                                </td>
                                <td style="padding: 50px 0px;">
                                    <form id="uploadimage" action="{{ route('image.upload') }}" method="post"
                                          enctype="multipart/form-data">
                                        <div id="selectImage">
                                            <label>Select Your Image</label><br/>
                                            <input type="file" name="logo-image" id="file" required
                                                   style="display: inline-block"/>
                                            <input type="submit" value="Upload" class="submit btn btn-primary"
                                                   name="submit"/>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>

                                <td><i class="fa fa-map-marker" style="position: relative;"></i> <span
                                            style="padding-left: 5px;">Firma</span></td>
                                <td>{{ $agencyDetails ? $agencyDetails->agency_name : ''}}</td>

                            </tr>
                            <tr>
                                <td><i class="fa fa-phone" style="position: relative;"></i> <span
                                            style="padding-left: 5px;">Name</span></td>
                                <td>{{ $agency ? $agency->name : '' }}</td>


                            </tr>
                            <tr>

                                <td><i class="fa fa-location-arrow" style="position: relative;"></i> <span
                                            style="padding-left: 5px;">Postal Address</span></td>
                                <td>{{ $agencyDetails ? $agencyDetails->postal_code : ''}}</td>

                            </tr>
                            <tr>

                                <td><i class="fa fa-file-archive-o" style="position: relative;"></i> <span
                                            style="padding-left: 5px;">Skills</span></td>
                                <td>{{ $agencyDetails ? $agencyDetails->skills : ''}}</td>

                            </tr>
                            <tr>
                                <td><i class="fa fa-money"></i> <span style="padding-left: 5px;">Country</span></td>
                                <td>{{$agencyDetails ? $agencyDetails->country : '' }}</td>


                            </tr>
                            {{--   <tr><td><i class="fa fa-mobile" style="position: relative;"></i> <span style="padding-left: 5px;">Mobile</span></td><td>{{ $agencyDetails ? $agencyDetails->mobile : '' }}</td>


                               </tr>
                               <tr>

                                   <td> <i class="fa fa-venus" style="position: relative;"></i>  <span style="padding-left: 5px;">Gender</span></td><td>{{ $agencyDetails ? $agencyDetails->gender : ''}}</td>

                               </tr>
                               <tr>
                                   <td><i class="fa fa-envelope" style="position: relative;"></i> <span style="padding-left: 5px;">Email</span></td><td>{{ $agency->email }}</td>
                               </tr>--}}
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


                <div class="box-header">
                    <h3 class="box-title">Account Settings</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-5">
                        <div class="col-xs-5">
                            <p><b>Order Messages</b></p>
                        </div>
                        <div class="col-xs-7">
                            <div class="onoffswitch1">
                                <input type="checkbox" class="onoffswitch-checkbox1"
                                       id="myonoffswitch1" {{ $agency->email_notify == 1 ? 'checked' :'' }}/>
                                <label class="onoffswitch-label1" for="myonoffswitch1">
                                    <span class="onoffswitch-inner1"></span>
                                    <span class="onoffswitch-switch1"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-5">
                        <div class="col-xs-5">
                            <p><b>Order Status</b></p>
                        </div>
                        <div class="col-xs-7">
                            <div class="onoffswitch3">
                                <input type="checkbox" class="onoffswitch-checkbox3"
                                       id="myonoffswitch3" {{ $agency->order_notify == 1 ? 'checked' :'' }}/>
                                <label class="onoffswitch-label3" for="myonoffswitch3">
                                    <span class="onoffswitch-inner3"></span>
                                    <span class="onoffswitch-switch3"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-xs-5">
                        <form action="{{ route('agency.notify.settings') }}" method="post">
                            <input type="hidden" name="email_notify" value="{{ $agency->email_notify }}"
                                   id="email_notify">
                            <input type="hidden" name="order_notify" value="{{ $agency->order_notify }}"
                                   id="order_notify">
                            <div class="col-md-11 sav-btn">
                                <button type="submit" style="background: #367FA9" class="btn btn-primary">Save
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Payment Details</h3>
                    @if(!empty($get_agency_Detail))
                        <a class="btn btn-sm pull-right btn-danger" data-toggle="modal"
                           data-target="#myModal" style="margin-left:10px;"> <i class="fa fa-pencil"></i>
                        </a>
                    @endif
                </div>

                <div class="box-body">


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active text-center" id="home">
                            @if(empty($get_agency_Detail))
                                <form action="{{!empty($get_agency_Detail)? route('update.pay.details') :   route('pay.details')  }}"
                                      method="post">

                                    <div class="col-sm-6 col-xs-12">
                                        <h3>Account information</h3>
                                        <div class="form-group">
                                            <label for="">Bank Name</label>
                                            <input type="text" name="bank-name" class="form-control"
                                                   placeholder="Enter bank name"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->bank_name : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Number</label>
                                            <input type="text" name="acct-number" class="form-control"
                                                   placeholder="Enter account number"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->acct_number : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Type</label>
                                            <input type="text" name="acct-type" class="form-control"
                                                   placeholder="Enter account type"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->acct_type : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">IBAN#</label>
                                            <input type="text" name="iban" class="form-control"
                                                   placeholder="Enter IBAN"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->iban_number : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Swift code</label>
                                            <input type="text" name="swift" class="form-control"
                                                   placeholder="Enter swift code"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->swiss_code : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <h3>Other information</h3>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" class="form-control"
                                                   placeholder="Enter address"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->bank_address : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="city" class="form-control"
                                                   placeholder="Enter city"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->city : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <input type="text" name="country" class="form-control"
                                                   placeholder="Enter country"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->country : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Postal Code</label>
                                            <input type="text" name="postal" class="form-control"
                                                   placeholder="Enter postal code"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->postal_code : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Paypal Account</label>
                                            <input type="text" name="paypal" class="form-control"
                                                   placeholder="Enter Payapl account id"
                                                   value="{{ ($get_agency_Detail)? $get_agency_Detail->paypal_acct : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="agencyId" value="{{ $agency->id }}">
                                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            @else

                                <div class="col-sm-6 col-xs-12">
                                    <h3 style="background: #dad7d7;">Account information</h3>
                                    <table class="table text-left">
                                        <tbody>
                                        <tr>
                                            <td>Bank name</td>
                                            <td>{{ $get_agency_Detail->bank_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Account number</td>
                                            <td>{{ $get_agency_Detail->acct_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>Account type</td>
                                            <td>{{ $get_agency_Detail->acct_type }}</td>
                                        </tr>
                                        <tr>
                                            <td>IBAN #</td>
                                            <td>{{ $get_agency_Detail->iban_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>Swiss code</td>
                                            <td>{{ $get_agency_Detail->swiss_code }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <h3 style="background: #dad7d7;">Other information</h3>
                                    <table class="table text-left">
                                        <tbody>
                                        <tr>
                                            <td>Bank address</td>
                                            <td>{{ $get_agency_Detail->bank_address }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $get_agency_Detail->city }}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{ $get_agency_Detail->country }}</td>
                                        </tr>
                                        <tr>
                                            <td>Postal code</td>
                                            <td>{{ $get_agency_Detail->postal_code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Paypal</td>
                                            <td>{{ $get_agency_Detail->paypal_acct }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><!-- /.row -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form action="{{  route('update.pay.details') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit payment Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-6 col-xs-12">
                            <h3>Account information</h3>
                            <div class="form-group">
                                <label for="">Bank Name</label>
                                <input type="text" name="bank-name" class="form-control" placeholder="Enter bank name"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->bank_name : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Account Number</label>
                                <input type="text" name="acct-number" class="form-control"
                                       placeholder="Enter account number"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->acct_number : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Account Type</label>
                                <input type="text" name="acct-type" class="form-control"
                                       placeholder="Enter account type"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->acct_type : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">IBAN#</label>
                                <input type="text" name="iban" class="form-control" placeholder="Enter IBAN"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->iban_number : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Swift code</label>
                                <input type="text" name="swift" class="form-control" placeholder="Enter swift code"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->swiss_code : '' }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <h3>Other information</h3>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter address"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->bank_address : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter city"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->city : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Enter country"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->country : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Postal Code</label>
                                <input type="text" name="postal" class="form-control" placeholder="Enter postal code"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->postal_code : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="">Paypal Account</label>
                                <input type="text" name="paypal" class="form-control"
                                       placeholder="Enter Payapl account id"
                                       value="{{ ($get_agency_Detail)? $get_agency_Detail->paypal_acct : '' }}">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <input type="hidden" name="agencyId" value="{{ $agency->id }}">
                            <input type="submit" name="save" value="Save" class="btn btn-primary">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
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
            var table = $("#example2").DataTable();
            var table = $("#example3").DataTable();
        });
    </script>
    <script>

        $(function () {
            $('#amountWithdraw').on('click', ('.confirmRequest'), function (e) {
                e.preventDefault();
                var form = e.target.parentNode;
                ;
                var formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    method: form.method,
                    contentType: false,
                    processData: false,
                    data: formData,
                }).done(function (data) {
                    console.log(data);
                    if (data > 0) {
                        $.notify({
                                    // options
                                    message: 'Request submitted Successfully'

                                },

                                {
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
                            message: 'Request submission failed please try again'
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

            })
        })


    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#pay-details-restrict").click(function () {
                alert("Please add your payment details first!");
            });
        })
    </script>


@endsection