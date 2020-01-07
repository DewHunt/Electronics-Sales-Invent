<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\DealerCollection;

use DB;
use MPDF;
use PDF;

class DealerCollectionHistoryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Dealer Collection History";
    	$searchFormLink = "dealerCollectionHistory.index";
    	$printFormLink = "dealerCollectionHistory.print";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$dealers = DealerSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $collectionHistories = array();

        $collectionHistories = DealerCollection::select('tbl_dealer_collections.payment_date as date', 'tbl_dealer_collections.dealer_id as dealerId', 'tbl_dealers.name as dealerName', 'tbl_dealer_collections.money_receipt_no as moneyReceiptNo', 'tbl_dealer_collections.money_receipt_type as moneyReceiptType', 'tbl_dealer_collections.payment_amount as paymentAmount')
        	->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_collections.dealer_id')
            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('tbl_dealer_collections.payment_date', array($fromDate,$toDate));
                }

                if ($dealer)
                {
                    $query->whereIn('tbl_dealer_collections.dealer_id',$dealer);
                }
            })
            ->orderBy('tbl_dealers.name','asc')
            ->orderBy('tbl_dealer_collections.payment_date','asc')
            ->get();

    	return view('admin.dealerCollectionHistory.index')->with(compact('title','searchFormLink','printFormLink','print','dealers','dealer','fromDate','toDate','collectionHistories'));
    }

    public function print(Request $request)
    {
    	$title = "Print Dealer Collection History";

    	$dealer = $request->dealer;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $collectionHistories = array();

        $collectionHistories = DealerCollection::select('tbl_dealer_collections.payment_date as date', 'tbl_dealer_collections.dealer_id as dealerId', 'tbl_dealers.name as dealerName', 'tbl_dealer_collections.money_receipt_no as moneyReceiptNo', 'tbl_dealer_collections.money_receipt_type as moneyReceiptType', 'tbl_dealer_collections.payment_amount as paymentAmount')
        	->leftJoin('tbl_dealers','tbl_dealers.id','=','tbl_dealer_collections.dealer_id')
            ->orWhere(function($query) use($fromDate,$toDate,$dealer){
                if (!empty($fromDate))
                {
                    $query->whereBetween('tbl_dealer_collections.payment_date', array($fromDate,$toDate));
                }

                if ($dealer)
                {
                    $query->whereIn('tbl_dealer_collections.dealer_id',$dealer);
                }
            })
            ->orderBy('tbl_dealers.name','asc')
            ->orderBy('tbl_dealer_collections.payment_date','asc')
            ->get();

        $pdf = PDF::loadView('admin.dealerCollectionHistory.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'collectionHistories'=>$collectionHistories]);

        return $pdf->stream('dealer_collection_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
