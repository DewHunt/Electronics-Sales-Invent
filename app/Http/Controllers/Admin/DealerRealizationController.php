<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;

use DB;
use MPDF;
use PDF;

class DealerRealizationController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Dealer Realization";
    	$searchFormLink = "dealerRealization.index";
    	$printFormLink = "dealerRealization.print";

    	$dealer = $request->dealer;
    	$month = $request->month;
    	$year = $request->year;
        $print = $request->print;

    	$dealers = DealerSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        if ($year == "" || $month == "")
        {
            $realizations = array();
        }
        else
        {
	        $previousYearRealizations = DB::table('view_dealer_statement')
	            ->select('date','dealerId','dealerName', DB::raw('0 as yearlySales'), DB::raw('0 as yearlyCollection'), DB::raw('0 as monthlySales'), DB::raw('0 as monthlyCollection'), DB::raw('(SUM(issueAmount) - (SUM(collectionAmount) + SUM(issueReturnAmount))) as previousYearBalance'))
	            ->orWhere(function($query) use($year,$dealer){
	                if (@$year)
	                {
	                    $query->whereYear('date','<',$year);
	                }

	                if (@$dealer)
	                {
	                    $query->whereIn('dealerId',$dealer);
	                }
	            })
	            ->groupBy('dealerId');

	        $monthlyRealizations = DB::table('view_dealer_statement')
	            ->select('date','dealerId','dealerName', DB::raw('0 as yearlySales'), DB::raw('0 as yearlyCollection'), DB::raw('SUM(issueAmount) as monthlySales'), DB::raw('(SUM(collectionAmount) + SUM(issueReturnAmount)) as monthlyCollection'), DB::raw('0 as previousYearBalance'))
	            ->orWhere(function($query) use($year,$month,$dealer){
	                if (!empty($year))
	                {
	                    $query->whereYear('date',$year);
	                }

	                if (@$month)
	                {
	                    $query->whereMonth('date',$month);
	                }

	                if (@$dealer)
	                {
	                    $query->whereIn('dealerId',$dealer);
	                }
	            })
	            ->groupBy('dealerId');

	        $realizations = DB::table('view_dealer_statement')
	            ->select('date','dealerId','dealerName', DB::raw('SUM(issueAmount) as yearlySales'), DB::raw('(SUM(collectionAmount) + SUM(issueReturnAmount)) as yearlyCollection'), DB::raw('0 as monthlySales'), DB::raw('0 as monthlyCollection'),DB::raw('0 as previousYearBalance'))
	            ->orWhere(function($query) use($year,$dealer){
	                if (@$year)
	                {
	                    $query->whereYear('date', $year);
	                }

	                if (@$dealer)
	                {
	                    $query->whereIn('dealerId',$dealer);
	                }
	            })
	            ->groupBy('dealerId')
	            ->unionAll($monthlyRealizations)
	            ->unionAll($previousYearRealizations)
	            ->orderBy('dealerName')
	            ->get();
        }

    	return view('admin.dealerRealization.index')->with(compact('title','searchFormLink','printFormLink','print','dealers','dealer','month','year','realizations'));
    }

    public function print(Request $request)
    {
    	$title = "Dealer Realization";

    	$dealer = $request->dealer;
    	$month = $request->month;
    	$year = $request->year;

	    $previousYearRealizations = DB::table('view_dealer_statement')
	        ->select('date','dealerId','dealerName', DB::raw('0 as yearlySales'), DB::raw('0 as yearlyCollection'), DB::raw('0 as monthlySales'), DB::raw('0 as monthlyCollection'), DB::raw('(SUM(issueAmount) - (SUM(collectionAmount) + SUM(issueReturnAmount))) as previousYearBalance'))
	        ->orWhere(function($query) use($year,$dealer){
	            if (@$year)
	            {
	                $query->whereYear('date','<',$year);
	            }

	            if (@$dealer)
	            {
	                $query->whereIn('dealerId',$dealer);
	            }
	        })
	        ->groupBy('dealerId');

	    $monthlyRealizations = DB::table('view_dealer_statement')
	        ->select('date','dealerId','dealerName', DB::raw('0 as yearlySales'), DB::raw('0 as yearlyCollection'), DB::raw('SUM(issueAmount) as monthlySales'), DB::raw('(SUM(collectionAmount) + SUM(issueReturnAmount)) as monthlyCollection'), DB::raw('0 as previousYearBalance'))
	        ->orWhere(function($query) use($year,$month,$dealer){
	            if (!empty($year))
	            {
	                $query->whereYear('date',$year);
	            }

	            if (@$month)
	            {
	                $query->whereMonth('date',$month);
	            }

	            if (@$dealer)
	            {
	                $query->whereIn('dealerId',$dealer);
	            }
	        })
	        ->groupBy('dealerId');

	    $realizations = DB::table('view_dealer_statement')
	        ->select('date','dealerId','dealerName', DB::raw('SUM(issueAmount) as yearlySales'), DB::raw('(SUM(collectionAmount) + SUM(issueReturnAmount)) as yearlyCollection'), DB::raw('0 as monthlySales'), DB::raw('0 as monthlyCollection'),DB::raw('0 as previousYearBalance'))
	        ->orWhere(function($query) use($year,$dealer){
	            if (@$year)
	            {
	                $query->whereYear('date', $year);
	            }

	            if (@$dealer)
	            {
	                $query->whereIn('dealerId',$dealer);
	            }
	        })
	        ->groupBy('dealerId')
	        ->unionAll($monthlyRealizations)
	        ->unionAll($previousYearRealizations)
	        ->orderBy('dealerName')
	        ->get();

        $pdf = PDF::loadView('admin.dealerRealization.print',['title'=>$title,'year'=>$year,'month'=>$month,'realizations'=>$realizations]);

        return $pdf->stream('dealer_realization_'.$month.'_of_'.$year.'.pdf');
    }
}
