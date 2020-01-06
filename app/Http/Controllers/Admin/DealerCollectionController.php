<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerCollection;
use App\DealerSetup;
use App\ProductIssue;
use App\ProductIssueList;

use DB;
use MPDF;
use PDF;

class DealerCollectionController extends Controller
{
	public function index()
	{
		$title = "Dealer Collection";

		$dealerCollections = DealerCollection::select('tbl_dealer_collections.*','tbl_dealers.name as dealerName','tbl_dealers.mobile as dealerMobile')
			->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_collections.dealer_id')
			->orderBy('tbl_dealer_collections.id','dsc')
			->get();

    	return view('admin.dealerCollection.index')->with(compact('title','dealerCollections'));
	}

	public function add()
	{
    	$title = "Add Dealer Collection";
    	$formLink = "dealerCollection.save";
    	$buttonName = "Save";

    	$dealers = DealerSetup::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.dealerCollection.add')->with(compact('title','formLink','buttonName','dealers'));
	}

    public function save(Request $request)
    {
        $paymentDate = date('Y-m-d', strtotime($request->paymentDate));

        DealerCollection::create( [
        	'product_issue_id' => $request->productIssue,
        	'dealer_id' => $request->dealer,
        	'payment_no' => $request->paymentNo,
            'payment_date' => $paymentDate,
            'money_receipt_no' => $request->moneyReceiptNo,
            'money_receipt_type' => $request->moneyReceiptType,
            'payment_amount' => $request->newPaid,         
            'remarks' => $request->remarks,         
        ]);

        return redirect(route('dealerCollection.index'))->with('msg','Dealer Collection Added Successfully');
    }

	public function edit($dealerCollectionId)
	{
    	$title = "Edit Dealer Collection";
    	$formLink = "dealerCollection.update";
    	$buttonName = "Update";

    	$dealerCollection = DealerCollection::select('tbl_dealer_collections.*','tbl_dealers.name as dealerName','tbl_product_issue.issue_no as productIssueNo')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_collections.dealer_id')
    		->leftJoin('tbl_product_issue','tbl_product_issue.id','=','tbl_dealer_collections.product_issue_id')
    		->where('tbl_dealer_collections.id',$dealerCollectionId)
    		->where('tbl_dealer_collections.status','1')
    		->first();

		$productIssueList = ProductIssue::where('id',$dealerCollection->product_issue_id)->first();
		$previousDealerCollection = DealerCollection::select(DB::raw('SUM(payment_amount) as previousCollection'))
			->where('product_issue_id',$dealerCollection->product_issue_id)
			->first();

    	return view('admin.dealerCollection.edit')->with(compact('title','formLink','buttonName','dealerCollection','productIssueList','previousDealerCollection'));
	}

    public function update(Request $request)
    {
        // $this->validation($request);
        // dd($request->all());

        $dealerCollection = DealerCollection::find($request->dealerCollectionId);

        $paymentDate = date('Y-m-d', strtotime($request->paymentDate));

        $dealerCollection->update( [
        	'dealer_id' => $request->dealer,
        	'payment_no' => $request->paymentNo,
            'payment_date' => $paymentDate,
            'money_receipt_no' => $request->moneyReceiptNo,
            'money_receipt_type' => $request->moneyReceiptType,
            'payment_amount' => $request->newPaid,         
            'remarks' => $request->remarks,         
        ]);

        return redirect(route('dealerCollection.index'))->with('msg','Dealer Collection Updated Successfully');
    }

    public function printMoneyReceipt($dealerCollectionId)
    {
        $title = "Money Receipt";

    	$dealerCollection = DealerCollection::select('tbl_dealer_collections.*','tbl_dealers.name as dealerName','tbl_product_issue.issue_no as productIssueNo')
    		->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_collections.dealer_id')
    		->leftJoin('tbl_product_issue','tbl_product_issue.id','=','tbl_dealer_collections.product_issue_id')
    		->where('tbl_dealer_collections.id',$dealerCollectionId)
    		->where('tbl_dealer_collections.status','1')
    		->first();

		$productIssueList = ProductIssue::where('id',$dealerCollection->product_issue_id)->first();
		$previousDealerCollection = DealerCollection::select(DB::raw('SUM(payment_amount) as previousCollection'))
			->where('product_issue_id',$dealerCollection->product_issue_id)
			->first();

        $pdf = PDF::loadView('admin.dealerCollection.print',['title'=>$title,'dealerCollection'=>$dealerCollection,'productIssueList'=>$productIssueList,'previousDealerCollection'=>$previousDealerCollection]);

        return $pdf->stream('dealer_collection_money_receipt.pdf');
    }

    public function getProductIssueInfo(Request $request)
    {
    	$productIssues = ProductIssue::where('dealer_id',$request->dealerId)->where('status','1')->get();

    	$output = "";

        if ($productIssues)
        {
            $output .= '<select class="form-control chosen-select" id="productIssue" name="productIssue">';
            $output .= '<option value="">Select Product Issue No.</option>';          
            foreach ($productIssues as $productIssue)
            {
                $output .= '<option value="'.$productIssue->id.'">'.$productIssue->issue_no.'</option>';
            }
            $output .= '</select>';         
        }
        else
        {
            $output .= '<select class="form-control chosen-select" id="productIssue" name="productIssue">';
            $output .= '<option value="">Select Product Issue No.</option>';
            $output .= '</select>';
        }  

        echo $output;
    }

	public function getDealerInfo(Request $request)
	{
		$productIssueList = ProductIssue::where('id',$request->productIssueId)->first();
		$dealerCollection = DealerCollection::select(DB::raw('SUM(payment_amount) as previousCollection'))
			->where('product_issue_id',$request->productIssueId)
			->first();
    	
        if($request->ajax())
        {
            return response()->json([
                'productIssueList'=>$productIssueList,
                'dealerCollection'=>$dealerCollection
            ]);
        }
	}

    public function delete(Request $request)
    {
        DealerCollection::where('id',$request->dealerCollectionId)->delete();
    }
}