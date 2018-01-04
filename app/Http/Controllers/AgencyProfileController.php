<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Schema;
use Illuminate\Support\Facades\Redirect;
use App\Order;
use App\Notification;
use App\Gig;
use App\User;
use App\Gigtype;
use App\Gigtype_Subcategory;
use App\AgencyInvoice;
use App\agency_payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\pay;
use App\GigImages;

class AgencyProfileController extends Controller {

    public function index()
    {
        if(isset($_GET['id'])){
            $notify = Notification::where('id',$_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();
        }
        $agency = Auth::agency()->get();
        $feedback = DB::table('order_feedback')->where(['agency_id' => $agency->id])->sum('order_feedback');
        $total = DB::table('order_feedback')->where(['agency_id' => $agency->id])->count();
        if($total > 0) {
            $data['rating'] = $feedback / $total;
        }else{
            $data['rating'] = '';
        }
        $data['total'] = $total;
        $agencyDetail = DB::table('agency_additional')->where('agency_id',$agency->id)->first();
        $get_agency_Detail = DB::table('agency_payment_details')->where('agency_id',$agency->id)->first();
        $data['agency'] = $agency;
        $data['agencyDetails'] = $agencyDetail;
        $data['agencyInvoices'] = AgencyInvoice::where(['agency_id' => $agency->id])->get();
        $data['pendingOrders'] = $agency->getPendingOrders();
        $data['completedOrders'] = $agency->getCompletedOrders();
        $data['get_agency_Detail'] = $get_agency_Detail;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.agencyProfile')->with($data);

    }

    public function image_upload(Request $request)
    {
        if ($request->input('submit')) {
            $image = $request->file('logo-image');
            if (!empty($image)) {

                $file_ext =  $image->getClientOriginalExtension();
                $new_name = time().$image->getClientOriginalName();
                $movedImage = $image->move(public_path('photos/mini/'), $new_name);
                $absolute_path = url() . '/photos/mini/' . $new_name;
                $agency = Auth::agency()->get();
                $gigImage = User::where(['id' => $agency->id])->update(['profile_image' => $new_name]);
                return redirect()->back();
            }
        }
    }



    public function userHistory()
    {
        if(isset($_GET['id'])){
            $notify = Notification::where('id',$_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();
        }
        $agency = Auth::agency()->get();
        $agencyDetail = DB::table('agency_additional')->where('agency_id',$agency->id)->first();
        $services = DB::table('service_charges')->first();
        $data['service'] = $services;
        $data['agency'] = $agency;
        $get_agency_Detail = DB::table('agency_payment_details')->where('agency_id',$agency->id)->first();

        //  $data['agencyDetails'] = $agencyDetail;
        $agencyInvoice = AgencyInvoice::where(['agency_id' => $agency->id])
                                        ->orwhere(['refer_agency_id' => $agency->id])->orderBy('id','desc')->get();
        $agencyInvoice2 = AgencyInvoice::where(['agency_id' => $agency->id,'payable'=>0])->get();
        $data['agencyInvoices'] = $agencyInvoice;
        $data['agencyInvoices2'] = $agencyInvoice2;
        $data['comissionInvoices'] = AgencyInvoice::where(['refer_agency_id' => $agency->id])->get();
        $data['pendingOrders'] = $agency->getPendingOrders();
        $data['completedOrders'] = $agency->getCompletedOrders();
        $data['get_agency_Detail'] = $get_agency_Detail;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.agency_history')->with($data);

    }


    public function editagency()
    {

        $agency = Auth::agency()->get();
        $agency_details = DB::table('agency_additional')->where('agency_id', $agency->id)->first();

        $skills = explode(',', $agency_details->skills);
        for($i = 0; $i < count($skills); $i++){
            $agency_skills[] = $skills[$i];
        }
        $data['Agency_skills'] = $agency_skills;
        $countries = DB::table('apps_countries')->get();
        $gigTypes = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
        foreach ($gigTypes as $gigType) {
            $gigType['Subcategory'] = Gigtype_Subcategory::where('gigtypes_id', $gigType->id)->get();
        }
        $data['agency'] = $agency;
        $data['gigtypes'] = $gigTypes;
        $data['countries'] = $countries;
        $data['agencyDetails'] = $agency_details;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.editAgencyProfile', $data);
    }


   public function putAgencyProfileUpdate(Request $request){


       $validator = Validator::make($request->all(),
           [
               'phone' => 'required',
               'post_add' => 'required|max:150',
               'mobile' => 'required',
               'name' => 'required|max:30',
               'email' => 'required',
               'country' => 'required',
               'company' => 'required',
           ]

       );

       if($request->has('subcat') OR $request->has('types')){

           if ($request->input('types') OR $request->input('subcat') OR $request->input('others')){
               if(!empty($request->input('types')))
               $products[] = implode(',', $request->input('types')); //$products[]


               if(!empty($request->input('subcat')))
                   $products[] = implode(',', $request->input('subcat'));
               if(!empty($request->input('others')))
                   $products[]=  $request->input('others');



               $prod = '';
               for($i=0; $i<count($products); $i++){

                   $prod .= $products[$i].',';
                   
               }

           }
       }
       else {
           $prod = '';
       }


       $data =[
           'postal_code' => $request->input('post_add'),
           'street_no' => $request->input('street'),
           'city' => $request->input('city'),
           /*'skills' => $request->input('zip'),*/
           'telephone' => $request->input('phone'),
           'mobile' => $request->input('mobile'),
           'country' => $request->input('country'),
           'gender' => $request->input('gender'),
           'f_name' => $request->input('fname'),
           'l_name' => $request->input('lname'),
           'employees' => $request->input('emp'),
           'skills' => $prod,
       ];


       if(!$validator->fails())
       {

           DB::beginTransaction();
           DB::table('agency_additional')->where('agency_id',Auth::agency()->get()->id)->update($data);
           $user = User::where('id', $request->input('user_id'))->update(['email' => $request->input('email'), 'name' => $request->input('name')]);
           DB::commit();


           if($user){
               Session::put('success', 'Profile has been updated successfully');
               return redirect()->route('agencyprofile');
           }

       }
       else{
          
           return Redirect::back()->withErrors($validator)->withInput();
       }
   }

    public function AgencyPayments(Request $request){

        $agency_id = $_GET['agency_id'];
        ///$agency_invoices = AgencyInvoice::where(['agency_id' => $agency_id])->count();

        $agency_invoice = AgencyInvoice::where(['agency_id' => $agency_id])->get();
        $agency_col = Schema::getColumnListing('agency_invoices');
        $num_fields = count($agency_col);
        $header = array();
        for($i = 0; $i < $num_fields; $i++){

            $header[] = $agency_col[$i];
        }
        $output = fopen('php://output', 'w');

        if ($output && $agency_invoice)
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Agency Invoice.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($output, $header);
            foreach($agency_invoice as $invoice) {

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

    public function requestWithdraw(Request $request){

        $agency = Auth::agency()->get();
        $agency_id = $request->input('agencyId');
        $method = $request->input('pay-method');
        $amount = $request->input('amount');
        $charges = $agency->wallet-$amount;
        $result = User::where('id',$agency_id)->update(['request_withdraw' => 1,'wallet'=>$charges]);
        $agencyInvoice = new AgencyInvoice();
        $agencyInvoice->invoiceno = "";
        $agencyInvoice->setDetail('Deducted for '. $method.' Withdrawal fees (ref#'.rand(0,5) . date("dmy") . time().')');
        $agencyInvoice->setPaid($amount);
        $agencyInvoice->setBalance(0);
        $agencyInvoice->setAgencyId($agency->id);
        $agencyInvoice->setMethod($method);
        $agencyInvoice->created_at = date('Y-m-d H:m:i');
        $agencyInvoice->updated_at = date('Y-m-d H:m:i');
        $agencyInvoice->save();
        $agencyInvoice = new AgencyInvoice();
        $agencyInvoice->invoiceno = rand(0, 99) . date("dmy") . time();
        $agencyInvoice->setDetail('Withdrawal from your 4slash Wallet');
        $agencyInvoice->setPaid($charges);
        $agencyInvoice->setBalance(0);
        $agencyInvoice->setAgencyId($agency->id);
        $agencyInvoice->setMethod($method);
        $agencyInvoice->created_at = date('Y-m-d H:m:i');
        $agencyInvoice->updated_at = date('Y-m-d H:m:i');
        $agencyInvoice->invoice_status = "payable";
        $agencyInvoice->save();

        $invoice = AgencyInvoice::where(['id'=>$agencyInvoice->id])->first();
        DB::table('withdraw_request')->insert([
            'agency_name' => $agency->username,
            'agency_email' => $agency->email,
            'amount' => $agency->wallet,
            'payment_method' => $method,
            'created_at' => date('Y-m-d H:m:i'),
            'agency_id' => $agency->id,
            'status' => 1
        ]);
        AgencyInvoice::where(['agency_id'=>$agency_id,'invoice_status'=>Null,'reference_invoice'=>"unpaid"])->update(['reference_invoice'=> "paid",'reference_invoiceno'=>$invoice->invoiceno]);
        if($result)
        {
            $admin = User::where('type','admin')->first();
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $not_id = Notification::sendNotification('', $admin->id,'<a href="'.route('admin.agency', ['agencyMail' => $agency->email]).'?ref=notification">Agency '.$agency->name.' asked for amount withdraw</a>');
            Notification::where('id', $not_id)->update(['message' =>'<a href="'.route('admin.agency', ['agencyMail' => $agency->email]).'?ref=notification&id='.$not_id.'">Agency '.$agency->name.' asked for amount withdraw</a>']);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            /* Send an email to the Admin*/
            $data = [
                'user'       =>  $agency->username,
                'amount'     =>  $agency->wallet,
                'email'      =>  $agency->email,
                'subj'       =>  'Attracting agency inquiry'
            ];
            
            $this->send_email($to = 'marketplace@4slash.com', $data, $type = 'admin');
            $from    ='marketplace@4slash.com';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";

            $data['type'] = $type;
            $data['invoiceno'] = $invoice->invoiceno;
            /* Render Email View */
            $msg = View('pages.emails.invoice-email', $data)->render();

            $response = mail('marketplace@4slash.com', $data['subj'], $msg, $headers);
            Session::flash('updated','Details updated successfully');
            return $result;
        }
        else{

            return false;
        }



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

    public function agency_payment_details(request $request){

        $details = new agency_payment();
        $details->bank_name = $request->input('bank-name');
        $details->save();
        return View::make("hello");
    }

    public function payment_details(Request $request){

        $payment = new pay();


        $payment->bank_name       = $request->input('bank-name');
        $payment->acct_number     = $request->input('acct-number');
        $payment->acct_type       = $request->input('acct-type');
        $payment->bank_address    = $request->input('address');
        $payment->city            = $request->input('city');
        $payment->country         = $request->input('country');
        $payment->postal_code     = $request->input('postal');
        $payment->paypal_acct     = $request->input('paypal');
        $payment->iban_number     = $request->input('iban');
        $payment->swiss_code      = $request->input('swift');
        $payment->agency_id       = $request->input('agencyId');
        $data['payment']          = $payment;
        $payment->save();

        return Redirect::back()->with($data);
    }

    public function update_paymeny_details(Request $request){
        $data = [
            'bank_name'      => $request->input('bank-name'),
            'acct_number'    => $request->input('acct-number'),
            'acct_type'      => $request->input('acct-type'),
            'bank_address'   => $request->input('address'),
            'city'           => $request->input('city'),
            'country'        => $request->input('country'),
            'postal_code'    => $request->input('postal'),
            'paypal_acct'    => $request->input('paypal'),
            'iban_number'    => $request->input('iban'),
            'swiss_code'     => $request->input('swift')
        ];
        DB::beginTransaction();
        $agency = Auth::agency()->get();
        $update_user_payment_details = DB::table('agency_payment_details')->where('agency_id', $agency->id)->update($data);
        DB::commit();
                    return redirect()->route('agencyprofile');
//        if($update_user_payment_details){
//            Session::put('success_update', 'Profile has been updated successfully');
//            return redirect()->route('agencyprofile');
//        }
    }

    
}
