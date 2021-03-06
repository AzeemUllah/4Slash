 <header class="main-header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                @if(\Illuminate\Support\Facades\Auth::user()->check())
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-3" aria-expanded="false" style="color: #555555">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar" style="background-color:#31b4ff;"></span>
                    <span class="icon-bar" style="background-color:#31b4ff;"></span>
                    <span class="icon-bar" style="background-color:#31b4ff;"></span>
                </button>
                @endif
                <a href="{{ url() }}" class="logo js-gtm-event" data-gtm-action="logo" data-gtm-event="navigation"
                   data-gtm-label="clicked">4slash logo</a>
                 
                @if(!\Illuminate\Support\Facades\Auth::user()->check())
                <div class="col-xs-5" id="show-box-1">
                    <form id="withou-logged-form" class="navbar-form navbar-left" accept-charset="UTF-8"
                          action="{{ route('gigs') }}" id="search-form-nav-bar" method="get">
                        <div class="global-search js-global-search ">
                            <div class="inner cf">
                                <input class="inner-1" class="js-search-input searchinputbar" id="" maxlength="40"
                                       name="search"
                                       placeholder="Find Services " type="text" autocomplete="off">
                                <button class="inner-2"
                                        type="submit">
                                     
                                </button>
                            </div>
                        </div>
                    </form>
                    <a id="show-text-head-2" href="" class="show1"></a>
                </div>
                <div class="col-xs-4" id="show-box-2">
                    <ul>
                        <li class="pull-left col-xs-6"><a href="#" class="show12"
                                                          class="js-open-popup-join js-gtm-event"
                                                          data-gtm-action="black-nav" data-gtm-label="join"
                                                          data-gtm-event="navigation"
                                                          data-toggle="modal" data-target="#gridSystemModal1">Register</a>
                        </li>
                        <li class="pull-left col-xs-1" style="color:white;">|</li>
                        <li class="pull-left col-xs-5"><a href="#" class="show11"
                                                          class="js-open-popup-login js-gtm-event"
                                                          data-gtm-action="black-nav" data-gtm-label="sign in"
                                                          data-gtm-event="navigation" data-toggle="modal"
                                                          data-target="#gridSystemModal">Log in</a>
                        </li>
                         
                        {{--<li><a href="/funktioniert">So funktioniert´s</a></li>--}}
                    </ul>
                </div>
                @endif
            </div>
             
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-3" aria-expanded="false">
                <div class="col-md-4 col-sm-6 col-xs-6 ">
                    <ul class="nav navbar-nav" style="width: 100%">
                        <li class="show13">
                            <form class="navbar-form navbar-left" style="margin-top: 18px;margin-left: 0;margin-right: 0;width: 100%"
                                  accept-charset="UTF-8"
                                  action="{{ route('gigs') }}" id="search-form-nav-bar" method="get">
                                <div class="global-search js-global-search ">
                                     
                                    <div class="inner cf">
                                        <input class="inner1" class="js-search-input searchinputbar" id="" maxlength="40"
                                               name="search"
                                               placeholder="Find Services" type="text" autocomplete="off" >
                                        <button class="inner2"
                                                type="submit">
                                             
                                        </button>
                                    </div>
                                </div>
                                 
                                 
                            </form>
                        </li>
                    </ul>
                </div>
                <nav class="main-nav nav navbar-nav navbar-right mainmainnav">
                    <ul class="">
                        @if(\Illuminate\Support\Facades\Auth::user()->check())
                        <li>
                            <nav class="main-nav main-nav-user">
                                <ul>
                                    {{--<li class="menu-icn icn-todo hint--bottom js-mark" data-mark="todos"
                                            data-hint="Dashboard">
                                        <a href="{{ route('userdashboard') }}" class="js-gtm-event-auto"
                                           data-gtm-action="black-nav-loggedin" data-gtm-category="navigation"
                                           data-gtm-label="to do" title="Dashboard"><i
                                                    class="fa fa-dashboard fa-nav-icons"></i> </a>
                                    </li>--}}
                                    {{--<li style="padding-top: 20px; padding-right: 10px;">--}}
                                        {{--<div id="google_translate_element" style="display:none;"></div><script type="text/javascript">--}}
                                            {{--function googleTranslateElementInit() {--}}
                                                {{--new google.translate.TranslateElement({pageLanguage: 'de', includedLanguages: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');--}}
                                                {{--}--}}
                                            {{--</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>--}}
                                        {{--</li>--}}
                                    <li class="dropdown header-notify menu-icn icn-notify hint--bottom js-mark" style="margin-top: 15px;"
                                        data-mark="notifications" data-hint="Notifications">
                                        <a href="#" data-toggle="dropdown"
                                           class="js-notify-trigger js-gtm-event-auto"
                                           data-gtm-category="navigation" data-gtm-action="black-nav-loggedin"
                                           data-gtm-label="open notifications" rel="noindex, nofollow"
                                           title="Notifications">
                                            <i class="fa fa-bell fa-nav-icons"></i>
                                            <span class="label label-warning {{ (\App\Notification::hasNotifications()) ? '' : ' sr-only' }} user-notify">{{ \App\Notification::usertotalNotifications() }}</span>
                                        </a>
                                        <div class="notify-menu dashboard-notification-dropdown-css-override">
                                            <header>
                                                <h6 class="custom-margin-fix">
                                                    <a class="mark-read js-mark-read js-gtm-event-auto custom-color-for-notification-links" href="#"
                                                       data-gtm-category="navigation"
                                                       data-gtm-action="black-nav-loggedin"
                                                       data-gtm-label="mark notifications" rel="noindex, nofollow">Everything
                                                        Mark as read</a>
                                                    <span class="custom-class-for-notification-links"> Notifications </span>
                                                </h6>
                                            </header>
                                            <div class="antiscroll-wrap">
                                                <div class="antiscroll-inner">
                                                    <div class="loading">
                                                        <a style="color: #444444; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                                           href="#"></a>
                                                    </div>
                                                     
                                                    {{--<a class="load-more js-load-more js-gtm-event-auto" href="#"
                                                           data-gtm-category="navigation"
                                                           data-gtm-action="black-nav-loggedin"
                                                           data-gtm-label="load notifications" rel="noindex, nofollow">Load
                                                        More</a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="menu-icn icn-inbox hint--bottom js-icn-inbox" data-mark="inbox"
                                        data-hint="Workstreams">
                                        <a href="{{ route('myorders') }}" class="js-gtm-event-auto"
                                           data-gtm-action="black-nav-loggedin" data-gtm-category="navigation"
                                           data-gtm-label="click conversations" title="orders"><img
                                                    src="{{ url('/') .'/img/my_orders1.png'}}" width="29px"
                                                    style="margin-top: 19px;"> </a>
                                    </li>
                                    <li class="header-user header-user-is-online">
                                        <a href="{{ route('myorders') }}"
                                           class="user-trigger js-gtm-event-auto"
                                           data-gtm-action="black-nav-loggedin" data-gtm-category="navigation"
                                           data-gtm-label="open username">
                                            @if(!empty(\Illuminate\Support\Facades\Auth::user()->get()->profile_image))
                                            <span>
</span>
                                            <span class="user-pict-24">
                                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->get()->profile_image }}"
                                                         alt="Profile Image" width="24" height="24"
                                                         data-reload="inprogress">
                                                </span>
                                            <span class="user-is-online  is-online"
                                                  data-user-id="zohaibghafoor2"></span>
                                            @else
                                            <span class="user_icon">
                                                    <span class="user-pict-24"
                                                          style="width:24px;height:24px;background-color:#797979;color:white;padding:2px;">
                                                        <span style="font-size:16px;"
                                                              class="alternat">{{ \Illuminate\Support\Facades\Auth::user()->get()->username[0] }}</span>
                                                    </span>
                                                    <span class="user-is-online  is-online"
                                                          data-user-id="zohaibghafoor2"></span>
                                                </span>
                                            @endif
                                            <span class="user-name">{{ \Illuminate\Support\Facades\Auth::user()->get()->username }}</span>
                                            <span class="badge">{{ number_format(\Illuminate\Support\Facades\Auth::user()->get()->wallet,2)}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="userMenuTrag"><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('myorders')  }}"><span
                                                            class="fa fa-tachometer"></span> Dashboard</a>
                                            </li>
                                            <li>
                                                <a href="{{ url() }}/profile"><span
                                                            class="glyphicon glyphicon-user"></span> profile</a>
                                            </li>
                                            <li>
                                                <a href="" class="drop_down1"><span
                                                            class="glyphicon glyphicon-list"></span> orders<b
                                                            class="caret"></b></a>
                                                <ul class="cancel_order2" style="display: none;">
                                                    <li>
                                                        <a href="{{ route('myorders')  }}"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span class="glyphicon glyphicon-list"></span> Overview</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('myorders')  }}?status=cancel"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span class="glyphicon glyphicon-list"></span>
                                                            cancelled</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{ url() }}/payments"><span
                                                            class="glyphicon glyphicon-credit-card"></span>payments</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('myfavourites') }}"><span
                                                            class="glyphicon glyphicon-heart"></span> favorites</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('mysettings') }}">
                                                        <span
                                                                class="glyphicon glyphicon-cog"></span>
                                                    settings</a>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                <a href="{{ url() }}/logout"><span
                                                            class="glyphicon glyphicon-off"></span>Sign out
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </li>
                        @else
                        {{--<li style="padding-top: 20px; padding-right: 10px;"><div id="google_translate_element" style="display:none;"></div><script type="text/javascript">--}}
                                {{--function googleTranslateElementInit() {--}}
                                    {{--new google.translate.TranslateElement({pageLanguage: 'de', includedLanguages: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');--}}
                                    {{--}--}}
                                {{--</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></li>--}}
                        {{--<li><a href="/funktioniert" style="color:#e5e5e5" class="js-open-popup-join js-gtm-event"--}}
                                   {{--data-gtm-action="black-nav" data-gtm-label="join" data-gtm-event="navigation"><b>So funktioniert´s</b></a></li>--}}
                        <li><a href="#" class="gtm1" class="js-open-popup-join js-gtm-event loginbtn"
                               data-gtm-action="black-nav" data-gtm-label="join" data-gtm-event="navigation"
                               data-toggle="modal" data-target="#gridSystemModal1">Register</a></li>
                        <li><a href="#" class="gtm2" class="js-open-popup-login js-gtm-event loginbtn"
                               data-gtm-action="black-nav" data-gtm-label="sign in"
                               data-gtm-event="navigation" data-toggle="modal"
                               data-target="#gridSystemModal">Login</a></li>
                        <li><a href="https://4slash.zendesk.com" class="gtm3"
                               class="js-open-popup-login js-gtm-event loginbtn" data-gtm-action="black-nav"
                               data-gtm-label="sign in" data-gtm-event="navigation">Contact</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
             
             
             
        </div>
    </nav>
</header>
<header>
    @if(Request::segment(1) !== "checkout")
    <nav class="navbar navbar-default" style="min-height:0px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="row text-right">
                    <button type="button" class="btn btn-primary btn-custom-gig2 rightcustomgig"
                            style="border-radius:0 0 10px 10px;color:white; font-size:16px; font-weight: bold; outline:none; border-color: #367FA9;">
                        Custom Order <span class="custom-gig"><span
                                    class="glyphicon glyphicon-menu-up" id="custom-gig"
                                    style="display:none;"></span></span></button>
                    <span class="product1" id="unsere">Our Products</span>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-4" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="background-color:#31b4ff;"></span>
                        <span class="icon-bar" style="background-color:#31b4ff;"></span>
                        <span class="icon-bar" style="background-color:#31b4ff;"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-8 col-sm-10 col-xs-12 ">
                <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-4" aria-expanded="false">
                    <ul class="main-cat-list js-main-cat-list float-clear-fix">
                        @foreach(\App\Gigtype::where(['active' => 1, 'status' => 'enabled'])->get() as $cat)
                        @if(!empty($cat))
                        <li class="dropdown">
                            <a href="{{ route('gigscategory.gigs',['categoryslug'=> $cat->slug]) }}"
                               data-gtm-action="homepage-dropdown-click" class="dropdown-toggle"
                               data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
                               data-gtm-event="Category Navigation" data-gtm-label="graphics-design"
                               data-title="Graphics &amp; Design">{{ $cat->name }}</a>
                            <div class="unnecessary-firefox-wrapper">
                                @if(count(\App\Gigtype_Subcategory::where(['gigtypes_id' => $cat->id])->get()) > 0)
                                <div class="menu-cont">
                                    <ul class="styl dropdown-menu" style="padding-bottom: 4px;">
                                        @foreach(\App\Gigtype_Subcategory::where(['gigtypes_id' => $cat->id])->get() as $subcat)
                                        @if(!empty($subcat))
                                        <li>
                                            <a href="{{ route('category.subcategory.gigs', ['categoryslug' => $cat->slug, 'subcategoryslug' => $subcat->slug]) }}"
                                               data-gtm-action="homepage-dropdown-click"
                                               data-gtm-event="Category Navigation"
                                               data-gtm-label="create-cartoon-caricatures"
                                               data-title="Cartoons &amp; Caricatures">{{ $subcat->name }}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                        <li>  <a href="{{ route('gigscategory.packages',['categoryslug'=> $cat->slug]) }}">
                                                <span>Packages</span>
                                                <i class="fa fa-dropbox" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </nav>
     
    <div class="custom-gigs" style="margin:0px;">
        <div class="container">
            <div class="col-md-7 col-sm-12 col-xs-12 toggle-pane dropbarbig" style="background-color:white;">
                <div class="gig-style col-xs-12">
                    @if(\Illuminate\Support\Facades\Auth::user()->check())
                    <form id="formCustomOrder" method="post" action="{{ route('order.custom.create') }}">
                        <div class="col-md-5">
                            <h4 style="font-size:20px; font-family:Raleway-Medium; color:#1b2432">Products</h4>
                            <?php $count = 1; ?>
                            @foreach(\App\Gigtype::where(['status' => 'enabled', 'active' => 1])->get() as $cat)
                            <div class="accordion-group new-accordion">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                       href="#collapse{{ $count }}">
                                        {{ $cat->name }} <input type="hidden" name="gigtype" required
                                                                value="{{ $cat->id }}"/>
                                    </a>
                                </div>
                                 
                                <div id="collapse{{ $count }}"
                                     class="accordion-body collapse {{ (($count == 1)) ?  : ''}}">
                                    <div class="accordion-inner">
                                        <?php $subCatCount = 1; ?>
                                        @foreach(\App\Gigtype_Subcategory::where(['gigtypes_id' => $cat->id])->get() as $subCat)
                                        @if(!empty($subCat->name))
                                        <div class="checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx3">
                                            <input value="{{ $subCat->name }}" name="products[]"
                                                   id="checkbox{{ $count . $subCatCount }}"
                                                   class="styled radio-btn-addon" type="checkbox">
                                            <label class="span-custom-top remember-css chck-bx-p addon-name remain-signin-span-custom-position" for="checkbox{{ $count . $subCatCount }}">
                                                <p class="chck-bx-p">{{ $subCat->name }}</p>
                                            </label>
                                        </div>
                                        @endif
                                        <?php $subCatCount++ ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>
                         
                        <div class="col-md-7 sub-form">
                            <h4>Product Information</h4>
                            <input required name="comp-name" type="text" class="form-control input-lg"
                                   placeholder="Name">
                            <input required name="comp-email" type="email" class="form-control input-lg"
                                   placeholder="E-mail">
                            <input required name="comp-tel" type="tel" class="form-control input-lg" placeholder="Telephone
">
                            <input name="comp-site" type="text" class="form-control input-lg" placeholder="Website">
                            <textarea required name="comp-extra-note" class="form-control"
                                      placeholder="Project Description" rows="4"></textarea>
                            <p style="font-size:14px; color:#7b7b7b;">
                                <input type="hidden" name="gigtype" required value="">
                            </p>
                            <input class="form-control input-lg" placeholder="Project bugdet
 
">


                            <button type="submit" class="custom-prop-for-send-btn loginpage-checkbox a-button a-button-override-for-loginpage pull-right login-nav-bar-btn-right-custom">Send</button>

                            <!--
                                              <button type="submit" class="btn btn-primary form-btn"
                                                      style="background: #367fa9; border: 0px;">send
                                              </button>
                                -->
                             
                        </div>
                    </form>
                    @else
                    <form id="formCustomOrder" method="post" action="{{ route('ordercustom') }}">
                        <div class="col-md-5">
                            <h4 style="font-size:20px; font-family:Raleway-Medium; color:black">Product</h4>
                            <?php $count = 1; ?>
                            @foreach(\App\Gigtype::where(['status' => 'enabled', 'active' => 1])->get() as $cat)
                            <div class="accordion-group new-accordion">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                       href="#collapse{{ $count }}">
                                        {{ $cat->name }} <input type="hidden" name="gigtype" required
                                                                value="{{ $cat->id }}"/>
                                    </a>
                                </div>
                                 
                                <div id="collapse{{ $count }}"
                                     class="accordion-body collapse {{ (($count == 1)) ?  : ''}}">
                                    <div class="accordion-inner">
                                        <?php $subCatCount = 1; ?>
                                        @foreach(\App\Gigtype_Subcategory::where(['gigtypes_id' => $cat->id])->get() as $subCat)
                                        @if(!empty($subCat->name))
                                        <div class="checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx3">
                                            <input value="{{ $subCat->name }}" name="products[]"
                                                   id="checkbox{{ $count . $subCatCount }}"
                                                   class="styled radio-btn-addon" type="checkbox">
                                            <label class="span-custom-top remember-css chck-bx-p addon-name remain-signin-span-custom-position" for="checkbox{{ $count . $subCatCount }}">
                                                <p class="chck-bx-p">{{ $subCat->name }}</p>
                                            </label>
                                        </div>
                                        @endif
                                        <?php $subCatCount++ ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>
                         
                        <div class="col-md-7 sub-form">
                            <h4>Project information
                            </h4>
                            <input required name="comp-name" type="text" class="form-control input-lg"
                                   placeholder="Name">
                            <input required name="comp-email" type="email" class="form-control input-lg"
                                   placeholder="E-mail">
                            <input required name="comp-tel" type="tel" class="form-control input-lg" placeholder="Telephone
">
                            <input name="comp-site" type="text" class="form-control input-lg" placeholder="Website">
                            <textarea required name="comp-extra-note" class="form-control"
                                      placeholder="Project information" rows="4"
                                      style="padding: 6px 7px 7px 7px;"></textarea>
                            <p style="font-size:14px; color:#7b7b7b;">
                                <input type="hidden" name="gigtype" required value="">
                            </p>
                            <input class="form-control input-lg" placeholder="Project budget"
                                   style="padding: 6px 7px 7px 7px;">


                            <button type="submit" class="custom-prop-for-send-btn loginpage-checkbox a-button a-button-override-for-loginpage pull-right login-nav-bar-btn-right-custom">Send</button>


                            <!--
                                              <button type="submit" class="btn btn-primary form-btn"
                                                      style="background: #3c8dbc; border: 0px;">Send
                                              </button>
                                -->

                             
                        </div>
                    </form>
                    @endif
                </div>
                <button type="button" class="btn btn-primary btn-custom-gig rightbtn"
                        style="border-radius:0 0 10px 10px;color:white; font-size:16px; font-family:HelveticaLTStd-Light; outline:none; border-color: #367FA9;top: -37px;position: inherit; right: -10px;">
                    Make a wish <span class="custom-gig"><span class="glyphicon glyphicon-menu-down"
                                                               id="custom-gig"></span><span
                                class="glyphicon glyphicon-menu-up" id="custom-gig" style="display:none;"></span></span>
                </button>
            </div>
        </div>
    </div>
    @endif
</header>
 
<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="gridSystemModal1" tabindex="-1">
    <div class="modal-dialog modal-sm model-login-width" role="document">
        <div class="modal-content" ng-controller="RegisterController">
            <div class="modal-header login-header custom-padding-bottom-reg-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title login-title" id="gridSystemModalLabel">Registration</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form>
                        <div class="username form-group<?= "{{ hasEmailError ? ' has-error' : '' }}" ?>">
                            <label for="email_adress" class="sr-only">Email_address</label>
                            <span class="choice-1">
                            <i class="fa fa-envelope-o fa-custom-color fa-custom-position-password"></i>
                                <!--<img src="img/lg-key.png" style="height:25px;"> -->
                        </span>
                            <!--
                                            <span style="position:relative; top:38px; left:10px;">
                 
                                                        {{--<i class="fa fa-envelope-o"></i>--}}
                                    </span>
                -->
                            <input ng-model="emailModel" type="text" class="form-control em" id="email_adress"
                                   placeholder="Email" style="height:50px; padding: 6px 45px;">
                            <p class="help-block"><?='{{  email }}'?></p>
                        </div>
                        <div class="user form-group<?= "{{ hasUsernameError ? ' has-error' : '' }}" ?>">
                            <label for="user" class="sr-only">User Name</label>
                             
                             
                            <span class="choice-2">
                                <i class="fa fa-user-o fa-custom-color fa-custom-position-password"></i>
                                <!--<img src="img/lg-key.png" style="height:25px;"> -->
                            </span>
                            <!--
                                            <span style="position:relative; top:38px; left:10px;">
                                                       {{-- <img src="img/lg-men.png" style="height:25px;">--}}
                                    </span> -->
                             
                            <input ng-model="usernameModel" type="text" class="form-control em" id="user"
                                   placeholder="Username" style="height:50px; padding: 6px 45px;">
                            <p class="help-block"><?="{{  username }}"?></p>
                        </div>
                        <div class="pass form-group<?= "{{ hasPasswordError ? ' has-error' : '' }}" ?>">
                            <label for="pass" class="sr-only">Password</label>
                             
                            <span class="choice-3">
                            <i class="fa fa-key fa-custom-color fa-custom-position-password"></i>
                                <!--<img src="img/lg-key.png" style="height:25px;"> -->
                        </span>
                             
                             
                            <!--
                                            <span style="position:relative; top:40px; left:10px;">
                                                        {{--<img src="img/lg-key.png" style="height:25px;">--}}
                                    </span>
                -->
                            <input ng-model="passwordModel" type="password" class="form-control em" id="Pass"
                                   placeholder="Password" style="height:50px; padding: 6px 45px;">
                            <p class="help-block"><?='{{  password }}'?></p>
                        </div>
                        <div class="con_pass form-group<?= "{{ hasPasswordError ? ' has-error' : '' }}" ?>">
                            <label for="con_pass" class="sr-only">Confirm Password</label>
                             
                             
                            <span class="choice-4">
                            <i class="fa fa-key fa-custom-color fa-custom-position-password"></i>
                                <!--<img src="img/lg-key.png" style="height:25px;"> -->
                            </span>
                             
                            <!--
                                            <span style="position:relative; top:40px; left:10px;">
                                                       {{-- <img src="img/lg-key.png" style="height:25px;">--}}
                                    </span>
                            -->
                             
                             
                            <input ng-model="passwordConfirmationModel" type="password" class="form-control em"
                                   id="con_pass" placeholder="
Confirm Password" style="height:50px; padding: 6px 45px;">
                             
                        </div>
                         
                        <div class="form-group" style="padding-top:10px;">
                             
                             
                            <!--
                                            <label class="checkbox-inline"><input type="checkbox" value="" ng-model="agreeLicenceModel"
                                                                                  id="licence">I have read and accept the <a"/daten">privacy policy.*</a></label>
                                            <p class="help-block"></p>
                                            <p class="help-block"><span id="License_error"
                                                                        style="font-size: 12px;color: #A94442; font-weight: bold;"></span>
                                            </p>
                -->
                             
                             
                            <div class="regestration-modal-custom-padding-inbetween checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx2 custom-margin-bottom">
                                <input id="" class="styled radio-btn-addon"  value="1" ng-model="agreeLicenceModel"
                                       id="licence" type="checkbox" >
                                <label for="">
                                    <span class="span-custom-top remember-css chck-bx-p addon-name remain-signin-span-custom-position">I have read and accept the <a"/daten">privacy policy.*</a></span>
                                </label>
                                <p class="help-block"><?= "{{ agreeLicenceError ? ' Error' : '' }}" ?></p>
                                <p class="help-block"><span id="License_error"
                                                            class="group-1"></span>
                                </p>
                            </div>
                             
                             
                             
                             
                        </div>
                        <div class="form-group">
                             
                             
                            <!--
                            <label class="checkbox-inline"><input ng-model="newsletter_val" value="1" type="checkbox"
                                                                  name="newsletter" id="newsletter">I would like to be informed by e-mail about news and promotions. You can unsubscribe at any time in the newsletter or on our homepage.</label>
                            -->
                             
                             
                            <div class="regestration-modal-custom-padding checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx2 ">
                                <input id="" class="styled radio-btn-addon" value="1" ng-model="newsletter_val" type="checkbox" name="newsletter" id="newsletter">
                                <label for="">
                                    <span class="span-custom-top remember-css chck-bx-p addon-name remain-signin-span-custom-position">I would like to be informed by e-mail about news and promotions. You can unsubscribe at any time in the newsletter or on our homepage.</span>
                                </label>
                            </div>
                             
                             
                             
                             
                             
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <div class="g-recaptcha" data-sitekey="6LcKzC8UAAAAAEbQpcOX9ke0gVxP1Tz4DMKkP617"></div>
                                @if(Session::has('captcha_error'))
                                <p class="text-danger text-center email_sent">{{ Session::get('captcha_error') }}</p>
                                @endif
                                @if(Session::has('captcha_validation'))
                                <p class="text-danger text-center email_sent">{{ Session::get('captcha_validation') }}</p>
                                @endif
                                <p class="help-block"><span id="captcha_error"
                                                            class="group-2"></span>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <div class="chk-margin-float">
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="btn-margin-float">

                                    <button ng-click="login()" value="Register" ng-disabled="regSubmitted" ng-click="register()" id="submitRegister" type="submit" class="loginpage-checkbox a-button a-button-override-for-loginpage pull-right login-nav-bar-btn-right-custom">Register</button>


                                    <!--
                                                      <input type="submit" class="btn btn-primary reg_btn" value="Register"
                                                             ng-disabled="regSubmitted" ng-click="register()" id="submitRegister">
                                    -->



                                </div>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </form>
                </div>
            </div>
            <div class="modal-footer login-footer">
                <p class="footer-p">
                    Are you already registered? Click here to<a href="#" class="custom-link-color" data-toggle="modal"
                                                                data-target="#gridSystemModal"
                                                                id="loginModel" data-dismiss="modal"> login</a></p>
            </div>
             
             
             
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="gridSystemModal" tabindex="-1">
    <div class="modal-dialog modal-sm model-login-width" role="document">
        <div class="modal-content" ng-controller="LoginController">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title login-title" id="gridSystemModalLabel" style="color: #1b2432">Login</h4>
            </div>
             
             
             
            <div class="ssk-block" style="width: 230px; margin:0 auto">
                <a href="/redirect">
                    <img src="/img/login-with-facebook.png" alt="login-with-fb" style="width: 225px;">
                </a>
                {{--<a href="redirect" class=""><img src="img/facebookimage.png" style="width:100%"> </a> --}}
                {{--<a href="" class="ssk ssk-text ssk-twitter">Sign in with Twitter</a>--}}
                {{--<a href="" class="ssk ssk-text ssk-google-plus">Sign in with Google</a>--}}
            </div>
             
             
            <div ng-if="hasOtherError" class="alert alert-danger animate-if" role="alert">
                <span class="glyphicon glyphicon-warning-sign"></span>
                <?php echo "Wrong Username or password" ?>
            </div>
             
             
             
             
            <div class="modal-body">
                <form>
                    <div class="input form-group<?= "{{ hasEmailError ? ' has-error' : '' }}" ?>"
                         style="positon:relative">
                        <label for="emailadress" class="sr-only">Email address</label>
                         
                        <span style="position:relative; top:37px; left:15px;">
                                <i class="fa fa-envelope-o fa-custom-color"></i>
                        </span>
                         
                        <!--
                                      <span style="position:relative; top:35px; left:10px;">
                                                 {{-- <i class="fa fa-envelope-o"></i>--}}
                                </span> -->
                        <input ng-model="emailModel" type="email" class="form-control em" id="emailadress"
                               placeholder="E-mail" style="height:50px; padding: 6px 45px;">
                         
                         
                    </div>
                    <div class="input form-group<?= "{{ hasPasswordError ? ' has-error' : '' }}" ?>">
                        <label for="password" class="sr-only">Password</label>
                         
                         
                        <span style="position:relative; top:40px; left:10px;">
                            <i class="fa fa-key fa-custom-color fa-custom-position-password"></i>
                            <!--<img src="img/lg-key.png" style="height:25px;"> -->
                        </span>
                         
                        <!--
                                      <span style="position:relative; top:40px; left:10px;">
                                                  {{--<img src="img/lg-key.png" style="height:25px;">--}}
                                </span>
              -->
                        <input ng-model="passwordModel" type="password" class="form-control em" id="password"
                               placeholder="Password" style="height:50px; padding: 6px 45px;"> 
                         
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="chk-margin-float">
                                 
                                 
                                <div class="checkbox checkbox-info new-checkbox-style checkbox-circle chck-bx2 ">
                                    <input id="" class="styled radio-btn-addon" type="checkbox" data-smartlook_2fecb6293ed16="false">
                                    <label for="">
                                        <span class="span-custom-top remember-css chck-bx-p addon-name remain-signin-span-custom-position">Remember me</span>
                                    </label>
                                </div>
                                 
                                 
                                <!-- <input type="checkbox" class="chk-float-left"><span class="remember-css">Remember me</span> -->
                                 
                                 
                            </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="btn-margin-float">
                                 
                                <div class="col-md-12 login-nav-bar-btn-right-custom">
                                    <button ng-click="login()" value="login" type="submit" class="loginpage-checkbox a-button a-button-override-for-loginpage pull-right login-nav-bar-btn-right-custom" value="log in">Login</button>
                                </div>
                                 
                                 
                                <!--   <input ng-click="login()" type="submit" class="btn btn-primary register_btn" value="login"> -->
                                 
                            </div>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fgt-margin-float">
                                 
                                <p class="forgt-pass pull-right "><a href="/password/email" class="a-custom-color" href="/password/email">Forgot Password?
                                    </a></p>
                                 
                                <!--    <p class="forgt-pass"><a href="/password/email" style="color: black;">Forgot Password?</a></p> -->
                            </div>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                     
                     
                     
                    {{--  <div class="row">
                         
                        <div class="col-lg-6">
                            <a href="" class="btn btn-block ssk ssk-text ssk-facebook ssk-lg"><span style="font-size:smaller;">Facebook</span></a>
                            --}}{{--<div class="">--}}{{--
                                --}}{{--<a class="btn btn-block btn-social btn-facebook" style="box-shadow: 2px 3px 0px #0821A2">--}}{{--
                                    --}}{{--<i class="fa fa-facebook"></i>--}}{{--
                                    --}}{{--<span style="font-size: smaller;">Connect Facebook</span>--}}{{--
                                    --}}{{--</a>--}}{{--
                                --}}{{--</div>--}}{{--
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <a href="" class="btn btn-block ssk ssk-text ssk-google-plus ssk-lg"><span style="font-size: smaller;">Google</span></a>
                            --}}{{--<a href="" class="ssk ssk-text ssk-google-plus">Connect Google</a>--}}{{--
                            --}}{{--<div class="">--}}{{--
                                --}}{{--<a class="btn btn-block btn-social btn-google" style="box-shadow: 2px 3px 0px #770D00">--}}{{--
                                    --}}{{--<i class="fa fa-google"></i>--}}{{--
                                    --}}{{--<span style="font-size: smaller;">Connect Google</span>--}}{{--
                                    --}}{{--</a>--}}{{--
                                --}}{{--</div>--}}{{--
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->--}}
                </form>
            </div>
            <div class="modal-footer login-footer">
                <p class="footer-p"><a href="#" data-toggle="modal" class="footer-z" data-target="#gridSystemModal1" data-dismiss="modal" id="registrieren">New
                        registration</a></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $(".userMenuTrag").click(function () {
            var check = $(this).parent().find(".dropdown-menu").css("display");
            if (check == "none") {
                $(this).parent().find(".dropdown-menu").css("display", "block");
            } else {
                $(this).parent().find(".dropdown-menu").css("display", "none");
            }
        });
        $('.drop_down1').click(function () {
            var check = $('.cancel_order2').css('display');
            if (check == 'none') {
                $('.cancel_order2').show();
            } else {
                $('.cancel_order2').hide();
            }
        });
        $opened = 0;
        $(".header-notify").click(function(){
            //alert($opened);
            if($opened == 1){
                $opened = 0;
                $(".notify-menu").css("display", "none");

            }else{
                $opened = 1;
            }
        });
    });
    $(".dropdown-toggle").removeAttr("aria-expanded");
    $(".dropdown-toggle").click(function () {
        window.location.href = this;
        $(".styl").hide();
    });
    $(".btn-custom-gig2").on("click", function () {
        var chkDiv = $('.gig-style');
        if (chkDiv.css("display") == "none") {
            chkDiv.slideDown();
        } else {
            chkDiv.slideUp();
        }


    });
</script>
 
 