@extends('pages.admin.admin_template')


@section('header_title')
        <h1>Charges</h1>
@endsection

<style>
    /* .gig-images-box-body img{
         width:120px;
         flaot:left;
         margin-right:5px;
     }*/
</style>


@section('content')
    @if (\Illuminate\Support\Facades\Session::has('succes-charges'))
        <p class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('succes-charges') }}
            {{ \Illuminate\Support\Facades\Session::forget('succes-charges') }}
    @endif
    @if (\Illuminate\Support\Facades\Session::has('succes-error'))
        <p class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('succes-error') }}
            {{ \Illuminate\Support\Facades\Session::forget('succes-error') }}
        </p>
    @endif
        <form method="post" action="{{ route('charges.update') }}">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bank">Bank Charges</label>
                    <input type="text" name="bank" id="bank" class="form-control" value="{{ $query ? $query->bank_services : '' }}">
                </div>
                <div class="form-group">
                    <label for="paypal">Paypal Charges</label>
                    <input type="text" name="paypal" id="paypal"class="form-control" value="{{ $query ? $query->paypal_services : '' }}">
                </div>
                <div class="form-group">
                    @if($query)
                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-md">
                    @else
                        <input type="submit" name="submit" value="Add" class="btn btn-primary btn-md">
                    @endif
                </div>
            </div>
        </form>

@endsection



@section('pages_css')

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/select2/select2.min.css') }}">

@endsection



@section('pages_script')


@endsection
