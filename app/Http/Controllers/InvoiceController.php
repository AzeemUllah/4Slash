<?php

namespace App\Http\Controllers;


use App\Gig;
use App\Package;
use App\Invoice;
use App\User;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use PDF;
use DB;


class InvoiceController extends Controller
{
    public function index($orderNo, $invoiceNo)
    {

        $invoice = Invoice::where(['invoice_no' => $invoiceNo])->first();
        $order = Order::where(['id' => $invoice->order_id])->first();
        $gig = Gig::where(['id' => $order->gig_id])->first();
        $package = Package::where('packages_id', $order->packages_id)->first();
        $user = User::where('id', $order->user_id)->first();
        $order->invoice = $invoice;
        $order->gig = $gig;
        $order->package = $package;
        $order->custom = $order->type;
        $user_info = DB::table('user_info')->where('user_id', $user->id)->first();
        $data['order'] = $order;
        $data['user'] = $user;
        $data['userInfo'] = $user_info;
        $data['invoice'] = $invoice;
        return PDF::loadView('pages.invoice', $data)->stream();
	//	return $pdf->download('invoice.pdf');

//        return view('pages.invoice', $data);

    }

    public function agency_order_invoice($orderNo, $invoiceNo){
        $invoice = Invoice::where(['invoice_no' => $invoiceNo])->first();
        $order = Order::where(['id' => $invoice->order_id])->first();
        $gig = Gig::where(['id' => $order->gig_id])->first();
        $package = Package::where('packages_id', $order->packages_id)->first();
        $user = User::where('id', $order->user_id)->first();
        $order->invoice = $invoice;
        $order->gig = $gig;
        $order->package = $package;
        $order->custom = $order->type;
        $user_info = DB::table('users_info')->where('user_id', $user->id)->first();
        $data['order'] = $order;
        $data['user'] = $user;
        $data['userInfo'] = $user_info;
        $data['invoice'] = $invoice;
        return PDF::loadView('pages.invoice', $data)->stream();
    }

}

