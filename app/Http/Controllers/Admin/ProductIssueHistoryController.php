<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\CategorySetup;

use DB;
use MPDF;
use PDF;

class ProductIssueHistoryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Product Issue History";
    	$searchFormLink = "productIssueHistory.index";
    	$printFormLink = "productIssueHistory.print";

    	$dealer = $request->dealer;
    	$category = $request->category;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$dealers = DealerSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $categories = DB::table('tbl_categories as tab1')
            ->select('tab1.*')
            ->leftJoin('tbl_categories as tab2','tab2.parent','=','tab1.id')
            ->whereNull('tab2.parent')
            ->orderBy('name','asc')
            ->get();

        $productIssueHistories = array();

        $productIssueHistories = DB::table('view_product_issue_history')
        	->select('view_product_issue_history.date as date', 'view_product_issue_history.dealerId as dealerId', 'view_product_issue_history.dealerName as dealerName', 'view_product_issue_history.categoryId as categoryId', 'view_product_issue_history.categoryName as categoryName', 'view_product_issue_history.productId as productId', 'view_product_issue_history.productName as productName', 'view_product_issue_history.modelNo as modelNo', 'view_product_issue_history.productSerialNO as productSerialNO', 'view_product_issue_history.issueQty as issueQty', 'view_product_issue_history.issueAmount as issueAmount')
            ->orWhere(function($query) use($fromDate,$toDate,$dealer,$category){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_product_issue_history.date', array($fromDate,$toDate));
                }

                if ($dealer)
                {
                    $query->whereIn('view_product_issue_history.dealerId',$dealer);
                }

                if ($category)
                {
                    $query->whereIn('view_product_issue_history.categoryId',$category);
                }
            })
            ->orderBy('view_product_issue_history.dealerName','asc')
            ->orderBy('view_product_issue_history.categoryName','asc')
            ->orderBy('view_product_issue_history.productName','asc')
            ->get();

    	return view('admin.productIssueHistory.index')->with(compact('title','searchFormLink','printFormLink','print','dealers','categories','dealer','category','fromDate','toDate','productIssueHistories'));
    }
}
