<?php
namespace App\Http\Controllers;
use App\Agency;
use App\AgencyInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invoice;
use App\Order;
use App\Gig;
use App\Package;
use App\User;
use App\UserDetails;
use Hash;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Notification;

class AdminUsersController extends Controller
{
    use LogTrait;

    public function index()
    {


        $users = Admin::where(['type'=> 'user'])->orderBy('created_at','asc')->get();

        $data['users']= $users;

        return view('pages.admin.users')->with($data);

    }

    public  function getUser(Request $request, $userEmail){
        if (isset($_GET['ref'])) {
            if (isset($_GET['id'])) {
                $notify = Notification::where('id', $_GET['id'])->first();
                $notify->seen = 1;
                $notify->save();
            }
        }
        $user = User::where(['type' => 'user', 'email' => $userEmail])->first();
        $userDetail = DB::table('users_info')->where('user_id',$user->id)->first();
        $completedOrdersAmount = Order::where(['user_id' => $user->id, 'status' => 'complete'])->sum('amount');
        $completedOrdersServiceCharges = Order::where(['user_id' => $user->id, 'status' => 'complete'])->sum('service_charges');
        $pendingOrdersAmount = Order::where(['user_id' => $user->id, 'status' => 'pending'])->orWhere(['user_id' => $user->id, 'status' => 'jobdone'])
            ->orWhere(['user_id' => $user->id,'status' => 'jobdonebyagency'])->sum('amount');
        $pendingOrdersServiceCharges = Order::where(['user_id' => $user->id, 'status' => 'pending'])->orWhere(['user_id' => $user->id, 'status' => 'jobdone'])
            ->orWhere(['user_id' => $user->id,'status' => 'jobdonebyagency'])->sum('service_charges');
        $completedOrders = Order::where(['user_id' => $user->id, 'status' => 'complete'])->get();
        foreach($completedOrders as $completedOrder) {
            $completedOrder->gig = Gig::where(['id' => $completedOrder->gig_id])->first();
            $completedOrder->package = Package::where(['packages_id' => $completedOrder->packages_id])->first();
            $completedOrder->invoice = Invoice::where(['order_id' => $completedOrder->id])->first();
        }

        $data['completedOrdersAmount'] = $completedOrdersAmount;
        $data['pendingOrdersAmount'] = $pendingOrdersAmount;
        $data['completedOrders'] = $completedOrders;
        $data['pendingOrdersServiceCharges']             = $pendingOrdersServiceCharges;
        $data['completedOrdersServiceCharges']           = $completedOrdersServiceCharges;
        $data['user'] = $user;
        $data['userDetails'] = $userDetail;
        return view('pages.admin.user', $data);


    }


    public function updateUser( Request $request, $userEmail)
    {
        $user = User::where(['type' => 'user', 'email' => $userEmail])->first();
        $userDetail = DB::table('users_info')->where('user_id',$user->id)->first();

//        $data['update'] = true;
        $data['user'] = $user;
        $data['userDetail'] = $userDetail;
        return view('pages.admin.User_edit', $data);


    }

    public function putUserUpdate(Request $request) {

        $user = User::where(['email' => $request->input('email')])->first();
        $userDetail = DB::table('users_info')->where('id',$request->input('info_id'))->first();
        if(!empty($userDetail->id))
        {
            DB::table('users_info')->where('id',$request->input('info_id'))
                ->update([
                    'phone' => $request->input('phone'),
                    'mobile' => $request->input('mobile'),
                    'country' => $request->input('country'),
                    'postal_address' => $request->input('post_add'),
                    'company' => $request->input('company'),
                    'zip' => $request->input('zip'),
                ]);
        }
        else{

            DB::table('users_info')
                ->insert([
                    'phone' => $request->input('phone'),
                    'mobile' => $request->input('mobile'),
                    'billing_address' => $request->input('bill_add'),
                    'country' => $request->input('country'),
                    'company' => $request->input('company'),
                    'zip' => $request->input('zip'),
                    'user_id' => $user->id,
                ]);


        }
        $user->name = $request->input('name');
        $user->username = $request->input('user_name');
        $user->email = $request->input('email');
        /*$user->password = Hash::make($request->input('password'));*/
        $user->save();

        return redirect()->route('registeredusers');

    }


    public function UserActivate(Request $request)
    {
        $userid = $request->input('user-id');

        return ['status' => User::userActivate($userid)];
    }

    public function UserDelete(Request $request)
    {
        $userid = $request->input('user_id');

        return ['status' => User::where('id',$userid)->delete()];
    }

   public function Subadmin()
   {
       $admin = Auth::admin()->get();
       $message = 'open subadmin page';
       $remote_addr = $_SERVER['REMOTE_ADDR'];
       $request_uri = url().$_SERVER['REQUEST_URI'];
       $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
       $subadmin = User::where('type' , 'subadmin')->get();
       $data['subadmin'] = $subadmin;
       return view('pages.admin.subadmin',$data);

   }

   public function SubadminProfile(Request $request, $subadninEnail)
   {
       $subadmin = User::where(['type' => 'subadmin', 'email' => $subadninEnail])->first();
       $data['subadmin'] = $subadmin;
       return view('pages.admin.subadminprofile',$data);

   }

    public  function subadminCreat(Request $request){

      return view('pages.admin.subadminCreate');


    }

    public  function PostsubadminCreat(Request $request){

        $validator = Validator::make($request->all(), [
            'uname'   => 'required',
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|min:6|confirmed',
            'password_confirmation'  =>  'required|min:6',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        else {
//            $subadmin = [
//                /*'name' => $request->input('name'),*/
//                'username' => $request->input('uname'),
//                'email' => $request->input('email'),
//                'password' => Hash::make($request->input('password')),
//                'type' => 'subadmin',
//                'phone_number' => $request->input('phone'),
//            ];
            $user = new User();
            $user->username = $request->input('uname');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->type = "subadmin";
            $user->phone_number = $request->input('phone');
            $user->save();
            $admin = Auth::admin()->get();
            $message = 'Create subadmin';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, route('subadmin'),$admin->id,$message);
            return redirect()->route('subadmin');
        }



    }


    public function subAdminDelete(Request $request){

        $data = User::where('id', $request->input('user_id'))->delete();

        if($data){
            echo 1;
        }
        else {
            echo 0;
        }
        $admin = Auth::admin()->get();
        $message = 'deleted subadmin';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, route('subadmin'),$admin->id,$message);
    }

    public function get_subadmin_data(Request $request){
        $data = DB::table('users')->where('id', $request->input('user_id'))->get();
        return json_encode($data);
    }

    public function subadmin_update(Request $request){
            $data = [
               'username' => $request->input('uname'),
               'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
               'phone_number' => $request->input('phone')
            ];
            DB::table('users')->where('id',$request->input('agency_id'))->update($data);
            Session::flash('updated','Details updated successfully');
             return redirect()->route('subadmin');
    }
}



