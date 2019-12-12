<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CustomerRegistrationSetup;

use DB;
use PDF;
use MPDF;

class CustomerStatementController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Customer Statement";
    	$searchFormLink = "customerStatement.index";
    	$printFormLink = "customerStatement.print";

    	$customer = $request->customer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$customers = CustomerRegistrationSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $previousBalances = array();
        $customerStatements = array();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        $previousBalances = DB::table('view_customer_statement')
            ->select(DB::raw('SUM(view_customer_statement.salesAmount) as salesAmount'), DB::raw('SUM(view_customer_statement.collection) as collection'))
            ->orWhere(function($query) use($lastDate,$customer){
                if (!empty($lastDate))
                {
                    $query->where('view_customer_statement.date','<=', $lastDate);
                }

                if ($customer)
                {
                    $query->whereIn('view_customer_statement.customerId',$customer);
                }
            })
            ->first();

        $customerStatements = DB::table('view_customer_statement')
            ->select('view_customer_statement.date as date', 'view_customer_statement.customerName as customerName', DB::raw('SUM(view_customer_statement.salesAmount) as salesAmount'), DB::raw('SUM(view_customer_statement.collection) as collection'))
            ->orWhere(function($query) use($fromDate,$toDate,$customer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_customer_statement.date', array($fromDate,$toDate));
                }

                if ($customer)
                {
                    $query->whereIn('view_customer_statement.customerId',$customer);
                }
            })
            ->groupBy('view_customer_statement.customerId','view_customer_statement.invoiceNo')
            ->get();

    	return view('admin.customerStatement.index')->with(compact('title','searchFormLink','printFormLink','print','customers','customer','fromDate','toDate','previousBalances','customerStatements'));
    }
}
