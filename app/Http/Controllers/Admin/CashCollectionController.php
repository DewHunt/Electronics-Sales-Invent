<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\InvoiceSetup;
use App\CashCollection;
use App\Product;
use App\CustomerRegistrationSetup;

class CashCollectionController extends Controller
{
    public function index(){
    	$title = "Cash Collection";
    	$cashCollections = CashCollection::orderBy('id','ASC')->get();
    	return view('admin.cashCollection.index')->with(compact('title','cashCollections'));
    }

    public function add(){
    	$title = "New Cash Collection";
        $formLink = "cashCollection.save";
        $buttonName = "Save";
        $invoiceList = InvoiceSetup::orderBy('id','asc')->get();
    	return view('admin.cashCollection.add')->with(compact('title','formLink','buttonName','invoiceList'));
    }

    public function save(Request $request){
    	$collectionDate = date('Y-m-d',strtotime($request->collectionDate));
    	$cashCollection = CashCollection::create( [
            'invoice_id' => $request->invoiceId,       
            'collection_no' => $request->collectionNo,       
            'invoice_amount' => $request->invoiceAmount,       
            'previous_collection' => $request->previousCollection,
            'collection_date' => $collectionDate,       
            'collection_amount' => $request->collectionAmount,       
            'current_due' => $request->currentDue, 
            'remarks' => $request->remarks        
        ]);

        return redirect(route('cashCollection.index'))->with('msg', 'Cash Payment Collected Successfully');
    }

    public function update(Request $request){
    	$collectionId = $request->collectionId;
    	$cashCollection = CashCollection::find($collectionId);
    	$collectionDate = date('Y-m-d',strtotime($request->collectionDate));
    	$cashCollection->update( [      
            'invoice_amount' => $request->invoiceAmount,       
            'previous_collection' => $request->previousCollection,
            'collection_date' => $collectionDate,       
            'collection_amount' => $request->collectionAmount,       
            'current_due' => $request->currentDue, 
            'remarks' => $request->remarks        
        ]);

        return redirect(route('cashCollection.index'))->with('msg', 'Cash Payment Collection Update Successfully');
    }

    public function edit($id){
    	$title = "Edit Cash Collection";
        $formLink = "cashCollection.update";
        $buttonName = "Update";
        $cashCollection = CashCollection::where('id',$id)->first();
        $invoice = InvoiceSetup::where('id',$cashCollection->invoice_id)
            ->first();
        $product = Product::where('id',$invoice->product_id)->first();
    	return view('admin.cashCollection.edit')->with(compact('title','formLink','buttonName','cashCollection','invoice','product'));
    }

    public function print($collectionId){
        $title = "Money Receipt";
        $cashCollection = CashCollection::Where('id',$collectionId)->first();
        $invoice = InvoiceSetup::Where('id',$cashCollection->invoice_id)->first();
        $customer = CustomerRegistrationSetup::Where('id',$invoice->customer_id)->first();
        $product = Product::Where('id',$invoice->product_id)->first();
        $pdf = PDF::loadView('admin.cashCollection.print',['title'=>$title,'cashCollection'=>$cashCollection,'invoice'=>$invoice,'customer'=>$customer,'product'=>$product]);

        return $pdf->stream('money_receipt.pdf');
    }

    public function delete(Request $request)
    {
        CashCollection::where('id',$request->collectionId)->delete();
    }

    public function getInvoiceInformation(Request $request)
    {
        $invoiceId = $request->invoiceId;

        $invoice = InvoiceSetup::where('id',$invoiceId)
            ->first();
        $product = Product::where('id',$invoice->product_id)->first();
        $previous_collection = CashCollection::where('invoice_id',$invoiceId)->sum('collection_amount');

        if($request->ajax()){
        return response()
                ->json([
                    'invoice'=>$invoice,
                    'product'=>$product,
                    'previous_collection'=>$previous_collection,
                ]);
            }
    }
}
