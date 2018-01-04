<ul class="dash-list">
    <li>
        <a href="#">
            @if(!empty($user->profile_image))
                <img src="{{ $user->profile_image }}" class="img-circle dash-user-login-image" style="width: 75px;height: 75px;">
            @else
                <div class="img-circle dash-user-login-image" style="display:flex;align-items:center;width:75px;height:75px;background-color:#797979;color:white;padding:5px;"><span style="font-size:45px;">{{ $user->username[0] }}</span></div>
            @endif
            <span class="username-color">{{ $user->username }}
            </span>
        </a>
        <p style="margin-top: -20px; margin-bottom: 30px; color:#909090;">
            {{--Some Useful Links--}}
        </p>
    </li>


</ul>
 
<script>
    $('.drop_down').click(function(){

        $('.cancel_order').toggle();
    })
    </script>