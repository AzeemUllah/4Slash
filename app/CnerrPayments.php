<?php
/**
 * Created by PhpStorm.
 * User: 4slash
 * Date: 12/18/15
 * Time: 5:32 PM
 */

namespace App;


use App\Http\Requests;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class CnerrPayments
{

    public function makePaypalPayment(ItemList $itemList, $returnURL, $promocode_data) {

        $paypal_conf = config('paypal');
        $api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $api_context->setConfig($paypal_conf['settings']);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_list = $itemList;
        if(!empty($promocode_data)){
            $gig_price  = (float)$item_list->getItems()[0]->getPrice();
            $promocode_amount = (float)$item_list->getItems()[1]->getPrice();
            $actual_promocode = $gig_price + $promocode_amount;
            $processing_fees = (float)$item_list->getItems()[2]->getPrice();
            $amount = new Amount();
            $amount->setCurrency('GBP')->setTotal($actual_promocode+$processing_fees);
        }else {
            $amount = new Amount();
            $amount->setCurrency('GBP')->setTotal((float)$item_list->getItems()[0]->getPrice() + $item_list->getItems()[1]->getPrice());
        }

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($returnURL)->setCancelUrl($returnURL);

        $payment = new Payment();
        $payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);

        try {

            $payment->create($api_context);

        } catch(\PayPalConnectionException $ex) {

            if(config('app.debug')) {

                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;

            } else {

                die('Some error occur, sorry for inconvenient');

            }

        }

        foreach($payment->getLinks() as $link) {

            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;

            }

        }

        Session::put('paypal_payment_id', $payment->getId());


        if(isset($redirect_url)) {

            return $redirect_url;

        }

        return false;

    }

    public function confirmPaypalPayment($payerId) {

        $paypal_conf = config('paypal');
        $api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $api_context->setConfig($paypal_conf['settings']);

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        $payment = Payment::get($payment_id, $api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        $result = $payment->execute($execution, $api_context);


        if($result->getState() == 'approved') {

            return true;

        }

        return false;


    }


}