<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Product;
use App\CustomerProduct;
use App\CustomerRegistrationSetup;
use App\Installment;
use App\InstallmentSchedule;
use App\InvoiceSetup;

class InstallmentScheduleController extends Controller
{
    public function index(){
    	$title = "Installment Schedule List";
    	$installmentList = Installment::orderBy('id','ASC')->get();
    	return view('admin.installmentSchedule.index')->with(compact('title','installmentList'));
    }

    public function add(){
    	$title = "Prepare Installment Schedule";
        $formLink = "installmentSchedule.save";
        $buttonName = "Save";
        $customerProducts = InvoiceSetup::where('collection_type','!=','Cash')
            ->where('status','1')
            ->get();
    	return view('admin.installmentSchedule.add')->with(compact('title','formLink','buttonName','customerProducts'));
    }

    public function save(Request $request){
        $getCustomerProduct = CustomerProduct::where('id',$request->customerProductId)->first();
        $installment = Installment::create([
            'customer_product_id' => $request->customerProductId,       
            'customer_id' => $getCustomerProduct->customer_id,       
            'product_id' => $getCustomerProduct->product_id,       
            'invoice_no' => $request->invoiceNo,       
            'customer_name' => $request->customerName,
            'installment_price' => $request->productAmount,       
            'booking_amount' => $request->bookingAmount,       
            'installment_qty' => $request->installmentQty, 
            'installment_amount' => $request->installmentAmount        
        ]);

        if($installment)
        {
            $countInstallmentSchedule = count($request->installmentScheduleDate);
            $postData = [];
            for ($i=0; $i <$countInstallmentSchedule ; $i++) { 
                $installmentScheduleDate = date('Y-m-d',strtotime($request->installmentScheduleDate[$i]));
                $postData[] = [
                    'installment_id'=> $installment->id,
                    'invoice_no' => $request->invoiceNo,
                    'installment_schedule_date' => $installmentScheduleDate, 
                    'installment_schedule_amount' => $request->installmentScheduleAmount[$i], 
                ];
            }
            InstallmentSchedule::insert($postData);

            $invoice = InvoiceSetup::where('invoice_no',$request->invoiceNo)->first();

            $invoice->update([
                'status' => '0'
            ]);             
        }

        return redirect(route('installmentSchedule.index'))->with('msg','Installment Schedule Created Successfully');
    }

    public function edit($id)
    {
        $title = "Edit Installment Schedule";
        $formLink = "installmentSchedule.update";
        $buttonName = "Update";
        $installment = Installment::where('id',$id)->first();
        $installmentScheduleList = InstallmentSchedule::where('installment_id',$id)->orderBy('installment_schedule_date','ASC')->get();
        $product = Product::where('id',$installment->product_id)->first();
        return view('admin.installmentSchedule.edit')->with(compact('title','formLink','buttonName','installment','installmentScheduleList','product'));
    }

    public function update(Request $request){
        $installmentId = $request->installmentId;
        $countInstallmentSchedule = count($request->installmentScheduleDate);
        DB::table('tbl_installment_schedule')->where('installment_id', $installmentId)->delete();
            $postData = [];
            for ($i=0; $i <$countInstallmentSchedule ; $i++) { 
                $installmentScheduleDate = date('Y-m-d',strtotime($request->installmentScheduleDate[$i]));
                $postData[] = [
                    'installment_id'=> $installmentId,
                    'invoice_no' => $request->invoiceNo,
                    'installment_schedule_date' => $installmentScheduleDate, 
                    'installment_schedule_amount' => $request->installmentScheduleAmount[$i], 
                ];
            }
        InstallmentSchedule::insert($postData); 

        return redirect(route('installmentSchedule.index'))->with('msg','Installment Schedule Created Successfully');
    }

    public function delete(Request $request)
    {
        $installment = Installment::find($request->installmentId);
        $invoice = InvoiceSetup::where('invoice_no',$installment->invoice_no)->first();

        $invoice->update([
            'status' => '1'
        ]);

        Installment::where('id',$request->installmentId)->delete();
        InstallmentSchedule::where('installment_id',$request->installmentId)->delete();
    }

    public function getCustomerProductInfo(Request $request)
    {
        $customerProductId = $request->customerProductId;

        $invoice = InvoiceSetup::where('customer_product_id',$customerProductId)->first();
        $customerProduct = CustomerProduct::where('id',$customerProductId)->first();
        $customer = CustomerRegistrationSetup::where('id',$customerProduct->customer_id)->first();

        if($request->ajax()){
        return response()
                ->json([
                    'invoice'=>$invoice,
                    'customerProduct'=>$customerProduct,
                    'customer'=>$customer,
                ]);
            }
    }
}
