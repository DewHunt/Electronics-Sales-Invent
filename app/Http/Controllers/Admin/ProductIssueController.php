<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\DealerRequisition;
use App\DealerRequisitionProduct;
use App\LiftingProduct;
use App\Product;
use App\ProductIssue;
use App\ProductIssueList;

class ProductIssueController extends Controller
{
	public function index()
	{
		$title = "Product Issue";

    	return view('admin.productIssue.index')->with(compact('title'));
	}

	public function add()
	{
    	$title = "Add Product Issue";
    	$formLink = "productIssue.save";
    	$buttonName = "Save";

    	$dealers = DealerSetup::where('status','1')->orderBy('name','asc')->get();
    	$dealerRequisitions = DealerRequisition::where('status','0')->get();
    	$products = product::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.productIssue.add')->with(compact('title','formLink','buttonName','dealers','dealerRequisitions','products'));
	}

    public function save(Request $request)
    {
        // $this->validation($request);
        // dd($request->all());

        $issueDate = date('Y-m-d', strtotime($request->issueDate));

        $productIssue = ProductIssue::create( [
        	'requisition_id' => $request->dealerRequisitionId,
        	'dealer_id' => $request->dealerId,
            'issue_no' => $request->productIssueNo,
            'date' => $issueDate,
            'total_qty' => $request->totalQty,         
            'total_amount' => $request->totalAmount,         
        ]);

        $countProduct = count($request->productId);
        if($request->productId){
        	$postData = [];
        	for ($i=0; $i <$countProduct ; $i++) { 
        		$postData[] = [
        			'issue_id'=> $productIssue->id,
                    'product_id' => $request->productId[$i],
        			'model_no' => $request->productModel[$i],
                    'serial_no' => $request->productSerial[$i],
                    'commission_rate' => $request->commission[$i],
                    'price' => $request->productPrice[$i],
                    'qty' => $request->productQty[$i],
        			'amount' => $request->amount[$i],
        		];
        	}                
        	ProductIssueList::insert($postData);
        }

        return redirect(route('productIssue.index'))->with('msg','Product Issue Added Successfully');
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

    public function productSerialInfo(Request $request)
    {
        $output = '';

    	$productSerials = LiftingProduct::where('product_id',$request->productId)->get();

        if ($productSerials)
        {
            $output .= '<select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">';
            $output .= '<option value="">Select Serial No</option>';          
            foreach ($productSerials as $productSerial)
            {
                $output .= '<option value="'.$productSerial->serial_no.'">'.$productSerial->serial_no.'</option>';
            }
            $output .= '</select>';         
        }
        else
        {
            $output .= '<select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">';
            $output .= '<option value="">Select Serial No</option>';
            $output .= '</select>';
        }  

        echo $output;
    }

    public function dealerRequisitionInfo(Request $request)
    {
    	$dealerRequisition = DealerRequisition::where('id',$request->dealerRequisitionId)->first();
    	$dealerRequisitionProducts = DealerRequisitionProduct::select('tbl_dealer_requisition_products.*','tbl_products.name as productName','tbl_products.code as productCode')
            ->leftJoin('tbl_products','tbl_products.id','=','tbl_dealer_requisition_products.product_id')
            ->where('requisition_id',$request->dealerRequisitionId)->get();

    	$dealer = DealerSetup::where('id',$dealerRequisition->dealer_id)->first();
    	$productSerials = LiftingProduct::where('status','1')->get();
    	$productIssueLists = ProductIssue::select('tbl_product_issue_lists.*')
    		->join('tbl_product_issue_lists','tbl_product_issue_lists.issue_id','=','tbl_product_issue.id')
    		->where('tbl_product_issue.requisition_id',$request->dealerRequisitionId)
    		->get();

    	// dd($dealer);
    	
        if($request->ajax())
        {
            return response()->json([
                'dealerRequisition'=>$dealerRequisition,
                'dealer'=>$dealer,
                'dealerRequisitionProducts'=>$dealerRequisitionProducts,
                'productSerials'=>$productSerials,
                'productIssueLists'=>$productIssueLists,
            ]);
        }
    }
}
