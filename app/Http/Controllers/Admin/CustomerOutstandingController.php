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
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$customers = CustomerRegistrationSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	return view('admin.customerOutstanding.index')->with(compact('title','searchFormLink','printFormLink','customers','customer','fromDate','toDate','print'));
    }
}
