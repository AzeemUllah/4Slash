<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
use PayPal\Api\Transaction;


class CnerrPayment extends Model
{

    public static function makePaypalPayment(ItemList $itemList) {

        $paypal_conf = config('paypal');
        $api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $api_context->setConfig($paypal_conf['settings']);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_list = $itemList;

        $amount = new Amount();
        $amount->setCurrency('GBP')->setTotal(((float)$item_list->getItems()[0]->getPrice()));

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))->setCancelUrl(URL::route('payment.status'));

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
dd('getting links');
            if($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        Session::put('paypal_payment_id', $payment->getId());


        if(isset($redirect_url)) {

            return redirect($redirect_url);

        }

        return 'error';

    }

}