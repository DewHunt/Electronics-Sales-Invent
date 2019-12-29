<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Transfer;
use App\TransferProduct;
use App\Product;
use App\VendorSetup;
use App\Lifting;
use App\LiftingProduct;

use DB;
use PDF;
use MPDF;

class TransferProductController extends Controller
{
    public function index()
    {
    	$title = "Transfer Product";

    	$transfers = Transfer::orderBy('date','asc')->get();

    	return view('admin.transferProduct.index')->with(compact('title','transfers'));
    }

    public function add()
    {
    	$title = "Add Product Transfer";
    	$formLink = "transferProduct.save";
    	$buttonName = "Save";

    	$storeAndShowrooms = DB::table('view_store_and_showroom')->get();
    	$vendors = VendorSetup::orderBy('name','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	return view('admin.transferProduct.add')->with(compact('title','formLink','buttonName','storeAndShowrooms','vendors','products'));
    }

    public function save(Request $request)
    {
    	$host = explode(',',$request->host);
    	$hostId = $host[0];
    	$hostType = $host[1];

    	$destination = explode(',',$request->destination);
    	$destinationId = $destination[0];
    	$destinationType = $destination[1];

    	$date = date('Y-m-d', strtotime($request->transferDate));

    	$transfer = Transfer::create([
    		'vendor_id' => $request->supplier,
    		'product_id' => $request->product,
    		'transfer_no' => $request->transferNo,
    		'date' => $date,
    		'host_type' => $hostType,
    		'host_id' => $hostId,
    		'destination_type' => $destinationType,
    		'destination_id' => $destinationId,
    		'total_qty' => $request->totalQty
    	]);

        $countProduct = count($request->productId);

        if($request->productId)
        {
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++)
        	{ 
        		$postData[] = [
        			'transfer_id'=> $transfer->id,
                    'vendor_id' => $request->supplier,
                    'lifting_product_id' => $request->liftingProductId[$i],
        			'product_id' => $request->productId[$i],
                    'name' => $request->productName[$i],
        			'model_no' => $request->productModelNo[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i]
        		];
        	}                
        	TransferProduct::insert($postData);
        }

        return redirect(route('transferProduct.index'))->with('msg','Vendor Added Successfully');
    }

    public function edit($transferId)
    {
    	$title = "Edit Product Transfer";
    	$formLink = "transferProduct.update";
    	$buttonName = "Update";

    	$transfer = Transfer::where('id',$transferId)->first();
    	$transferProducts = TransferProduct::where('transfer_id',$transferId)->get();

    	$hosts = DB::table('view_store_and_showroom')->get();
        $destinations = DB::table('view_store_and_showroom')
        	->where('id','!=',$transfer->hostId)
        	->orWhere('type','!=',$transfer->hostType)
        	->get();
    	$vendors = VendorSetup::orderBy('name','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	return view('admin.transferProduct.edit')->with(compact('title','formLink','buttonName','hosts','destinations','vendors','products','transfer','transferProducts'));
    }

    public function update(Request $request)
    {
    	$host = explode(',',$request->host);
    	$hostId = $host[0];
    	$hostType = $host[1];

    	$destination = explode(',',$request->destination);
    	$destinationId = $destination[0];
    	$destinationType = $destination[1];

    	$date = date('Y-m-d', strtotime($request->transferDate));

    	$transfer = Transfer::find($request->transferId);

    	$transfer->update([
    		'vendor_id' => $request->supplier,
    		'product_id' => $request->product,
    		'transfer_no' => $request->transferNo,
    		'date' => $date,
    		'host_type' => $hostType,
    		'host_id' => $hostId,
    		'destination_type' => $destinationType,
    		'destination_id' => $destinationId,
    		'total_qty' => $request->totalQty
    	]);

        TransferProduct::where('transfer_id',$request->transferId)->delete();

        $countProduct = count($request->productId);

        if($request->productId)
        {
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++)
        	{ 
        		$postData[] = [
        			'transfer_id'=> $transfer->id,
                    'vendor_id' => $request->supplier,
                    'lifting_product_id' => $request->liftingProductId[$i],
        			'product_id' => $request->productId[$i],
                    'name' => $request->productName[$i],
        			'model_no' => $request->productModelNo[$i],
        			'serial_no' => $request->productSerialNo[$i],
        			'color' => $request->productColor[$i],
        			'qty' => $request->productQty[$i]
        		];
        	}                
        	TransferProduct::insert($postData);
        }

        return redirect(route('transferProduct.index'))->with('msg','Vendor Updated Successfully');
    }

    public function storeAndShowroomInfo(Request $request)
    {
        $output = '';

        $destinations = DB::table('view_store_and_showroom')
        	->where('id','!=',$request->hostId)
        	->orWhere('type','!=',$request->hostType)
        	->get();

        if ($destinations)
        {
            $output .= '<select class="form-control chosen-select destination" name="destination" id="destination">';
            $output .= '<option value="">Select Destination</option>';          
            foreach ($destinations as $destination)
            {
                $output .= '<option value="'.$destination->id.','.$destination->type.'">'.$destination->name.'</option>';
            }
            $output .= '</select>';         
        }
        else
        {
            $output .= '<select class="form-control chosen-select destination" name="destination" id="destination">';
            $output .= '<option value="">Select Destination</option>';
            $output .= '</select>';
        }  

        echo $output;
    }

    public function liftingProductInfo(Request $request)
    {
    	$liftingProducts = LiftingProduct::select('tbl_lifting_products.*','tbl_products.name as productName')
    		->join('tbl_products','tbl_products.id','=','tbl_lifting_products.product_id')
    		->where('tbl_lifting_products.product_id',$request->productId)
    		->where('tbl_lifting_products.vendor_id',$request->vendorId)
    		->where('tbl_lifting_products.store_or_showroom_type',$request->hostType)
    		->where('tbl_lifting_products.store_or_showroom_id',$request->hostId)
    		->get();

        if($request->ajax())
        {
            return response()->json([
                'liftingProducts'=>$liftingProducts,
            ]);
        }
    }

    public function print($transferId)
    {
        $title = "Product Transfer Chalan";

        $transfer = Transfer::select('tbl_transfers.*','tbl_vendors.name as vendorName')
            ->join('tbl_vendors','tbl_vendors.id','=','tbl_transfers.vendor_id')
            ->where('tbl_transfers.id',$transferId)
            ->first();

        $host = DB::table('view_store_and_showroom')
            ->select('name as hostName')
            ->where('type',$transfer->host_type)
            ->where('id',$transfer->host_id)
            ->first();

        $destination = DB::table('view_store_and_showroom')
            ->select('name as destinationName')
            ->where('type',$transfer->destination_type)
            ->where('id',$transfer->destination_id)
            ->first();

        $transferProducts = TransferProduct::select('tbl_transfer_products.*','tbl_products.code as productCode')
            ->join('tbl_products','tbl_products.id','=','tbl_transfer_products.product_id')
            ->where('tbl_transfer_products.transfer_id',$transferId)
            ->get();

        $pdf = PDF::loadView('admin.transferProduct.print',['title'=>$title,'transfer'=>$transfer,'host'=>$host,'destination'=>$destination,'transferProducts'=>$transferProducts,]);

        return $pdf->stream('product_transfer_chalan.pdf');
    }

    public function delete(Request $request)
    {
        Transfer::where('id',$request->transferId)->delete();    	
        TransferProduct::where('transfer_id',$request->transferId)->delete();    	
    }
}
