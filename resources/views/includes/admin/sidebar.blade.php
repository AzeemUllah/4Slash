<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(!empty(\Illuminate\Support\Facades\Auth::admin()->get()->profile_image))
                    <img src="{{ \Illuminate\Support\Facades\Auth::admin()->get()->profile_image }}" class="img-circle" alt="User Image" style="max-width: 45px; height: auto; width: 50px;">
                @else
                    <div class="img-circle" style="font-size:30px;color:white;width:45px;height:45px;background-color: gray;text-align:center;">{{ \Illuminate\Support\Facades\Auth::admin()->get()->username[0] }}</div>
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ \Illuminate\Support\Facades\Auth::admin()->get()->username }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
                <a href="{{ route('admindashboard') }}"><span>Dashboard</span></a>
            </li>
            <li class="treeview active">
                <a href=""><span>Administration</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu menu-open">
                    @if( \Illuminate\Support\Facades\Auth::admin()->get()->type !='subadmin')
                        <li>
                            <a href="{{ route('subadmin') }}"><span>Subadmin</span></a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('registeredusers') }}">Registerd Users</a>

                    </li>
                    <li>
                        <a href="{{ route('logs') }}">Activity Logs</a>

                    </li>
                    <li>
                        <a href="{{ route('news.letter') }}">Newsletter</a>

                    </li>
                    <li>
                        <a href="{{ route('charges.services') }}">Services Charges</a>
                    </li>
                    <li>
                        <a href="{{ url() }}" target="_blank">Visit 4slash</a>
                    </li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#"><span>Gigs Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu menu-open">
                    <li><a href="{{ route('admingigs') }}">All gigs</a></li>
                    <li><a href="{{ route('admingigscategories') }}">Categories</a></li>
                    <li><a href="{{ route('adminTrashGigs') }}">Trash</a></li>
                    {{--<li><a href="{{ route('adminCatTrashGigs') }}">Categories Trash</a></li>--}}
                </ul>
            </li>

            <li class="treeview active">
                <a href="#"><span>Packages Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu menu-open">
                    <li><a href=" {{ route('adminpackages') }}?package=active">All Packages</a></li>
                    <li><a href="{{ route('admintrashpackages') }}">Trash</a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    Orders
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu menu-open">
                    <li class="treeview active">
                        <a href="#">
                            Gigs Orders
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('adminorders') }}?status=pending">
                                    Pending Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('adminorders') }}?status=complete">
                                    Completed Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('adminorders') }}?status=cancel">
                                    Canceled Orders
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#">
                            Custom Orders
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admin.orders.custom') }}?status=pending">
                                    Custom Pending Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders.custom') }}?status=complete">
                                    Custom Completed Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders.custom') }}?status=cancel">
                                    Custom Canceled Orders
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            Package Orders
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admin.orders.packages') }}?status=pending">
                                    Pending Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders.packages') }}?status=complete">
                                    Completed Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders.packages') }}?status=cancel">
                                    Canceled Orders
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>