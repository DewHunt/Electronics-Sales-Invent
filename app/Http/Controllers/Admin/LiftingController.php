<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;
use App\Product;
use App\Lifting;
use App\LiftingProduct;

class LiftingController extends Controller
{
    public function index()
    {
    	$title = "Product Lifting";

    	// $liftings = Lifting::select('lifting.*','vandors.name as vendorName')
    	// 	->join('vendors','vendors.name','=','lifting.vendorId');
    	// 	->orderBy('lifting.purchase_by','asc')->get();
    	// 	->orderBy('vendors.name','asc')->get();

    	return view('admin.lifting.index')->with(compact('title'));
    }

    public function addLifting()
    {
    	$title = "Add Product Lifting";
    	$formLink = "lifting.save";
    	$buttonName = "Save";

    	$vendors = VendorSetup::orderBy('name','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	return view('admin.lifting.add')->with(compact('title','formLink','buttonName','vendors','products'));
    }

    public function saveVendor(Request $request)
    {
    	echo "Yahoo!!! It's Worked";
        // $this->validation($request);

        // VendorSetup::create( [
        // 	'code' => $request->code,
        //     'name' => $request->vendorName,
        //     'contact_person' => $request->contactPerson,
        //     'contact' => $request->contact,           
        //     'email' => $request->email,
        //     'address' => $request->address,          
        // ]);

        // return redirect(route('vendorSetup.index'))->with('msg','Vendor Added Successfully');
    }

    public function liftingProductInfo(Request $request)
    {
    	// echo $request->productId; die();
    	$product = Product::where('id',$request->productId)->first();

        if($request->ajax())
        {
            return response()->json([
                'product'=>$product
            ]);
        }
    }
}
