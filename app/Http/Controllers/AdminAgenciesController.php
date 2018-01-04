<?php

namespace App\Http\Controllers;

use App\Agency;
use App\AgencyInvoice;
use App\Gig;
use App\Package;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PDF;
use PhpParser\Builder\Use_;

class AdminAgenciesController extends Controller
{
    use LogTrait;

    public function index()
    {
        $agencies = Admin::where(['type' => 'agency'])->orderBy('id','desc')->get();
        $agenciesRequest = DB::table('agency_inquires')->orderBy('created_at','desc')->get();
        $data['agenciesRequest_count'] = DB::table('agency_inquires')->orderBy('created_at','desc')->where(['status' => null])->count();
        $data['newagencycount'] = DB::table('users')->where(['type' => 'agency','active'=> 1])->select(DB::raw('*'))
            ->whereRaw('Date(created_at) = CURDATE()')->count();
        $agenciesRequestdate = DB::table('agency_inquires')->where('status',NULL)->orderBy('created_at','desc')->get();
        $agenciesRegistration = DB::table('agency_additional')->orderBy('id','desc')->where('active',0)->get();
        $data['agenciesRegistration_count'] = DB::table('agency_additional')->orderBy('id','desc')->where(['active' => 0])->count();

        $admin = Admin::where(['type'=>'admin'])->first();
        foreach ($agencies as $agency) {
            $pendingOrders = Order::where(['status' => 'pending', 'assigned_to' => $agency->id])->orWhere(['assigned_to' => $agency->id, 'status' => 'jobdone'])
                ->orWhere(['assigned_to' => $agency->id, 'status' => 'jobdonebyagency'])->orWhere(['assigned_to' => $agency->id, 'status' => 'review'])
                ->orderBy('expiry', 'asc')->get();
            $completed = Order::where(['status' => 'complete', 'assigned_to' => $agency->id])
                                ->orderBy('expiry', 'asc')->get();
            $agency['pendingOrders'] = $pendingOrders->count();
            $agency['completed'] = $completed->count();
            $agency['packages'] = Package::where(['suggested_by' => $agency->id])->count();
            $agency['favors'] = Gig::where(['suggested_by' => $agency->id])->count();
            $agency['agency_additional'] = DB::table('agency_additional')->where(['agency_id' => $agency->id])->first();
            $feedback = DB::table('order_feedback')->where(['agency_id' => $agency->id])->sum('order_feedback');
            $total = DB::table('order_feedback')->where(['agency_id' => $agency->id])->count();
            if($total > 0) {
                $agency['rating'] = $feedback / $total;
            }else{
                $agency['rating'] = '';
            }
            $agency['total'] = $total;
        }
        /*$days = 0;
        foreach ($agenciesRequestdate as $item) {
            $date_time = explode(' ', $item->created_at);
            $date_time = explode('-', $date_time[0]);
            $date_time = $date_time[0] . '-' . $date_time[1] . '-' . $date_time[2];
            $current_date = date("Y-m-d");
            $diff = abs(strtotime($current_date) - strtotime($date_time));
            $day = 60 * 60 * 24;
            $MONTH = $day * 30;
            $YEAR = $day * 365;

            $years = floor($diff / ($YEAR));
            $months = floor(($diff - $years * $YEAR) / ($MONTH));
            $days = floor(($diff - $years * $YEAR - $months * $MONTH) / ($day));
        }
        if($days > 0){
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('adminagencies') . '?ref=notification">Agentur-Anfrage ist fällig.</a>');
            Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('adminagencies') . '?ref=notification&id=' . $notify_id . '">Agentur-Anfrage ist fällig.</a>']);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }*/
        $data['agencies'] = $agencies;
        $data['agenciesRegistration'] = $agenciesRegistration;
        $data['agenciesRequest'] = $agenciesRequest;

        return view('pages.admin.agencies')->with($data);
    }

    public function getAgency(Request $request, $agencyEmail)
    {

        if (isset($_GET['id'])) {

            $notify = Notification::where('id', $_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();


        }
        $admin = Auth::admin()->get();
        $message = 'view agency details';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $agency = Agency::where(['type' => 'agency', 'email' => $agencyEmail])->first();
        $pendingOrders = $agency->getPendingOrders();
        $completedOrders = $agency->getCompletedOrders();
        $agency_details = DB::table('agency_additional')->where('agency_id', $agency->id)->first();
        $get_agency_pay_details = DB::table('agency_payment_details')->where('agency_id',$agency->id)->first();
        $data['agencyDetails'] = $agency_details;
        $data['get_agency_pay_details'] = $get_agency_pay_details;
        $data['agency'] = $agency;
        $data['agency']['pendingOrders'] = $pendingOrders;
        $data['agency']['completedOrders'] = $completedOrders;
        $agency_pay = AgencyInvoice::where(['agency_id'=>$agency->id]);
        $data['agency']['agencyInvoices'] = AgencyInvoice::where(['agency_id' => $agency->id])->get();
//        $data['agency2']['agencyInvoices2'] = AgencyInvoice::where(['agency_id' => $agency->id,'payable'=>0])->get();
        return view('pages.admin.agency', $data);

    }

    public function AgencyPayments(Request $request)
    {

        $agency_id = $_GET['agency_id'];
        ///$agency_invoices = AgencyInvoice::where(['agency_id' => $agency_id])->count();

        $agency_invoice = AgencyInvoice::where(['agency_id' => $agency_id])->get();
        $agency_col = Schema::getColumnListing('agency_invoices');
        $num_fields = count($agency_col);
        $header = array();
        for ($i = 0; $i < $num_fields; $i++) {

            $header[] = $agency_col[$i];
        }
        $output = fopen('php://output', 'w');

        if ($output && $agency_invoice) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Agency Invoice.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($output, $header);
            foreach ($agency_invoice as $invoice) {

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
                fputcsv($output, $data);

            }
            fclose($output);
            die;
        }


    }


    public function agencyUpdate(Request $request, $agencyEmail)
    {
        $admin = Auth::admin()->get();
        $message = 'open agency update page';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $agency = Agency::where(['type' => 'agency', 'email' => $agencyEmail])->first();
        $agencies = Agency::where(['type' => 'agency','active' => 1])->get();

        $referred_agency =  Agency::where(['id'=> $agency->referr_agency])->first();
        $data['refered_agency'] = $referred_agency;
        $data['agencies'] = $agencies;
        $data['update'] = true;
        $data['agency'] = $agency;
        return view('pages.admin.agency_create', $data);

    }

    /*public function agencyDelete(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'Deleted agency';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $agency_id = $request->input('agency_id');
        $order = Order::where(['assigned_to' => $agency_id])->count();
        if($order > 0){
            return 0;
        }else{
            $agency = Agency::destroy($request->input('agency_id'));
            Gig::where(['suggested_by' => $agency_id])->update(['active' => 0 , 'featured' => 0,'status' => 'disabled' ]);
        return $agency;
        }
//        return $order;

    }*/

    public function agency_additional_Delete(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'Deleted agency';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $additional = DB::table('agency_additional')->where('id', $request->input('agency_id'))->first();
        $agency = DB::table('agency_additional')->where('id', $request->input('agency_id'))->delete();
        $from = 'marketplace@4slash.com';
        $sub = 'Registration - Activation link | 4slash';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        $to = $additional->email;
        $message = 'Hello ' . ucfirst($additional->name) . '<br> Your account has not been approved by our Team';
        $message .= 'For more info, Contact with our team on below email address ';
        $message .= 'Email: marketplace@4slash.com';
        // $message = view('NewAgencyEmail', $data)->render();

        mail($to, $sub, $message, $headers);
        if($agency) {
            return 1;
        }else{
            return 0;
        }

    }


    public function deleteInActiveAgency(Request $request)
    {

        $userData = DB::table('agency_inquires')->where('id', $request->input('agency_id'))->first();

        $agency = DB::table('agency_inquires')->where('id', $request->input('agency_id'))->delete();

        $from = 'marketplace@4slash.com';
        $sub = 'Registration - Activation link | 4slash';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        $to = $userData->email;
        $message = 'Hello ' . ucfirst($userData->name) . '<br> Your account has not been approved by our Team';
        $message .= 'For more info, Contact with our team on below email address ';
        $message .= 'Email: marketplace@4slash.com';
        // $message = view('NewAgencyEmail', $data)->render();

        mail($to, $sub, $message, $headers);

        return $agency;
    }

    public function agencyAccept(Request $request)
    {
        $id = $request->input('agency_id');
        $admin = Auth::admin()->get();
        $message = 'Accept agency request';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $agency = DB::table('users')->where('id', $id)->first();
        $status = DB::table('agency_additional')->where('agency_id', $request->input('agency_id'))->update(['active' => 1]);
        $active = User::where(['id' => $request->input('agency_id')])->update(['active' => 1]);
        if($active) {
                $from = 'marketplace@4slash.com';
                $sub = 'Registration - Activation link | 4slash';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                    $data = [
                        'type' => 'accepted',
                        'agency' => $agency->username,
                        'user' => 'agency',
                    ];
                    $to = $agency->email;
                    $message = view('pages/success_email_agency', $data)->render();
                    if(mail($to, $sub, $message, $headers)){
                        return 1;
                    }else{
                        return 0;
                    }



        }

        /*if($active) {
            $users = array('admin', 'agency');
            for ($i = 0; $i <= 1; $i++) {
                $from = 'marketplace@4slash.com';
                $sub = 'Registration - Aktivierungs-Link | 4slash.com';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                if ($users[$i] == 'admin') {
                    $data = [
                        'type' => 'accepted',
                        'user' => 'admin',
                        'agency' => $agency->username,
                    ];
                    $to = 'marketplace@4slash.com';
                    $message = view('NewAgencyEmail', $data)->render();

                    mail($to, $sub, $message, $headers);
                } elseif ($users[$i] == 'agency') {

                    $data = [
                        'type' => 'accepted',
                        'agency' => $agency->username,
                        'user' => 'agency',
                        'activation_code' => $agency->activation_code
                    ];
                    $to = $agency->email;
                    $message = view('NewAgencyEmail', $data)->render();

                    if (mail($to, $sub, $message, $headers)) {
//                        return $status;
                        return $active;
                    }

                }
            }

        }*/
    }

    public function putAgencyUpdate(Request $request)
    {


        $validator = Validator::make($request->all(), [

                'email' => 'required|max:255|unique:users,email,'.$request->input('agency_id'),
                'password' => 'min:8|confirmed',
                'password_confirmation' => 'min:8',

            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $agency = Agency::where(['id' => $request->input('agency_id')])->first();
            $agency->username = $request->input('name');
            $agency->email = $request->input('email');
            $agency->referr_agency = $request->input('parent-agency');
            $agency->master_percent = $request->input('percent');
            $agency->agency_percentage = $request->input('percent1');
            $agency->refer_percent = $request->input('percent2');
            if($request->input('password')) {
                $agency->password = Hash::make($request->input('password'));
            }
            $agency->save();
            $admin = Auth::admin()->get();
            $message = 'updated agency details';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = route('adminagencies');
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            return redirect()->route('adminagencies');
        }
    }

    public function withdrawAgencyAmount(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $transfer_amnt = $request->input('with_amnt');
                $invno = $request->input('invno');
                $agency = User::where(['id' => $request->input('agencyId')])->first();
                $agency_request = DB::table('withdraw_request')->where(['agency_id' => $request->input('agencyId')])->update(['status' => 0]);
                $agencyAmount = $transfer_amnt;
                $new_wallet = number_format($agency->wallet - $transfer_amnt,2);
                $agency->wallet = $new_wallet;
                $agency->request_withdraw = 0;
                AgencyInvoice::where(['invoiceno' => $invno])->update(['invoice_status' => 'Transferred']);
                if ($agency->save()) {

//                    $agencyInvoice = new AgencyInvoice();
//                    $agencyInvoice->invoiceno = rand(0, 99) . date("dmy") . time();
//                    $agencyInvoice->setDetail('Paid: ' . $agencyAmount . '&euro;');
//                    $agencyInvoice->setPaid($agencyAmount);
//                    $agencyInvoice->setBalance($agency->wallet);
//                    $agencyInvoice->setAgencyId($agency->id);
//                    $agencyInvoice->created_at = date('Y-m-d H:m:i');
//                    $agencyInvoice->updated_at = date('Y-m-d H:m:i');
//                    $agencyInvoice->save();
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $notify_id = Notification::sendnotification('', $agency->id, '<a href="' . route('agencyprofile') . '?ref=notification">Admin confirmed your amount withdraw</a>');
                    Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('agencyprofile') . '?ref=notification&id=' . $notify_id . '">Admin confirmed your amount withdraw</a>']);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                    /* Send an email to the Admin*/
                    $data = [
                        'user'       =>  $agency->username,
                        'amount'     =>  $agencyAmount,
                        'email'      =>  $agency->email,
                        'subj'       =>  'Ziehen Sie Erfolg'
                    ];

                    $this->send_email($to = $agency->email, $data, $type = 'agency');
                    $this->send_email($to = 'info@ad-print.de', $data, $type = 'admin');
                }
                $admin = Auth::admin()->get();
                $message = 'Accept withdraw amount request';
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                $request_uri = url().$_SERVER['REQUEST_URI'];
                $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);

            });

            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
        }

    }
    
    
    public function get_agency_data(request $request, $agencyEmail){
        $agency = DB::table('agency_additional')->where('email', $agencyEmail)->first();
        $data['agency_data'] = $agency;
        return view('pages.admin.agency_data',$data);
    }

    public function send_email($to, $data, $type = ''){

        $from    ='marketplace@4slash.com';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";

        $data['type'] = $type;
        /* Render Email View */
        $msg = View('pages.emails.withdrawEmail', $data)->render();

        $response = mail($to, $data['subj'], $msg, $headers);

        if($response)
            return true;
        else
            return false;

    }

    public function invoice_status(Request $request){
        $status = $request->input('status');
        $invoice_number = $request->input('invoice_number');
        $agency_invoice = AgencyInvoice::where(['invoiceno'=>$invoice_number])->update(['invoice_status'=> $status]);
        return $agency_invoice;
    }

    public function admin_invoice($invoiceNo)
    {

        $invoice = AgencyInvoice::where(['invoiceno' => $invoiceNo])->first();

//        $order = Order::where(['id' => $invoice->order_id])->first();
        $user = User::where('id', $invoice->agency_id)->first();
        $service = DB::table('service_charges')->first();
        $user_info = DB::table('agency_additional')->where('agency_id', $invoice->agency_id)->first();
        $order_details = AgencyInvoice::where(['reference_invoice' => "paid",'reference_invoiceno'=>$invoiceNo])->get();

        $data['order_details'] = $order_details;
        $data['user'] = $user;
        $data['userInfo'] = $user_info;
        $data['invoice'] = $invoice;
        $data['service'] = $service;
        return PDF::loadView('pages.admin_invoice', $data)->stream();
        //	return $pdf->download('invoice.pdf');

//        return view('pages.invoice', $data);

    }

    public function resend_email(Request $request){
        $admin = Auth::admin()->get();
        $message = 'Accept agency request';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $agency = DB::table('agency_inquires')->where('email', $request->input('agency_id'))->first();
        $status = DB::table('agency_inquires')->where('email', $request->input('agency_id'))->update(['created_at' => date('Y-m-d H:i:s')]);
        if($agency) {
            $users = array('admin', 'agency');
            for ($i = 0; $i <= 1; $i++) {
                $from = 'marketplace@4slash.com';
                $sub = 'Registration - Activation link | 4slash';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                if ($users[$i] == 'admin') {
                    $data = [
                        'type' => 'accepted',
                        'user' => 'admin',
                        'agency' => $agency->name,
                    ];
                    $to = 'marketplace@4slash.com';
                    $message = view('NewAgencyEmail', $data)->render();

                    mail($to, $sub, $message, $headers);
                } elseif ($users[$i] == 'agency') {

                    $data = [
                        'type' => 'accepted',
                        'agency' => $agency->name,
                        'user' => 'agency',
                        'activation_code' => $agency->activation_code
                    ];
                    $to = $agency->email;
                    $message = view('NewAgencyEmail', $data)->render();

                    if (mail($to, $sub, $message, $headers)) {
                        return $status;
                    }

                }
            }

        }
    }

    public function agencyActivate(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'Change agency status';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $agencyid = $request->input('agency_id');
        $order = Order::where(['assigned_to' => $agencyid])->count();
        if($order > 0){
            return 0;
        }else{
            Gig::where(['suggested_by' => $agencyid])->update(['active' => 0 , 'featured' => 0,'status' => 'disabled' ]);
            Package::where(['suggested_by' => $agencyid])->update(['active' => 0 , 'featured' => 0,'status' => 'disabled' ]);
            return ['status' => Agency::agencyActivate($agencyid)];
        }
    }

}
  