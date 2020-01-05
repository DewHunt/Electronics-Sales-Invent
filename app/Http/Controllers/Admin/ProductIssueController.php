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
use App\CommissionConfiguration;

use DB;
use MPDF;
use PDF;

class ProductIssueController extends Controller
{
	public function index()
	{
		$title = "Product Issue";

		$issuedProducts = ProductIssue::select('tbl_product_issue.*','tbl_dealers.name as dealerName')
			->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_product_issue.dealer_id')
			->orderBy('tbl_product_issue.id','dsc')
			->get();

    	return view('admin.productIssue.index')->with(compact('title','issuedProducts'));
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
            'issue_type' => $request->issueType,
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

	public function edit($issueId)
	{
    	$title = "Edit Product Issue";
    	$formLink = "productIssue.update";
    	$buttonName = "Update";

    	$issuedProduct = ProductIssue::select('tbl_product_issue.*','tbl_dealer_requisitions.requisition_no as requisitionNo')
    		->leftJoin('tbl_dealer_requisitions','tbl_dealer_requisitions.id','=','tbl_product_issue.requisition_id')
    		->where('tbl_product_issue.id',$issueId)->first();

    	$issuedProductLists = ProductIssueList::select('tbl_product_issue_lists.*','tbl_products.name as productName')
    		->leftJoin('tbl_products','tbl_products.id','=','tbl_product_issue_lists.product_id')
    		->where('issue_id',$issueId)->get();

    	return view('admin.productIssue.edit')->with(compact('title','formLink','buttonName','issuedProduct','issuedProductLists'));
	}

    public function update(Request $request)
    {
        // $this->validation($request);
        // dd($request->all());

        $issueDate = date('Y-m-d', strtotime($request->issueDate));

        $productIssue = ProductIssue::find($request->issueId);

        $productIssue->update([
        	'requisition_id' => $request->dealerRequisitionId,
        	'dealer_id' => $request->dealerId,
            'issue_no' => $request->issueType,
            'issue_no' => $request->productIssueNo,
            'date' => $issueDate,
            'total_qty' => $request->totalQty,         
            'total_amount' => $request->totalAmount,         
        ]);

        ProductIssueList::where('issue_id',$request->issueId)->delete();

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

        return redirect(route('productIssue.index'))->with('msg','Product Issue Updated Successfully');
    }

    public function productInfo(Request $request)
    {
    	$product = Product::where('id',$request->productId)->first();

    	$commission = CommissionConfiguration::where('commission_type','Dealer Commission')
    		->where('dealer_id',$request->dealerId)
    		->where('category_id',$product->category_id)
    		->first();
    // dd($commission);

    	if ($commission)
    	{
    		$commissionRate = $commission->commssion_rate;
    	}
    	else
    	{
    		$commissionRate = 0;
    	}
    	
        if($request->ajax())
        {
            return response()->json([
                'product'=>$product,
                'commissionRate'=>$commissionRate
            ]);
        }
    }

    public function productSerialInfo(Request $request)
    {
        $output = '';

    	$productSerials = LiftingProduct::select('tbl_lifting_products.*')
    		->leftJoin('tbl_product_issue_lists','tbl_product_issue_lists.serial_no','=','tbl_lifting_products.serial_no')
    		->whereNull('tbl_product_issue_lists.serial_no')
    		->where('tbl_lifting_products.product_id',$request->productId)
    		->where('tbl_lifting_products.status','1')
    		->get();

        // if ($productSerials)
        // {
        //     $output .= '<select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">';
        //     $output .= '<option value="">Select Serial No</option>';          
        //     foreach ($productSerials as $productSerial)
        //     {
        //         $output .= '<option class="serialNo_'.$productSerial->serial_no.'" id="serialNo_'.$productSerial->serial_no.'" value="'.$productSerial->serial_no.'">'.$productSerial->serial_no.'</option>';
        //     }
        //     $output .= '</select>';         
        // }
        // else
        // {
        //     $output .= '<select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">';
        //     $output .= '<option value="">Select Serial No</option>';
        //     $output .= '</select>';
        // }  

        // echo $output;
    	
        if($request->ajax())
        {
            return response()->json([
                'productSerials'=>$productSerials
            ]);
        }
    }

    public function dealerRequisitionInfo(Request $request)
    {
    	$dealerRequisition = DealerRequisition::where('id',$request->dealerRequisitionId)->first();
    	$dealerRequisitionProducts = DealerRequisitionProduct::select('tbl_dealer_requisition_products.*','tbl_products.name as productName','tbl_products.code as productCode','tbl_products.category_id as categoryId')
            ->leftJoin('tbl_products','tbl_products.id','=','tbl_dealer_requisition_products.product_id')
            ->where('requisition_id',$request->dealerRequisitionId)->get();

    	$dealer = DealerSetup::where('id',$dealerRequisition->dealer_id)->first();

    	$productSerials = LiftingProduct::select('tbl_lifting_products.*')
    		->leftJoin('tbl_product_issue_lists','tbl_product_issue_lists.serial_no','=','tbl_lifting_products.serial_no')
    		->whereNull('tbl_product_issue_lists.serial_no')
    		->where('tbl_lifting_products.status','1')
    		->get();

    	// dd($productSerials);

    	$productIssueLists = ProductIssue::select('tbl_product_issue_lists.*')
    		->join('tbl_product_issue_lists','tbl_product_issue_lists.issue_id','=','tbl_product_issue.id')
    		->where('tbl_product_issue.requisition_id',$request->dealerRequisitionId)
    		->get();

    	$allCommissions = CommissionConfiguration::where('commission_type','Dealer Commission')
    		->where('dealer_id',$dealerRequisition->dealer_id)
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
                'allCommissions'=>$allCommissions
            ]);
        }
    }

    public function printChalan($productIssueId){

    	$title = "Print Chalan";

    	$productIssue = ProductIssue::select('tbl_product_issue.*','tbl_dealers.name as dealerName','tbl_dealers.code as dealerCode','tbl_dealers.address as dealerAddress','tbl_dealers.mobile as dealerMobile','tbl_districts.name as districtsEnglishName','tbl_districts.bangla_name as districtsBanglaName','tbl_upazilas.name as upazilaEnglishName','tbl_upazilas.bangla_name as upazilaBanglaName')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_product_issue.dealer_id')
    		->leftJoin('tbl_districts','tbl_districts.id','=','tbl_dealers.district_id')
    		->leftJoin('tbl_upazilas','tbl_upazilas.id','=','tbl_dealers.upazila_id')
    		->first();

    	$productIssueLists = ProductIssueList::select('tbl_product_issue_lists.*','tbl_products.name as productName')
	    	->leftJoin('tbl_products','tbl_products.id','=','tbl_product_issue_lists.product_id')
	    	->where('tbl_product_issue_lists.issue_id',$productIssueId)
	    	->get();

	    	// dd($productIssueLists);

    	$pdf = PDF::loadView('admin.productIssue.printChalan',['title'=>$title,'productIssue'=>$productIssue,'productIssueLists'=>$productIssueLists]);

    	return $pdf->stream('product_issue_'.$productIssue->issue_no.'.pdf');
    }

    public function delete(Request $request)
    {

        ProductIssue::where('id',$request->productIssueId)->delete();

        ProductIssueList::where('issue_id',$request->productIssueId)->delete();
    }
}
