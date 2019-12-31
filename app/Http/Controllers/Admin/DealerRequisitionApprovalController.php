<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerRequisition;
use App\DealerRequisitionProduct;

use DB;
use PDF;
use MPDF;

class DealerRequisitionApprovalController extends Controller
{
    public function index()
    {
    	$title = "All Pending Requisitions";
    	$formLink = "dealerRequisitionApproval.update";
    	$buttonName = "Save";

    	$dealerRequisitions = DealerRequisition::select('tbl_dealer_requisitions.*','tbl_dealers.name as dealerName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_requisitions.dealer_id')
    		->where('tbl_dealer_requisitions.status','1')
    		->orderBy('tbl_dealer_requisitions.date','dsc')
    		->get();

    	$approveDealerRequisitions = DealerRequisition::select('tbl_dealer_requisitions.*','tbl_dealers.name as dealerName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_requisitions.dealer_id')
    		->where('tbl_dealer_requisitions.status','0')
    		->orderBy('tbl_dealer_requisitions.date','dsc')
    		->get();

    	return view('admin.dealerRequisitionApproval.index')->with(compact('title','formLink','buttonName','dealerRequisitions','approveDealerRequisitions'));
    }

    public function update(Request $request)
    {
    	// dd($request->all());

    	$dealerRequisition = DealerRequisition::find($request->dealerRequisitionId);

        $dealerRequisition->update([         
            'approved_by' => $request->approveBy,          
            'total_approve_qty' => $request->totalApproveQty,          
            'total_approve_amount' => $request->totalApproveAmount,         
            'status' => 0,         
        ]);

        $countDealerRequisitionProduct = count($request->dealerRequisitionProductId);
        if($request->dealerRequisitionProductId){
        	for ($i=0; $i < $countDealerRequisitionProduct; $i++) {
		    	$dealerRequisitionProduct = DealerRequisitionProduct::where('id',$request->dealerRequisitionProductId[$i])->first();

		        $dealerRequisitionProduct->update([         
		            'approved_qty' => $request->approveQty[$i],          
		            'approved_amount' => $request->approveAmount[$i],         
		            'status' => 0,         
		        ]);
        	}
        }

        return redirect(route('dealerRequisitionApproval.index'))->with('msg','Dealer Requisition Approved Successfully');
    }

    public function dealerRequisitionInfo(Request $request)
    {
    	$dealerRequisition = DealerRequisition::select('tbl_dealer_requisitions.*','tbl_dealers.name as dealerName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_requisitions.dealer_id')
    		->where('tbl_dealer_requisitions.id',$request->dealerRequisitionId)
    		// ->where('tbl_dealer_requisitions.status','1')
    		->first();

    	$dealerRequisitionProducts = DealerRequisitionProduct::select('tbl_dealer_requisition_products.*','tbl_products.name as productName','tbl_products.model_no as modelNo')
    		->leftJoin('tbl_products','tbl_products.id','=','tbl_dealer_requisition_products.product_id')
    		->where('tbl_dealer_requisition_products.requisition_id',$request->dealerRequisitionId)
    		->get();

    	// dd($dealerRequisition);
    	
        if($request->ajax())
        {
            return response()->json([
                'dealerRequisition'=>$dealerRequisition,
                'dealerRequisitionProducts'=>$dealerRequisitionProducts
            ]);
        }
    }
}
