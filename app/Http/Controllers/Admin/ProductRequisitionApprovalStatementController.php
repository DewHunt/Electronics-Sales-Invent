<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\DealerRequisition;

use DB;
use MPDF;
use PDF;

class ProductRequisitionApprovalStatementController extends Controller
{
    public function index(Request $request)
    {
    	// dd($request->all());
    	$title = "Requisition And Approval Statement";
    	$searchFormLink = "productRequisitionApprovalStatement.index";
    	$printFormLink = "productRequisitionApprovalStatement.print";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$dealers = DealerSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $requisitionApprovalStatements = array();

        $requisitionApprovalStatements = DB::table('view_product_requisition_approval_statement')
            ->select('view_product_requisition_approval_statement.date as date', 'view_product_requisition_approval_statement.dealerId as dealerId', 'view_product_requisition_approval_statement.dealerName as dealerName', 'view_product_requisition_approval_statement.productName as productName', 'view_product_requisition_approval_statement.productModelNo as productModelNo', 'view_product_requisition_approval_statement.requisitionQty as requisitionQty', 'view_product_requisition_approval_statement.approvedQty as approvedQty')
            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_product_requisition_approval_statement.date', array($fromDate,$toDate));
                }

                if ($dealer)
                {
                    $query->whereIn('view_product_requisition_approval_statement.dealerId',$dealer);
                }
            })
            ->orderBy('view_product_requisition_approval_statement.dealerName','asc')
            ->orderBy('view_product_requisition_approval_statement.productName','asc')
            ->get();

    	return view('admin.productRequisitionApprovalStatement.index')->with(compact('title','searchFormLink','printFormLink','print','dealers','dealer','fromDate','toDate','requisitionApprovalStatements'));
    }

    public function print(Request $request)
    {
    	$title = "Print Requisition And Approval Statement";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $requisitionApprovalStatements = array();

        $requisitionApprovalStatements = DB::table('view_product_requisition_approval_statement')
            ->select('view_product_requisition_approval_statement.date as date', 'view_product_requisition_approval_statement.dealerId as dealerId', 'view_product_requisition_approval_statement.dealerName as dealerName', 'view_product_requisition_approval_statement.productName as productName', 'view_product_requisition_approval_statement.productModelNo as productModelNo', 'view_product_requisition_approval_statement.requisitionQty as requisitionQty', 'view_product_requisition_approval_statement.approvedQty as approvedQty')
            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_product_requisition_approval_statement.date', array($fromDate,$toDate));
                }

                if ($dealer)
                {
                    $query->whereIn('view_product_requisition_approval_statement.dealerId',$dealer);
                }
            })
            ->orderBy('view_product_requisition_approval_statement.dealerName','asc')
            ->orderBy('view_product_requisition_approval_statement.productName','asc')
            ->get();

        $pdf = PDF::loadView('admin.productRequisitionApprovalStatement.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'requisitionApprovalStatements'=>$requisitionApprovalStatements]);

        return $pdf->stream('product_requisition_approval_statement_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
