<?php
namespace App\Http\Controllers;
use App\Admin;
use App\CustomOrder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ActivityLogController;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\ReadConcern;
use Psr\Log\LoggerTrait;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    use LogTrait;
    public function index(Request $request)
    {
        $user = Auth::admin()->get();
        $data['wallet'] = Admin::where(['id' => $user->id])->first()->wallet;
        $data['totalUser'] = Admin::where(['type' => 'user'])->count();
        $date = date("d-m-Y");
        $data['NewOrders'] = DB::table('orders')->select(DB::raw('*'))
            ->whereRaw('Date(created_at) = CURDATE()')->count();
        $data['totalnewuser'] = DB::table('users')->select(DB::raw('*'))
            ->whereRaw('Date(created_at) = CURDATE()')->count();
        $data['totalNewFavorOrders'] = Order::where('type','gig')->count();
        $data['totalNewPackageOrders'] = Order::where('type','package')->count();
        $data['individuell'] = CustomOrder::count();
        $data['reviewagency'] = DB::table('agency_additional')->where('active',0)->count();
        $data['activeagency'] = DB::table('users')->where('type','agency')->count();
        $data['favorreview'] = DB::table('gigs')->where(['active'=>0,'status'=>'disabled'])->count();
        $data['packagereview'] = DB::table('packages')->where(['active'=>0])->count();
        $data['requestpayment'] = DB::table('users')->where(['request_withdraw' => 1])->count();
        return view('pages.admin.dashboard')->with($data);
    }

    public function detail(){
        $query = DB::table('service_charges')->select('*')->first();
        $data['query'] = $query;
        return view('pages.admin.charges')->with($data);
    }
    public function getLogs(){
        $query = DB::table('cnerr_log')->select('*')->get();
        $data['logs'] = $query;
        return view('pages.admin.activity_log')->with($data);
    }

    public function newsletter(){
        $user = User::where(['type'=>'user','newsletter'=>1])->get();
        $data['news'] = $user;
        return view('pages.admin.newsletter')->with($data);
    }

    public function services_charges_add(Request $request){
        $bank = $request->input('bank');
        $paypal = $request->input('paypal');

        if($request->input('submit')){
            $query = DB::table('service_charges')->insert([
                ['id'=> 1,'bank_services' => $bank,'paypal_services'=>$paypal],
            ]);
            if($query){
                SESSION::flash('succes-charges', 'Charges added successfully');
                return Redirect()->route('charges.services');
            }else{
                SESSION::flash('succes-error', 'error');
                return Redirect()->route('charges.services');
            }
        }

        if($request->input('update')){
            $query = DB::table('service_charges')->where('id',1)->update(['bank_services' => $bank,'paypal_services'=>$paypal]);
            if($query){
                SESSION::flash('succes-charges', 'Charges updated successfully');
                return Redirect()->route('charges.services');
            }else{
                SESSION::flash('succes-error', 'error');
                return Redirect()->route('charges.services');
            }
        }

    }

    public function addSliders(Request $request)
    {
        if($request->has("newAdd")){
            $query = DB::table('home_slider')->insertGetId(["slide_title"=>NULL]);
            if ($query) {
                return $query;
            } else {
                return "error";
            }
        }

        if($request->has("update")){
            $id = $request->input("update");
            $title1 = $request->input("title1");
            $title2 = $request->input("title2");
            $style = $request->input("style");
            $fileUpErr = "";
            $data = [
                'title' => $title1,
                'title2' => $title2,
                'txt_style' => $style
            ];
            if($request->hasFile("image")){
                $image = $request->file('image');
                $sel_old_img = DB::table('home_slider')->where(['id' => $id])->first();
                if(!empty($sel_old_img->image_name)){
                    File::delete(public_path('files/slider_images/').$sel_old_img->image_name);
                }
                $file_ext = '.' . $image->getClientOriginalExtension();
                $newName = md5(time()."".uniqid()) . $file_ext;
                if($image->move(public_path('files/slider_images/'), $newName)){
                    $data = [
                        'image_name' => $newName,
                        'title' => $title1,
                        'title2' => $title2,
                        'txt_style' => $style
                    ];
                }else{
                    $fileUpErr = "File upload error.";
                }
            }
            if(empty($fileUpErr)){
                $query = DB::table('home_slider')->where(["id"=>$id])->update($data);
                if($query){
                    $result = DB::table('home_slider')->where(["id"=>$id])->first();
                    return response()->json(["res"=>$result]);
                }else{
                    return response()->json(["err"=>"Update error."]);
                }
            }else{
                return response()->json(["err"=>$fileUpErr]);
            }
        }

        $imgages = DB::table('home_slider')->get();
        $data['imgages'] = $imgages;
        return view('pages.admin.addslider', $data);

    }

    public function slideRemove(Request $request)
    {
        if($request->has("id")){
            $id = $request->input('id');
            $sel_rec_file_id = DB::table('home_slider')->where(['id' => $id])->first();
            if(!empty($sel_rec_file_id->image_name)){
                File::delete(public_path('files/slider_images/').$sel_rec_file_id->image_name);
            }
            $query = DB::table('home_slider')->where(['id' => $id])->delete();
            if($query){
                return response()->json(['res' => 'success']);
            }
        }
        return response()->json(['res' => 'failed']);
    }

    public function payment_withdraw(){
        $data['requests'] = DB::table('users')->where(['request_withdraw'=>1])->get();
        return view('pages.admin.payments',$data);
    }

    public function withdrawals(){
        $data['requests'] = DB::table('withdraw_request')->where(['status'=>1])->get();
        return view('pages/admin/withdrawals',$data);
    }

}
