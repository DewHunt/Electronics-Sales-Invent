<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CustomerRegistrationSetup;

use DB;
use PDF;
use MPDF;

class CustomerOutstandingController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Customer Outstanding";
    	$searchFormLink = "customerOutstanding.index";
    	$printFormLink = "customerOutstanding.print";

    	$customer = $request->customer;

    	$customers = CustomerRegistrationSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	if ($customer)
    	{
	    	$customerOutstandings = DB::table('view_customer_outstanding')
	    		->select('view_customer_outstanding.*')
	    		->whereIn('customerId',$customer)
	    		->where('balance','>','0')
	    		->whereNull('balance')
	    		->orderBy('customerName')
	    		->get();
    	}
    	else
    	{
	    	$customerOutstandings = DB::table('view_customer_outstanding')
	    		->select('view_customer_outstanding.*')
	    		->where('balance','>','0')
	    		->orWhereNull('balance')
	    		->orderBy('customerName')
	    		->get();
    	}

    	return view('admin.customerOutstanding.index')->with(compact('title','searchFormLink','printFormLink','customers','customer','customerOutstandings'));
    }

    public function print(Request $request)
    {
    	$title = "Print Customer Outstanding";

    	$customer = $request->customer;

    	if ($customer)
    	{
	    	$customerOutstandings = DB::table('view_customer_outstanding')
	    		->select('view_customer_outstanding.*')
	    		->whereIn('customerId',$customer)
	    		->where('balance','>','0')
	    		->whereNull('balance')
	    		->orderBy('customerName')
	    		->get();
    	}
    	else
    	{
	    	$customerOutstandings = DB::table('view_customer_outstanding')
	    		->select('view_customer_outstanding.*')
	    		->where('balance','>','0')
	    		->orWhereNull('balance')
	    		->orderBy('customerName')
	    		->get();
    	}

        $pdf = PDF::loadView('admin.customerOutstanding.print',['title'=>$title,'customerOutstandings'=>$customerOutstandings]);

        return $pdf->stream('customer_outstandings.pdf');
    }
}
