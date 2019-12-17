<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CustomerRegistrationSetup;
use App\ShowroomSetup;
use App\CustomerProduct;
use App\InvoiceSetup;
use App\Product;
use App\LiftingProduct;

use PDF;
use DB;

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

            if($request->collectionType == "Full Payment")
            {
                $customerProductPrice = $getCustomerProduct->cash_price;
            }

            if($request->collectionType == "Partial Payment")
            {
                $customerProductPrice = $getCustomerProduct->mrp_price;
            }

            if($request->collectionType == "Installment")
            {
                $customerProductPrice = $getCustomerProduct->installment_price;
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
                $invoiceDate = date('Y-m-d',strtotime($request->invoiceDate));
                $invoiceNo = "inv-".$lastInvoiceId."-".date('y')."-".$randomNumber;
                $invoice = InvoiceSetup::create( [
                    'invoice_date' => $invoiceDate,
                    'invoice_no' => $invoiceNo,
                    'collection_type' => $request->collectionType,       
                    'customer_id' => $getCustomerProduct->customer_id,       
                    'customer_product_id' => $customerProductId,       
                    'product_id' => $getCustomerProduct->product_id,
                    'product_name' => $getCustomerProduct->product_name,
                    'product_serial_no' => $request->productSerial,
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

                if ($request->productSerial != "No Serial Number")
                {
                    $liftingProduct = LiftingProduct::where('serial_no',$request->productSerial)->first();

                    $liftingProduct->update([
                        'status' => '0'
                    ]);
                }
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

        return view('admin.invoiceSetup.add')->with(compact('title','formLink','buttonName','customer','invoice','getCustomerProduct','productInfo','print'));
    }

    public function getAllProduct(Request $request)
    {
        $output = '';
        $results = '';
        $collectionType = $request->collectionType;

        if($collectionType == "Full Payment")
        {
            $purchaseType = "Cash";
        }

        if($collectionType == "Partial Payment")
        {
            $purchaseType = "Cash";
        }

        if($collectionType == "Installment")
        {
            $purchaseType = "Installment";
        }

        $customerProducts = CustomerProduct::select('tbl_customer_products.*','tbl_customers.name as customerName','tbl_products.name as productName','tbl_products.code as productCode','tbl_products.color as productColor','tbl_products.model_no as productModelNo')
            ->join('tbl_products','tbl_products.id','=','tbl_customer_products.product_id')
            ->join('tbl_customers','tbl_customers.id','=','tbl_customer_products.customer_id')
            ->where('tbl_customer_products.purchase_type',$purchaseType)
            ->where('tbl_customer_products.status','1')
            ->get();

        if ($customerProducts)
        {
            $output .= '<select class="form-control chosen-select" name="customerProductId" id="customerProductId">';
            $output .= '<option value="">Select Product</option>';          
            foreach ($customerProducts as $customerProduct)
            {
                // $output .= '<option value="'.$customerProduct->id.'">'.$customerProduct->customerName.' / '.$customerProduct->productName.'</option>';
                $output .= '<option value="'.$customerProduct->id.'">'.$customerProduct->customerName.' / '.$customerProduct->productName.' ('.$customerProduct->productCode.' - '.$customerProduct->productColor.' - '.$customerProduct->productModelNo.')</option>';
            }
            $output .= '</select>';         
        }
        else
        {
            $output .= '<select class="form-control chosen-select" name="customerProductId" id="customerProductId">';
            $output .= '<option value="">Select Product</option>';
            $output .= '</select>';
        }  

        echo $output;
    }

    public function getAllProductSerial(Request $request)
    {
        $output = '';
        $results = '';

        $customerProduct = CustomerProduct::where('id',$request->customerProductId)->where('status','1')->first();

        $productSerials = LiftingProduct::where('product_id',$customerProduct->product_id)->where('status','1')->get();

        if ($productSerials)
        {
            $output .= '<select class="form-control chosen-select" name="productSerial" id="productSerial">';
            $output .= '<option value="">Select Product Serial</option>';          
            foreach ($productSerials as $productSerial)
            {
                $output .= '<option value="'.$productSerial->serial_no.'">'.$productSerial->serial_no.'</option>';
            }
            $output .= '<option value="No Serial Number">No Serial Number</option>';
            $output .= '</select>';         
        }
        else
        {
            $output .= '<select class="form-control chosen-select" name="productSerial" id="productSerial">';
            $output .= '<option value="">Select Product Serial</option>';
            $output .= '<option value="No Serial Number">No Serial Number</option>';
            $output .= '</select>';
        }  

        echo $output;
    }

    public function printInvoice($invoiceId){

        $title = "Print Invoice";

        $invoice = DB::table('tbl_invoice')
            ->select('tbl_invoice.*','tbl_customers.name as customerName','tbl_customers.phone_no as customerPhoneNo','tbl_products.name as productName','tbl_products.code as productCode','tbl_showroom.name as showroomName')
            ->join('tbl_customers','tbl_customers.id','=','tbl_invoice.customer_id')
            ->join('tbl_products','tbl_products.id','=','tbl_invoice.product_id')
            ->join('tbl_customer_products','tbl_customer_products.id','=','tbl_invoice.customer_product_id')
            ->join('tbl_showroom','tbl_showroom.id','=','tbl_customer_products.showroom_id')
            ->where('tbl_invoice.id',$invoiceId)
            ->first();
       
        $pdf = PDF::loadView('admin.invoiceSetup.printInvoice',['title'=>$title,'invoice'=>$invoice]);

        return $pdf->stream($invoice->invoice_no.'.pdf');
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

            $chalanNo = str_replace('inv', 'chalan', $invoice->invoice_no);
       
        $pdf = PDF::loadView('admin.invoiceSetup.printChalan',['title'=>$title,'invoice'=>$invoice]);

        return $pdf->stream($chalanNo.'.pdf');
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

        // dd($invoiceInfo);

        $customerProduct = CustomerProduct::find($invoiceInfo->customer_product_id);
        $customerProduct->update([
            'status' => '1'
        ]);

        if ($invoiceInfo->product_serial_no != "No Serial Number")
        {
            $liftingProduct = LiftingProduct::where('serial_no',$invoiceInfo->product_serial_no)->first();
            $liftingProduct->update([
                'status' => '1'
            ]);
        }

        $invoice = InvoiceSetup::where('id',$request->invoiceId)->delete();
    }
}
