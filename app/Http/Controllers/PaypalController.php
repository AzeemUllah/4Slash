<?php

namespace App\Http\Controllers;
error_reporting(E_ALL);
ini_set("display_errors",1);
use App\OrderAddon;
use App\Gig_addon;
use App\Gig;
use Aws\Common\Facade\Ses;
use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use Validator;
use DB;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {


        $paypal_conf = config('paypal');

        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);

    }


    public function postPaymentWithoutLogin(Request $request)
    {
        $order_gig = Session::get('order_gig');

//        $orderAddons = Session::get('order_addons');
        $getorderAddons = Session::get('order_addons');
        $orderAddons = Session::get('addons_id');
        $order_info = Session::get('order_info');
        Session::put('order_info', $order_info);
        $addon_quantity = Session::get('addon_quantity');
        $addons_name_list = array();
        $addons_amount_list = array();
        $total_addons_amount = 0;
        if(!empty($orderAddons)) {
            foreach ($orderAddons as $orderAddonData) {
                $orderAddon = Gig_addon::where('id', $orderAddonData)->first()->amount;
                $orderAddonName = Gig_addon::where('id', $orderAddonData)->first()->name;
//            $total_addons_amount += $orderAddon->amount;
                $total_addons_amount += $orderAddon;
                array_push($addons_name_list, $orderAddonName);
                array_push($addons_amount_list, $orderAddon);

            }
        }
        if (!empty($total_addons_amount)) {

            Session::put('total_order_amount', ($total_addons_amount + $order_gig->price));
        } else {
            Session::put('total_order_amount', $order_gig->price);
        }
        $totalOrderAmount = ((float)$total_addons_amount) + ((float)$order_gig->price);
        $promocode = Session::get('promocode');
        $promocode_data = DB::table('Promocodes')->where(['promocode' => $promocode, 'type' => 'free', 'status' => 1])->first();
        $netTotalAmount = 0;
        $calc_promocode_amount = 0;
        if(!empty($promocode_data)) {
            $calc_promocode_amount = ($totalOrderAmount*$promocode_data->amount)/100;
            $netTotalAmount = $totalOrderAmount - $calc_promocode_amount;
        }else{
            $netTotalAmount = $totalOrderAmount;
        }
        $processingFees = (($netTotalAmount * 5) / 100);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');


        $item_list = new ItemList();


        $item = new Item();
        $item->setName('Gig: ' . $order_gig->title)
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($order_gig->price);
        $item_list->addItem($item);

//        foreach ($getorderAddons as $orderAddon) {
//
//            $item = new Item();
//            $item->setName('Addon: ' . $orderAddon->addon)
//                ->setCurrency('EUR')
//                ->setQuantity($orderAddon->quantity)
//                ->setPrice($orderAddon->amount);
//            $item_list->addItem($item);
//
//        }
        if(!empty($getorderAddons)) {
            for ($i = 0; $i < count($addon_quantity); $i++) {
                $item = new Item();
                $item->setName('Addon: ' . $addons_name_list[$i])
                    ->setCurrency('GBP')
                    ->setQuantity($addon_quantity[$i])
                    ->setPrice($addons_amount_list[$i]);
                $item_list->addItem($item);
            }
        }

        $item = new Item();
        $item->setName('Processing Fees: ')
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($processingFees);
        $item_list->addItem($item);
        if($promocode_data){
            $item = new Item();
            $item->setName('Promocode: '.$promocode_data->promocode)
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice(-$calc_promocode_amount);
            $item_list->addItem($item);
        }

        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal($netTotalAmount + $processingFees);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);

        try {

            $payment->create($this->_api_context);

        } catch (\PayPalConnectionException $ex) {

            if (config('app.debug')) {

                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;

            } else {

                die('Some error occur, sorry for inconvenient');

            }

        }


        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        Session::put('paypal_payment_id', $payment->getId());


        if (isset($redirect_url)) {

            return redirect($redirect_url);

        }

        return 'error';


    }


    public function postPayment(Request $request)
    {
        $addon = $request->input('addon');
        $gig_id = $request->input('gig_id');
        $gigData = Gig::where('id',$gig_id)->first();
        $addon_amount = array();
        $addon_quantity = array();
        $addons_amount = array();
        $addonsData = array();
        $addonsNameData = array();
        $addonsID = array();
        if(!empty($addon['id'])) {
            foreach ($addon['id'] as $item) {
                $orderAddonData = Gig_addon::where('id', $item)->first();
                array_push($addon_amount, $orderAddonData->amount);
                array_push($addonsData, $orderAddonData);
                array_push($addonsNameData, $orderAddonData->addon);
                array_push($addonsID,$item);
            }
            Session::put('addons_id',$addonsID);
        }
        if(!empty($addon)) {
            foreach ($addon['quantity'] as $item) {
                array_push($addon_quantity, $item);
            }
            Session::put('addon_quantity',$addon_quantity);
        }
        if(!empty($addon['id'])) {
            for ($i = 0; $i < count($addon_quantity); $i++) {
                $single_addon_amount = $addon_quantity[$i] * $addon_amount[$i];
                array_push($addons_amount, $single_addon_amount);
            }
        }
        $promocode = $request->input('promocode');
        Session::put('promocode',$promocode);
        $promocode_data = DB::table('Promocodes')->where(['promocode' => $promocode,'type' => 'free','status' => 1])->first();
//        Session::put('order_info', [
//            'company_name' => $request->input('company_name'),
//            'company_tagline' => $request->input('company_tagline'),
//            'company_industry' => $request->input('company_industry'),
//            'company_discription' => $request->input('company_discription')
//        ]);
        $calc_promocode_amount = 0;
        if ($request->has('type') && $request->input('type') == 'custom_order') {
            Session::put('order_type', $request->input('type'));
            Session::put('message_id', $request->input('message_id'));
            Session::put('order_uuid', $request->input('orde_uuid'));
            Session::put('total_days', $request->input('total_days'));
            Session::put('custom_order_products', $request->input('custom_order_products'));
            Session::put('total_amount', $request->input('total_amount'));
            $totalOrderAmount = $request->input('total_amount');
            Session::put('total_order_amount', ($totalOrderAmount));
        } else {
            Session::put('questions', $request->input('question'));


//            $order_gig = Session::get('order_gig');
            $order_gig = $gigData;

//            $addons = $request->input('addon');
//            $orderAddons = OrderAddon::getOrderAddons($addons);
            Session::put('order_addons', $addonsData);
//            $orderAddons = Session::get('order_addons');
            $orderAddons = $addons_amount;
            $orderAddonsData = $addonsData;
            $total_addons_amount = 0;
            foreach ($orderAddons as $orderAddon) {
                $total_addons_amount += $orderAddon;
//                Session::put('total_order_amount', ($total_addons_amount + $order_gig->price));
            }

            if (!empty($total_addons_amount)) {

                Session::put('total_order_amount', ($total_addons_amount + $order_gig->price));
            } else {
                Session::put('total_order_amount', $order_gig->price);
            }

//            $OrderAmount = ($total_addons_amount + $order_gig->price);
            $OrderAmount = Session::get('total_order_amount');
            if($promocode_data) {
                $calc_promocode_amount = ($OrderAmount*$promocode_data->amount)/100;
                $totalOrderAmount = $OrderAmount - $calc_promocode_amount;
            }else{

                $totalOrderAmount = $OrderAmount;
            }

        }

        $processingFees = (($totalOrderAmount * 5) / 100);
            Session::put('order_last_amount', $totalOrderAmount + $processingFees);

        if (Auth::user()->check()) {

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_list = new ItemList();


            //Check if the order come from custom offer workstream area
            if ($request->has('type') && $request->input('type') == 'custom_order') {

                $item = new Item();
                $item->setName('Order Products: ' . Session::get('custom_order_products'))
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice(Session::get('total_amount'));
                $item_list->addItem($item);

                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            } else {

                $item = new Item();
                $item->setName('Gig: ' . $order_gig->title)
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($order_gig->price);
                $item_list->addItem($item);

//                foreach ($orderAddons as $orderAddon) {
//
//                    $item = new Item();
//                    $item->setName('Addon: ' . $orderAddon->addon)
//                        ->setCurrency('EUR')
//                        ->setQuantity($orderAddon->quantity)
//                        ->setPrice($orderAddon->amount);
//                    $item_list->addItem($item);
//
//                }
                if(!empty($addon['id'])) {
                    for ($i = 0; $i < count($addon_quantity); $i++) {
                        $item = new Item();
                        $item->setName('Addon: ' . $addonsNameData[$i])
                            ->setCurrency('GBP')
                            ->setQuantity($addon_quantity[$i])
                            ->setPrice($addon_amount[$i]);
                        $item_list->addItem($item);
                    }
                }

                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
                if($promocode_data){
                    $item = new Item();
                    $item->setName('Promocode: '.$promocode_data->promocode)
                        ->setCurrency('GBP')
                        ->setQuantity(1)
                        ->setPrice(-$calc_promocode_amount);
                    $item_list->addItem($item);
                }
            }


            $amount = new Amount();
            $amount->setCurrency('GBP')
                ->setTotal(Session::get('order_last_amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('payment.status'))
                ->setCancelUrl(URL::route('payment.status'));

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions([$transaction]);

            try {

                $payment->create($this->_api_context);

            } catch (\PayPalConnectionException $ex) {
                if (config('app.debug')) {

                    echo "Exception: " . $ex->getMessage() . PHP_EOL;
                    $err_data = json_decode($ex->getData(), true);
                    exit;

                } else {

                    die('Some error occur, sorry for inconvenient');

                }

            }


            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            Session::put('paypal_payment_id', $payment->getId());


            if (isset($redirect_url)) {

                return redirect($redirect_url);

            }

            return 'error';

        } else {

            return redirect()->route('login');

        }

    }

    public function getPaymentStatus()
    {


        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect()->route('userdashboard');

        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit;

        if ($result->getState() == 'approved') {

            $custom_order_redirect = Session::get('order_type');
            if (!empty($custom_order_redirect) && $custom_order_redirect == 'custom_order') {

                return redirect()->route('customordercommit')
                    ->with('success', 'Payment success');
            } else {
                return redirect()->route('ordercommit')
                    ->with('success', 'Payment success');
            }

        }

        return redirect()->route('userdashboard');

    }


    public function getPaymentStatus1()
    {

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect()->route('makeOrderessential');

        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit;

        if ($result->getState() == 'approved') {

            $custom_order_redirect = Session::get('order_type');
            if (!empty($custom_order_redirect) && $custom_order_redirect == 'custom_order') {

                return redirect()->route('customordercommit')
                    ->with('success', 'Payment success');
            } else {
                return redirect()->route('makeOrderessential')
                    ->with('success', 'Payment success');
            }

        }

        return redirect()->route('userdashboard');

    }


    public function getPaymentloginStatus()
    {

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect()->route('makeOrderessential');

        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit;

        if ($result->getState() == 'approved') {

            $custom_order_redirect = Session::get('order_type');
            if (!empty($custom_order_redirect) && $custom_order_redirect == 'custom_order') {

                return redirect()->route('customordercommit')
                    ->with('success', 'Payment success');
            } else {
                return redirect()->route('makeOrderessential')
                    ->with('success', 'Payment success');
            }

        }

        return redirect()->route('userdashboard');

    }



    public function getPaymentloginStatus1()
    {

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect()->route('makeOrderenterprise');

        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit;

        if ($result->getState() == 'approved') {

            $custom_order_redirect = Session::get('order_type');
            if (!empty($custom_order_redirect) && $custom_order_redirect == 'custom_order') {

                return redirect()->route('customordercommit')
                    ->with('success', 'Payment success');
            } else {
                return redirect()->route('makeOrderenterprise')
                    ->with('success', 'Payment success');
            }

        }

        return redirect()->route('userdashboard');



    }





    public function Status2()
    {


        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect()->route('makeOrderenterprise');

        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit;

        if ($result->getState() == 'approved') {

            $custom_order_redirect = Session::get('order_type');
            if (!empty($custom_order_redirect) && $custom_order_redirect == 'custom_order') {

                return redirect()->route('customordercommit')
                    ->with('success', 'Payment success');
            } else {
                return redirect()->route('makeOrderenterprise')
                    ->with('success', 'Payment success');
            }

        }

        return redirect()->route('userdashboard');

    }




public function withoutloginessential(Request $request){


$totalOrderAmount = Session::get('totalorderamount');

    $processingFees = (($totalOrderAmount * 5) / 100);
    Session::put('order_last_amount', $totalOrderAmount + $processingFees);


    if (Auth::user()->check()) {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_list = new ItemList();


        //Check if the order come from custom offer workstream area
        if ($request->has('type') && $request->input('type') == 'custom_order') {

            $item = new Item();
            $item->setName('Order Products: ' . Session::get('custom_order_products'))
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice(Session::get('total_amount'));
            $item_list->addItem($item);

            $item = new Item();
            $item->setName('Processing Fees: ')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($processingFees);
            $item_list->addItem($item);
        } else {

            $item = new Item();
            $item->setName('Gig: ' . 'essential')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($totalOrderAmount);
            $item_list->addItem($item);



            $item = new Item();
            $item->setName('Processing Fees: ')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setPrice($processingFees);
            $item_list->addItem($item);
        }


        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal(Session::get('order_last_amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status3'))
            ->setCancelUrl(URL::route('payment.status3'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);

        try {

            $payment->create($this->_api_context);

        } catch (\PayPalConnectionException $ex) {


            if (config('app.debug')) {

                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;

            } else {

                die('Some error occur, sorry for inconvenient');

            }

        }


        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        Session::put('paypal_payment_id', $payment->getId());


        if (isset($redirect_url)) {

            return redirect($redirect_url);

        }

        return 'error';

    }

}





    public function essential(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'admin_email' => 'required|email|unique:essential_form',
            'fullname' => 'required',
            'password' => 'required|min:5',
            'companyname' => 'required',
            'country' => 'required',
            'phonenumber' => 'required',
            'usernumber' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }


        Session::put('order_information', [
            'full_name' => $request->input('fullname'),
            'admin_email' => $request->input('admin_email'),
            'company_name' => $request->input('companyname'),
            'country' => $request->input('country'),
            'user_number' => $request->input('usernumber'),
            'phone_number' => $request->input('phonenumber'),
            'password' => $request->input('password'),
        ]);

        $totalOrderAmount = $request->input('totalamount');

        $processingFees = (($totalOrderAmount * 5) / 100);
        Session::put('order_last_amount', $totalOrderAmount + $processingFees);

        if (Auth::user()->check()) {

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_list = new ItemList();


            //Check if the order come from custom offer workstream area
            if ($request->has('type') && $request->input('type') == 'custom_order') {

                $item = new Item();
                $item->setName('Order Products: ' . Session::get('custom_order_products'))
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice(Session::get('total_amount'));
                $item_list->addItem($item);

                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            } else {

                $item = new Item();
                $item->setName('Gig: ' . 'essential')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($totalOrderAmount);
                $item_list->addItem($item);



                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            }


            $amount = new Amount();
            $amount->setCurrency('GBP')
                ->setTotal(Session::get('order_last_amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('payment.status1'))
                ->setCancelUrl(URL::route('payment.status1'));

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions([$transaction]);

            try {

                $payment->create($this->_api_context);

            } catch (\PayPalConnectionException $ex) {


                if (config('app.debug')) {

                    echo "Exception: " . $ex->getMessage() . PHP_EOL;
                    $err_data = json_decode($ex->getData(), true);
                    exit;

                } else {

                    die('Some error occur, sorry for inconvenient');

                }

            }


            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            Session::put('paypal_payment_id', $payment->getId());


            if (isset($redirect_url)) {

                return redirect($redirect_url);

            }

            return 'error';

        } else {

            Session::put('order_information', [
                'full_name' => $request->input('fullname'),
                'admin_email' => $request->input('admin_email'),
                'company_name' => $request->input('companyname'),
                'country' => $request->input('country'),
                'user_number' => $request->input('usernumber'),
                'phone_number' => $request->input('phonenumber'),
                'password' => $request->input('password'),
            ]);


            $totalOrderAmount = $request->input('totalamount');
            $processingFees = (($totalOrderAmount * 5) / 100);
            Session::put('totalorderamount',$totalOrderAmount);
            Session::put('processing_fee',$processingFees);
            return redirect()->route('login2');

        }
    }


    public function withoutloginenterprise(Request $request){




        $totalOrderAmount = Session::get('totalorderamount');

        

        $processingFees = (($totalOrderAmount * 5) / 100);
        Session::put('order_last_amount', $totalOrderAmount + $processingFees);

        if (Auth::user()->check()) {

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_list = new ItemList();


            //Check if the order come from custom offer workstream area
            if ($request->has('type') && $request->input('type') == 'custom_order') {

                $item = new Item();
                $item->setName('Order Products: ' . Session::get('custom_order_products'))
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice(Session::get('total_amount'));
                $item_list->addItem($item);

                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            } else {

                $item = new Item();
                $item->setName('Gig: ' . 'enterprise')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($totalOrderAmount);
                $item_list->addItem($item);



                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            }


            $amount = new Amount();
            $amount->setCurrency('GBP')
                ->setTotal(Session::get('order_last_amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('payment.status4'))
                ->setCancelUrl(URL::route('payment.status4'));

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions([$transaction]);

            try {

                $payment->create($this->_api_context);

            } catch (\PayPalConnectionException $ex) {


                if (config('app.debug')) {

                    echo "Exception: " . $ex->getMessage() . PHP_EOL;
                    $err_data = json_decode($ex->getData(), true);
                    exit;

                } else {

                    die('Some error occur, sorry for inconvenient');

                }

            }


            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            Session::put('paypal_payment_id', $payment->getId());


            if (isset($redirect_url)) {

                return redirect($redirect_url);

            }

            return 'error';

        }

    }



    public function enterprise(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'admin_email' => 'required|email|unique:enterprise',
            'fullname' => 'required',
            'password' => 'required|min:5',
            'companyname' => 'required',
            'country' => 'required',
            'phonenumber' => 'required',
            'usernumber' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }


        Session::put('order_information1', [
            'full_name' => $request->input('fullname'),
            'admin_email' => $request->input('admin_email'),
            'company_name' => $request->input('companyname'),
            'country' => $request->input('country'),
            'user_number' => $request->input('usernumber'),
            'phone_number' => $request->input('phonenumber'),
            'password' => $request->input('password'),
        ]);

        $totalOrderAmount = $request->input('totalamount1');

        $processingFees = (($totalOrderAmount * 5) / 100);
        Session::put('order_last_amount', $totalOrderAmount + $processingFees);

        if (Auth::user()->check()) {

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_list = new ItemList();


            //Check if the order come from custom offer workstream area
            if ($request->has('type') && $request->input('type') == 'custom_order') {

                $item = new Item();
                $item->setName('Order Products: ' . Session::get('custom_order_products'))
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice(Session::get('total_amount'));
                $item_list->addItem($item);

                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            } else {

                $item = new Item();
                $item->setName('Gig: ' . 'enterprise')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($totalOrderAmount);
                $item_list->addItem($item);



                $item = new Item();
                $item->setName('Processing Fees: ')
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setPrice($processingFees);
                $item_list->addItem($item);
            }


            $amount = new Amount();
            $amount->setCurrency('GBP')
                ->setTotal(Session::get('order_last_amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('payment.status2'))
                ->setCancelUrl(URL::route('payment.status2'));

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions([$transaction]);

            try {

                $payment->create($this->_api_context);

            } catch (\PayPalConnectionException $ex) {


                if (config('app.debug')) {

                    echo "Exception: " . $ex->getMessage() . PHP_EOL;
                    $err_data = json_decode($ex->getData(), true);
                    exit;

                } else {

                    die('Some error occur, sorry for inconvenient');

                }

            }


            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            Session::put('paypal_payment_id', $payment->getId());


            if (isset($redirect_url)) {

                return redirect($redirect_url);

            }

            return 'error';

        } else {

            Session::put('order_information1', [
                'full_name' => $request->input('fullname'),
                'admin_email' => $request->input('admin_email'),
                'company_name' => $request->input('companyname'),
                'country' => $request->input('country'),
                'user_number' => $request->input('usernumber'),
                'phone_number' => $request->input('phonenumber'),
                'password' => $request->input('password'),
            ]);


            $totalOrderAmount = $request->input('totalamount1');
            $processingFees = (($totalOrderAmount * 5) / 100);
            Session::put('totalorderamount',$totalOrderAmount);
            Session::put('processing_fee',$processingFees);
            return redirect()->route('login4');

        }
    }





}
