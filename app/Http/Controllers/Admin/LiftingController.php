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

    	$liftings = Lifting::select('tbl_liftings.*','tbl_vendors.name as vendorName')
    		->join('tbl_vendors','tbl_vendors.name','=','tbl_liftings.vendorId')
    		->orderBy('tbl_liftings.purchase_by','asc')
    		->orderBy('tbl_vendors.name','asc')
            ->get();

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
        // dd($product); die();

        if($request->ajax())
        {
            return response()->json([
                'product'=>$product
            ]);
        }
    }
}
