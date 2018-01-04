<?php

namespace App\Http\Controllers;

use App\PackageType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;



class AdminPackagesTypesController extends Controller
{
    public function index()
    {
        $packagesTypes = PackageType::all();

        $data['packagesTypes'] = $packagesTypes;

        return view('pages.admin.packages_types')->with($data);
    }

    public function create(Request $request)
    {
        $data['update'] = false;
        if(isset($_POST['package-submit']))
        {
            PackageType::create(['name' => $request->input('package-name')]);
            return redirect()->route('adminpackagestypes');
        }

        return view('pages.admin.packages_types_create',$data);
    }

    public function PackageTypeUpdate(Request $request, $packageTypeId)
    {
        $package_type= PackageType::where(['id' => $packageTypeId])->first();
        $data['update'] = true;
        $data['package_type'] = $package_type;
        return view('pages.admin.packages_types_create', $data);

    }
    public function putPackageTypeUpdate(Request $request)
    {
        $package_type= PackageType::where(['id' => $request->input('type_id')])->first();
        $package_type->name = $request->input('package-name');
        $package_type->save();
        return redirect()->route('adminpackagestypes');

    }



    public function delete(Request $request)
    {
        $totalpackagedeleted = PackageType::destroy($request->input('package-type-id'));

        if($totalpackagedeleted > 0)
        {
            return ['deleted' => true];
        }
        else
        {
            return ['deleted' => false];
        }
    }

    public function PackageTypeActivate(Request $request)
    {
        $packageTypeId = $request->input('packagetype-id');

        return ['status' => PackageType::packageTypeActivate($packageTypeId)];
    }



}