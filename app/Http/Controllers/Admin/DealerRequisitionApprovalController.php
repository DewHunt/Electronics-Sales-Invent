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
    	$formLink = "dealerRequisitionApproval.save";
    	$buttonName = "Save";

    	$dealerRequisitions = DealerRequisition::select('tbl_dealer_requisitions.*','tbl_dealers.name as dealerName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_requisitions.dealer_id')
    		->where('tbl_dealer_requisitions.status','1')
    		->orderBy('tbl_dealer_requisitions.date','dsc')
    		->get();

    	return view('admin.dealerRequisitionApproval.index')->with(compact('title','formLink','buttonName','dealerRequisitions'));
    }

    public function save(Request $request)
    {
    	dd($request->all());
    }

    public function dealerRequisitionInfo(Request $request)
    {
    	$dealerRequisition = DealerRequisition::select('tbl_dealer_requisitions.*','tbl_dealers.name as dealerName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_requisitions.dealer_id')
    		->where('tbl_dealer_requisitions.id',$request->dealerRequisitionId)
    		->where('tbl_dealer_requisitions.status','1')
    		->first();

    	$dealerRequisitionProducts = DealerRequisitionProduct::select('tbl_dealer_requisition_products.*','tbl_products.name as productName','tbl_products.model_no as modelNo')
    		->leftJoin('tbl_products','tbl_products.id','=','tbl_dealer_requisition_products.product_id')
    		->where('tbl_dealer_requisition_products.requisition_id',$request->dealerRequisitionId)
    		->get();
    	
        if($request->ajax())
        {
            return response()->json([
                'dealerRequisition'=>$dealerRequisition,
                'dealerRequisitionProducts'=>$dealerRequisitionProducts
            ]);
        }
    }
}
