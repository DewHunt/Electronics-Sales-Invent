<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\DealerRequisition;
use App\DealerRequisitionProduct;
use App\Product;

class ProductIssueController extends Controller
{
	public function index()
	{
		$title = "Product Issue";

    	return view('admin.productIssue.index')->with(compact('title'));
	}

	public function add()
	{
    	$title = "Add Dealer Requisation";
    	$formLink = "productIssue.save";
    	$buttonName = "Save";

    	$dealers = DealerSetup::where('status','1')->orderBy('name','asc')->get();
    	$dealerRequisitions = DealerRequisition::where('status','0')->get();
    	$products = product::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.productIssue.add')->with(compact('title','formLink','buttonName','dealers','dealerRequisitions','products'));
	}

    public function productInfo(Request $request)
    {
    	$product = Product::where('id',$request->productId)->first();
    	
        if($request->ajax())
        {
            return response()->json([
                'product'=>$product
            ]);
        }
    }

    public function dealerRequisitionInfo(Request $request)
    {
    	$dealerRequisition = DealerRequisition::where('id',$request->dealerRequisitionId)->first();
    	$dealerRequisitionProducts = DealerRequisitionProduct::where('requisition_id',$request->dealerRequisitionId)->get();
    	$dealer = DealerSetup::where('id',$dealerRequisition->dealer_id)->first();

    	// dd($dealer);
    	
        if($request->ajax())
        {
            return response()->json([
                'dealerRequisition'=>$dealerRequisition,
                'dealer'=>$dealer,
                'dealerRequisitionProducts'=>$dealerRequisitionProducts
            ]);
        }
    }
}
