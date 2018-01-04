<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\User;
use App\Order;
use App\Gig;
use Illuminate\Support\Facades\Auth;

class AgencyDashboardController extends Controller
{
    public function index(Request $request)
    {
        $agency = Auth::agency()->get();
       //$orders = Order::where(['assigned_to' => $agency->id, 'status' => 'pending'])->get();
        $orders = DB::table('orders')
            ->join('gigs', 'gigs.id', '=', 'orders.gig_id')
            ->where(['type' => 'gig','orders.assigned_to' => $agency->id, 'orders.status' =>'pending'])
            ->orWhere(['type' => 'gig','orders.assigned_to' => $agency->id,'orders.status' => 'jobdone'])
            ->orWhere(['type' => 'gig','orders.status' => 'review', 'orders.assigned_to' => $agency->id])
            ->orWhere(['type' => 'gig','orders.assigned_to' => $agency->id, 'orders.status' => 'jobdonebyagency'])
            ->select('orders.*', 'gigs.title')
            ->get();
        $Packageorders = DB::table('orders')
            ->join('packages', 'packages.packages_id', '=', 'orders.packages_id')
            ->where(['type' => 'package','orders.assigned_to' => $agency->id, 'orders.status' => 'pending'])
            ->orWhere(['type' => 'package','orders.assigned_to' => $agency->id, 'orders.status' => 'review'])
            ->orWhere(['type' => 'package','orders.assigned_to' => $agency->id, 'orders.status' => 'jobdonebyagency'])
            ->orWhere(['type' => 'package','orders.assigned_to' => $agency->id, 'orders.status' => 'jobdone'])
            ->select('orders.*', 'packages.title')
            ->get();
        $customOrders = Order::where(['type' => 'custom','assigned_to' => $agency->id, 'status' => $request->input('status')])
            ->orWhere(['type' => 'custom','assigned_to' => $agency->id,'status' => $request->input('status')])
            ->orWhere(['type' => 'custom','assigned_to' => $agency->id,'status' => 'review'])
            ->orWhere(['type' => 'custom','assigned_to' => $agency->id,'status'=> 'jobdone'])
            ->orWhere(['type' => 'custom','assigned_to' => $agency->id,'status' => 'jobdonebyagency'])->get();
       // $orders = Order::find(1)->allgigs();
            $count_pending_orders = count($orders);
            $count_package_ordrs = count($Packageorders);
            $count_custom_orders = count($customOrders);
        if($count_package_ordrs > 0 || $count_custom_orders > 0 || $count_pending_orders > 0){
               $data['total_pckage_ordres'] = $count_package_ordrs;
               $data['packagesOrder'] = $Packageorders;
               $data['pendingdorders'] = $count_pending_orders;
               $data['orders'] = $orders;
               $data['total_custom_orders'] = $count_custom_orders;
               $data['customorders'] = $customOrders;
            }
            elseif($count_custom_orders > 0){
                $data['total_custom_orders'] = $count_custom_orders;
                $data['customorders'] = $customOrders;
            }
            elseif($count_pending_orders > 0){
                $data['pendingdorders'] = $count_pending_orders;
                $data['orders'] = $orders;
            }



        $agencyAmount      = User::where(['id' => $agency->id])->first();
        $data['get_pending'] = Order::where(['assigned_to' => $agency->id, 'status' => 'pending'])->count();
        $data['get_finsihed'] = Order::where(['assigned_to' => $agency->id, 'status' => 'complete'])->count();
        $data['get_processed'] = Order::where(['assigned_to' => $agency->id, 'status' => 'jobdone'])
            ->orwhere(['assigned_to' => $agency->id, 'status' => 'jobdonebyagency'])
            ->count();
        $data['agencyAmount'] = $agencyAmount;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.dashboard')->with($data);
    }

    public function business(){
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages/agency/business',$data);
    }

    public function faq(){
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages/agency/faq',$data);
    }
}