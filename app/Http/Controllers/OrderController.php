<?php

namespace App\Http\Controllers;

use Aws\Common\Facade\Ses;
use Mail;
use App\CnerrPayment;
use App\CnerrPayments;
use App\Gig_addon;
use App\Notification;
use App\Order;
use App\OrderQuestionAnswer;
use App\Package;
use App\User;
use App\Message;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\OrderAddon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Gig_question;
use App\Gig;
use App\Gigtype;
use Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

class OrderController extends Controller
{

    private function getQuestions($questions)
    {

        foreach ($questions as $question) {
            if ($question->type == 'check')
                $question->answers = explode(',', $question->answers);
            else if ($question->type = 'range') {
                $question->answers = explode(' ', $question->answers);
            }
        }

        return $questions;
    }

    private function getOrderAddons($request)
    {

        $addons_response = $request->except(['funnel']);

        $addons['addons'] = [];
        $addons['total_addons_amount'] = 0;

        foreach ($addons_response as $key => $value) {
            if (!empty($request->input($key))) {
                $addon = Gig_addon::where(['id' => $key])->first();
                $addon['quantity'] = $value;
                $addon['total_amount'] = $addon->amount * $value;

                $addons['total_addons_amount'] = ((int)$addons['total_addons_amount']) + ((int)$addon->amount * $value);
                array_push($addons['addons'], $addon);
            }
        }

        return $addons;

    }

    public function index(Request $request, $gigType, $gig)
    {
        $gigTypee = Gigtype::where('slug', $gigType)->first();
        $gig = Gig::where(['gigtype_id' => $gigTypee->id, 'slug' => $gig, 'uuid' => $request->input('funnel')])->first();
        $questions = Gig_question::where('gig_id', $gig->id)->get();

        $order_addons = $this->getOrderAddons($request);


        Session::put('order_gig', $gig);
        Session::put('order_addons', $order_addons);

        $data['questions'] = $this->getQuestions($questions);
        $data['order_addons'] = $order_addons;
        $data['gig'] = $gig;
        $data['total_order_amount'] = ((int)$order_addons['total_addons_amount']) + ((int)$gig->price);

        return view('pages.order')->with($data);
    }


    public function processCustomOrder(Request $request)
    {

        $order_total_amount = Session::get('total_order_amount');

        $net_total = round($order_total_amount / (1 + 19 / 100), 2);
        $order_service_tax = (($order_total_amount * 5) / 100);
        $order_govt_tax = ($order_total_amount - $net_total);

        $days = Session::get('total_days');

        $expiry = date('Y-m-d H:m:i', strtotime('+' . $days . ' days'));

        $data = [

            'expiry' => $expiry,
            'amount' => $order_total_amount,
            'service_charges' => $order_service_tax,
            'govt_tax' => $order_govt_tax,
            'net_total' => $net_total

        ];

        $orderUpdate = Order::where('uuid', Session::get('order_uuid'))->update($data);
        $message = Message::where('id', Session::get('message_id'))->update(['message_status' => 'offer_accepted']);

        if ($message) {
            $order = Order::where('uuid', Session::get('order_uuid'))->first();
            $admin = Admin::where('type', 'admin')->first();
            $user = Auth::user()->get();
            $not_id = Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">User has accepted the offer.</a>');
            Notification::where('id', $not_id)->update(['message' => '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">User has accepted the offer.</a>']);
            // Send Mail


            $users = array('user', 'admin');

            $data['admin'] = User::where('type', 'admin')->first();
            $data['user'] = User::where(['type' => 'user', 'id' => $user->id])->first();

            for ($i = 0; $i <= 1; $i++) {

                $from = 'marketplace@4slash.com';
                $sub = 'New Order';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                if ($users[$i] == 'user') {
                    $data = [
                        'order_no' => $order->order_no,
                        'gig' => $order->custom_order_products,
                        'date' => $order->created_at,
                        'user' => $user->username,
                    ];

                    $view = View('mail', $data)->render();
                    $mailbody = $view;
                     $to = $user->email;

                    mail($to, $sub, $mailbody, $headers);


                } else if ($users[$i] == 'admin') {
                    $data_admin = [
                        'type' => 'admin',
                        'order_no' => $order->order_no,
                        'orderUUID' => $order->uuid,
                        'gig' => $order->custom_order_products,
                        'gig_delivery_days' => Session::get('total_days'),
                        'gig_discription' => Session::get('company_discription'),
                        'date' => $order->created_at,
                        'gig_amount' => $order->amount,
                        'user' => $user->username,
                        'user_email' => $user->email

                    ];

                    $view = View('adminMail', $data_admin)->render();
                    $to = 'marketplace@4slash.com';
                    $subAdmin = 'New order | 4slash';

                    mail($to, $subAdmin, $view, $headers);
                }


            }
        }


        Session::forget('message_id');
        Session::forget('order_type');
        Session::forget('total_days');
        Session::forget('total_order_amount');
        $order = Order::where('uuid', Session::get('order_uuid'))->first();
        Session::forget('order_uuid');
        $data = [
            'success' => $request->session()->flash('status', 'Thank you for your order'),
            'order_no' => $request->session()->flash('order', $order->order_no)

        ];
        return redirect()->route('myorders', ['orderno' => $order->order_no])->with($data);


    }


    public function createOrder(Request $request)
    {
        $gig = Session::get('order_gig');
        $orderAddon = Session::get('order_addons');
        $user = Auth::user()->get();
        if (!empty(Session::get('questions')))
            $questions = Session::get('questions');
        else
            $questions = '';


        DB::transaction(function () use ($request, $gig, $user) {
            if($request->input('promocode')){
                $promocode = $request->input('promocode');
                $promocode_data = DB::table('Promocodes')->where(['promocode' => $promocode,'type' => 'basic','status' => 1])->orWhere(['promocode' => $promocode,'type' => 'platinum'])->first();
                $order_total_amount = (float)Session::get('total_order_amount') - (float)$promocode_data->amount;
            }else {
                $promocode_data = '';
                $order_total_amount = Session::get('order_last_amount');
            }
            $order_info = Session::get('order_info');
            // $questions = Session::get('questions');
            $net_total = round($order_total_amount / (1 + 19 / 100), 2);
            $wallet = $request->input('method_type');
            if($wallet !== "wallet") {
                $order_service_tax = (($order_total_amount * 5) / 100);
            }else{
                $order_service_tax = 0;
            }
            $order_govt_tax = ($order_total_amount - $net_total);
            //$order_net_amount = $order_total_amount - $order_govt_tax;
            $order = new Order;
            $order->uuid = \Webpatser\Uuid\Uuid::generate(4);
            $order->order_no = date("Ymd") . strtoupper(substr(uniqid(sha1(time())), 0, 4));
            $order->gig_id = $gig->id;
            $order->gig_owner_id = $gig->user_id;

            $gig_data = Gig::select('auto_assign', 'suggested_by', 'active')->where('id', $gig->id)->first();

            /* Check if the gig has auto assign
             * create a variable
             * assign to that user who suggested or created the gig or the gig owner
             * */
            if ($gig_data->auto_assign == 1 && $gig_data->active == 1 || $gig_data->active == 3) {
                $order->assigned_to = $gig_data->suggested_by;
                $agency = User::where('id', $gig_data->suggested_by)->first();
                $users = array('user', 'admin', 'agency');
            } else {
                $users = array('user', 'admin');

            }



            $order->user_id = $user->id;
            $order->company_name = $user->username;
            $order->company_tagline = $user->username;
            $order->company_industry = $user->username;
            $order->company_discription = 'NULL';
            $order->type = 'gig';
            $order->amount = $order_total_amount;
            $order->service_charges = $order_service_tax;
            $order->govt_tax = $order_govt_tax;
            $order->net_total = $net_total;
            $order->expiry = Carbon::now()->addDays(((int)$gig->delivery_days));
            if($wallet == "wallet"){
                $order->order_from_type = $wallet;
                $user_current_wallet = $user->wallet;
                $new_wallet_amount = $user_current_wallet-$order_total_amount;
                User::where('id',$user->id)->update(['wallet' => $new_wallet_amount]);
            }else{
                $order->order_from_type = "paypal";
            }
            $order->save();

            $refererr_user = DB::table('user_referral')->where('referral_email',$user->email)->first();
            if(!empty($refererr_user)) {
                if ($refererr_user->status == 1) {
                    $refererr_user_update = DB::table('user_referral')->where('referral_email', $user->email)->update(['status' => 0]);
                    $user_wallet_update = DB::table('users')->where('email', $user->email)->update(['wallet' => 5.00]);
                    $refererr_user_data = DB::table('users')->where('id', $refererr_user->user_id)->first();
                    $user_new_wallet = $refererr_user_data->wallet + 5;
                    $referrer_user_wallet_update = DB::table('users')->where('id', $refererr_user->user_id)->update(['wallet' => $user_new_wallet]);
                }
            }
            if(Session::get('promocode')) {
                $promocode = Session::get('promocode');
                DB::table('Promocodes')->where('promocode', $promocode)->update(['status' => 0]);
            }
            Session::put('order_id', $order->id);
            $admin = Admin::where('type', 'admin')->first();

            if($gig_data->auto_assign == 1 && $gig_data->active == 1 || $gig_data->active == 3) {
                /* Send Notification to the Agency*/
                $not_id_agency = DB::table('notifications')->insertGetId([
                    'order_id' => $order->id,
                    'user_id' => $agency->id,
                    'message' => '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">New order</a>'
                ]);

                /* update notification of agency*/
                DB::table('notifications')->where('id', $not_id_agency)->update([
                    'message' => '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id_agency . '">New order</a>'
                ]);
            }

            $not_id = Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">New order</a>');
            Notification::where('id', $not_id)->update(['message' => '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">New order</a>']);
            // Send Mail


            $data['admin'] = User::where('type', 'admin')->first();
            $data['user'] = User::where(['type' => 'user', 'id' => $user->id])->first();

            for ($i = 0; $i < count($users); $i++) {

                $from = 'marketplace@4slash.com';
                $sub = 'order | 4slash';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                if ($users[$i] == 'user') {
                    $data = [
                        'order_no' => $order->order_no,
                        'gig' => $gig->title,
                        'date' => $order->created_at,
                        'user' => $user->username
                    ];
                    $view = View('mail', $data)->render();
                    $mailbody = $view;
                    $to = $user->email;

                    mail($to, $sub, $mailbody, $headers);


                } else if ($users[$i] == 'admin') {
                    $data_admin = [
                        'type' => 'admin',
                        'order_no' => $order->order_no,
                        'orderUUID' => $order->uuid,
                        'gig' => $gig->title,
                        'gig_delivery_days' => $gig->delivery_days,
                        'gig_discription' => $gig->short_discription,
                        'date' => $order->created_at,
                        'gig_amount' => $order->amount,
                        'user' => $user->username,
                        'user_email' => $user->email

                    ];

                    $view = View('adminMail', $data_admin)->render();
                    $body = $view;
                    /*$to = 'marketplace@4slash.com';*/
                    $subAdmin = 'New order | 4slash';

                    mail($to, $subAdmin, $body, $headers);
                } else if ($users[$i] == 'agency') {
                    $data = [
                        'user' => $agency->username,
                        'order_no' => $order->order_no,
                        'orderuuid' => $order->uuid
                    ];
                    $to = $agency->email;
                    $body = view('agencyEmail', $data)->render();
                    $sub = 'Agency | New Order | 4slash';
                    mail($to, $sub, $body, $headers);
                }


            }


//            foreach($questions as $key => $value) {
//
//                    $orderQuestionAnswer = new OrderQuestionAnswer;
//                    $orderQuestionAnswer->gig_question_id = (int)$key;
//                    $orderQuestionAnswer->order_id = (int)$order->id;
//                    $orderQuestionAnswer->answers = $value;
//                    $orderQuestionAnswer->save();
//
//            }


        });

        OrderAddon::insertOrderAddons($orderAddon);
        Session::forget('order_gig');
        Session::forget('order_addons');
        Session::forget('order_info');
        Session::forget('total_order_amount');
        $order = Order::where('id', Session::get('order_id'))->first();
        $data = [
            'success' => $request->session()->flash('status', 'Thank you for your order'),
            'order_no' => $request->session()->flash('order', $order->order_no)

        ];
        Session::forget('order_id');
        return redirect()->route('myorders', ['orderno' => $order->order_no])->with($data);

    }


    public function makeOrder(Request $request)
    {

        $user = Auth::user()->get();

        $database = DB::transaction(function () use ($request, $user) {

            $order_info = Session::get('order_information');

             $password = Hash::make($order_info['password']);

             $date = date('Y-m-d H:i:s');

            $order_total_amount = Session::get('order_last_amount');
            DB::table('essential_form')->insert(['full_name'=>$order_info['full_name'],'password'=>$password,'admin_email'=>$order_info['admin_email'],'company_name'=>$order_info['company_name'],'country'=>$order_info['country'],'user_number'=>$order_info['user_number'],'phone_number'=>$order_info['phone_number'],'package_type'=>'Sprout Essential Package','total_amount'=>$order_total_amount,'created_at'=>$date]);



        });
        $get_user_data = Session::get('order_information');

        $full_name = $get_user_data['full_name'];
        $admin_email = $get_user_data['admin_email'];
        $company_name = $get_user_data['company_name'];
        $Country = $get_user_data['country'];
        $usernumber = $get_user_data['user_number'];
        $phone_number = $get_user_data['phone_number'];
        $password = bcrypt($get_user_data['password']);
        $app = [];
        array_push($app, 'setting','notes','welcome','sales','employees');
        $created_at = date('Y-m-d H:i:s');



        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'sprout.4slash.com:3000/connect-4slash',[

                'headers' =>[
                    'Content-Type' => 'application/x-www-form-urlencoded'

                ],
                'form_params' =>[
                    'full_name' => $full_name,
                    'password' => $password,
                    'admin_email' => $admin_email,
                    'company_name' => $company_name,
                    'country' => $Country,
                    'phone_number' => $phone_number,
                    'created_at' => $created_at,
                    'allowed_apps' => $app ,
                    'allowed_users' => $usernumber,
                ]

            ]);


            echo $res->getStatusCode();
            echo $res->getHeaderLine('content-type');
            echo $res->getBody();



        }catch (Exception $e) {
            print_r($e->getResponse());
        }


    }

    public function makeOrder2(Request $request)
    {

        $user = Auth::user()->get();

        DB::transaction(function () use ($request, $user) {

            $order_info = Session::get('order_information1');


            $password = Hash::make($order_info['password']);

            $date = date('Y-m-d H:i:s');

            // $questions = Session::get('questions');
            $order_total_amount = Session::get('order_last_amount');

            DB::table('enterprise')->insert(['full_name' => $order_info['full_name'], 'password' => $password, 'admin_email' => $order_info['admin_email'], 'company_name' => $order_info['company_name'], 'country' => $order_info['country'], 'user_number' => $order_info['user_number'], 'phone_number' => $order_info['phone_number'], 'package_type' => 'Sprout Enterprise Package', 'total_amount' => $order_total_amount, 'created_at' => $date]);

        });
        $get_user_data = Session::get('order_information1');

        $full_name = $get_user_data['full_name'];
        $admin_email = $get_user_data['admin_email'];
        $company_name = $get_user_data['company_name'];
        $Country = $get_user_data['country'];
        $usernumber = $get_user_data['user_number'];
        $phone_number = $get_user_data['phone_number'];
        $password = bcrypt($get_user_data['password']);
        $app = [];
        array_push($app, 'setting','notes','welcome','sales','employees','attendance','fleets','project','massmailing','accounting','recruitment','manufacturing','inventory','purchases','timesheet','leaves','expenses','maintenance','pointofsale','contacts','notes','calendar','discuss','');
        $created_at = date('Y-m-d H:i:s');



        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'sprout.4slash.com:3000/connect-4slash',[

                'headers' =>[
                    'Content-Type' => 'application/x-www-form-urlencoded'

                ],
                'form_params' =>[
                    'full_name' => $full_name,
                    'password' => $password,
                    'admin_email' => $admin_email,
                    'company_name' => $company_name,
                    'country' => $Country,
                    'phone_number' => $phone_number,
                    'created_at' => $created_at,
                    'allowed_apps' => $app,
                    'allowed_users' => $usernumber,
                ]

            ]);


            echo $res->getStatusCode();
            echo $res->getHeaderLine('content-type');
            echo $res->getBody();



        }catch (Exception $e) {
            print_r($e->getResponse());
        }
    }



    public function createCustomOrder(Request $request)
    {

        if (Order::createCustomOrder($request)) {
            Session::put(['status' => 'Your request has been received and processed!
We will send you an offer within 24 hours.']);
            return redirect()->route('tahnku');
        } else {
            return ['status' => false];
        }

    }

    public function createPackageOrder(Request $request)
    {
            $package_id = $request->input('package_id');
            $package_type = $request->input('package_type');
            $promocode = $request->input('promocode');
            $promocode_data = DB::table('Promocodes')->where('promocode', $promocode)->first();
            if ($package_type == "bronze") {
                $package = DB::table('package_bronze')->where('id', $package_id)->first();
            } elseif ($package_type == "silver") {
                $package = DB::table('package_silver')->where('id', $package_id)->first();
            } else {
                $package = DB::table('package_gold')->where('id', $package_id)->first();
            }
            //$package = Package::where(['packages_id' => $request->input('package_id')])->first();
//        $package = Package::where(['packages_id' => $package_id])->first();
            $total_order_amount = 0;
            $calc_promcode_amount = 0;
            if (!empty($promocode_data)) {
                Session::put('promocode', $promocode);
                Session::put('promocode_data', $promocode_data);
                $calc_promcode_amount = ($package->price * $promocode_data->amount) / 100;
                Session::put('calc_promcode_amount',$calc_promcode_amount);
                $total_order_amount = $package->price - $calc_promcode_amount;
            } else {
                $total_order_amount = $package->price;
            }

            $processing_fees = ($total_order_amount * 5) / 100;
            Session::put('package', $package);
            Session::put('package_order_last_amount', $total_order_amount + $processing_fees);
        if(Auth::user()->check()) {
            $itemsList = new ItemList();


            $item = new Item();
            $item->setName('Package: ' . $package->package_name)
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($package->price);
            $itemsList->addItem($item);

            if ($promocode_data) {
                $item = new Item();
                $item->setName('Promocode: ' . $promocode_data->promocode)
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice(-$calc_promcode_amount);
                $itemsList->addItem($item);
            }

            $item = new Item();
            $item->setName('Processing Fess')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($processing_fees);
            $itemsList->addItem($item);
            $cnerrPayments = new CnerrPayments();
            $paymentURL = $cnerrPayments->makePaypalPayment($itemsList, URL::route('order.confirm', ['orderType' => 'package']), $promocode_data);

            if ($paymentURL) {
                Session::put('cnerrPayments', $cnerrPayments);
                return redirect($paymentURL);
            } else {
                return redirect()->back();
            }
        }else{
            return redirect()->route('signin');
        }

    }

    public function createPackageOrderWithoutLogin(Request $request)
    {

        $package = Session::get('package');
        $total_order_amount = 0;
        $calc_promcode_amount = 0;
        $promocode_data = Session::get('promocode_data');
        if (!empty($promocode_data)) {
            $calc_promcode_amount = ($package->price * $promocode_data->amount) / 100;
            $total_order_amount = $package->price - $calc_promcode_amount;
        } else {
            $total_order_amount = $package->price;
        }

        $processing_fees = ($total_order_amount * 5) / 100;
        if(Auth::user()->check()) {
            $itemsList = new ItemList();


            $item = new Item();
            $item->setName('Package: ' . $package->package_name)
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($package->price);
            $itemsList->addItem($item);

            if ($promocode_data) {
                $item = new Item();
                $item->setName('Promocode: ' . $promocode_data->promocode)
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice(-$calc_promcode_amount);
                $itemsList->addItem($item);
            }

            $item = new Item();
            $item->setName('Processing Fess')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($processing_fees);
            $itemsList->addItem($item);
            $cnerrPayments = new CnerrPayments();
            $paymentURL = $cnerrPayments->makePaypalPayment($itemsList, URL::route('order.confirm', ['orderType' => 'package']), $promocode_data);

            if ($paymentURL) {
                Session::put('cnerrPayments', $cnerrPayments);
                return redirect($paymentURL);
            } else {
                return redirect()->back();
            }
        }else{
            return redirect()->route('signin');
        }

    }

    public function confirmOrder(Request $request, $orderType)
    {


        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect()->route('userdashboard');

        }

        $cnerrPayments = Session::get('cnerrPayments');
        Session::forget('cnerrPayments');


        if ($cnerrPayments->confirmPaypalPayment(Input::get('PayerID'))) {


            if ($orderType == 'package') {
                $package = Session::get('package');
                $package_user = Package::where('packages_id',$package->package_id)->first();
                $expiry = date('Y-m-d H:m:i', strtotime('+' . $package->delivery_days . ' days'));
                Session::forget('package');
                $order_total_amount = $package->price;
                $net_total = round($order_total_amount / (1 + 19 / 100), 2);
                $order_service_tax = (($order_total_amount * 5) / 100);
                $order_govt_tax = ($order_total_amount - $net_total);
                $order = new Order();
                $order->uuid = \Webpatser\Uuid\Uuid::generate(4);
                $order->user_id = Auth::user()->get()->id;
                $order->gig_owner_id = $package_user->user_id;
                $order->assigned_to = $package_user->user_id;
                $order->company_name = Auth::user()->get()->username;
                $order->company_tagline = Auth::user()->get()->username;
                $order->company_industry = Auth::user()->get()->username;
                $order->order_no = date("Ymd") . strtoupper(substr(uniqid(sha1(time())), 0, 4));
                $order->type = 'package';
                $order->expiry = $expiry;
                $order->amount = $order_total_amount;
                $order->service_charges = $order_service_tax;
                $order->govt_tax = $order_govt_tax;
                $order->net_total = $net_total;
                $order->packages_id = $package->package_id;
                $order->sub_package_name = $package->package_name;
                $order->sub_package_desc = $package->desc;
                $order->package_days = $package->delivery_days;
                $order->pack_revisions = $package->revisions;
                $order->pack_source = $package->source_file;
                $order->save();
                $users = array('user', 'admin');
                $user = Auth::user()->get();
                $data['admin'] = User::where('type', 'admin')->first();
                $data['user'] = User::where(['type' => 'user', 'id' => $user->id])->first();
                if(Session::get('promocode')) {
                    $promocode = Session::get('promocode');
                    DB::table('Promocodes')->where('promocode', $promocode)->update(['status' => 0]);
                }

                for ($i = 0; $i <= 1; $i++) {

                    $from = 'marketplace@4slash.com';
                    $sub = 'Order | 4slash';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                    if ($users[$i] == 'user') {
                        $data = [
                            'order_no' => $order->order_no,
                            'gig' => $package->package_name,
                            'date' => $order->created_at,
                            'user' => $user->username
                        ];
                        $view = View('mail', $data)->render();
                        $mailbody = $view;
                        $to = $user->email;

                        mail($to, $sub, $mailbody, $headers);


                    } else if ($users[$i] == 'admin') {
                        $data_admin = [
                            'type' => $order->type,
                            'order_no' => $order->order_no,
                            'orderUUID' => $order->uuid,
                            'gig' => $package->package_name,
                            'date' => $order->created_at,
                            'gig_amount' => $order->amount,
                            'user' => $user->username,
                            'user_email' => $user->email

                        ];

                        $view = View('adminMail', $data_admin)->render();
                        $body = $view;
                        $to = 'marketplace@4slash.com';
                        $subAdmin = 'New order 4slash';

                        mail($to, $subAdmin, $body, $headers);
                    }


                }

                /* Send Notification to the Agency*/
                $not_id_agency = DB::table('notifications')->insertGetId([
                    'order_id' => $order->id,
                    'user_id' => $package_user->user_id,
                    'message' => '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">New order</a>'
                ]);

                /* update notification of agency*/
                DB::table('notifications')->where('id', $not_id_agency)->update([
                    'message' => '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id_agency . '">New order</a>'
                ]);


                $admin = User::where(['type' => 'admin'])->first();

                $not_id = Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">You have a new Packages Order</a>');
                Notification::where('id', $not_id)->update(['message' => '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">You have a new Packages Order</a>']);
//                return redirect()->route('myorders');
                $data = [
                    'success' => $request->session()->flash('status', 'Thank you for your order'),
                    'order_no' => $request->session()->flash('order', $order->order_no)

                ];
                return redirect()->route('myorders', ['orderno' => $order->order_no])->with($data);
            }

        }
//        return redirect()->route('userdashboard');

    }

    public function order_expire(){
        $date = date("Y-m-d H:i:s");
        $agencies = User::where(['type' => 'agency'])->get();
        foreach ($agencies as $agency){
            $orders = Order::where(['assigned_to' => $agency])->get();
            foreach ($orders as $order){
                if($order->expiry == $date){
                    $from = 'marketplace@4slash.com';
                    $sub = 'Order | 4slash';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                    $data = [
                        'user' => $agency->username,
                        'order_no' => $order->order_no,
                        'orderuuid' => $order->uuid
                    ];
                    $to = $agency->email;
                    $body = view('pages/email/order_expire', $data)->render();
                    $sub = 'Agency | Order Expire | 4slash';
                    mail($to, $sub, $body, $headers);
                }
            }
        }
    }


}