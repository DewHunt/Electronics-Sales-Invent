<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lifting;
use App\LiftingProduct;
use App\LiftingReturn;
use App\LiftingReturnProduct;
use App\VendorSetup;
use App\Product;

use DB;
use PDF;
use MPDF;

class LiftingReturnController extends Controller
{
    public function index()
    {
    	$title = "Lifting Returns";

    	$liftingReturns = LiftingReturn::select('tbl_lifting_returns.*','tbl_vendors.name as vendorName')
    		->leftJoin('tbl_vendors','tbl_vendors.id','=','tbl_lifting_returns.vendor_id')
    		->orderBy('tbl_lifting_returns.id','dsc')
            // ->orderBy('tbl_lifting_returns.purchase_by','asc')
    		// ->orderBy('tbl_vendors.name','asc')
            ->get();

    	return view('admin.liftingReturn.index')->with(compact('title','liftingReturns'));
    }

    public function add()
    {
    	$title = "Add Lifting Returns";
    	$formLink = "liftingReturn.save";
    	$buttonName = "Save";

    	$storeAndShowrooms = DB::table('view_store_and_showroom')->get();
    	$vendors = VendorSetup::orderBy('name','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	return view('admin.liftingReturn.add')->with(compact('title','formLink','buttonName','storeAndShowrooms','vendors','products'));
    }

    public function save(Request $request)
    {
    	// dd($request->all());
    	$storeOrShowrooms = explode(',',$request->storeOrShowroom);
    	$storeOrShowroomId = $storeOrShowrooms[0];
    	$storeOrShowroomType = $storeOrShowrooms[1];

    	$date = date('Y-m-d', strtotime($request->liftingReturnDate));

    	$liftingReturn = LiftingReturn::create([
    		'vendor_id' => $request->supplier,
    		'store_or_showroom_type' => $storeOrShowroomType,
    		'store_or_showroom_id' => $storeOrShowroomId,
    		'product_id' => $request->product,
    		'serial_no' => $request->serialNo,
    		'date' => $date,
    		'total_qty' => $request->totalQty,
    		'total_price' => $request->totalPrice,
    		'total_mrp_price' => $request->totalMrpPrice,
    		'total_haire_price' => $request->totalHigherPrice,
    		'remarks' => $request->remarks,
    	]);

        $countProduct = count($request->productId);

        if($request->productId)
        {
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++)
        	{ 
        		$postData[] = [
        			'lifting_return_id'=> $liftingReturn->id,
        			'lifting_id'=> $request->liftingId[$i],
                    'lifting_product_id' => $request->liftingProductId[$i],
        			'vendor_id' => $request->supplier,
                    'store_or_showroom_type' => $storeOrShowroomType,
        			'store_or_showroom_id' => $storeOrShowroomId,
        			'product_id' => $request->productId[$i],
        			'product_name' => $request->productName[$i],
        			'model_no' => $request->productModelNo[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i],
        			'price' => $request->productPrice[$i],
        			'mrp_price' => $request->productMrpPrice[$i],
        			'haire_price' => $request->productHigherPrice[$i],
        		];
        	}                
        	LiftingReturnProduct::insert($postData);
        }

        return redirect(route('liftingReturn.index'))->with('msg','Lifitng Return Added Successfully');
    }

    public function edit($liftingReturnId)
    {
    	$title = "Add Lifting Returns";
    	$formLink = "liftingReturn.update";
    	$buttonName = "Update";

    	$liftingReturn = LiftingReturn::where('id',$liftingReturnId)->first();
    	$liftingReturnProducts = LiftingReturnProduct::where('lifting_return_id',$liftingReturnId)->get();

    	$storeAndShowrooms = DB::table('view_store_and_showroom')->get();
    	$vendors = VendorSetup::orderBy('name','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	return view('admin.liftingReturn.edit')->with(compact('title','formLink','buttonName','storeAndShowrooms','vendors','products','liftingReturn','liftingReturnProducts'));
    }

    public function update(Request $request)
    {
    	// dd($request->all());
    	$storeOrShowrooms = explode(',',$request->storeOrShowroom);
    	$storeOrShowroomId = $storeOrShowrooms[0];
    	$storeOrShowroomType = $storeOrShowrooms[1];

    	$date = date('Y-m-d', strtotime($request->liftingReturnDate));

    	$liftingReturn = LiftingReturn::find($request->liftingReturnId);

    	$liftingReturn->update([
    		'vendor_id' => $request->supplier,
    		'store_or_showroom_type' => $storeOrShowroomType,
    		'store_or_showroom_id' => $storeOrShowroomId,
    		'product_id' => $request->product,
    		'serial_no' => $request->serialNo,
    		'date' => $date,
    		'total_qty' => $request->totalQty,
    		'total_price' => $request->totalPrice,
    		'total_mrp_price' => $request->totalMrpPrice,
    		'total_haire_price' => $request->totalHigherPrice,
    		'remarks' => $request->remarks,
    	]);

    	LiftingReturnProduct::where('lifting_return_id',$request->liftingReturnId)->delete();

        $countProduct = count($request->productId);

        if($request->productId)
        {
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++)
        	{ 
        		$postData[] = [
        			'lifting_return_id'=> $liftingReturn->id,
        			'lifting_id'=> $request->liftingId[$i],
                    'lifting_product_id' => $request->liftingProductId[$i],
        			'vendor_id' => $request->supplier,
                    'store_or_showroom_type' => $storeOrShowroomType,
        			'store_or_showroom_id' => $storeOrShowroomId,
        			'product_id' => $request->productId[$i],
        			'product_name' => $request->productName[$i],
        			'model_no' => $request->productModelNo[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i],
        			'price' => $request->productPrice[$i],
        			'mrp_price' => $request->productMrpPrice[$i],
        			'haire_price' => $request->productHigherPrice[$i],
        		];
        	}                
        	LiftingReturnProduct::insert($postData);
        }

        return redirect(route('liftingReturn.index'))->with('msg','Lifitng Return Updated Successfully');
    }

    public function liftingProductInfo(Request $request)
    {
    	$liftingProducts = LiftingProduct::select('tbl_lifting_products.*','tbl_products.name as productName')
    		->join('tbl_products','tbl_products.id','=','tbl_lifting_products.product_id')
    		->where('tbl_lifting_products.product_id',$request->productId)
    		->where('tbl_lifting_products.vendor_id',$request->vendorId)
    		->where('tbl_lifting_products.store_or_showroom_type',$request->storeOrShowroomType)
    		->where('tbl_lifting_products.store_or_showroom_id',$request->storeOrShowroomId)
    		->get();

        if($request->ajax())
        {
            return response()->json([
                'liftingProducts'=>$liftingProducts,
            ]);
        }
    }

    public function print($liftingReturnId)
    {
        $title = "Product Lifting Return Chalan";

        $liftingReturn = LiftingReturn::select('tbl_lifting_returns.*','tbl_vendors.name as vendorName')
            ->join('tbl_vendors','tbl_vendors.id','=','tbl_lifting_returns.vendor_id')
            ->where('tbl_lifting_returns.id',$liftingReturnId)
            ->first();
        $liftingReturnProducts = LiftingReturnProduct::select('tbl_lifting_return_products.*','tbl_products.code as productCode')
            ->join('tbl_products','tbl_products.id','=','tbl_lifting_return_products.product_id')
            ->where('tbl_lifting_return_products.lifting_return_id',$liftingReturnId)
            ->get();

        $pdf = PDF::loadView('admin.liftingReturn.print',['title'=>$title,'liftingReturn'=>$liftingReturn,'liftingReturnProducts'=>$liftingReturnProducts]);

        return $pdf->stream('product_lifting_return_chalan.pdf');
    }

    public function delete(Request $request)
    {
        LiftingReturn::where('id',$request->liftingReturnId)->delete();    	
        LiftingReturnProduct::where('lifting_return_id',$request->liftingReturnId)->delete();    	
    }
}
