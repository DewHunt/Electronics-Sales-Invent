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

            if($request->collectionType == "Full Payment"){
                $customerProductPrice = $getCustomerProduct->cash_price;
            }else{
                $customerProductPrice = $getCustomerProduct->mrp_price;
            }

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
                    $lastInvoiceId = $lastInvoice + 1;
                }
                else
                {
                    $lastInvoiceId = 1;
                }
                $randomNumber = 10000+$lastInvoiceId;
                $invoiceNo = "inv-".$lastInvoiceId."-".date('y')."-".$randomNumber;
                $invoice = InvoiceSetup::create( [
                    'invoice_no' => $invoiceNo,
                    'collection_type' => $request->collectionType,       
                    'customer_id' => $getCustomerProduct->customer_id,       
                    'customer_product_id' => $customerProductId,       
                    'product_id' => $getCustomerProduct->product_id,
                    'qty' => $getCustomerProduct->qty,       
                    'customer_product_price' => $customerProductPrice,       
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

        $customerProducts = CustomerProduct::select('tbl_customer_products.*','tbl_products.name as productName','tbl_products.code as productCode')
            ->join('tbl_products','tbl_products.id','=','tbl_customer_products.product_id')
            ->where('tbl_customer_products.purchase_type','Cash')
            ->where('tbl_customer_products.status','1')
            ->get();

        return view('admin.invoiceSetup.add')->with(compact('title','formLink','buttonName','customerProducts','customer','invoice','getCustomerProduct','productInfo','print'));
    }

    public function printInvoice($invoiceId){

        $title = "Print Invoice";
        // $invoice = InvoiceSetup::orWhere('id',$invoiceId)->first();
        // $customer = CustomerRegistrationSetup::where('id',$invoice->customer_id)->first();
        // $getCustomerProduct = CustomerProduct::where('id',$invoice->customer_product_id)->first();
        // $productInfo = Product::where('id',$getCustomerProduct->product_id)->first();
        // $showRoom = ShowroomSetup::where('id',$getCustomerProduct->showroom_id)->first();
       
        // $pdf = PDF::loadView('admin.invoiceSetup.printInvoice',['title'=>$title,'invoice'=>$invoice,'customer'=>$customer,'getCustomerProduct'=>$getCustomerProduct,'productInfo'=>$productInfo,'showRoom'=>$showRoom]);
        $invoice = DB::table('tbl_invoice')
            ->select('tbl_invoice.*','tbl_customers.name as customerName','tbl_customers.phone_no as customerPhoneNo','tbl_products.name as productName','tbl_products.code as productCode','tbl_showroom.name as showroomName')
            ->join('tbl_customers','tbl_customers.id','=','tbl_invoice.customer_id')
            ->join('tbl_products','tbl_products.id','=','tbl_invoice.product_id')
            ->join('tbl_customer_products','tbl_customer_products.id','=','tbl_invoice.customer_product_id')
            ->join('tbl_showroom','tbl_showroom.id','=','tbl_customer_products.showroom_id')
            ->where('tbl_invoice.id',$invoiceId)
            ->first();
       
        $pdf = PDF::loadView('admin.invoiceSetup.printInvoice',['title'=>$title,'invoice'=>$invoice]);

        return $pdf->stream('invoice.pdf');
    }

    public function printChalan($invoiceId){

        $title = "Print Chalan";
        $invoice = DB::table('tbl_invoice')
            ->select('tbl_invoice.*','tbl_products.name as productName','tbl_products.code as productCode','tbl_showroom.name as showroomName')
            ->join('tbl_products','tbl_products.id','=','tbl_invoice.product_id')
            ->join('tbl_customer_products','tbl_customer_products.id','=','tbl_invoice.customer_product_id')
            ->join('tbl_showroom','tbl_showroom.id','=','tbl_customer_products.showroom_id')
            ->where('tbl_invoice.id',$invoiceId)
            ->first();
       
        $pdf = PDF::loadView('admin.invoiceSetup.printChalan',['title'=>$title,'invoice'=>$invoice]);

        return $pdf->stream('invoice.pdf');
    }

   public function view($id){
    $title = "View Customer Invoice";
    $invoice = InvoiceSetup::orWhere('id',$id)->first();
    $customer = CustomerRegistrationSetup::where('id',$invoice->customer_id)->first();
    $getCustomerProduct = CustomerProduct::where('id',$invoice->customer_product_id)->first();
    $productInfo = Product::where('id',$getCustomerProduct->product_id)->first();
    $showRoom = ShowroomSetup::where('id',$getCustomerProduct->showroom_id)->first();
    return view('admin.invoiceSetup.view')->with(compact('title','customer','invoice','getCustomerProduct','productInfo','showRoom'));
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