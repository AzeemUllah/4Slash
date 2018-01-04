<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\AgencyInvoice;
use App\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use App\User;
use App\Gig;
use App\Package;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'uuid',
        'order_no',
        'gig_id',
        'gig_owner_id',
        'user_id',
        'company_name',
        'company_tagline',
        'company_industry',
        'company_discription',
        'company_email',
        'company_tel',
        'company_site',
        'company_extra_notes',
        'type',
        'status',
        'amount',
        'expiry',
        'service_charges',
        'govt_tax',
        'net_total',
        'reference_invoice'
    ];

    public function acknowledge() {



        try {

            DB::transaction(function () {
                $this->status = 'complete';
                if ($this->save()) {
                    $invoice = new Invoice;
                    $invoice->generate($this->id);
                    $agency = User::where(['id' => $this->assigned_to])->first();
                    $referr_agency = $agency->referr_agency;
                    $referr_agency_user = User::where(['referr_agency' => $referr_agency])->first();
                    $payee_agency = User::where(['id' => $referr_agency])->first();
                    $tax = (round((double)$this->amount - round(((float)$this->amount)/(1 + 19/100),2),2));
                    $this->amount = round(($this->amount) - $tax,2);
                    $agencyPercentAmount = round((((double)$this->amount * (double)$agency->agency_percentage) / 100),2);
                    $referr_agencyPercentAmount = round((((double)$this->amount * (double)$agency->refer_percent) / 100),2);

                    $total_amount = $agencyPercentAmount - $referr_agencyPercentAmount;
                    $agency->addWalletAmount($total_amount);
                    if($payee_agency) {
                        $payee_agency->addWalletAmount($referr_agencyPercentAmount);
                    }

                    $custom = $this->type;
                    if($custom == 'custom')
                    {

                        $admin = User::where(['type' => 'admin'])->first();
                        /*$admin = User::where(['id' => $this->gig_owner_id])->first();*/
                        $total_dedcution = $agencyPercentAmount + $referr_agencyPercentAmount;
                        $adminPercentAmount = ((double)$this->amount - $total_dedcution);
                        $admin->addWalletAmount($adminPercentAmount);
                    }
                    elseif($custom == 'package'){

                        $admin = User::where(['type' => 'admin'])->first();
                        /*$admin = User::where(['id' => $this->gig_owner_id])->first();*/
                        $total_dedcution = $agencyPercentAmount + $referr_agencyPercentAmount;
                        $adminPercentAmount = ((double)$this->amount - $total_dedcution);
                        $admin->addWalletAmount($adminPercentAmount);
                    }
                    else{

                        $total_dedcution = $agencyPercentAmount + $referr_agencyPercentAmount;
                        $adminPercentAmount = ((double)$this->amount - $total_dedcution);
                        $admin = User::where(['type' => 'admin'])->first();
                        $admin->addWalletAmount($adminPercentAmount);
                    }
                    $gig = Gig::where(['id' => $this->gig_id])->first();
                    $package = Package::where('packages_id', $this->packages_id)->first();
                    $agencyInvoice = new AgencyInvoice();
                    $agencyInvoice->invoiceno = rand(0, 99) . date("dmy") . time();

                    if($gig){
                        $agencyInvoice->setDetail("Favor" . $gig->title . "\r\n" . "Order#: " . $this->order_no);
                    }
                    elseif($custom == 'custom'){
                        $agencyInvoice->setDetail($this->type . ": \r\n" . "Order#: " . $this->order_no);
                    }
                    else{
                        $agencyInvoice->setDetail($this->type . ": " . $package->title . "\r\n" . "Order#: " . $this->order_no);
                    }
                    $agencyInvoice->setPayable($agencyPercentAmount);
                    if($gig || $custom == "custom" || $package){
                        $agencyInvoice->setBalance($total_amount);
                    }else{
                        $agencyInvoice->setBalance($agency->wallet);
                    }
                    $agencyInvoice->setAgencyId($agency->id);
                    $agencyInvoice->setRefer_agencyId($referr_agency);
                    $agencyInvoice->setRefer_agencyAmount($referr_agencyPercentAmount);
                    if($payee_agency) {
                        $agencyInvoice->setRefer_agencyBalance($payee_agency->wallet);
                    }
                    $agencyInvoice->setOrder_no($this->order_no);
                    $agencyInvoice->created_at= date('Y-m-d H:m:i');
                    $agencyInvoice->updated_at= date('Y-m-d H:m:i');
                    $agencyInvoice->reference_invoice = "unpaid";
                    $agencyInvoice->save();

                }

            });
        }catch(\Exception $e) {

        }

    }

    /**
     * @param string $compName
     * @param string $compEmail
     * @param string $compTel
     * @param string $compSite
     * @param string $compExNote
     *
     * @return bool
     */
    public static function createCustomOrder($request) {

        if($request->input('products')) {
            $products = implode(',', $request->input('products'));
        } else {
            $products = '';
        }
        $compName = $request->input('comp-name');
        $compEmail = $request->input('comp-email');
        $compTel = $request->input('comp-tel');
        $compSite = $request->input('comp-site');
        $compExNote = $request->input('comp-extra-note');
        if(!Auth::user()->get()){
            try {

                $admin = User::where(['type' => 'admin'])->first();
                $from='no-reply@cnerr.de';
                $sub=' „Kein Cnerr User |  Individuelle Anfrage“ ';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
                $view =" New custom inquiry from ". $compName;
                $mailbody = $view;
                $to = 'info@cnerr.de';

                /*mail($to,$sub,$mailbody,$headers);*/
                /*$not_id = Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">You have a new Custom Order</a>');
                Notification::where('id', $not_id)->update(['message' => '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">You have a new Custom Order</a>']);*/
                return true;
            }
            catch (\Exception $e) {

                return false;
            }

        }
        elseif(Auth::user()->get())
        {
            try {

                DB::transaction(function () use ($products, $compName, $compEmail, $compTel, $compSite, $compExNote) {

                    $order = new self();
                    $order->uuid = \Webpatser\Uuid\Uuid::generate(4);
                    $order->order_no = date("Ymd") . strtoupper(substr(uniqid(sha1(time())),0,4));
                    $order->user_id = Auth::user()->get()->id;
                    $order->company_name = $compName;
                    $order->company_email = $compEmail;
                    $order->company_tel = $compTel;
                    $order->company_site = $compSite;
                    $order->company_extra_notes = $compExNote;
                    $order->custom_order_products = $products;
                    $order->type = 'custom';
                    $order->save();

                    if($order->id) {

                        $id = DB::table('custom_orders')->insertGetId(['order_id' => $order->id, 'user_id' => Auth::user()->get()->id]);
                        if ($id) {

                            $admin = User::where(['type' => 'admin'])->first();
                            $not_id = Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">You have a new Custom Order</a>');
                            Notification::where('id', $not_id)->update(['message' => '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">You have a new Custom Order</a>']);
//                return redirect()->route('myorders');

//                     Notification::sendNotification($order->id, $admin->id, '<a href='.route('').'You have a new custom order.');
                        }
                    }

                });

                return true;

            }
            catch (\Exception $e) {

                return false;
            }

        }

    }


}
