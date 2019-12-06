<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;

use DB;
use PDF;
use MPDF;

class VendorStatementController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Vendor Statement";
    	$searchFormLink = "vendorStatement.index";
    	$printFormLink = "vendorStatement.print";

    	$vendor = $request->vendor;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $previousBalances = array();
        $vendorStatements = array();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        $previousBalances = DB::table('view_vendor_statement_report')
            ->select(DB::raw('SUM(view_vendor_statement_report.lifting) as lifting'), DB::raw('SUM(view_vendor_statement_report.payment) as payment'), DB::raw('SUM(view_vendor_statement_report.others) as others'))
            ->orWhere(function($query) use($lastDate,$vendor){
                if (!empty($lastDate))
                {
                    $query->where('view_vendor_statement_report.date','<=', $lastDate);
                }

                if ($vendor)
                {
                    $query->whereIn('view_vendor_statement_report.vendorId',$vendor);
                }
            })
            ->first();

        $vendorStatements = DB::table('view_vendor_statement_report')
            ->select('view_vendor_statement_report.date as date', DB::raw('SUM(view_vendor_statement_report.lifting) as lifting'), DB::raw('SUM(view_vendor_statement_report.payment) as payment'), DB::raw('SUM(view_vendor_statement_report.others) as others'),'tbl_vendors.name as vendorName')
            ->join('tbl_vendors','tbl_vendors.id','=','view_vendor_statement_report.vendorId')
            ->orWhere(function($query) use($fromDate,$toDate,$vendor){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_vendor_statement_report.date', array($fromDate,$toDate));
                }

                if ($vendor)
                {
                    $query->whereIn('view_vendor_statement_report.vendorId',$vendor);
                }
            })
            ->groupBy('view_vendor_statement_report.date','tbl_vendors.name')
            ->get();

    	return view('admin.vendorStatement.index')->with(compact('title','searchFormLink','printFormLink','print','vendors','vendor','fromDate','toDate','previousBalances','vendorStatements'));
    }

    public function print(Request $request)
    {
        $title = "Print Vendor Statement";

        $vendor = $request->vendor;
        $fromDate = date('Y-m-d',strtotime($request->fromDate));
        $toDate = date('Y-m-d',strtotime($request->toDate));

        $previousBalances = array();
        $vendorStatements = array();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        $previousBalances = DB::table('view_vendor_statement_report')
            ->select(DB::raw('SUM(view_vendor_statement_report.lifting) as lifting'), DB::raw('SUM(view_vendor_statement_report.payment) as payment'), DB::raw('SUM(view_vendor_statement_report.others) as others'))
            ->orWhere(function($query) use($lastDate,$vendor){
                if (!empty($lastDate))
                {
                    $query->where('view_vendor_statement_report.date','<=', $lastDate);
                }

                if ($vendor)
                {
                    $query->whereIn('view_vendor_statement_report.vendorId',$vendor);
                }
            })
            ->first();

        $vendorStatements = DB::table('view_vendor_statement_report')
            ->select('view_vendor_statement_report.date as date', DB::raw('SUM(view_vendor_statement_report.lifting) as lifting'), DB::raw('SUM(view_vendor_statement_report.payment) as payment'), DB::raw('SUM(view_vendor_statement_report.others) as others'),'tbl_vendors.name as vendorName')
            ->join('tbl_vendors','tbl_vendors.id','=','view_vendor_statement_report.vendorId')
            ->orWhere(function($query) use($fromDate,$toDate,$vendor){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_vendor_statement_report.date', array($fromDate,$toDate));
                }

                if ($vendor)
                {
                    $query->whereIn('view_vendor_statement_report.vendorId',$vendor);
                }
            })
            ->groupBy('view_vendor_statement_report.date','tbl_vendors.name')
            ->get();

        $pdf = PDF::loadView('admin.vendorStatement.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'previousBalances'=>$previousBalances,'vendorStatements'=>$vendorStatements]);

        return $pdf->stream('vendor_statement_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
