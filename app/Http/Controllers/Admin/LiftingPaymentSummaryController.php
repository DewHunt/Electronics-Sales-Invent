<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;

use DB;
use PDF;
use MPDF;

class LiftingPaymentSummaryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Lifting Record";
    	$searchFormLink = "liftingPaymentSummary.index";
    	$printFormLink = "liftingPaymentSummary.print";

    	$vendor = $request->vendor;
    	$year = $request->year;
    	$month = $request->month;
        $print = $request->print;

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        if ($year == "" || $month == "")
        {
            $liftingPaymentSummaries = array();
        }
        else
        {
            $previousliftingPaymentSummary = DB::table('view_lifting_payment_summary')
                ->select(DB::raw('0 as yearlyLifting'), DB::raw('0 as monthlyLifting'), DB::raw('0 as yearlyPayment'), DB::raw('0 as monthlyPayment'), DB::raw('SUM(view_lifting_payment_summary.lifting) as previousLifting'), DB::raw('SUM(view_lifting_payment_summary.payment) as previousPayment'), 'view_lifting_payment_summary.vendorId as vendorId', 'view_lifting_payment_summary.vendorName as vendorName')
                ->orWhere(function($query) use($year,$vendor){
                    if (@$year)
                    {
                        $query->whereYear('view_lifting_payment_summary.date','<',$year);
                    }

                    if (@$vendor)
                    {
                        $query->whereIn('view_lifting_payment_summary.vendorId',$vendor);
                    }
                })
                ->groupBy('view_lifting_payment_summary.vendorId','view_lifting_payment_summary.vendorName');

            $monthlyliftingPaymentSummaries = DB::table('view_lifting_payment_summary')
                ->select(DB::raw('0 as yearlyLifting'), DB::raw('SUM(view_lifting_payment_summary.lifting) as monthlyLifting'), DB::raw('0 as yearlyPayment'), DB::raw('SUM(view_lifting_payment_summary.payment) as monthlyPayment'), DB::raw('0 as previousPurchase'), DB::raw('0 as previousPayment'), 'view_lifting_payment_summary.vendorId as vendorId', 'view_lifting_payment_summary.vendorName as vendorName')
                ->orWhere(function($query) use($year,$month,$vendor){
                    if (@$year)
                    {
                        $query->whereYear('view_lifting_payment_summary.date', $year);
                    }

                    if (@$month)
                    {
                        $query->whereMonth('view_lifting_payment_summary.date', $month);
                    }

                    if (@$vendor)
                    {
                        $query->whereIn('view_lifting_payment_summary.vendorId',$vendor);
                    }
                })
                ->groupBy('view_lifting_payment_summary.vendorId','view_lifting_payment_summary.vendorName');

            $liftingPaymentSummaries = DB::table('view_lifting_payment_summary')
                ->select(DB::raw('SUM(view_lifting_payment_summary.lifting) as yearlyLifting'), DB::raw('0 as monthlyLifting'), DB::raw('SUM(view_lifting_payment_summary.payment) as yearlyPayment'), DB::raw('0 as monthlyPayment'), DB::raw('0 as previousLifting'), DB::raw('0 as previousPayment'), 'view_lifting_payment_summary.vendorId as vendorId', 'view_lifting_payment_summary.vendorName as vendorName')
                ->orWhere(function($query) use($year,$vendor){
                    if (@$year)
                    {
                        $query->whereYear('view_lifting_payment_summary.date', $year);
                    }

                    if (@$vendor)
                    {
                        $query->whereIn('view_lifting_payment_summary.vendorId',$vendor);
                    }
                })
                ->groupBy('view_lifting_payment_summary.vendorId','view_lifting_payment_summary.vendorName')
                ->unionAll($monthlyliftingPaymentSummaries)
                ->unionAll($previousliftingPaymentSummary)
                ->orderBy('vendorId')
                ->get();
        }

    	return view('admin.liftingPaymentSummary.index')->with(compact('title','searchFormLink','printFormLink','print','vendors','vendor','year','month','liftingPaymentSummaries'));
    }

    public function print(Request $request)
    {
        $title = "Lifting Record";

        $vendor = $request->vendor;
        $year = $request->year;
        $month = $request->month;

        if ($year == "" || $month == "")
        {
            $liftingPaymentSummaries = array();
        }
        else
        {
            $previousliftingPaymentSummary = DB::table('view_lifting_payment_summary')
                ->select(DB::raw('0 as yearlyLifting'), DB::raw('0 as monthlyLifting'), DB::raw('0 as yearlyPayment'), DB::raw('0 as monthlyPayment'), DB::raw('SUM(view_lifting_payment_summary.lifting) as previousLifting'), DB::raw('SUM(view_lifting_payment_summary.payment) as previousPayment'), 'view_lifting_payment_summary.vendorId as vendorId', 'view_lifting_payment_summary.vendorName as vendorName')
                ->orWhere(function($query) use($year,$vendor){
                    if (@$year)
                    {
                        $query->whereYear('view_lifting_payment_summary.date','<',$year);
                    }

                    if (@$vendor)
                    {
                        $query->whereIn('view_lifting_payment_summary.vendorId',$vendor);
                    }
                })
                ->groupBy('view_lifting_payment_summary.vendorId','view_lifting_payment_summary.vendorName');

            $monthlyliftingPaymentSummaries = DB::table('view_lifting_payment_summary')
                ->select(DB::raw('0 as yearlyLifting'), DB::raw('SUM(view_lifting_payment_summary.lifting) as monthlyLifting'), DB::raw('0 as yearlyPayment'), DB::raw('SUM(view_lifting_payment_summary.payment) as monthlyPayment'), DB::raw('0 as previousPurchase'), DB::raw('0 as previousPayment'), 'view_lifting_payment_summary.vendorId as vendorId', 'view_lifting_payment_summary.vendorName as vendorName')
                ->orWhere(function($query) use($year,$month,$vendor){
                    if (@$year)
                    {
                        $query->whereYear('view_lifting_payment_summary.date', $year);
                    }

                    if (@$month)
                    {
                        $query->whereMonth('view_lifting_payment_summary.date', $month);
                    }

                    if (@$vendor)
                    {
                        $query->whereIn('view_lifting_payment_summary.vendorId',$vendor);
                    }
                })
                ->groupBy('view_lifting_payment_summary.vendorId','view_lifting_payment_summary.vendorName');

            $liftingPaymentSummaries = DB::table('view_lifting_payment_summary')
                ->select(DB::raw('SUM(view_lifting_payment_summary.lifting) as yearlyLifting'), DB::raw('0 as monthlyLifting'), DB::raw('SUM(view_lifting_payment_summary.payment) as yearlyPayment'), DB::raw('0 as monthlyPayment'), DB::raw('0 as previousLifting'), DB::raw('0 as previousPayment'), 'view_lifting_payment_summary.vendorId as vendorId', 'view_lifting_payment_summary.vendorName as vendorName')
                ->orWhere(function($query) use($year,$vendor){
                    if (@$year)
                    {
                        $query->whereYear('view_lifting_payment_summary.date', $year);
                    }

                    if (@$vendor)
                    {
                        $query->whereIn('view_lifting_payment_summary.vendorId',$vendor);
                    }
                })
                ->groupBy('view_lifting_payment_summary.vendorId','view_lifting_payment_summary.vendorName')
                ->unionAll($monthlyliftingPaymentSummaries)
                ->unionAll($previousliftingPaymentSummary)
                ->orderBy('vendorId')
                ->get();
        }

        $pdf = PDF::loadView('admin.liftingPaymentSummary.print',['title'=>$title,'year'=>$year,'month'=>$month,'liftingPaymentSummaries'=>$liftingPaymentSummaries]);

        return $pdf->stream('lifting_payment_summary_'.$year.'_to_'.$month.'.pdf');
    }
}
