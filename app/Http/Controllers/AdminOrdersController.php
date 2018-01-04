<?php

namespace App\Http\Controllers;

use App\Gig;
use App\Agency;
use App\Order;
use App\User;
use App\Package;
use Illuminate\Http\Request;
use Schema;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminOrdersController extends Controller
{
    use LogTrait;

    public function index(Request $request)
    {
        $count_orders = 0;

        $user = Auth::admin()->get();
        $pendingorders = Order::where(['type' => 'gig','status' => $request->input('status')])->orWhere(['type' => 'gig','status' => 'jobdone'])
                         ->orWhere(['type' => 'gig', 'status' => 'jobdonebyagency'])->orWhere(['type' => 'gig', 'status' => 'review'])
                        ->orderBy('created_at','desc')
                        ->orderBy('expiry', 'asc')
                        ->get();
        $completed_orders = Order::where(['type' => 'gig','status' => $request->input('status')])->orderBy('expiry', 'asc')->get();
        $canceled_orders = Order::where(['type' => 'gig','status' => $request->input('status')])->orderBy('expiry', 'asc')->get();
        if($request->input('status') == 'pending') {
            $admin = Auth::admin()->get();
            $message = 'open pending orders page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $count_orders = count($pendingorders);
        }
        if($request->input('status') == 'cancel') {
            $admin = Auth::admin()->get();
            $message = 'open cancel orders page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $cancel_orders = count($canceled_orders);
            $data['total_cancel_orders'] = $cancel_orders;
            $data['canceledorders']    = $canceled_orders;
        }
        foreach($canceled_orders as $order) {

            $order['gig'] = Gig::where(['id' => $order->gig_id])->first();
        }
        if($request->input('status') == 'complete') {
            $admin = Auth::admin()->get();
            $message = 'open complete orders page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $count_complete_orders = count($completed_orders);
            $data['total_complete_orders'] = $count_complete_orders;
        }
        foreach($completed_orders as $corder) {

            $corder['gig'] = Gig::where(['id' => $corder->gig_id])->first();
            $corder['agency'] = Agency::where('id', $corder->assigned_to)->first();
        }
        foreach($pendingorders as $order) {

            $order['gig'] = Gig::where(['id' => $order->gig_id])->first();
            $order['agency'] = Agency::where('id', $order->assigned_to)->first();
        }

        $data['total_pending_orders'] = $count_orders;
        $data['pendingorders'] = $pendingorders;
        $data['completedorders'] = $completed_orders;
        $data['agent'] = DB::table('users')->where('type', 'agency')->get();
        return view('pages.admin.orders')->with($data);
    }

    public function customOrders(Request $request) {

        $status = $request->input('status');

        $custompendingOrders = Order::where(['type' => 'custom', 'status' => $status])->orWhere(['type' => 'custom' ,'status' =>  'jobdone'])
                                     ->orWhere(['type' => 'custom','status' => 'jobdonebyagency'])
                                     ->orWhere(['type' => 'custom', 'status' => 'review'])->orderBy('created_at','desc')->get();
        $canceled_orders = Order::where(['type' => 'custom','status' => $status])->orderBy('expiry', 'asc')->get();
        if($status == 'cancel') {
            $admin = Auth::admin()->get();
            $message = 'open custom cancel order page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $cancel_orders = count($canceled_orders);
            if($cancel_orders > 0){
                foreach($canceled_orders as $canceled_order){
                    $completed_order['agency'] = Agency::where('id', $canceled_order->assigned_to)->first();
                }
            }
            $data['total_cancel_orders'] = $cancel_orders;
            $data['canceledorders']    = $canceled_orders;
        }
        if($status == 'pending')
        {
            $admin = Auth::admin()->get();
            $message = 'open custom pending order page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $admin = Auth::admin()->get();
            $message = 'open custom pending order page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $count_pending_orders = count($custompendingOrders);
            if($count_pending_orders > 0){
                foreach($custompendingOrders as $custompendingOrder){
                    $custompendingOrder['agency'] = Agency::where('id', $custompendingOrder->assigned_to)->first();
                }
            }
            $data['countpendingorders'] = $count_pending_orders;
            $data['customOrders'] = $custompendingOrders;
         }
        $completed_orders = Order::where(['type' => 'custom', 'status' => $status])->get();
        if($status == 'complete'){
            $admin = Auth::admin()->get();
            $message = 'open custom completed order page';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
            $countorders = count($completed_orders);
            if($countorders > 0){
                foreach($completed_orders as $completed_order){
                    $completed_order['agency'] = Agency::where('id', $completed_order->assigned_to)->first();
                }
            }
            $data['countorders'] = $countorders;
            $data['completeOrders'] = $completed_orders;
        }
        $data['agent'] = DB::table('users')->where('type', 'agency')->get();
        return view('pages.admin.customOrders')->with($data);

    }

    public function packagesOrders(Request $request) {

        $status = $request->input('status');
        $packagesOrders = Order::where(['type' => 'package', 'status' => $status])->orWhere(['type' => 'package','status' => 'jobdone'])
            ->orWhere(['type' => 'package','status' => 'jobdonebyagency'])->orWhere(['type' => 'package','status' => 'review'])->get();
        $packagesCompleteOrders = Order::where(['type' => 'package', 'status' => $status])->get();
        $canceled_orders = Order::where(['type' => 'package','status' => $request->input('status')])->orderBy('expiry', 'asc')->get();
        if($status == 'cancel') {
            $cancel_orders = count($canceled_orders);
            if($cancel_orders > 0)
                foreach ($canceled_orders as $packageOrder) {
                    $packageOrder['package'] = Package::where(['packages_id' => $packageOrder->packages_id])->first();
                    $packageOrder['agency'] = Agency::where('id', $packageOrder->assigned_to)->first();
                }
            $data['total_cancel_orders'] = $cancel_orders;
            $data['canceledorders']    = $canceled_orders;
        }
        elseif($status == 'complete'){
            $countCompleteOrdres = count($packagesCompleteOrders);
            if($countCompleteOrdres > 0)
                foreach ($packagesCompleteOrders as $packageOrder) {
                    $packageOrder['package'] = Package::where(['packages_id' => $packageOrder->packages_id])->first();
                    $packageOrder['agency'] = Agency::where('id', $packageOrder->assigned_to)->first();
                }
            $data['CountpackagesCompleteOrders'] = $countCompleteOrdres;
            $data['packagesCompleteOrders'] = $packagesCompleteOrders;
        }
        else
          {
                $countPendingOrders = count($packagesOrders);
                if($countPendingOrders > 0)
                    foreach ($packagesOrders as $packageOrder) {
                        $packageOrder['package'] = Package::where(['packages_id' => $packageOrder->packages_id])->first();
                        $packageOrder['agency'] = Agency::where('id', $packageOrder->assigned_to)->first();
                    }

                $data['pendingordersCount'] = $countPendingOrders;
              $data['packagesOrders'] = $packagesOrders;
            }
        return view('pages.admin.packagesOrders')->with($data);

    }

    public function OrdersCSV(Request $request){

        if($_GET['type'] == 'gig'){
            $completed_orders = Order::where(['type' => 'gig','status' => 'complete'])->orderBy('expiry', 'asc')->get();
            $header = array('Order No', 'Gig', 'User Name', 'Order Date', 'Amount');
        }
        elseif($_GET['type'] == 'custom'){
            $completed_orders = Order::where(['type' => 'custom','status' => 'complete'])   ->orderBy('expiry', 'asc')->get();
            $header = array('Order No', 'Custom Order', 'User Name', 'Order Date', 'Amount');
        }
        elseif($_GET['type'] == 'package'){
            $completed_orders = Order::where(['type' => 'package','status' => 'complete'])->orderBy('expiry', 'asc')->get();
            $header = array('Order No', 'Package', 'User Name', 'Order Date', 'Amount');
        }

        $output = fopen('php://output', 'w');

        if ($output && $completed_orders)
        {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-disposition: attachment;filename=Orders' . date('Y-m-d') . '.csv');
            header('Content-Transfer-Encoding: binary');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($output, $header);
            foreach($completed_orders as $order) {
                if($_GET['type'] == 'gig') {
                    $gig = Gig::where(['id' => $order->gig_id])->first();
                    $title = $gig->title;
                }
                elseif($_GET['type'] == 'custom'){
                    $title = $order->type;
                }
                elseif($_GET['type'] == 'package'){
                  $package =  Package::where(['packages_id' => $order->packages_id])->first();
                    $title = $package->title;
                }
                $user = User::where(['id' => $order->user_id])->first();
                $data = array(
                    $order->order_no,
                    $title,
                    $user->username,
                    date('d.m.Y',strtotime($order->created_at)),
                    number_format($order->amount,2),
                );
                fputcsv($output,array_map('html_entity_decode',array_values($data)));

            }
            fclose($output);
            die;
        }

    }
    public function singleOrder(Request $request){

//        $status = $request->input('status');

//       Order::where(['id', $request->input('order_id'),'type' => 'custom', 'status' => $status])->first();
        $order = Order::where('id', $request->input('order_id'))->orWhere(['type' => 'custom'])->first();


        return response()->json($order);
        //json_encode($gig);
    }

    public function singlePendingOrder(Request $request)
    {
        $order = Order::where(['order_no' => $request->input('order_id'), 'status' => 'pending'])->first();


        return response()->json($order);


    }
    public function deleteOrder(Request $request)
    {
        $order_id = $request->input('order_id');
        $order_delete= Order::where('id',$order_id)->delete();
        if($order_delete)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }

    public function get_completeorders(Request $request){
        $status  = $request->input('status');
        $order_no = $request->input('order_no');
        if($order_no != 'all'){
            $order = DB::table('orders')
                ->join('users', 'orders.assigned_to', '=', 'users.id')
                ->join('gigs', 'gigs.suggested_by', '=', 'orders.assigned_to')
                ->select('users.username', 'gigs.*','orders.*')
                ->orderBy('gigs.created_at', 'desc')
                ->where(['orders.assigned_to' => $order_no, 'orders.type' => 'gig', 'orders.status' => $status])
                ->get();
        }else{
            $order = DB::table('orders')
                ->join('users', 'orders.assigned_to', '=', 'users.id')
                ->join('gigs', 'gigs.suggested_by', '=', 'orders.assigned_to')
                ->select('users.username', 'gigs.*','orders.*')
                ->orderBy('gigs.created_at', 'desc')
                ->where(['orders.type' => 'gig', 'orders.status' => $status])
                ->get();
        }
        header("Content-Type:application/json");
        return $order;
    }

    public function get_complete_customorders(Request $request){
        $status  = $request->input('status');
        $order_no = $request->input('order_no');
        if($order_no != 'all'){
            $order_block = DB::table('orders')
                ->join('users','orders.assigned_to','=','users.id')
                ->orderBy('id','desc')
                ->select('orders.*','users.username')
                ->where(['orders.assigned_to' => $order_no, 'orders.type' => 'custom', 'orders.status' => $status])
                ->get();
        }
        else{
            $order_block = DB::table('orders')
                ->join('users','orders.assigned_to','=','users.id')
                ->orderBy('id','desc')
                ->select('orders.*','users.username')
                ->where(['orders.type' => 'custom'])
                ->get();
        }
        header("Content-Type:application/json");
        return $order_block;
    }

    public function get_order_complaints(){
        $order_complaints = DB::table('order_complaints')->orderBy('created_at','desc')->get();
        $data['order_complaints'] = $order_complaints;
        return view('pages.admin.complaints_order')->with($data);
    }

    public function complaint_resolved(Request $request){
        $id = $request->input('id');
        $text = $request->input('text');
        $update = DB::table('order_complaints')->where('id',$id)->update(['rslvd_txt' => $text ,'status' => 1]);
        if($update){
            return 1;
        }else{
            return 0;
        }
    }

}
