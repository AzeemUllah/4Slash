@include('includes.header')
<div class="dash-main-content" style="min-height: 800px;">
    <div class="login-modal">
        <div class="modal-signin">

            @if(\Illuminate\Support\Facades\Session::has('status'))
                <div class="alert alert-success"
                     role="alert">{{ \Illuminate\Support\Facades\Session::get('status') }}</div>
                {{ \Illuminate\Support\Facades\Session::forget('status') }}
            @endif
            @if(\Illuminate\Support\Facades\Session::has('successMessage_title'))
                <div class="alert alert-success" role="alert">
                    <h4 style="font-size:18px;">{{ \Illuminate\Support\Facades\Session::get('successMessage_title') }}</h4>
                    <h4 style="font-size:18px;">{{ \Illuminate\Support\Facades\Session::get('successMessage_subtitle') }}</h4>
                    <h4 style="font-size:18px;">{{ \Illuminate\Support\Facades\Session::get('successMessage_subtitle2') }}</h4>
                </div>
                {{ \Illuminate\Support\Facades\Session::forget('successMessage_title, successMessage_subtitle') }}
            @endif

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".cnerr-footer-background-color").css({"position": "absolute", "left": "0px","right":"0px","bottom":"0px"});
    })
</script>
@include('includes.footer')
