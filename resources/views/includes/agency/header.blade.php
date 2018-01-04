<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('agencydashboard') }}" class="logo agency-logo" style="width: 315px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>N</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="https://cnerr.de/img/logo.png" alt="" width="30%"
                                   style="margin-bottom: 3px;"><span
                    style="font-size: 17px;"> | Partner Panel</span></span>
        <span class=""></span>
    </a>
    <a href="{{ url() }}" target="_blank" style="display: none;" class="visit_site"></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="margin-left: 300px;">
        <!-- Sidebar toggle button-->
        {{--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>--}}
        @if(\Illuminate\Support\Facades\Auth::agency()->check())
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                    <span style="float: right; width: 300px; position: relative; top: 10px; right: 30px;">
                        <span style="color:white; position: relative; top: 3px; font-weight: 600; font-size: 16px;">Vacation mode / Urlaubsmodus:</span>
                    <div class="onoffswitch">
                      <input type="checkbox" class="onoffswitch-checkbox"
                             id="myonoffswitch" {{ ($vacation == 1) ? "checked" : '' }} />
                      <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                    </span>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 18px;">
                            <i class="fa fa-bell-o"></i>
                            <span style="font-size: 12px; top: 7px;"
                                  class="label label-warning {{ \App\Notification::agencytotalNotifications() }}">{{ \App\Notification::agencytotalNotifications() }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Neu Nachricht {{\App\Notification::agencytotalNotifications() }} new
                                Message
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#"></a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                {{--<li class="dropdown tasks-menu">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="fa fa-flag-o"></i>--}}
                {{--<span class="label label-danger">9</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="header">You have 9 tasks</li>--}}
                {{--<li>--}}
                {{--<!-- inner menu: contains the actual data -->--}}
                {{--<ul class="menu">--}}
                {{--<li><!-- Task item -->--}}
                {{--<a href="#">--}}
                {{--<h3>--}}
                {{--Design some buttons--}}
                {{--<small class="pull-right">20%</small>--}}
                {{--</h3>--}}
                {{--<div class="progress xs">--}}
                {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">20% Complete</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li><!-- end task item -->--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="footer">--}}
                {{--<a href="#">View all tasks</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(!empty(\Illuminate\Support\Facades\Auth::agency()->get()->profile_image))
                                <img src="{{ url("photos/mini/".Illuminate\Support\Facades\Auth::agency()->get()->profile_image) }}"
                                     class="user-image" alt="User Image">
                            @else
                                <div class="user-image"
                                     style="background-color: gray;text-align:center;">{{ \Illuminate\Support\Facades\Auth::agency()->get()->username[0] }}</div>
                            @endif
                            <span class="hidden-xs">{{ \Illuminate\Support\Facades\Auth::agency()->get()->username }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if(!empty(\Illuminate\Support\Facades\Auth::agency()->get()->profile_image))
                                    <img src="{{  url("photos/mini/".Illuminate\Support\Facades\Auth::agency()->get()->profile_image) }}"
                                         class="img-circle" alt="User Image">
                                @else
                                    <div class="img-circle"
                                         style="background-color: gray;text-align:center; width: 60px;height:60px;margin: 0 auto;padding-top: 18px;">{{ \Illuminate\Support\Facades\Auth::agency()->get()->username[0] }}</div>
                                @endif
                                <p>
                                    {{ \Illuminate\Support\Facades\Auth::agency()->get()->username }}
                                    {{--<small>Member since Nov. 2012</small>--}}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('agencyprofile') }}" class="btn btn-success btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('agencylogout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        @endif
    </nav>
</header>
