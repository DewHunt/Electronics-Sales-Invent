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

    	$dealers = DealerSetup::select('tbl_dealers.*')
    		->join('tbl_product_issue','tbl_product_issue.dealer_id','=','tbl_dealers.id')
    		->where('tbl_dealers.status','1')
			->groupBy('tbl_product_issue.dealer_id')
    		->orderBy('tbl_dealers.name','asc')
    		->get();

    	return view('admin.dealerCollection.add')->with(compact('title','formLink','buttonName','dealers'));
	}

    public function save(Request $request)
    {
        // $this->validation($request);
        // dd($request->all());

        $paymentDate = date('Y-m-d', strtotime($request->paymentDate));

        DealerCollection::create( [
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

	public function getDealerInfo(Request $request)
	{
		$productIssueList = ProductIssue::where('dealer_id',$request->dealerId)->first();
		$dealerCollection = DealerCollection::select(DB::raw('SUM(payment_amount) as previousCollection'))
			->where('dealer_id',$request->dealerId)
			// ->groupBy('dealer_id')
			->first();
    	
        if($request->ajax())
        {
            return response()->json([
                'productIssueList'=>$productIssueList,
                'dealerCollection'=>$dealerCollection
            ]);
        }
	}
}