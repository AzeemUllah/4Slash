<style>
    .agency-wallet:hover, .side-buttons:hover{
        background: #367fa9;
    }
    .agency-wallet{
        margin:10px 0;
        font-size: 16px;
    }
    /*.agency-wallet:nth-child(4){
        background: #97dcfd !important;
    }
    .agency-wallet:nth-child(4):hover{
        background: #367fa9 !important;
    }
    .agency-wallet:nth-child(3){
        background: #4cb6e8;
    }
    .agency-wallet:nth-child(3):hover{
        background: #367fa9 !important;
    }*/
</style>
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Bestellungen / Orders</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked agency-side-menu" style="border-bottom: 5px solid #ECF0F5;">
                <li style="{{!empty($_GET['status']) && $_GET['status'] == "pending" ? 'border-left: 4px solid #3c8dbc' : '' }}"><a href="{{ route('agencyorderslist') }}?status=pending" id="btnPending" data-url=""><img src="{{ url('/') .'/img/pending.png' }}" style="margin-right: 4px"  width="24" height="24" data-reload="inprogress"> in Bearbeitung / Pending </a></li>
                {{--<span class="label label-primary pull-right">12</span>--}}
                {{--<span class="label label-warning pull-right">65</span>--}}
            </ul>
            <ul class="nav nav-pills nav-stacked">
                <li style="{{Request::segment(2) == "gig-suggestion" ? 'border-left: 4px solid #3c8dbc' : '' }}"><a href="{{ route('gigsuggestion') }}"><img src="{{ url('/') .'/img/Untitled-1 copy.PNG' }}" width="24" height="24" data-reload="inprogress" style="margin-right: 4px"> Favor Vorschlag /Suggest a favor</a></li>
            </ul>
            <ul class="nav nav-pills nav-stacked">
                <li style="{{Request::segment(2) == "suggested_gigs" ? 'border-left: 4px solid #3c8dbc;border-bottom: 5px solid #ECF0F5' : 'border-bottom: 5px solid #ECF0F5' }}"><a href="{{ route('suggestedgigs') }}"><img src="{{ url('/') .'/img/fav_grn.png' }}" width="24" height="24" data-reload="inprogress" style="margin-right: 4px"> Meine favors/ Suggested favors</a></li>
            </ul>
            <ul class="nav nav-pills nav-stacked">
                <li style="{{Request::segment(2) == "package-suggestion" ? 'border-left: 4px solid #3c8dbc' : '' }}"><a href="{{ route('packageuggestion') }}"><img src="{{ url('/') .'/img/packageSuggestion.png' }}" width="24" height="24" data-reload="inprogress" style="margin-right: 4px"> Paket-Vorschlag /Suggest Package</a></li>
            </ul>
            <ul class="nav nav-pills nav-stacked">
                <li style="{{Request::segment(2) == "suggested_packages" ? 'border-left: 4px solid #3c8dbc;border-bottom: 5px solid #ECF0F5' : 'border-bottom: 5px solid #ECF0F5' }}"><a href="{{ route('suggestedpackages') }}"><img src="{{ url('/') .'/img/pack_grn.png' }}" width="24" height="24" data-reload="inprogress" style="margin-right: 4px"> Meine Pakete / Suggested Packages</a></li>
            </ul>
            <ul class="nav nav-pills nav-stacked">
                <li style="{{!empty($_GET['status']) && $_GET['status'] == "complete" ? 'border-left: 4px solid #3c8dbc;border-bottom: 5px solid #ECF0F5' : 'border-bottom: 5px solid #ECF0F5' }}"><a href="{{ route('agencyorderslist') }}?status=complete" id="btnCompleted" data-url=""><img src="{{ url('/') .'/img/completed.png' }}" style="margin-right: 4px" width="24" height="24" data-reload="inprogress"> Fertig / Completed </a></li>
            </ul>
        </div><!-- /.box-body -->
    </div><!-- /. box -->
    <div class="agency-wallet">
        <a href="{{ route('userHistory') }}"> <span class="discrip">Provision / Commission</span><span class="pull-right wallet">&euro; {{ \Illuminate\Support\Facades\Auth::agency()->get()->wallet }} </span></a>
    </div>
    <div class=" agency-wallet" style="width: 100%;">
        <a href="{{ route('agencyprofile') }}"  ><span class="discrip">Agentur Profil / Agency Profile</span></a>
    </div>
    <div class="agency-wallet" style="width: 100%;">
        <a href="{{ route('agencycontactform') }}"  ><span class="discrip">Kontakt / Contact to cnerr</span></a>
    </div>
    <div class="agency-wallet" style="width: 100%;">
        <a href="{{ route('agency.business') }}"><span class="discrip">Geschäftsmodell / Business Model</span></a>
    </div>
    <div class="agency-wallet" style="width: 100%;">
        <a href="{{ url('/').'/bower_components/files/user_manual_new.pdf' }}" target="_blank"><span class="discrip">FAQ</span></a>
    </div>
    <div class="col-xs-12" style="background-color: white">
        <ul style="list-style-type: none; color: #367fa9;padding: 0px;line-height: 2;font-size: 13px;">
            <li><b>Gutes Design ist innovativ.</b></li>
            <li>(Good design is innovative.)</li>
            <li><b>Gutes Design macht ein Produkt brauchbar.</b></li>
            <li>(Good design makes a product useful.)</li>
            <li><b>Gutes Design ist ästhetisch.</b></li>
            <li>(Good design is aesthetic.)</li>
            <li><b>Gutes Design macht ein Produkt verständlich.</b></li>
            <li>(Good design makes a product understandable.)</li>
            <li><b>Gutes Design ist unaufdringlich.</b></li>
            <li>(Good design is unobtrusive.)</li>
            <li><b>Gutes Design ist ehrlich.</b></li>
            <li>(Good design is honest.)</li>
            <li><b>Gutes Design ist langlebig.</b></li>
            <li>(Good design is long-lasting.)</li>
            <li><b>Gutes Design ist konsequent bis ins letzte Detail.</b></li>
            <li>(Good design is thorough down to the last detail.)</li>
            <li><b>Gutes Design ist umweltfreundlich.</b></li>
            <li>(Good design is environmentally friendly.)</li>
            <li><b>Gutes Design ist so wenig Design wie möglich.</b></li>
            <li>(Good design is as little design as possible.)</li>
            <li style="float: right">by Dieter Rams</li>
        </ul>
    </div>
</div><!-- /.col -->