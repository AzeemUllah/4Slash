<header class="m-grid__item		m-header " data-minimize="minimize" data-minimize-offset="200"

        data-minimize-mobile-offset="200">
    <div class="m-header__top">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop" style=" padding-left: 50px;padding-right: 30px;">
                <!-- begin::Brand -->
                <div class="m-stack__item m-brand">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="http://192.168.100.107">
                                <img src="{{asset('assets\demo\demo2\media\img\logo\logo14.png')}}"
                                     style="width: 100px;">
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
                                 data-dropdown-toggle="click" aria-expanded="true">

                                <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"
                                              style="right: auto; left: 65.0175px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first m--hide">
																	<span class="m-nav__section-text">
																		Quick Menu
																	</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
																			Human Resources
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">
																			Customer Relationship
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item"><a href="#" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
																			Order Processing
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">
																			Accounting
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">
																			Customer Relationship
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
																			Order Processing
																		</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- begin::Responsive Header Menu Toggler-->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- end::Responsive Header Menu Toggler-->
                            <!-- begin::Topbar Toggler-->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!--end::Topbar Toggler-->
                        </div>
                    </div>
                </div>
                <!-- end::Brand -->
                <!-- begin::Topbar -->

                <div class="m-stack__item m-stack__item--fluid m-header-head"  style=""id="m_header_nav">
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        @if(!\Illuminate\Support\Facades\Auth::user()->check())
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline" style=" margin-top: 0px">
                                    <li style="padding-top: 30px;"
                                        class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        data-dropdown-toggle="click">
                                     <span class="m-topbar__username m-topbar__nav-wrapper" style="font-size: 14px;">
                                        <a href="/registers" style="padding-left:30px; "
                                           class="m-topbar__username m-topbar__nav-wrapper">
														Register
													</a>
                                        </span>
                                        <a href="#" class="m-nav__link m-dropdown__toggle">


                                        </a>
                                    </li>
                                    <li style="padding-top: 30px;"
                                        class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        data-dropdown-toggle="click">

                                    <span class="m-topbar__username m-topbar__nav-wrapper" style="font-size: 14px;">
                                        <a href="{{route('signin')}}" style="padding-left:30px; "
                                           class="m-topbar__username m-topbar__nav-wrapper">
														Signin
													</a>
                                        </span>
                                    </li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                                        <ul class="m-topbar__nav m-nav m-nav--inline topbar1">
                                            <li class="header-notify m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                                data-dropdown-toggle="click" data-dropdown-persistent="false" style="display:inline-block; list-style-type:none;padding-right:20px; padding-top: 0px;">
                                                <a href="#" class=" m-nav__link m-dropdown__toggle mark-read js-mark-read js-gtm-event-auto custom-color-for-notification-links" href="#"
                                                   data-gtm-category="navigation"
                                                   data-gtm-action="black-nav-loggedin"
                                                   data-gtm-label="mark notifications" rel="noindex, nofollow"
                                                   id="m_topbar_notification_icon">
                                                    @if(\App\Notification::usertotalNotifications() > 0)
                                                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger m-animate-blink"></span>
                                                        <span class="m-nav__link-icon m-animate-shake">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-music-2"></i>
                                                        </span>
                                                    </span>
                                                    @else
                                                        <span class="m-nav__link-icon">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-music-2"></i>
                                                        </span>
                                                    </span>
                                                    @endif
                                                </a>
                                                <div class="notify-menu m-dropdown__wrapper">
                                                    {{--<span class="m-dropdown__arrow m-dropdown__arrow--center" style="margin-left:100px;"></span>--}}
                                                    <div class=" m-dropdown__inner ">
                                                        <div class="m-dropdown__header m--align-center" style="background: #292b2c;">
                                                            <span class="m-dropdown__header-title">
                                                                User Notifications
                                                            </span>


                                                        </div>
                                                        <div class="m-dropdown__body antiscroll-wrap" style="max-height: 300px;overflow: auto;">
                                                            <div class="m-dropdown__content notifications-list">

                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                                                                        <div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >
                                                                                            You You You You You You You You
                                                                                        </span>
                                                                                        <span class="m-list-timeline__time">
                                                                                            Just now<br>
                                                                                            12/23/2456
                                                                                    </span>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >
                                                                                            You You You You You You You You
                                                                                        </span>
                                                                                        <span class="m-list-timeline__time">
                                                                                            Just now<br>
                                                                                            12/23/2456
                                                                                    </span>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >
                                                                                            You You You You You You You You
                                                                                        </span>
                                                                                        <span class="m-list-timeline__time">
                                                                                            Just now<br>
                                                                                            12/23/2456
                                                                                    </span>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >
                                                                                            You You You You You You You You
                                                                                        </span>
                                                                                        <span class="m-list-timeline__time">
                                                                                            Just now<br>
                                                                                            12/23/2456
                                                                                    </span>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >
                                                                                            You You You You You You You You
                                                                                        </span>
                                                                                        <span class="m-list-timeline__time">
                                                                                            Just now<br>
                                                                                            12/23/2456
                                                                                    </span>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >
                                                                                            You You You You You You You You
                                                                                        </span>
                                                                                        <span class="m-list-timeline__time">
                                                                                            Just now<br>
                                                                                            12/23/2456
                                                                                    </span>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="m-list-timeline__items">
                                                                                    <div class="m-list-timeline__item">
                                                                                        <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                        <span class="m-list-timeline__text" style="" >ssssssss</span>
                                                                                        <span class="m-list-timeline__time">Just now<br>12/23/2456</span>


                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>

                                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                                data-dropdown-toggle="click" style="display:inline-block; list-style-type:none;">
                                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                                    @if(!empty(\Illuminate\Support\Facades\Auth::user()->get()->profile_image))
                                                        <span class="m-topbar__userpic">
                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->get()->profile_image }}" class="m--img-rounded m--marginless m--img-centered" alt="" style="width: 35px"/>
                                            </span>
                                                    @else
                                                        <span class="m-topbar__username">
                                                <span class="show_user_name_nick">
                                                    {{ \Illuminate\Support\Facades\Auth::user()->get()->username[0] }}
                                                </span>
                                            </span>
                                                    @endif
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    {{--<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>--}}
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center"
                                                             style=" background-size: cover; background-color: #292b2c;">
                                                            <div class="m-card-user m-card-user--skin-dark">
                                                                <div class="m-card-user__pic">
                                                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->get()->profile_image }}"
                                                                         class="m--img-rounded m--marginless" alt=""/>
                                                                </div>
                                                                <div class="m-card-user__details">
                                    <span class="m-card-user__name m--font-weight-500">
                                    {{ \Illuminate\Support\Facades\Auth::user()->get()->username }}
                                    </span>
                                                                    <a href="#"
                                                                       class="m-card-user__email m--font-weight-300 m-link">
                                                                        {{ \Illuminate\Support\Facades\Auth::user()->get()->email }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="m-nav m-nav--skin-light">
                                                                    <li class="m-nav__section m--hide">
<span class="m-nav__section-text">
Section
</span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="{{ route('profile') }}" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                            <span class="m-nav__link-title">
                                                                                        <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                        My Profile
                                                                        </span>
                                                                        <span class="m-nav__link-badge">

                                                                        </span>
                                                                        </span>
                                                                    </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="{{ route('myorders')}}" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                            <span class="m-nav__link-title">
                                                                                        <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                        My Order
                                                                        </span>
                                                                        <span class="m-nav__link-badge">

                                                                        </span>
                                                                        </span>
                                                                    </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="{{ route('mysettings') }}" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                            <span class="m-nav__link-text">
My settings
</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                    <li class="m-nav__item">
                                                                        <a href="/payments" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                                            <span class="m-nav__link-text">
Payments
</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="{{ route('myfavourites') }}" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                            <span class="m-nav__link-text">
favourites
</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                    <li class="m-nav__item">
                                                                        <a href="{{ url() }}/logout"
                                                                           class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                            Logout
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                </ul>
                                @endif
                            </div>

                    </div>
                </div>

                <!-- end::Topbar -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="m_modal_1_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Sign In
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="m-login__signin">

                        <form class="m-login__form m-form" action="#">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email"
                                       autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password"
                                       placeholder="Password" name="password">
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--focus">
                                        <input type="checkbox" name="remember"> Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <!--<div class="col m&#45;&#45;align-right m-login__form-right">-->
                                <!--<a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>-->
                                <!--</div>-->
                            </div>
                            <div class="m-login__form-action">
                                <center>
                                    <button id="m_login_signin_submit"
                                            class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                        Sign In
                                    </button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="m_modal_1_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Sign Up
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="m-login__signup">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Sign Up</h3>
                            <div class="m-login__desc">Enter your details to create your account:</div>
                        </div>
                        <form class="m-login__form m-form" action="#">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email"
                                       autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="password" placeholder="Password"
                                       name="password">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password"
                                       placeholder="Confirm Password" name="rpassword">
                            </div>
                            <div class="row form-group m-form__group m-login__form-sub">
                                <div class="col m--align-left">
                                    <label class="m-checkbox m-checkbox--focus">
                                        <input type="checkbox" name="agree">I Agree the <a href="#"
                                                                                           class="m-link m-link--focus">terms
                                            and conditions</a>.
                                        <span></span>
                                    </label>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>
                            <center>
                                <div class="m-login__form-action">
                                    <button id="#"
                                            class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
                                        Sign Up
                                    </button>&nbsp;&nbsp;
                                    <button id="m_login_signup_cancel"
                                            class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                                        Cancel
                                    </button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>

                </div>
            </div>
        </div>
    </div>


    <div class="m-header__bottom" style="padding-left: 32px;padding-right: 25px;">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- begin::Horizontal Menu -->
                <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light "
                            id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu"
                         class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            @foreach(\App\Gigtype::where(['active' => 1, 'status' => 'enabled'])->get() as $cat)
                                @if(!empty($cat))
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                        data-menu-submenu-toggle="hover" aria-haspopup="true">
                                        <a href="{{ route('gigscategory.gigs',['categoryslug'=> $cat->slug]) }}"
                                           class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <span class="m-menu__link-text">
                        {{ $cat->name }}
                        </span>
                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                        </a>

                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                            <ul class="m-menu__subnav">
                                                @foreach(\App\Gigtype_Subcategory::where(['gigtypes_id' => $cat->id])->get() as $subcat)
                                                    @if(!empty($subcat))
                                                        <li class="m-menu__item " aria-haspopup="true">
                                                            <a href="{{ route('category.subcategory.gigs', ['categoryslug' => $cat->slug, 'subcategoryslug' => $subcat->slug]) }}"
                                                               class="m-menu__link submenu-a ">
                                                                {{--<i class="m-menu__link-icon flaticon-diagram"></i>--}}
                                                                <span class="m-menu__link-title">
                                 <span class="m-menu__link-wrap">
                                 <span class="m-menu__link-text">

                                 {{ $subcat->name }}

                                 </span>

                                     @endif
                                     @endforeach
                                 </span>
                                 </span>
                                                            </a>
                                                        </li>

                                            </ul>
                                        </div>

                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-"
                     id="m_quicksearch" data-search-type="default">
                    <!--begin::Search Form -->
                    <form class="m-header-search__form" action="{{ route('gigs') }}" method="get">
                        <div class="m-header-search__wrapper">
                                       <span class="m-header-search__icon-search" id="m_quicksearch_search">
                                           <i class="la la-search"></i>
                                       </span>
                            <span class="m-header-search__input-wrapper">
                                           <input autocomplete="off" type="text" name="search"
                                                  class="m-header-search__input" value="" placeholder="Search..."
                                                  id="m_quicksearch_input">
                                       </span>
                            <span class="m-header-search__icon-close" id="m_quicksearch_close">
                                           <i class="la la-remove"></i>
                                       </span>
                            <span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
                                           <i class="la la-times"></i>
                                       </span>
                        </div>
                    </form>
                    <!--end::Search Form -->
                    <!--begin::Search Results -->
                    <div class="m-dropdown__wrapper">
                        {{--<div class="m-dropdown__arrow m-dropdown__arrow--center"></div>--}}
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__scrollable m-scrollable mCustomScrollbar _mCS_4 mCS-autoHide mCS_no_scrollbar"
                                     data-scrollable="true" data-max-height="300" data-mobile-max-height="200"
                                     style="max-height: 300px; height: 300px; position: relative; overflow: visible;">
                                    <div id="mCSB_4"
                                         class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside"
                                         tabindex="0" style="max-height: 300px;">
                                        <div id="mCSB_4_container"
                                             class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y"
                                             style="position:relative; top:0; left:0;" dir="ltr">
                                            <div class="m-dropdown__content m-list-search m-list-search--skin-light"></div>
                                        </div>
                                    </div>
                                    <div id="mCSB_4_scrollbar_vertical"
                                         class="mCSB_scrollTools mCSB_4_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical"
                                         style="display: none;">
                                        <div class="mCSB_draggerContainer">
                                            <div id="mCSB_4_dragger_vertical" class="mCSB_dragger"
                                                 style="position: absolute; min-height: 50px; top: 0px;">
                                                <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                            </div>
                                            <div class="mCSB_draggerRail"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Search Result-->
                </div>
            </div>
        </div>
        <div>
</header>
