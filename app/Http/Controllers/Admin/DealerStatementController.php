<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;

use DB;
use MPDF;
use PDF;

class DealerStatementController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Dealer Statement";
    	$searchFormLink = "dealerStatement.index";
    	$printFormLink = "dealerStatement.print";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

    	$dealers = DealerSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();


        $previousBalance = DB::table('view_dealer_statement')
            ->select(DB::raw('(SUM(issueAmount) - (SUM(collectionAmount) + SUM(issueReturnAmount))) as previousBalance'))
            ->orWhere(function($query) use($lastDate,$dealer){
                if (!empty($lastDate))
                {
                    $query->where('date','<=', $lastDate);
                }

                if (@$dealer)
                {
                    $query->whereIn('dealerId',$dealer);
                }
            })
            ->first();

        $dealerStatements = DB::table('view_dealer_statement')
            ->select('date','dealerId','dealerName', DB::raw('SUM(issueAmount) as sales'), DB::raw('(SUM(collectionAmount) + SUM(issueReturnAmount)) as collection'))
            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_dealer_statement.date', array($fromDate,$toDate));
                }

                if (@$dealer)
                {
                    $query->whereIn('dealerId',$dealer);
                }
            })
            ->groupBy('dealerName','date')
            ->orderBy('dealerName')
            ->get();

    	return view('admin.dealerStatement.index')->with(compact('title','searchFormLink','printFormLink','print','dealers','dealer','fromDate','toDate','previousBalance','dealerStatements'));
    }

    public function print(Request $request)
    {
    	$title = "Print Dealer Statement";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));


        $previousBalance = DB::table('view_dealer_statement')
            ->select(DB::raw('(SUM(issueAmount) - (SUM(collectionAmount) + SUM(issueReturnAmount))) as previousBalance'))
            ->orWhere(function($query) use($lastDate,$dealer){
                if (!empty($lastDate))
                {
                    $query->where('date','<=', $lastDate);
                }

                if (@$dealer)
                {
                    $query->whereIn('dealerId',$dealer);
                }
            })
            ->first();

        $dealerStatements = DB::table('view_dealer_statement')
            ->select('date','dealerId','dealerName', DB::raw('SUM(issueAmount) as sales'), DB::raw('(SUM(collectionAmount) + SUM(issueReturnAmount)) as collection'))
            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_dealer_statement.date', array($fromDate,$toDate));
                }

                if (@$dealer)
                {
                    $query->whereIn('dealerId',$dealer);
                }
            })
            ->groupBy('dealerName','date')
            ->orderBy('dealerName')
            ->get();

        $pdf = PDF::loadView('admin.dealerStatement.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'previousBalance'=>$previousBalance,'dealerStatements'=>$dealerStatements]);

        return $pdf->stream('dealer_statement_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
