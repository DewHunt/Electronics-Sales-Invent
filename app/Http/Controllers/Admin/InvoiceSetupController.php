<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use DB;
use App\CustomerRegistrationSetup;
use App\ShowroomSetup;
use App\CustomerProduct;
use App\InvoiceSetup;
use App\Product;

class InvoiceSetupController extends Controller
{
    public function index(){
    	$title = "Invoice Setup";
    	$invoices = InvoiceSetup::orderBy('id','asc')->get();
    	return view('admin.invoiceSetup.index')->with(compact('title','invoices'));
    }

    public function add(Request $request)
    {
        if($request->customerProductId)
        {
            $customerProductId = $request->customerProductId;
            $print = $request->print;
            $getCustomerProduct = CustomerProduct::where('id',$customerProductId)->first();
            $productInfo = Product::where('id',$getCustomerProduct->product_id)->first();

            $existInvoice = InvoiceSetup::where('customer_product_id',$customerProductId)->first();
            if(@$existInvoice)
            {
                $invoice = $existInvoice;
            }
            else
            {
                $lastInvoice = InvoiceSetup::max('id');
                if(@$lastInvoice)
                {
                    $lastInvoiceId = $lastInvoice;
                }
                else
                {
                    $lastInvoiceId = 1;
                }
                $randomNumber = 10000+$lastInvoiceId;
                $invoiceNo = "inv-".$lastInvoiceId."-".date('y')."-".$randomNumber;
                $invoice = InvoiceSetup::create( [
                    'invoice_no' => $invoiceNo,       
                    'customer_id' => $getCustomerProduct->customer_id,       
                    'customer_product_id' => $customerProductId,       
                    'product_id' => $getCustomerProduct->product_id,
                    'qty' => $getCustomerProduct->qty,       
                    'customer_product_price' => $getCustomerProduct->cash_price,       
                    'customer_product_model' => $getCustomerProduct->product_model, 
                    'customer_product_usage_address' => $getCustomerProduct->product_usage_address,       
                    'customer_product_purchase_date' => $getCustomerProduct->purchase_date,
                    'customer_product_color' => $productInfo->color,       
                    'customer_product_waranty' => $productInfo->warranty,           
                ]);

                $customerProduct = CustomerProduct::find($customerProductId);

                $customerProduct->update([
                    'status' => '0'
                ]);
            }
        }
        else
        {
            $invoice = array();
            $getCustomerProduct = array();
            $productInfo = array();
            $print = "";
        }
        
        $title = "Create New Invoice";
        $formLink = "invoiceSetup.add";
        $buttonName = "Create Invoice";
        $customer = CustomerRegistrationSetup::where('id',1)->first();

        $customerProducts = CustomerProduct::where('purchase_type','Cash')
            ->where('status','1')
            ->get();

        return view('admin.invoiceSetup.add')->with(compact('title','formLink','buttonName','customerProducts','customer','invoice','getCustomerProduct','productInfo','print'));
    }

    public function printInvoice($invoiceId){

    	$title = "Print Invoice";
        $invoice = InvoiceSetup::orWhere('id',$invoiceId)->first();
        $customer = CustomerRegistrationSetup::where('id',$invoice->customer_id)->first();
        $getCustomerProduct = CustomerProduct::where('id',$invoice->customer_product_id)->first();
	    $productInfo = Product::where('id',$getCustomerProduct->product_id)->first();
        $showRoom = ShowroomSetup::where('id',$getCustomerProduct->showroom_id)->first();
       
        $pdf = PDF::loadView('admin.invoiceSetup.printInvoice
',['title'=>$title,'invoice'=>$invoice,'customer'=>$customer,'getCustomerProduct'=>$getCustomerProduct,'productInfo'=>$productInfo,'showRoom'=>$showRoom]);

        return $pdf->stream('invoice.pdf');
    }

    public function printChalan($invoiceId){

    	$title = "Print Chalan";
        $invoice = InvoiceSetup::orWhere('id',$invoiceId)->first();
        $customer = CustomerRegistrationSetup::where('id',$invoice->customer_id)->first();
        $getCustomerProduct = CustomerProduct::where('id',$invoice->customer_product_id)->first();
	    $productInfo = Product::where('id',$getCustomerProduct->product_id)->first();
        $showRoom = ShowroomSetup::where('id',$getCustomerProduct->showroom_id)->first();
       
        $pdf = PDF::loadView('admin.invoiceSetup.printChalan',['title'=>$title,'invoice'=>$invoice,'customer'=>$customer,'getCustomerProduct'=>$getCustomerProduct,'productInfo'=>$productInfo,'showRoom'=>$showRoom]);

        return $pdf->stream('invoice.pdf');
    }

   public function view($id){
   	$title = "View Customer Invoice";
   	$invoice = InvoiceSetup::orWhere('id',$id)->first();
    $customer = CustomerRegistrationSetup::where('id',$invoice->customer_id)->first();
    $getCustomerProduct = CustomerProduct::where('id',$invoice->customer_product_id)->first();
    $productInfo = Product::where('id',$getCustomerProduct->product_id)->first();
    $showRoom = ShowroomSetup::where('id',$getCustomerProduct->showroom_id)->first();
   	return view('admin.invoiceSetup.view')->with(compact('title','customerProducts','customer','invoice','getCustomerProduct','productInfo','showRoom'));
   }

   public function delete(Request $request)
    {

        $invoiceInfo = InvoiceSetup::find($request->invoiceId);

        $customerProduct = CustomerProduct::find($invoiceInfo->customer_product_id);

        // echo $customerProduct->product_model;

        $customerProduct->update([
            'status' => '1'
        ]);
        $invoice = InvoiceSetup::where('id',$request->invoiceId)->delete();
    }
}
