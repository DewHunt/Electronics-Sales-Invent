<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;

use DB;
use MPDF;
use PDF;

class DealerCommissionStatementController extends Controller
{
    public function index(Request $request)
    {
    	// dd($request->all());
    	$title = "Dealer Commission Report";
    	$searchFormLink = "dealerCommissionStatement.index";
    	$printFormLink = "dealerCommissionStatement.print";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;
        $btnSummary = $request->btnSummary;
        $btnRecord = $request->btnRecord;

    	$dealers = DealerSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        if ($request->btnSummary == "Summary")
        {
	        $dealerCommissionSummaries = DB::table('view_dealer_commission_statement')
	            ->select('view_dealer_commission_statement.date as date', 'view_dealer_commission_statement.dealerId as dealerId', 'view_dealer_commission_statement.dealerName as dealerName', DB::raw('SUM(view_dealer_commission_statement.commissionAmount) as totalCommissionAmount'))
	            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
	                if (!empty($fromDate))
	                {
	                    $query->whereBetween('view_dealer_commission_statement.date', array($fromDate,$toDate));
	                }

	                if ($dealer)
	                {
	                    $query->whereIn('view_dealer_commission_statement.dealerId',$dealer);
	                }
	            })
	            ->groupBy('view_dealer_commission_statement.dealerId')
	            ->get();
        }
        else
        {
            $dealerCommissionSummaries = "";
        }

        if ($request->btnRecord == "Record")
        {
	        $dealerCommissionStatements = DB::table('view_dealer_commission_statement')
	            ->select('view_dealer_commission_statement.date as date', 'view_dealer_commission_statement.dealerId as dealerId', 'view_dealer_commission_statement.dealerName as dealerName', 'view_dealer_commission_statement.categoryName as categoryName', 'view_dealer_commission_statement.saleAmount as saleAmount', 'view_dealer_commission_statement.commissionRate as commissionRate', 'view_dealer_commission_statement.commissionAmount as commissionAmount')
	            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
	                if (!empty($fromDate))
	                {
	                    $query->whereBetween('view_dealer_commission_statement.date', array($fromDate,$toDate));
	                }

	                if ($dealer)
	                {
	                    $query->whereIn('view_dealer_commission_statement.dealerId',$dealer);
	                }
	            })
	            ->get();
        }
        else
        {
            $dealerCommissionStatements = "";
        }

    	return view('admin.dealerCommissionStatement.index')->with(compact('title','searchFormLink','printFormLink','print','btnSummary','btnRecord','dealers','dealer','fromDate','toDate','dealerCommissionStatements','dealerCommissionSummaries'));
    }

    public function print(Request $request)
    {
    	$title = "Print Dealers Commission Report";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $btnPrintSummary = $request->btnPrintSummary;
        $btnPrintRecord = $request->btnPrintRecord;

        if ($request->btnPrintSummary == "Print Summary")
        {
	        $dealerCommissionSummaries = DB::table('view_dealer_commission_statement')
	            ->select('view_dealer_commission_statement.date as date', 'view_dealer_commission_statement.dealerId as dealerId', 'view_dealer_commission_statement.dealerName as dealerName', 'tbl_dealers.mobile as dealerPhone', 'tbl_dealers.address as dealerAddress', DB::raw('SUM(view_dealer_commission_statement.commissionAmount) as totalCommissionAmount'))	            
	            ->leftJoin('tbl_dealers','tbl_dealers.id','=','view_dealer_commission_statement.dealerId')
	            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
	                if (!empty($fromDate))
	                {
	                    $query->whereBetween('view_dealer_commission_statement.date', array($fromDate,$toDate));
	                }

	                if ($dealer)
	                {
	                    $query->whereIn('view_dealer_commission_statement.dealerId',$dealer);
	                }
	            })
	            ->groupBy('view_dealer_commission_statement.dealerId')
	            ->get();
        }
        else
        {
            $dealerCommissionSummaries = "";
        }

        if ($request->btnPrintRecord == "Print Record")
        {
	        $dealerCommissionStatements = DB::table('view_dealer_commission_statement')
	            ->select('view_dealer_commission_statement.date as date', 'view_dealer_commission_statement.dealerId as dealerId', 'view_dealer_commission_statement.dealerName as dealerName', 'tbl_dealers.mobile as dealerPhone', 'tbl_dealers.address as dealerAddress', 'view_dealer_commission_statement.categoryName as categoryName', 'view_dealer_commission_statement.saleAmount as saleAmount', 'view_dealer_commission_statement.commissionRate as commissionRate', 'view_dealer_commission_statement.commissionAmount as commissionAmount')
	            ->leftJoin('tbl_dealers','tbl_dealers.id','=','view_dealer_commission_statement.dealerId')
	            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
	                if (!empty($fromDate))
	                {
	                    $query->whereBetween('view_dealer_commission_statement.date', array($fromDate,$toDate));
	                }

	                if ($dealer)
	                {
	                    $query->whereIn('view_dealer_commission_statement.dealerId',$dealer);
	                }
	            })
	            ->get();
        }
        else
        {
            $dealerCommissionStatements = "";
        }

        $pdf = PDF::loadView('admin.dealerCommissionStatement.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'btnPrintSummary'=>$btnPrintSummary,'btnPrintRecord'=>$btnPrintRecord,'dealerCommissionSummaries'=>$dealerCommissionSummaries,'dealerCommissionStatements'=>$dealerCommissionStatements]);

        return $pdf->stream('dealer_commission_statement_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
