<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;
use App\PaymentToCompany;

use DB;
use PDF;
use MPDF;

class PaymentRecordController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Payment Record";
    	$searchFormLink = "paymentRecord.index";
    	$printFormLink = "paymentRecord.print";

    	$vendor = $request->vendor;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	$productRecords = PaymentToCompany::select('tbl_payment_to_company.payment_date as paymentDate','tbl_payment_to_company.payment_now as price','tbl_vendors.name as vendorName')
    		->join('tbl_vendors','tbl_vendors.id','=','tbl_payment_to_company.vendor_id')
    		->orWhere(function($query) use($fromDate,$toDate,$vendor){
    			if (!empty($fromDate))
    			{
    				$query->whereBetween('tbl_payment_to_company.payment_date',array($fromDate,$toDate));
    			}

    			if($vendor)
    			{
    				$query->whereIn('tbl_payment_to_company.vendor_id',$vendor);
    			}
    		})
    		->orderBy('tbl_payment_to_company.payment_date','asc')
    		->orderBy('tbl_vendors.name','asc')
    		->get();

    	return view('admin.paymentRecord.index')->with(compact('title','searchFormLink','printFormLink','vendors','vendor','fromDate','toDate','print','productRecords'));
    }

    public function print(Request $request)
    {
    	$title = "Payment Record";

    	$vendor = $request->vendor;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

    	$productRecords = PaymentToCompany::select('tbl_payment_to_company.payment_date as paymentDate','tbl_payment_to_company.payment_now as price','tbl_vendors.name as vendorName')
    		->join('tbl_vendors','tbl_vendors.id','=','tbl_payment_to_company.vendor_id')
    		->orWhere(function($query) use($fromDate,$toDate,$vendor){
    			if (!empty($fromDate))
    			{
    				$query->whereBetween('tbl_payment_to_company.payment_date',array($fromDate,$toDate));
    			}

    			if($vendor)
    			{
    				$query->whereIn('tbl_payment_to_company.vendor_id',$vendor);
    			}
    		})
    		->orderBy('tbl_payment_to_company.payment_date','asc')
    		->orderBy('tbl_vendors.name','asc')
    		->get();


        $pdf = PDF::loadView('admin.paymentRecord.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'productRecords'=>$productRecords]);
        return $pdf->stream('product_record.pdf');
    }
}
