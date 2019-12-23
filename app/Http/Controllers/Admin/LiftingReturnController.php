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
    	$host = explode(',',$request->host);
    	$hostId = $host[0];
    	$hostType = $host[1];

    	$destination = explode(',',$request->destination);
    	$destinationId = $destination[0];
    	$destinationType = $destination[1];

    	$date = date('Y-m-d', strtotime($request->transferDate));

    	$transfer = Transfer::create([
    		'vendor_id' => $request->supplier,
    		'product_id' => $request->product,
    		'transfer_no' => $request->transferNo,
    		'date' => $date,
    		'host_type' => $hostType,
    		'host_id' => $hostId,
    		'destination_type' => $destinationType,
    		'destination_id' => $destinationId,
    		'total_qty' => $request->totalQty
    	]);

        $countProduct = count($request->productId);

        if($request->productId)
        {
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++)
        	{ 
        		$postData[] = [
        			'transfer_id'=> $transfer->id,
                    'vendor_id' => $request->supplier,
                    'lifting_product_id' => $request->liftingProductId[$i],
        			'product_id' => $request->productId[$i],
                    'name' => $request->productName[$i],
        			'model_no' => $request->productModelNo[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i]
        		];
        	}                
        	TransferProduct::insert($postData);
        }

        return redirect(route('liftingReturn.index'))->with('msg','Lifitng Return Added Successfully');
    }
}
