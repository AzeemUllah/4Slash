

@include('includes.header')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        {{--<div class="mr-auto">--}}
            {{--<h3 class="m-subheader__title " style="padding-left: 25px;">--}}
                {{--My Profile--}}
            {{--</h3>--}}
        {{--</div>--}}

    </div>
</div>
<!-- END: Subheader -->
<div class="m-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">
                            Your Profile
                        </div>
                        <h3 class="profile1">My Profile</h3>

                        <div class="m-card-profile__pic">

                            <div class="m-card-profile__pic-wrapper">
                                <img src="{{ $user->profile_image }}" alt=""/>
                            </div>
                        </div>
                       
                        <div class="m-card-profile__details">
												<span class="m-card-profile__name">
													{{  $user->username }}
												</span>
                            <a href="#" class="m-card-profile__email m-link">

                            </a>
                        </div>
                    </div>
                    {{--<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">--}}
                        {{--<li class="m-nav__separator m-nav__separator--fit"></li>--}}
                        {{--<li class="m-nav__section m--hide">--}}
												{{--<span class="m-nav__section-text">--}}
													{{--Section--}}
												{{--</span>--}}
                        {{--</li>--}}
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="profile%26demo%3ddefault.html" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-profile-1"></i>--}}
                                {{--<span class="m-nav__link-title">--}}
														{{--<span class="m-nav__link-wrap">--}}
															{{--<span class="m-nav__link-text">--}}
																{{--My Profile--}}
															{{--</span>--}}
															{{--<span class="m-nav__link-badge">--}}
																{{--<span class="m-badge m-badge--success">--}}
																	{{--2--}}
																{{--</span>--}}
															{{--</span>--}}
														{{--</span>--}}
													{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="profile%26demo%3ddefault.html" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-share"></i>--}}
                                {{--<span class="m-nav__link-text">--}}
														{{--Activity--}}
													{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="profile%26demo%3ddefault.html" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-chat-1"></i>--}}
                                {{--<span class="m-nav__link-text">--}}
														{{--Messages--}}
													{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="profile%26demo%3ddefault.html" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-graphic-2"></i>--}}
                                {{--<span class="m-nav__link-text">--}}
														{{--Sales--}}
													{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="profile%26demo%3ddefault.html" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-time-3"></i>--}}
                                {{--<span class="m-nav__link-text">--}}
														{{--Events--}}
													{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="profile%26demo%3ddefault.html" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-lifebuoy"></i>--}}
                                {{--<span class="m-nav__link-text">--}}
														{{--Support--}}
													{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    <div class="m-portlet__body-separator"></div>
                    <!--<div class="m-widget1 m-widget1&#45;&#45;paddingless">-->
                    <!--<div class="m-widget1__item">-->
                    <!--<div class="row m-row&#45;&#45;no-padding align-items-center">-->
                    <!--<div class="col">-->
                    <!--<h3 class="m-widget1__title">-->
                    <!--Member Profit-->
                    <!--</h3>-->
                    <!--<span class="m-widget1__desc">-->
                    <!--Awerage Weekly Profit-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--<div class="col m&#45;&#45;align-right">-->
                    <!--<span class="m-widget1__number m&#45;&#45;font-brand">-->
                    <!--+$17,800-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="m-widget1__item">-->
                    <!--<div class="row m-row&#45;&#45;no-padding align-items-center">-->
                    <!--<div class="col">-->
                    <!--<h3 class="m-widget1__title">-->
                    <!--Orders-->
                    <!--</h3>-->
                    <!--<span class="m-widget1__desc">-->
                    <!--Weekly Customer Orders-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--<div class="col m&#45;&#45;align-right">-->
                    <!--<span class="m-widget1__number m&#45;&#45;font-danger">-->
                    <!--+1,800-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="m-widget1__item">-->
                    <!--<div class="row m-row&#45;&#45;no-padding align-items-center">-->
                    <!--<div class="col">-->
                    <!--<h3 class="m-widget1__title">-->
                    <!--Issue Reports-->
                    <!--</h3>-->
                    <!--<span class="m-widget1__desc">-->
                    <!--System bugs and issues-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--<div class="col m&#45;&#45;align-right">-->
                    <!--<span class="m-widget1__number m&#45;&#45;font-success">-->
                    <!-- -27,49%-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            @if(\Illuminate\Support\Facades\Session::has('success'))
            <div id="successmessege" class="alert alert-brand alert-dismissible fade show   m-alert m-alert--square m-alert--air" role="alert" style="text-align: center;font-size: 14px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>
                    Well done!
                </strong>

                {{ \Illuminate\Support\Facades\Session::get('success') }} </div>
            @endif
            {{--@if(\Illuminate\Support\Facades\Session::has('success'))--}}
                {{--<div class="alert alert-success"--}}
                     {{--role="alert" style="text-align: center;font-size: 15px;">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>--}}
            {{--@endif--}}
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <a href="{{ route('profile.update') }}" class="m-nav__link">
                        <button type="button" class="btn btn-primary">
                            Edit Profile
                        </button>
                        </a>
                        {{--<li class="m-nav__item">--}}
                            {{--<a href="{{ route('profile.update') }}" class="m-nav__link">--}}
                                {{--<i class="m-nav__link-icon flaticon-multimedia-2"></i>--}}
                                {{--<span class="m-nav__link-text">--}}
																						{{--Edit Profile--}}
																					{{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="m_user_profile_tab_1">
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 m--hide">
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section" style="display: inline-block;">
                                            1. Personal Details
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input " class="col-2 col-form-label labelfield">
                                        Company
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $userDetail ? $userDetail->company : ''}}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input " class="col-2 col-form-label labelfield">
                                        Gender:
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $userDetail ? $userDetail->gender : ''}}</p>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        Name
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $user ? $user->name : ''}}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        Surname*
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $user ? $userDetail->surname : ''}}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        Address / Number *
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $userDetail ? $userDetail->postal_address : ''}}</p>
                                        {{--<span class="m-form__help">--}}
																{{--If you want your invoices addressed to a company. Leave blank to use your full name.--}}
															{{--</span>--}}
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        Country
                                    </label>
                                    <div class="col-7">
                                       <p>{{$userDetail ? $userDetail->country : '' }}</p>
                                    </div>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section" style="display: inline-block;">
                                            2. Address
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        ZIP / City:
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $userDetail ? $userDetail->zip : ''}}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        phone number:
                                    </label>
                                    <div class="col-7">
                                       <p>{{ $userDetail ? $userDetail->phone : '' }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        mobile
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $userDetail ? $userDetail->mobile : '' }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label labelfield">
                                        E-mail
                                    </label>
                                    <div class="col-7">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

                            </div>
                        </form>
                    </div>
                    <div class="tab-pane active" id="m_user_profile_tab_2"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes.footer')


{{--<script>--}}
    {{--$(function () {--}}
        {{--setTimeout(function(){--}}
            {{--$("#successmessege").hide('500')--}}

        {{--}, 5000);--}}
    {{--});--}}
{{--</script>--}}