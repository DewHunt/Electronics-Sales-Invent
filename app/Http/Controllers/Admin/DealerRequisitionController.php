<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerRequisition;
use App\DealerRequisitionProduct;
use App\DealerSetup;
use App\Product;

class DealerRequisitionController extends Controller
{
    public function index()
    {
    	$title = "Dealer Requisation";

    	$dealerRequisitions = DealerRequisition::select('tbl_dealer_requisitions.*','tbl_dealers.name as dealerName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_requisitions.dealer_id')
    		->where('tbl_dealer_requisitions.status','1')
    		->orderBy('tbl_dealer_requisitions.date','dsc')
    		->get();

    	return view('admin.dealerRequisition.index')->with(compact('title','dealerRequisitions'));
    }

    public function add()
    {
    	$title = "Add Dealer Requisation";
    	$formLink = "dealerRequisition.save";
    	$buttonName = "Save";

    	$dealers = DealerSetup::where('status','1')->orderBy('name','asc')->get();
    	$products = product::where('status','1')->orderBy('name','asc')->get();
    	$products = Product::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.dealerRequisition.add')->with(compact('title','formLink','buttonName','dealers','products'));
    }

    public function save(Request $request)
    {
        // $this->validation($request);

        $requisitionDate = date('Y-m-d', strtotime($request->requisitionDate));

        $dealerRequisition = DealerRequisition::create( [
        	'dealer_id' => $request->dealerId,
            'requisition_no' => $request->requisitionNo,
            'date' => $requisitionDate,
            'product_id' => $request->product,         
            'total_qty' => $request->totalQty,          
            'total_amount' => $request->totalAmount,         
        ]);

        $countProduct = count($request->productId);
        if($request->productId){
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++) { 
        		$postData[] = [
        			'requisition_id'=> $dealerRequisition->id,
                    'product_id' => $request->productId[$i],
        			'product_name' => $request->productName[$i],
                    'model_no' => $request->productModel[$i],
                    'price' => $request->productPrice[$i],
                    'qty' => $request->productQty[$i],
        			'amount' => $request->amount[$i],
        		];
        	}                
        	DealerRequisitionProduct::insert($postData);
        }

        return redirect(route('dealerRequisition.index'))->with('msg','Dealer Requisition Added Successfully');
    }

    public function edit($dealerRequisitionId)
    {
    	$title = "Edit Dealer Requisation";
    	$formLink = "dealerRequisition.update";
    	$buttonName = "Update";

    	$dealerRequisition = DealerRequisition::where('id',$dealerRequisitionId)->first();
    	$dealerRequisitionProducts = DealerRequisitionProduct::where('requisition_id',$dealerRequisitionId)->get();
    	$dealers = DealerSetup::where('status','1')->orderBy('name','asc')->get();
    	$products = product::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.dealerRequisition.edit')->with(compact('title','formLink','buttonName','dealers','products','dealerRequisition','dealerRequisitionProducts'));
    }

    public function update(Request $request)
    {
        $requisitionDate = date('Y-m-d', strtotime($request->requisitionDate));

        $dealerRequisition = DealerRequisition::find($request->dealerRequisitionId);

        $dealerRequisition->update( [
        	'dealer_id' => $request->dealerId,
            'requisition_no' => $request->requisitionNo,
            'date' => $requisitionDate,
            'product_id' => $request->product,         
            'total_qty' => $request->totalQty,          
            'total_amount' => $request->totalAmount,         
        ]);

        DealerRequisitionProduct::where('requisition_id',$request->dealerRequisitionId)->delete();

        $countProduct = count($request->productId);
        if($request->productId){
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++) { 
        		$postData[] = [
        			'requisition_id'=> $dealerRequisition->id,
                    'product_id' => $request->productId[$i],
        			'product_name' => $request->productName[$i],
                    'model_no' => $request->productModel[$i],
                    'price' => $request->productPrice[$i],
                    'qty' => $request->productQty[$i],
        			'amount' => $request->amount[$i],
        		];
        	}                
        	DealerRequisitionProduct::insert($postData);
        }

        return redirect(route('dealerRequisition.index'))->with('msg','Dealer Requisition Updated Successfully');
    }

    public function productInfo(Request $request)
    {
    	$product = Product::where('id',$request->productId)->first();
    	
        if($request->ajax())
        {
            return response()->json([
                'product'=>$product
            ]);
        }
    }

    public function delete(Request $request)
    {
    	DealerRequisition::where('id',$request->dealerRequisitionId)->delete();
    	DealerRequisitionProduct::where('requisition_id',$request->dealerRequisitionId)->delete();
    }
}
