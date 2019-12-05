<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;

class VendorStatementController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Vendor Statement";
    	$searchFormLink = "vendorStatement.index";
    	$printFormLink = "vendorStatement.print";

    	$vendor = $request->vendor;
    	$formDate = date('Y-m-d',strtotime($request->formDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	return view('admin.vendorStatement.index')->with(compact('title','searchFormLink','printFormLink','vendors','vendor','formDate','toDate'));
    }
}
