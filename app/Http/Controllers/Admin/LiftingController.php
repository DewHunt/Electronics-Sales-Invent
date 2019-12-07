<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;
use App\Product;
use App\Lifting;
use App\LiftingProduct;

use DB;
use PDF;
use MPDF;

class LiftingController extends Controller
{
    public function index()
    {
    	$title = "Product Lifting";

    	$liftings = Lifting::select('tbl_liftings.*','tbl_vendors.name as vendorName')
    		->join('tbl_vendors','tbl_vendors.id','=','tbl_liftings.vendor_id')
    		->orderBy('tbl_liftings.purchase_by','asc')
    		->orderBy('tbl_vendors.name','asc')
            ->get();

    	return view('admin.lifting.index')->with(compact('title','liftings'));
    }

    public function add()
    {
    	$title = "Add Product Lifting";
    	$formLink = "lifting.save";
    	$buttonName = "Save";

    	$vendors = VendorSetup::where('status','1')->orderBy('name','asc')->get();
    	$products = Product::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.lifting.add')->with(compact('title','formLink','buttonName','vendors','products'));
    }

    public function save(Request $request)
    {
        // $this->validation($request);

        $submissionDate = date('Y-m-d', strtotime($request->submissionDate));
        $voucherDate = date('Y-m-d', strtotime($request->voucherDate));

        $lifting = Lifting::create( [
        	'serial_no' => $request->serialNo,
            'vaouchar_no' => $request->voucharNo,
            'vendor_id' => $request->vendorId,
            'purchase_by' => $request->purchaseBy,           
            'submission_date' => $submissionDate,
            'vouchar_date' => $voucherDate,          
            'total_qty' => $request->totalQty,          
            'total_price' => $request->totalPrice,          
            'total_mrp_price' => $request->totalMrpPrice,          
            'total_haire_price' => $request->totalHairePrice,          
        ]);

        $countProduct = count($request->productId);
        if($request->productId){
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++) { 
        		$postData[] = [
        			'lifting_id'=> $lifting->id,
        			'product_id' => $request->productId[$i],
        			'model_no' => $request->productModel[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i],
        			'price' => $request->productPrice[$i], 
        			'mrp_price' => $request->productMrpPrice[$i],
        			'haire_price' => $request->productHairePrice[$i],
        		];
        	}                
        	LiftingProduct::insert($postData);
        }

        return redirect(route('lifting.index'))->with('msg','Product Lifting Added Successfully');
    }

    public function edit($liftingId)
    {
    	$title = "Add Product Lifting";
    	$formLink = "lifting.update";
    	$buttonName = "Update";

    	$vendors = VendorSetup::where('status','1')->orderBy('name','asc')->get();
    	$products = Product::where('status','1')->orderBy('name','asc')->get();
    	$lifting = Lifting::where('id',$liftingId)->first();
    	$liftingProducts = LiftingProduct::select('tbl_lifting_products.*','tbl_products.name as productName')
    		->join('tbl_products','tbl_products.id','=','tbl_lifting_products.product_id')
    		->where('.tbl_lifting_products.lifting_id',$liftingId)
    		->get();

    	return view('admin.lifting.edit')->with(compact('title','formLink','buttonName','vendors','products','lifting','liftingProducts'));
    }

    public function update(Request $request)
    {
    	// dd($request->all()); die();
        // $this->validation($request);

        $submissionDate = date('Y-m-d', strtotime($request->submissionDate));
        $voucherDate = date('Y-m-d', strtotime($request->voucherDate));
        $liftingId = $request->liftingId;

        $lifting = Lifting::find($liftingId);

        $lifting->update( [
        	'serial_no' => $request->serialNo,
            'vaouchar_no' => $request->voucharNo,
            'vendor_id' => $request->vendorId,
            'purchase_by' => $request->purchaseBy,           
            'submission_date' => $submissionDate,
            'vouchar_date' => $voucherDate,          
            'total_qty' => $request->totalQty,          
            'total_price' => $request->totalPrice,          
            'total_mrp_price' => $request->totalMrpPrice,          
            'total_haire_price' => $request->totalHairePrice,          
        ]);

        LiftingProduct::where('lifting_id',$liftingId)->delete();

        $countProduct = count($request->productId);
        if($request->productId){
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++) { 
        		$postData[] = [
        			'lifting_id'=> $lifting->id,
        			'product_id' => $request->productId[$i],
        			'model_no' => $request->productModel[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i],
        			'price' => $request->productPrice[$i], 
        			'mrp_price' => $request->productMrpPrice[$i],
        			'haire_price' => $request->productHairePrice[$i],
        		];
        	}                
        	LiftingProduct::insert($postData);
        }

        return redirect(route('lifting.index'))->with('msg','Product Lifting Updated Successfully');
    }

    public function liftingProductInfo(Request $request)
    {
    	// echo $request->productId; die();
    	$product = Product::where('id',$request->productId)->first();
        // dd($product); die();

        if($request->ajax())
        {
            return response()->json([
                'product'=>$product
            ]);
        }
    }

    public function print($liftingId)
    {
        $title = "Product Lifting Chalan";

        $lifting = Lifting::select('tbl_liftings.*','tbl_vendors.name as vendorName')
            ->join('tbl_vendors','tbl_vendors.id','=','tbl_liftings.vendor_id')
            ->where('tbl_liftings.id',$liftingId)
            ->first();
        $liftingProducts = LiftingProduct::select('tbl_lifting_products.*','tbl_products.name as productName','tbl_products.code as productCode')
            ->join('tbl_products','tbl_products.id','=','tbl_lifting_products.product_id')
            ->where('.tbl_lifting_products.lifting_id',$liftingId)
            ->get();

        $pdf = PDF::loadView('admin.lifting.print',['title'=>$title,'lifting'=>$lifting,'liftingProducts'=>$liftingProducts]);

        return $pdf->stream('product_lifting_chalan.pdf');
    }

    public function delete(Request $request)
    {
    	// echo $lifting = $request->liftingId; die();
    	$liftingId = $request->liftingId;
    	Lifting::where('id',$liftingId)->delete();
    	LiftingProduct::where('lifting_id',$liftingId)->delete();
    }

    // public function validation(Request $request)
    // {
    //     $this->validate(request(), [
    //         'code' => 'required',
    //         'vendorName' => 'required',
    //     ]);
    // }
}
