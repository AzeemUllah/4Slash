<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Gig;
use App\Package;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user()->get();

        $completedOrdersAmount = Order::where(['user_id' => $user->id, 'status' => 'complete'])->sum('amount');
        $completedOrdersServiceCharges = Order::where(['user_id' => $user->id, 'status' => 'complete'])->sum('service_charges');
        $pendingOrdersAmount = Order::where(['user_id' => $user->id, 'status' => 'pending'])->orWhere(['user_id' => $user->id, 'status' => 'jobdone'])
                                      ->orWhere(['user_id' => $user->id,'status' => 'jobdonebyagency'])->sum('amount');
        $pendingOrdersServiceCharges = Order::where(['user_id' => $user->id, 'status' => 'pending'])->orWhere(['user_id' => $user->id, 'status' => 'jobdone'])
                                              ->orWhere(['user_id' => $user->id,'status' => 'jobdonebyagency'])->sum('service_charges');
        $completedOrders = Order::where(['user_id' => $user->id, 'status' => 'complete'])->orderBy('created_at','desc')->get();
        foreach($completedOrders as $completedOrder) {
            $completedOrder->gig = Gig::where(['id' => $completedOrder->gig_id])->first();
            $completedOrder->package = Package::where('packages_id', $completedOrder->packages_id)->first();
            $completedOrder->custom = $completedOrder->type;
            $completedOrder->invoice = Invoice::where(['order_id' => $completedOrder->id])->first();
        }

        $data['completedOrdersAmount']                   = $completedOrdersAmount;
        $data['pendingOrdersAmount']                     = $pendingOrdersAmount;
        $data['completedOrders']                         = $completedOrders;
        $data['pendingOrdersServiceCharges']             = $pendingOrdersServiceCharges;
        $data['completedOrdersServiceCharges']           = $completedOrdersServiceCharges;
        $data['wallet']                                  = $user->wallet;
        return view('pages.payments')->with($data);
    }

    public function UserPayments(Request $request){

        $invoiceNo = $_GET['invoiceNo'];
        ///$agency_invoices = AgencyInvoice::where(['agency_id' => $agency_id])->count();
        $invoices = Invoice::where(['invoice_no' => $invoiceNo])->first();
        //$agency_invoice = Invoice::where(['agency_id' => $agency_id])->get();
        $agency_col = Schema::getColumnListing('invoices');
        $num_fields = count($agency_col);
        $header = array();
        for($i = 0; $i < $num_fields; $i++){

            $header[] = $agency_col[$i];
        }
        $output = fopen('php://output', 'w');

        if ($output && $invoices)
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Agency Invoice.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($output, $header);
            foreach($invoices as $invoice) {

                $data = array(
                    $invoice->id,
                    $invoice->detail,
                    $invoice->payable,
                    $invoice->paid,
                    $invoice->balance,
                    $invoice->agency_id,
                    $invoice->invoiceno,
                    $invoice->created_at,
                    $invoice->updated_at,
                );
                fputcsv($output,$data);

            }
            fclose($output);
            die;
        }




    }

}
