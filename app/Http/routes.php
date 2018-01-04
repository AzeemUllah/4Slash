<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
Route::get('/sendEmail', ['as' => 'emailSend', 'uses' => 'HomeController@sendmail']);
Route::get('/send_test_email', ['as' => 'send_test_email', 'uses' => 'AgencyOrdersController@send_test_email']);
Route::get('/logout', 'AuthController@getLogout');

Route::get('/generate/promocode',[
    'uses' => 'HomeController@insert_promocode',
    'as'   => 'private.controller'
]);

Route::get('/profile_new',[
        'uses' => 'HomeController@propro',
        'as' => 'profile_new',
    ]


);



Route::get('/pricing',[
        'uses' => 'HomeController@pricing',
        'as' => 'pricing',
    ]


);

Route::get('/contact',[
        'uses' => 'HomeController@contact',
        'as' => 'contact',
    ]


);

Route::get('/trial',[
        'uses' => 'HomeController@trial',
        'as' => 'trial',
    ]


);

Route::get('/thankyou',[
        'uses' => 'HomeController@thankyou',
        'as' => 'thankyou',
    ]


);


Route::get('/enterprise_package',[
        'uses' => 'HomeController@enterprise',
        'as' => 'enterprise_package',
    ]
);


Route::get('/custom_package',[
        'uses' => 'HomeController@custom',
        'as' => 'custom_package',
    ]
);

Route::get('/customer',[
        'uses' => 'HomeController@customer',
        'as' => 'customer',
    ]
);

Route::get('/terms',[
        'uses' => 'HomeController@terms',
        'as' => 'terms',
    ]
);

Route::get('/press',[
        'uses' => 'HomeController@press',
        'as' => 'press',
    ]
);
Route::get('/partnership',[
        'uses' => 'HomeController@partnership',
        'as' => 'partnership',
    ]
);
Route::get('/privacy',[
        'uses' => 'HomeController@privacy',
        'as' => 'privacy',
    ]
);



Route::post('/free_package',[
        'uses' => 'HomeController@free',
        'as' => 'free_package',
    ]
);

Route::get('/signin',[
        'uses' => 'LoginController@signin',
        'as' => 'signin',
    ]
);

Route::post('/free_package_form',[
        'uses' => 'HomeController@freeform',
        'as' => 'free_package_form',
    ]
);
Route::get('/essential_form',[
        'uses' => 'HomeController@essentialform',
        'as' => 'essential_form',
    ]
);

Route::get('/enterprise_form',[
        'uses' => 'HomeController@enterpriseform',
        'as' => 'enterprise_form',
    ]
);

Route::get('/feature_apps',[
        'uses' => 'HomeController@featureapps',
        'as' => 'feature_apps',
    ]
);

Route::post('/posting4',[
        'uses' => 'freeform@datapost',
        'as' => 'posting',
    ]
);

Route::post('/login1',[
        'uses' => 'LoginController@index1',
        'as' => 'login1',
    ]
);

Route::post('/login2',[
        'uses' => 'LoginController@index2',
        'as' => 'login2',
    ]
);



Route::post('/login4',[
        'uses' => 'LoginController@index3',
        'as' => 'login4',
    ]
);




Route::post('/store',[
        'uses' => 'freeform@store',
        'as' => 'forsaved',
    ]
);

Route::post("free","freeform@free");
//Route::post("store","freeform@store");

Route::get("essential","Essentialform@essential");
Route::post("essential","PaypalController@essential");
Route::get("withoutloginessential","PaypalController@withoutloginessential");

Route::get("enterprise","enterpriseform@enterprise");
Route::post("enterprise","PaypalController@enterprise");
Route::get("withoutloginenterprise","PaypalController@withoutloginenterprise");

Route::get("store2","PricingController@store2");
Route::post("store2","PricingController@store2");

Route::get("store3","PricingController@store3");
Route::post("store3","PricingController@store3");

Route::get("store4","PricingController@store4");
Route::post("store4","PricingController@store4");


Route::post("/App_selection",[
    'uses' => 'PricingController@checkfreelogin',
    'as' => 'login1',
]);







Route::get("/essen",[
    'uses' => 'PricingController@essen',
    'as' => 'essen',
]);


Route::get("/enter",[
    'uses' => 'PricingController@enter',
    'as' => 'enter',
]);





Route::get('/google_login', 'AuthController@redirectToGoogleProvider');

Route::get('/google_callback', 'AuthController@handleGoogleProviderCallback');
Route::get('/daten', 'LoginController@daten_page');
Route::get('/login', 'LoginController@index');
Route::get('/login1', 'LoginController@index1');
Route::get('/activate/email', 'AuthController@activateEmail');
Route::get('/userslogin', [
        'uses' => 'LoginController@index',
        'as' => 'registerLogin']
);

Route::get('/registers', 'RegisterController@index');

Route::get('/favors', [
    'uses' => 'GigsController@index',
    'as' => 'gigs',
]);

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
Route::get('/funktioniert',function(){
    return view('pages.funktioniert');
});

Route::post('/resetagencyPassword', [
    'uses' => 'Auth\PasswordController@sendagencyPassword',
    'as' => 'forgotEmail',
]);

Route::post('/resetPassword', [
    'uses' => 'Auth\UserPasswordController@sendPassword',
    'as' => 'userforgotEmail',
]);

Route::get('/resetEmailPassword/{email}/{token}', [
    'uses' => 'Auth\PasswordController@resetPasswordForm',
    'as' => 'resetEmailPassword',
]);

Route::get('/favors/{categoryslug}', [
    'uses' => 'GigsController@getGigsByCategory',
    'as' => 'gigscategory.gigs'
]);
Route::get('/packages/{categoryslug}', [
    'uses' => 'GigsController@getPackagesByCategory',
    'as' => 'gigscategory.packages'
]);
Route::post('/resetAgencyPassword', [
    'uses' => 'Auth\PasswordController@resetAgencyPassword',
    'as' => 'resetAgencyPassword'
]);

Route::post('/resetuserPassword', [
    'uses' => 'Auth\UserPasswordController@resetuserpassword',
    'as' => 'resetuserPassword'
]);
Route::get('/uber', function() {
    return view('pages/aboutus');
});
Route::get('/mail', function() {
    return view('test');
});
Route::get('/favors/cat/{categoryslug}/subcat/{subcategoryslug}', [
    'uses' => 'GigsController@getGigsBySubCategory',
    'as' => 'category.subcategory.gigs'
]);
Route::get('/services/charge',[
    'uses' => 'AdminDashboardController@detail',
    'as'   => 'charges.services',
]);
Route::post('/services/update',[
    'uses' => 'AdminDashboardController@services_charges_add',
    'as'   => 'charges.update',
]);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');




/*
 * Restricted Pages
 */

Route::get('/notifications', ['middleware' => 'auth', 'uses' => 'NotificationsController@index']);
Route::get('/profile', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@index',
    'as' => 'profile'
]);


Route::get('/profile/update', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@updateUser',
    'as' => 'profile.update'
]);

Route::post('/profile/putUpdate', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@putUpdateUser',
    'as' => 'profile.PutUpdate'
]);

Route::get('/profile/edit', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@editUser',
    'as' => 'edit.userDetails'
]);


Route::post('/profile/change-profile-image', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@change_profile_image',
    'as' => 'changeprofileimage',
]);

Route::post('/agencyprofile/profile-image', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@agency_profile_change',
    'as' => 'agency.changeprofileimage',
]);
Route::post('/profile/change-profile-cover-image', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@change_profile_cover_image',
    'as' => 'changeprofilecoverimage',
]);
Route::get('/payments', ['middleware' => 'auth', 'uses' => 'PaymentsController@index']);
Route::get('/settings', [
    'middleware' => 'auth',
    'uses' => 'SettingsController@index',
    'as' => 'mysettings',
]);
Route::post('/notify/settings',[
    'middleware' => 'auth',
    'uses'       => 'SettingsController@notify_settings',
    'as'         => 'notify.settings'
]);
Route::get('/gigs/{gigType}', ['middleware' => 'auth', 'uses' => 'GigsController@gigsByType']);
Route::get('/favors/{gigType}/{gig}', ['uses' => 'GigController@index']);
Route::post('/favors/{gigType}/{gig}', ['uses' => 'GigController@index']);
Route::post('/favors/{gigType}/{gig}/order', ['middleware' => 'auth', 'uses' => 'OrderController@index']);

Route::get('/order/commitorder', ['middleware' => 'auth', 'uses' => 'OrderController@createOrder', 'as' => 'ordercommit']);

Route::get('/essentialform5', ['middleware' => 'auth', 'uses' => 'OrderController@makeOrder', 'as' => 'makeOrderessential']);
Route::get('/enterpriseform5', ['middleware' => 'auth', 'uses' => 'OrderController@makeOrder2', 'as' => 'makeOrderenterprise']);
Route::get('/order/customCommitOrder', ['middleware' => 'auth', 'uses' => 'OrderController@processCustomOrder', 'as' => 'customordercommit']);







Route::post('register', 'RegisterController@postRegister');
Route::post('login', ['uses' => 'AuthController@postLogin', 'as' => 'login']);
Route::post('userLogin', [
    'uses'  => 'LoginController@postLogin',
    'as'    => 'postUserlogin'
]);


Route::post('userLogin2', [
    'uses'  => 'LoginController@postLogin1',
    'as'    => 'postUserlogin1'
]);


Route::post('userLogin3', [
    'uses'  => 'LoginController@postLogin2',
    'as'    => 'postUserlogin2'
]);




Route::post('/order/custom/createWithoutLogin', [
    'uses' => 'OrderController@createCustomOrder',
    'as' => 'ordercustom'
]);

Route::post('/order/expire/email', [
    'uses' => 'OrderController@order_expire',
    'as' => 'orderexpire'
]);

Route::get('/order/{orderno}/invoice/{invoiceno}', [
    'uses' => 'InvoiceController@index',
    'as' => 'orderinvoice',
]);

Route::get('adminInvoice/{orderno}/invoice/{invoiceno}',[
    'user' => 'InvoiceController@agency_order_invoice',
    'as'   => 'admin.invoice',
]);

Route::get('payment/status', [
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
]);

Route::get('essentialform', [
    'as' => 'payment.status1',
    'uses' => 'PaypalController@getPaymentStatus1',
]);

Route::get('essentialformlog', [
    'as' => 'payment.status3',
    'uses' => 'PaypalController@getPaymentloginStatus',
]);


Route::get('enterpriseformlog', [
    'as' => 'payment.status4',
    'uses' => 'PaypalController@getPaymentloginStatus1',
]);


Route::get('enterpriseform', [
    'as' => 'payment.status2',
    'uses' => 'PaypalController@Status2',
]);

Route::get('/packages', [
    'uses' => 'PackagesController@index',
    'as' => 'userpackages'
]);

Route::post('/packages/single', [
    'uses' => 'PackagesController@index',
    'as' => 'single.package'
]);

Route::get('/package/{packageId}/{funnel}/{uuid}',[
    'uses' => 'PackagesController@single_package',
    'as'   => 'site.single.package'
]);

Route::get('/package/{packageId}',[
    'uses' => 'PackagesController@single_package',
    'as'   => 'fb.single.package'
]);

Route::post('/get/single/package/details',[
    'uses' => 'PackagesController@get_single_pakcage_details',
    'as'   => 'get.single.package.details'
]);

Route::post('payment', [
    'uses' => 'PaypalController@postPayment',
    'as' => 'payment',
]);

Route::post('/checkout',[
    'uses' => 'HomeController@proceed_to_checkout',
    'as'   => 'proceed.checkout'
]);

Route::get('paymentprocess', [
    'uses' => 'PaypalController@postPaymentWithoutLogin',
    'as' => 'Gigpaymentprocess',
]);

Route::post('/order/packages', [
    'uses' => 'OrderController@createPackageOrder',
    'as' => 'order.package'
]);

Route::get('/order/packages/auth', [
    'uses' => 'OrderController@createPackageOrderWithoutLogin',
    'as' => 'order.package.withoutlogin'
]);


//Route::get('paymentprocessessential', [
//    'uses' => 'PaypalController@essentialWithoutLogin',
//    'as' => 'paymentprocessessential',
//]);

Route::group(['middleware' => 'auth'], function() {

    Route::get('/userdashboard', [
        'uses' => 'DashboardController@index',
        'as' => 'userdashboard'
    ]);

    Route::get('/favourites', [
        'uses' => 'MyFavouritesController@index',
        'as' => 'myfavourites',
    ]);

    Route::post('/customorder/create', [
        'uses' => 'CustomOrdersController@create',
        'as' => 'customordercreate'
    ]);

    Route::get('/my_orders', [
        'uses' => 'MyOrdersController@index',
        'as' => 'myorders'
    ]);
    Route:post('/order_complaint',[
        'uses' => 'MyOrdersController@complaint',
        'as'   => 'order.complaint'
    ]);
    Route::get('/order/{orderno}', [
        'uses' => 'MyOrdersController@getMyOrder',
        'as' => 'getmyorder'
    ]);

    Route::get('/getMsgs/{orderno}', [
        'uses' => 'MyOrdersController@get_messages',
        'as' => 'get_messages'
    ]);

    Route::get('/countMsgs/{orderno}', [
        'uses' => 'MyOrdersController@count_msgs',
        'as' => 'count_msgs'
    ]);



    Route::post('/order/message', [
        'uses' => 'MyOrdersController@postMessage',
        'as' => 'order.post.message'
    ]);

    Route::post('/userMessageFiles', [
        'uses' => 'MyOrdersController@GetorderMessageFiles',
        'as' => 'userorderFiles'
    ]);

    Route::post('/order_message', [
        'uses' => 'MyOrdersController@postMessageFiles',
        'as' => 'usermessageimages'
    ]);

    Route::post('/order/acknowledge', [
        'uses' => 'MyOrdersController@orderAcknowledge',
        'as' => 'order.acknowledge'
    ]);

    Route::post('/order/askformodification', [
        'uses' => 'MyOrdersController@orderAskForModification',
        'as' => 'order.askformodification'
    ]);

    Route::post('/order/custom/create', [
        'uses' => 'OrderController@createCustomOrder',
        'as' => 'order.custom.create'
    ]);

//    Route::post('/order/packages/{package_id}/{package_name}', [
//        'uses' => 'OrderController@createPackageOrder',
//        'as' => 'order.package'
//    ]);


    Route::get('/confirmorder/{orderType}', [
        'uses' => 'OrderController@confirmOrder',
        'as' => 'order.confirm'
    ]);



    Route::post('/gig/favourite', [
        'uses' => 'GigController@favourite',
        'as' => 'gig.favourite'
    ]);

    Route::post('/package/favourite', [
        'uses' => 'PackagesController@favourite',
        'as' => 'package.favourite'
    ]);


    Route::post('/gig/Unfavourite', [
        'uses' => 'GigController@UnFavourite',
        'as' => 'gig.unfavourite'
    ]);

    Route::get('/userNotifications', [
        'uses' => 'NotificationsController@getUserNotification',
        'as' => 'getnotifications'
    ]);
    Route::post('/readNotifications', [
        'uses' => 'NotificationsController@readUserNotification',
        'as' => 'readnotifications'
    ]);
    Route::post('/searchOrders', [
        'uses' => 'MyOrdersController@searchOrders',
        'as' => 'orders.search'
    ]);


    Route::get('/showSelectedOrders', [
        'uses' => 'MyOrdersController@selectedOrders',
    ]);
    Route::post('/feedback',[
        'uses' => 'MyOrdersController@order_feedback',
        'as'   => 'order.feedback'
    ]);


});

























Route::post('/messageImages/{orderno}/{orderuuid}/{user}', [
    'uses' => 'AdminOrderController@messageImages',
    'as' => 'adminmessageimages'
]);

Route::group(['prefix' => '/admin'], function() {

    Route::get('/', function () {
        return redirect()->route('adminlogin');
    });
    Route:post('reject/suggestion', [
        'uses' => 'AdminGigsController@reject_suggestion',
        'as'  => 'gigrejection.admin'
    ]);
    Route::get('/login', ['uses' => 'AdminLoginController@index', 'as' => 'adminlogin']);

    Route::post('/login', ['uses' => 'AdminAuthController@postLogin', 'as' => 'adminpostlogin']);

    Route::group(['middleware' => 'auth.admin'], function() {

        Route::get('/newsletter',[
            'uses' => 'AdminDashboardController@newsletter',
            'as'  => 'news.letter'
        ]);
        Route::post('/order_message', [
            'uses' => 'AdminOrderController@postMessageFiles',
            'as' => 'usermessageimages'
        ]);

        Route::get('/subadmin',[

            'uses' => 'AdminUsersController@Subadmin',
            'as'   => 'subadmin'
        ]);
        Route::post('/subadmin/data' ,[
            'uses' => 'AdminUsersController@get_subadmin_data',
            'as'   => 'subadmin.data'
        ]);
        Route:post('subadminupdate',[
            'uses' => 'AdminUsersController@subadmin_update',
            'as'   => 'subadmin.update.data'
        ]);
        Route::get('/slider',[

            'uses' => 'AdminDashboardController@addSliders',
            'as'   => 'addSliders'
        ]);
        Route::get('/logs',[

            'uses' => 'AdminDashboardController@getLogs',
            'as'   => 'logs'
        ]);
        Route::post('/slider_add',[

            'uses' => 'AdminDashboardController@addSliders',
            'as'   => 'addNewSlider'
        ]);
        Route::post('/slide_remove',[

            'uses' => 'AdminDashboardController@slideRemove',
            'as'   => 'slideRemove'
        ]);
        Route::post('/filter',[
            'uses' => 'AdminGigsController@filter_search',
            'as'   => 'filter.search'
        ]);
        Route::post('/filter/all',[
            'uses' => 'AdminGigsController@filter_search_all',
            'as'   => 'filter.search.all'
        ]);
        Route::post('/filter/order',[
            'uses' => 'AdminOrdersController@get_completeorders',
            'as'   => 'filter.search.order.all'
        ]);
        Route::post('/filter/custom/order',[
            'uses' => 'AdminOrdersController@get_complete_customorders',
            'as'   => 'filter.search.custom.order.all'
        ]);
        Route::get('/subadmin/{subadminEmail}',[

            'uses'  => 'AdminUsersController@SubadminProfile',
            'as'    => 'subadminprofile'

        ]);

        Route::get('/subadminCreat',[

            'uses'  => 'AdminUsersController@subadminCreat',
            'as'    => 'subadminCreat'
        ]);


        Route::get('/subAdminDelete',[

            'uses'  => 'AdminUsersController@subAdminDelete',
            'as'    => 'subAdminDelete'
        ]);

        Route::get('/adminInvoice/{invoiceNo}',[
            'uses' => 'AdminAgenciesController@admin_invoice',
            'as'   => 'admin.invoice',
        ]);

        Route::post('/subadminpostCreat',[

            'uses'  => 'AdminUsersController@PostsubadminCreat',
            'as'    => 'subadminPostCreat'
        ]);

        /*Route::get('/packages', [
            'uses' => 'PackagesController@index',
            'as' => 'adminpackages',
        ]);*/

        Route::get('/users', [
            'uses' => 'AdminUsersController@index',
            'as' => 'registeredusers'
        ]);
        Route::get('/complaints',[
            'uses' => 'AdminOrdersController@get_order_complaints',
            'as'   => 'get.orders.complaints'
        ]);
        Route::post('/complaints/resolved',[
            'uses' => 'AdminOrdersController@complaint_resolved',
            'as'   => 'orders.resolved'
        ]);
        Route::get('/user/{userEmail}', [
            'uses' => 'AdminUsersController@getUser',
            'as' => 'registereduser'
        ]);

        Route::get('/user/{userEmail}/update', [
            'uses' => 'AdminUsersController@updateUser',
            'as' => 'user.update'
        ]);

        Route::post('/user/update', [
            'uses' => 'AdminUsersController@putUserUpdate',
            'as' => 'adminUserUpdate',
        ]);

        Route::post('/user/activate', [
            'uses' => 'AdminUsersController@UserActivate',
            'as' => 'user.activate'
        ]);

        Route::post('/user/delete', [
            'uses' => 'AdminUsersController@UserDelete',
            'as' => 'userdelete'
        ]);


        Route::get('/adminSingleGig', [
            'uses' => 'AdminGigsController@singleGig',
            'as' => 'adminSingleGig'
        ]);

        Route::get('/adminSinglePackage', [
            'uses' => 'AdminPackagesController@singlePackage',
            'as' => 'adminSinglePackage'
        ]);

        Route::get('/adminCatSingleGig', [
            'uses' => 'AdminGigsController@catSingleGig',
            'as' => 'adminCatSingleGig'
        ]);
        Route::get('/admin/package/{packageId}',[
            'uses' => 'PackagesController@single_package',
            'as'   => 'admin.single.package'
        ]);
        Route::get('/packages/create', [
            'uses' => 'AdminPackagesController@create',
            'as' => 'adminpackagescreate'
        ]);

        Route::post('/packages/create', [
            'uses' => 'AdminPackagesController@create'
        ]);

        Route::get('/package/{packageId}', [
            'uses' => 'AdminPackagesController@packageUpdate',
            'as' => 'packageUpdate'
        ]);

        Route::post('/adminpackage/update', [
            'uses' => 'AdminPackagesController@putPackageUpdate',
            'as' => 'package.update'
        ]);

        Route::post('/package/activate', [
            'uses' => 'AdminPackagesController@PackageActivate',
            'as' => 'package.activate'
        ]);
        Route::post('/package/accept', [
            'uses' => 'AdminPackagesController@PackageAccept',
            'as' => 'package.accept'
        ]);



        Route::post('/pakages/delete', [

            'uses' => 'AdminPackagesController@delete',
            'as' => 'pakagedelete'
        ]);

        Route::get('/packages/types', [
            'uses' => 'AdminPackagesTypesController@index',
            'as' => 'adminpackagestypes'
        ]);


        Route::get('/TrashGigs', [
            'uses' => 'AdminGigsController@trashGigs',
            'as' => 'adminTrashGigs'
        ]);
        Route::get('/Trashpackages',[
            'uses' => 'AdminPackagesController@trashpackages',
            'as'   => 'admintrashpackages'
        ]);
        Route::get('/catTrashGigs', [
            'uses' => 'AdminGigsController@catTrashGigs',
            'as' => 'adminCatTrashGigs'
        ]);

        Route::get('/moveToTrash', [
            'uses' => 'AdminGigsController@add_gig_to_trash',
            'as' => 'adminTrashGig'
        ]);

        Route::get('/catMoveToTrash', [
            'uses' => 'AdminGigsController@add_gigtype_to_trash',
            'as' => 'adminCatTrashGig'
        ]);


        Route::get('/deleteOrder', [
            'uses' => 'AdminOrdersController@deleteOrder',
            'as' => 'orderdelete'
        ]);


        Route::get('/SingleOrder', [
            'uses' => 'AdminOrdersController@singleOrder',
            'as' => 'adminSingleOrder'
        ]);

        Route::get('/pemdingOrder',[

            'uses' => 'AdminOrdersController@singlePendingOrder',
            'as' => 'pendingOrder'
        ]);

        Route::get('/undoTrash', [
            'uses' => 'AdminGigsController@undoGig',
            'as' => 'adminUndoGig'
        ]);

        Route::get('/undoTrash/package', [
            'uses' => 'AdminPackagesController@undoPackage',
            'as' => 'adminUndoPackage'
        ]);


        Route::get('/undoCatTrash', [
            'uses' => 'AdminGigsController@catUndoGig',
            'as' => 'adminCatUndoGig'
        ]);

        Route::get('/packagesOrders', [
            'uses' => 'AdminOrdersController@packagesOrders',
            'as' => 'admin.orders.packages'
        ]);


        Route::get('/packages/types/create', [
            'uses' => 'AdminPackagesTypesController@create',
            'as' => 'adminpackagestypescreate'
        ]);

        Route::get('/packages/types/{packageTypeId}', [
            'uses' => 'AdminPackagesTypesController@PackageTypeUpdate',
            'as' => 'packageTypeUpdate'
        ]);

        Route::post('/packages/types/create', [
            'uses' => 'AdminPackagesTypesController@create'
        ]);

        Route::post('/packageType/activate', [
            'uses' => 'AdminPackagesTypesController@PackageTypeActivate',
            'as' => 'packageType.activate'
        ]);

        Route::post('/packages/types/delete', [
            'uses' => 'AdminPackagesTypesController@delete',
            'as' => 'adminpackagestypesdelete'
        ]);

        Route::post('/packages/types/update', [
            'uses' => 'AdminPackagesTypesController@putPackageTypeUpdate',
            'as' => 'package.type.update'
        ]);

        Route::get('/favors', [
            'uses' => 'AdminGigsController@index',
            'as' => 'admingigs',
        ]);

        Route::get('/notifications', [
            'uses' => 'NotificationsController@getNotifications',
            'as' => 'getnotifications'
        ]);

        Route::get('/packages', [
            'uses' => 'AdminPackagesController@index',
            'as' => 'adminpackages',
        ]);

        Route::get('/favors/create', [
            'uses' => 'AdminGigsController@create',
            'as' => 'gigcreate'
        ]);

        Route::post('/deleteQuestion', [
            'uses' => 'AdminGigsController@deleteQuestion',
            'as' => 'deleteQuestion'
        ]);

        Route::post('/gig/update', [
            'uses' => 'AdminGigController@update',
            'as' => 'gig.update'
        ]);

        Route::post('/favors/create', 'AdminGigsController@createGig');

        Route::delete('/gigs/delete', [
            'uses' => 'AdminGigsController@deleteGig',
            'as' => 'adminGigDelete'
        ]);

        Route::get('/favors/categories', [
            'uses' => 'AdminGigsCategoriesController@index',
            'as' => 'admingigscategories'
        ]);

        Route::get('/favors/category/subcategories', [
            'uses' => 'AdminGigsCategoriesController@getSubCategories',
            'as' => 'admin.category.subcategories'
        ]);

        Route::post('gigs/category/featured',[

            'uses' => 'AdminGigsCategoriesController@featuredCategory',
            'as' => 'category.featured'
        ]);
        Route::post('/favours/delete',[

            'uses' => 'AdminGigsCategoriesCreateController@deleteSubCategory',
            'as' => 'gig-subcat-remove'
        ]);



        Route::get('/favors/categories/create', [
            'uses' => 'AdminGigsCategoriesController@getCreate',
            'as' => 'admingigscategoriescreate'
        ]);

        Route::post('/gigs/categories/create', [
            'uses' => 'AdminGigsCategoriesController@postCreate',
            'as' => 'admingigscategoriescreatecreate'
        ]);

        Route::post('/gigs/categories/update', [
            'uses' => 'AdminGigsCategoriesController@categoryUpdate',
            'as' => 'gigs.categories.update'
        ]);

        Route::post('/gigs/categories/delete', [
            'uses' => 'AdminGigsCategoriesCreateController@delete',
            'as' => 'admingigscategoriesdelete'
        ]);

        Route::post('/gig/image/{imageid}/remove', [
            'uses' => 'AdminGigController@removeGigImage',
            'as' => 'gig.image.remove'
        ]);

        Route::post('/gig/activate', [
            'uses' => 'AdminGigController@gigActivate',
            'as' => 'gig.activate'
        ]);
        Route::post('/gig/accept', [
            'uses' => 'AdminGigController@gigAccepted',
            'as' => 'gig.accept'
        ]);
        Route::post('/package/activate', [
            'uses' => 'AdminPackagesController@packageActivate',
            'as' => 'package.activate'
        ]);

        Route::post('/categoriesGig/activate', [
            'uses' => 'AdminGigsCategoriesController@CategoriesGigActivate',
            'as' => 'gigsCategoriesActivate'
        ]);

        Route::post('/gig/featured', [
            'uses' => 'AdminGigController@gigFeatured',
            'as' => 'gig.featured'
        ]);

        Route::post('/package/featured', [
            'uses' => 'AdminPackagesController@packageFeatured',
            'as' => 'package.featured'
        ]);

        Route::get('/dashboard', [
            'uses' => 'AdminDashboardController@index',
            'as' => 'admindashboard',
        ]);


        Route::get('/agencies', [
            'uses' => 'AdminAgenciesController@index',
            'as' => 'adminagencies',
        ]);

        Route::get('/agencies/suggestion', [
            'uses' => 'AdminGigsController@suggestedGigs',
            'as' => 'agenciesSuggestion',
        ]);

        Route::get('/agencies/packages', [
            'uses' => 'AdminPackagesController@suggestedPackages',
            'as' => 'packagesSuggestion',
        ]);
        Route::get('/agencies/package/suggestion',[
            'uses' => 'AdminPackagesController@package_suggestion',
            'as'   => 'admin.package.suggestion'
        ]);
        Route::get('/agency/{agencyMail}', [
            'uses' => 'AdminAgenciesController@getAgency',
            'as' => 'admin.agency'
        ]);
        Route::get('/agency_data/{agencyEmail}',[
            'uses' => 'AdminAgenciesController@get_agency_data',
            'as'   => 'agency.datarequest'
        ]);

        Route::get('agencyPayments',[

            'uses'  => 'AdminAgenciesController@AgencyPayments',
            'as'    => 'agencyPaymentsExport'
        ]);

        Route::post('/agencies/amount/withdraw', [
            'uses' => 'AdminAgenciesController@withdrawAgencyAmount',
            'as' => 'agency.amount.withdraw'
        ]);

        Route::get('/agency/{agencyEmail}/update', [
            'uses' => 'AdminAgenciesController@agencyUpdate',
            'as' => 'agency.update'
        ]);

        Route::get('/agency/{agencyEmail}/accept', [
            'uses' => 'AdminAgenciesController@agencyAccept',
            'as' => 'agency.AcceptRequest'
        ]);

        Route::post('/agency/resend', [
            'uses' => 'AdminAgenciesController@resend_email',
            'as' => 'agency.resend.email'
        ]);

        Route::post('/agency/accept', [
            'uses' => 'AdminAgenciesController@agencyAccept',
            'as' => 'agency.Accept.Request'
        ]);

        Route::get('/delete_agency', [
            'uses' => 'AdminAgenciesController@agencyDelete',
            'as' => 'deleteAgency'

        ]);

        Route::get('/delete_InactiveAgency', [
            'uses' => 'AdminAgenciesController@deleteInActiveAgency',
            'as' => 'deleteInactiveAgency'

        ]);

        Route::get('/delete/additionalAgency', [
            'uses' => 'AdminAgenciesController@agency_additional_Delete',
            'as' => 'delete.Agency.additional'

        ]);

        Route::post('/agency/activate', [
            'uses' => 'AdminAgenciesController@agencyActivate',
            'as' => 'agency.activate'
        ]);

        Route::get('/orders', [
            'uses' => 'AdminOrdersController@index',
            'as' => 'adminorders',
        ]);

        Route::get('/orders/custom', [
            'uses' => 'AdminOrdersController@customOrders',
            'as' => 'admin.orders.custom'
        ]);

        Route::get('/orders_csv', [
            'uses' => 'AdminOrdersController@OrdersCSV',
            'as' => 'orders_csv'
        ]);


        Route::post('/order/assign', [
            'uses' => 'AdminOrderController@assignJobTo',
            'as' => 'adminorderassign'
        ]);

        Route::get('/order/{orderno}/{orderuuid}', [
            'uses' => 'AdminOrderController@index',
            'as' => 'adminorder',
        ]);
        Route::get('/order', [
            'uses' => 'AdminOrderController@ajax_order',
            'as' => 'adminorderajax',
        ]);

        Route::get('/order/{orderno}/{orderuuid}/jobdone', [
            'uses' => 'AdminOrderController@jobDone',
            'as' => 'adminorderjobdone',
        ]);

        Route::get('/order/{orderno}/{orderuuid}/recentMessages', [
            'uses' => 'AdminOrderController@get_recent_messages',
            'as' => 'getAgencyOrderMessages',
        ]);


        Route::get('/order/{orderno}/{orderuuid}/getAdminUserMessages', [
            'uses' => 'AdminOrderController@get_admin_user_msgs',
            'as' => 'getAdminUserMessages',
        ]);

        Route::get('/order/{orderno}/{orderuuid}/getCountClientMsgs', [
            'uses' => 'AdminOrderController@getCountClientMsgs',
            'as' => 'getCountClientMsgs',
        ]);


        Route::get('/order/{orderno}/{orderuuid}/countAgencyMsgs', [
            'uses' => 'AdminOrderController@countAgencyMsgs',
            'as' => 'countAgencyMsgs',
        ]);


        Route::get('/order/{orderno}/{orderuuid}/jobcancel', [
            'uses' => 'AdminOrderController@jobCancel',
            'as' => 'adminorderjobCancel',
        ]);

        Route::post('/order/{orderno}/{orderuuid}', [
            'uses' => 'AdminOrderController@sendOrderMessage',
            'as' => 'adminordermessage'
        ]);

        Route::post('/adminorderMessageFiles', [
            'uses' => 'AdminOrderController@GetorderMessageFiles',
            'as' => 'adminorderFiles'
        ]);
        Route::get('get_block_order/{status}',[
            'uses' => 'AdminOrderController@get_orders_block',
            'as'  => 'get.order.block'
        ]);
        Route::get('get_gig_block_order/{status}',[
            'uses' => 'AdminOrderController@get_gig_orders_block',
            'as'  => 'get.gig.order.block'
        ]);
        Route::post('/open/order',[
            'uses' => 'AdminOrderController@open_order',
            'as'   => 'open.order'
        ]);
        Route::post('/leave/request',[
            'uses' => 'AdminOrderController@leave_request',
            'as'   => 'leave.request'
        ]);
        Route::get('check/leave/request/{order_no}/{funnel}',[
            'uses' => 'AdminOrderController@check_leave_request',
            'as'   => 'check.leave.request'
        ]);
        Route::post('cancel/leave/request',[
            'uses' => 'AdminOrderController@cancel_leave',
            'as'   => 'cancel.leave.request'
        ]);
        Route::get('/agencies/create', [
            'uses' => 'AdminAgenciesCreateController@index',
            'as' => 'adminagenciescreate',
        ]);

        Route::post('/agencies/postcreate', [
            'uses' => 'AdminAgenciesCreateController@agencyRegister',
            'as' => 'adminagenciesPostcreate',
        ]);

        Route::post('/agency/update', [
            'uses' => 'AdminAgenciesController@putAgencyUpdate',
            'as' => 'adminAgenciesUpdate',
        ]);

        Route::post('/agency/update', [
            'uses' => 'AdminAgenciesController@putAgencyUpdate',
            'as' => 'adminAgenciesUpdate',
        ]);


        Route::post('/gigImagesRemove/', [
            'uses' => 'AdminGigController@removeGigImages',
            'as' => 'gig.images.remove'
        ]);

        Route::post('/gigAddonRemove/', [
            'uses' => 'AdminGigController@removeGigAddon',
            'as' => 'gig-adon-remove'
        ]);

        Route::post('/gigoptionRemove/', [
            'uses' => 'AdminPackagesController@packageoption',
            'as' => 'gig-option-remove'
        ]);
        Route::post('/package/updation/', [
            'uses' => 'AdminPackagesController@putPackageUpdate',
            'as' => 'admin.package.update'
        ]);
        Route::post('agency/gigoptionRemove/', [
            'uses' => 'AgencyOrdersController@agencypackageoption',
            'as' => 'agency.gig-option-remove'
        ]);
        Route::post('/packageImagesRemove/', [
            'uses' => 'AdminPackagesController@removepackageImages',
            'as' => 'packages.images.remove.agency'
        ]);
        Route::get('/admin_package/{packageId}', [
            'uses' => 'AdminPackagesController@package_suggestion',
            'as' => 'adminpackageUpdate'
        ]);
        Route::post('/suggestion/packagecreate',[
            'uses' => 'AdminPackagesController@PackageCreate',
            'as'  => 'Create.adminpacakge'
        ]);

        Route::get('/logout', [
            'uses' => 'AdminAuthController@logout',
            'as' => 'adminlogout'
        ]);
        Route::post('/statuschanged',[
            'uses' => 'AdminAgenciesController@invoice_status',
            'as'   => 'status.changed',
        ]);
        Route::get('/payments/withdrawrequest',[
            'uses' => 'AdminDashboardController@payment_withdraw',
            'as'  => 'payment.request'
        ]);
        Route::get('/withdrawals',[
            'uses' => 'AdminDashboardController@withdrawals',
            'as'   => 'withdraw.page'
        ]);
        Route::post('/pakages/delete', [
            'uses' => 'AdminPackagesController@delete',
            'as' => 'adminpakagedelete'
        ]);
        Route::get('package/accept/{packageId}',[
            'uses' => 'AdminPackagesController@PackageAccept',
            'as'   => 'accept.package'
        ]);
        Route::post('package/reject',[
            'uses' => 'AdminPackagesController@PackageReject',
            'as'   => 'reject.package'
        ]);

    });


});

//gig details
Route::get('/favors/{gigType}/{gig}', [
    'uses' => 'GigController@index',
    'as' => 'gigdetail',
]);



Route::post('/messageImages/{orderno}/{orderuuid}', [
    'uses' => 'AgencyOrdersController@messageImages',
    'as' => 'agencymessageimages'
]);

Route::group(['prefix' => '/agency'], function() {

    Route::post('/sendproblememail',[
        'uses' => 'AgencyOrdersController@send_problem_email',
        'as'   => 'send.problem.email'
    ]);
    Route::get('/login', [
        'uses' => 'AgencyAuthController@index',
        'as' => 'agencylogin'
    ]);
    Route::post('/order_message', [
        'uses' => 'AgencyOrdersController@postMessageFiles',
        'as' => 'usermessageimages'
    ]);
    Route::get('/agency_package/{packageId}', [
        'uses' => 'AgencyOrdersController@packageUpdate',
        'as' => 'agencypackageUpdate'
    ]);
    Route::post('/agencypackageImagesRemove/', [
        'uses' => 'AgencyOrdersController@removepackageImages',
        'as' => 'packages.images.remove.agencies'
    ]);
    Route::delete('/gigs/delete', [
        'uses' => 'AgencyOrdersController@deleteGig',
        'as' => 'agencyDeleteGig'
    ]);



    Route::post('/gigImagesRemove/', [
        'uses' => 'AgencyOrdersController@removeGigImages',
        'as' => 'gig.images.remove.agency'
    ]);

    Route::get('/agencyactivate/email', [
        'uses' => 'AgencyAuthController@activateAgency',
        'as' => 'agencyloginActivate'
    ]);
    Route::post('/login',[
        'uses' => 'AgencyAuthController@postLogin',
        'as' => 'agencypostlogin'
    ]);

    Route::group(['middleware' => 'auth.agency'], function() {

        Route::get('/dashboard', [
            'uses' => 'AgencyDashboardController@index',
            'as' => 'agencydashboard'
        ]);
        Route::get('/agency/business', [
            'uses' => 'AgencyDashboardController@business',
            'as'   => 'agency.business'
        ]);
        Route::get('/profile', [
            'uses' => 'AgencyProfileController@index',
            'as' => 'agencyprofile'
        ]);



        Route::post('/profile/image', [
            'uses' => 'AgencyProfileController@image_upload',
            'as' => 'image.upload'
        ]);


        Route::get('/userHistory', [
            'uses' => 'AgencyProfileController@userHistory',
            'as' => 'userHistory'
        ]);

        Route::get('/profile/edit',[
            'uses' => 'AgencyProfileController@editagency',
            'as'   => 'agencyDetailsUpdate'
        ]);

        Route::post('/profile/update',[

            'uses' => 'AgencyProfileController@putAgencyProfileUpdate',
            'as'  => 'PutProfile.Update'

        ]);

        Route::get('agency_invoice',[

            'uses'  => 'AgencyProfileController@AgencyPayments',
            'as'    => 'agencyPayments'
        ]);

        Route::get('/orders-list', [
            'uses' => 'AgencyOrdersController@getOrdersList',
            'as' => 'agencyorderslist'
        ]);

        Route::get('/gig-suggestion', [
            'uses' => 'AgencyOrdersController@gigSuggestion',
            'as' => 'gigsuggestion'
        ]);

        Route::get('/package-suggestion', [
            'uses' => 'AgencyOrdersController@packageSuggestion',
            'as' => 'packageuggestion'
        ]);

        Route::get('/suggested_gigs', [
            'uses' => 'AgencyOrdersController@SuggestedGigs',
            'as' => 'suggestedgigs'
        ]);
        Route::post('/agencySingleGig', [
            'uses' => 'AgencyOrdersController@singleGig',
            'as' => 'agencySingleGig'
        ]);
        Route::post('/gigAddon/agency/Remove/', [
            'uses' => 'AdminGigController@removeGigAddon',
            'as' => 'gig-addon-remove'
        ]);

        Route::get('/checkGigsStatus', [
            'uses'  => 'AgencyOrdersController@checkGigsStatus',
            'as'    => 'checkGigsStatus'
        ]);

        Route::get('/checkPackagesStatus', [
            'uses'  => 'AgencyOrdersController@checkPackagesStatus',
            'as'    => 'checkPackagesStatus'
        ]);

        Route::post('/updateAutoAssign', [
            'uses'  =>  'AgencyOrdersController@updateAutoAssign',
            'as'    =>  'update.auto_assign'
        ]);

        Route::get('/suggested_packages', [
            'uses' => 'AgencyOrdersController@SuggestedPacakges',
            'as' => 'suggestedpackages'
        ]);

        Route::post('/suggestion/gigcreate',[

            'uses' => 'AgencyOrdersController@suggestionGigCreate',
            'as'  => 'Create.Agencygig'

        ]);

        Route::post('/suggestion/packagecreate',[

            'uses' => 'AgencyOrdersController@suggestionPackageCreate',
            'as'  => 'Create.Agencypacakge'

        ]);


        Route::get('/favors/Agencycategory/subcategories', [
            'uses' => 'AdminGigsCategoriesController@getSubCategories',
            'as' => 'agency.category.subcategories'
        ]);
        Route::post('/suggestiongig/update', [
            'uses' => 'AgencyOrdersController@update',
            'as' => 'suggestgig.update'
        ]);

        Route::get('/order', [
            'uses' => 'AgencyOrderController@index',
            'as' => 'agencyorder'
        ]);

        Route::post('/order/{orderno}/{orderuuid}', [
            'uses' => 'AgencyOrdersController@sendOrderMessage',
            'as' => 'agencyordermessage'
        ]);


        Route::get('/order/{orderno}/{orderuuid}/recentMessages', [
            'uses' => 'AgencyOrdersController@get_admin_agency_chat',
            'as' => 'get_agency_order_msgs',
        ]);


        Route::get('/order/{orderno}/{orderuuid}/getAdminUserMessages', [
            'uses' => 'AgencyOrdersController@get_admin_user_msgs',
            'as' => 'get_admin_user_msgs',
        ]);

        Route::get('/order/{orderno}/{orderuuid}/getCountClientMsgs', [
            'uses' => 'AgencyOrdersController@get_count_admin_user_msgs',
            'as' => 'get_count_admin_user_msgs',
        ]);


        Route::get('/order/{orderno}/{orderuuid}/countAgencyMsgs', [
            'uses' => 'AgencyOrdersController@countAgencyMsgs',
            'as' => 'count_agency_msgs',
        ]);

        Route::post('/orderMessageFiles', [
            'uses' => 'AgencyOrdersController@GetorderMessageFiles',
            'as' => 'agencyorderFiles'
        ]);

        Route::post('/delete_message', [
            'uses' => 'AgencyOrdersController@delete_message',
            'as' => 'agency.delete.message'
        ]);

        Route::get('/order/{orderno}/{orderuuid}/jobdone', [
            'uses' => 'AgencyOrdersController@jobDone',
            'as' => 'agencyorderjobdone',
        ]);

        Route::get('/logout', [
            'uses' => 'AgencyAuthController@logout',
            'as' => 'agencylogout'
        ]);

        Route::get('/order/{orderno}/{orderuuid}', [
            'uses' => 'AgencyOrdersController@singleOrder',
            'as' => 'agencySingleOrder',
        ]);

        Route::get('/AgencyNotifications', [

            'uses' => 'NotificationsController@getAgencyNotification',
            'as' => 'getAgencyNotifications'
        ]);

        Route::post('/order/{orderno}/{orderuuid}', [
            'uses' => 'AgencyOrdersController@sendOrderMessage',
            'as' => 'agencyOrderMessage'
        ]);

        Route::post('/profile/withdrawamount',[

            'uses' => 'AgencyProfileController@requestWithdraw',
            'as'   => 'request.amount.withdraw'

        ]);
        Route::post('agency/notify/settings',[
            'uses'       => 'SettingsController@agency_notify_settings',
            'as'         => 'agency.notify.settings'
        ]);
        Route::get('agency/faq',[
            'uses'       => 'AgencyDashboardController@faq',
            'as'         => 'agency.faq'
        ]);
        Route::post('/pakages/delete', [
            'uses' => 'AgencyOrdersController@delete',
            'as' => 'agencypakagedelete'
        ]);
        Route::post('/package/update', [
            'uses' => 'AgencyOrdersController@putPackageUpdate',
            'as' => 'agency.package.update'
        ]);

    });

});

Route::get('/agency/contact',[
    'uses' => 'ContactController@agency_contact_form',
    'as'   => 'agencycontactform'
]);
Route::get('/contact', [
    'uses' => 'ContactController@contactUs',
    'as' => 'contact'
]);
Route::get('/kontact/agency', [
    'uses' => 'ContactController@Agencycontact',
    'as' => 'Agencycontact'
]);
Route::get('/thanku_cnerr', [
    'uses' => 'ContactController@thankuPage',
    'as' => 'tahnku'
]);



Route::get('/impressum', [
    'uses' => 'ImpressumController@index',
    'as' => 'impressum'
]);

Route::get('/datenschutz', [
    'uses' => 'ImpressumController@datum',
    'as' => 'datenschutz'
]);

Route::get('/AGB', [
    'uses' => 'ImpressumController@agb',
    'as' => 'agb'
]);

Route::get('/agency_register', [
    'uses' => 'HomeController@agencyContact',
    'as' => 'agency.register'
]);

Route::get('agency_register/agencyEmail', [
    'uses' => 'HomeController@agencyRegister',
    'as' => 'agency.registerForm'
]);
Route::post('/agency_register/agencyEmail', [
    'uses' => 'HomeController@agencyRegister',
    'as' => 'agency.registerFormSuccess'
]);
Route::post('agency_update/payment', [
    'uses' => 'AgencyProfileController@update_paymeny_details',
    'as'   => 'update.pay.details'
]);
Route::post('agency_payment_details', [
    'uses' => 'AgencyProfileController@payment_details',
    'as'   => 'pay.details'
]);
Route::post('vacation_mode',[
    'uses' => 'AgencyAuthController@vacation_mode',
    'as'   => 'vacation.mode'
]);

//Route::post('/agency/pay_details',[
//    'uses' => 'AgencyProfileController',
//    'as'   => ''
//]);




/*
 * Authentication
 */

//Route::get('register', ['uses' => 'AuthController@getRegister', 'as' => 'auth.reg']);
//Route::post('register', ['uses' => 'AuthController@postRegister']);




/*
 * Web Services API
 */

Route::group(['prefix' => 'api'], function() {
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('authenticate/google', 'AuthenticateController@redirectToGoogleProvider');
    Route::get('authenticate/google/callback', 'AuthenticateController@handleGoogleProviderCallback');
});

  Route::get('ali', [ 
      'uses' => 'ContactController@pay_method',
      'as'   => 'pay.details'
]);

Route::get('/referral_programme',[
    'uses' => 'HomeController@referral_programme',
    'as'   => 'referral.programme'
]);

Route::post('/checkEmail',[
    'uses' => 'HomeController@checkEmail',
    'as'   => 'Check.email'
]);

Route::get('/test/referral/email',function(){
    return view('referral_email');
});
Route::post('/check/promocode',[
    'uses' => 'HomeController@check_promocode',
    'as'   => 'check.promocode'
]);
?>



