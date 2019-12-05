<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;
use App\PaymentToCompany;
use App\Lifting;

class PaymentToCompanyController extends Controller
{
    public function index()
    {
    	$title = "Payment To Company";

    	$paymentToCompany = PaymentToCompany::select('tbl_payment_to_company.*','tbl_vendors.name as vendorName')
    		->join('tbl_vendors','tbl_vendors.id','=','tbl_payment_to_company.vendor_id')
    		->orderBy('tbl_vendors.name','asc')
    		->orderBY('tbl_payment_to_company.payment_date','asc')
    		->get();

    	return view('admin.paymentToCompany.index')->with(compact('title','paymentToCompany'));
    }

    public function addPaymentToCompany()
    {
    	$title = "Add Payment To Company";
    	$formLink = "paymentToCompany.save";
    	$buttonName = "Save";

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	return view('admin.paymentToCompany.add')->with(compact('title','formLink','buttonName','vendors'));
    }

    public function savePaymentToCompany(Request $request)
    {
    	// dd($request->all());

        $paymentDate = date('Y-m-d', strtotime($request->paymentDate));
        
        $this->validate(request(), [       
             'vendorId' => 'required',  
             'paymentType' => 'required',  
        ]);

        $paymentToCompany = PaymentToCompany::create( [     
            'vendor_id' => $request->vendorId,                      
            'payment_no' => $request->paymentNo,                      
            'payment_date' => $paymentDate,                                  
            'current_due' => $request->currentDue, 
            'payment_now' => $request->paymentNow, 
            'balance' => $request->balance, 
            'money_receipt' => $request->moneyReceipt, 
            'payment_type' => $request->paymentType, 
            'remarks' => $request->remarks,                   
        ]);

       return redirect(route('paymentToCompany.index'))->with('msg','Payment To Company Complete Successfully');
    }

    public function editPaymentToCompany($paymentToCompanyId)
    {
    	$title = "Edit Payment To Company";
    	$formLink = "paymentToCompany.update";
    	$buttonName = "Update";

    	$paymentToCompany = PaymentToCompany::where('id',$paymentToCompanyId)->first();

    	$vendor = VendorSetup::where('id',$paymentToCompany->vendor_id)->first();


    	return view('admin.paymentToCompany.edit')->with(compact('title','formLink','buttonName','vendor','paymentToCompany'));
    }

    public function updatePaymentToCompany(Request $request)
    {
    	// dd($request->all());

        $paymentDate = date('Y-m-d', strtotime($request->paymentDate));
        
        $this->validate(request(), [       
             'vendorId' => 'required',  
             'paymentType' => 'required',  
        ]);

        $paymentToCompanyId = $request->paymentToCompanyId;
        $paymentToCompany = PaymentToCompany::find($paymentToCompanyId);

        $paymentToCompany->update( [     
            'vendor_id' => $request->vendorId,                      
            'payment_no' => $request->paymentNo,                      
            'payment_date' => $paymentDate,                                  
            'current_due' => $request->currentDue, 
            'payment_now' => $request->paymentNow, 
            'balance' => $request->balance, 
            'money_receipt' => $request->moneyReceipt, 
            'payment_type' => $request->paymentType, 
            'remarks' => $request->remarks,                   
        ]);

       return redirect(route('paymentToCompany.index'))->with('msg','Payment To Company Updated Successfully');
    }

    public function getVendorInfo(Request $request)
    {
    	// echo $vendorId; die();
    	$lifting = Lifting::where('vendor_id',$request->vendorId)->sum('total_price');
    	$liftingReturn = 0; 
    	$currentDue = PaymentToCompany::where('vendor_id',$request->vendorId)->sum('payment_now');
    	$data = ['lifting' => $lifting,'liftingReturn'=>$liftingReturn,'currentDue'=>$currentDue];

    	return $data;    	
    }
}
