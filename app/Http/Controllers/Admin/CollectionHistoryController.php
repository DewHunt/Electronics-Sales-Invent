<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\StaffSetup;
use App\Installment;
use App\InstallmentSchedule;

use DB;
use PDF;
use MPDF;

class CollectionHistoryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Collection History";
    	$searchFormLink = "collectionHistory.index";
    	$printFormLink = "collectionHistory.print";
        $tillCollectionDate = Date('Y-m-d',strtotime($request->tillCollectionDate));
        $collectorParameter = $request->collector;
        $print = $request->print;
    	$collectorList = StaffSetup::orderBy('name','asc')->get();
        $collectionHistoryList = DB::table('tbl_installment_collection_list')
                    ->select('tbl_installment_collection_list.*','tbl_installment.installment_collector_id as installmentCollectorId','tbl_installment.installment_collector_name as installmentCollectorName')
                    ->where('tbl_installment_collection_list.installment_collection_date','<=',$tillCollectionDate)
                    ->join('tbl_installment','tbl_installment.id','=','tbl_installment_collection_list.installment_id')
                    ->where(function($query) use($collectorParameter){
                            if (@$collectorParameter)
                            {
                                $query->whereIn('tbl_installment.installment_collector_id',$collectorParameter);
                            }
                        })
                    ->get();

    	return view('admin.collectionHistory.index')->with(compact('title','searchFormLink','printFormLink','print','collectorList','collectionHistoryList','tillCollectionDate','collectorParameter'));
    }

    public function print(Request $request)
    {
    	$title = "Collection History Report";

    	$tillCollectionDate = $request->tillCollectionDate;
        $collectorParameter = $request->collector;
        $collectorList = StaffSetup::orderBy('name','asc')->get();
        $collectionHistoryList = DB::table('tbl_installment_collection_list')
                    ->select('tbl_installment_collection_list.*','tbl_installment.installment_collector_id as installmentCollectorId','tbl_installment.installment_collector_name as installmentCollectorName')
                    ->where('tbl_installment_collection_list.installment_collection_date','<=',$tillCollectionDate)
                    ->join('tbl_installment','tbl_installment.id','=','tbl_installment_collection_list.installment_id')
                    ->where(function($query) use($collectorParameter){
                            if (@$collectorParameter)
                            {
                                $query->whereIn('tbl_installment.installment_collector_id',$collectorParameter);
                            }
                        })
                    ->get();

        $pdf = PDF::loadView('admin.collectionHistory.print',['title'=>$title,'tillCollectionDate'=>$tillCollectionDate,'collectionHistoryList'=>$collectionHistoryList]);

        return $pdf->stream('drop_collection_list');
    }
}
