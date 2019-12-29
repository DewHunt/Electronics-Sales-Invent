<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;

use DB;
use PDF;
use MPDF;

class ProductStatementController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Product Statement Report";
    	$searchFormLink = "productStatement.index";
    	$printFormLink = "productStatement.print";

    	$product = $request->product;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

    	$products = Product::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $openingBalance = DB::table('view_product_statement')
            ->select(DB::raw('((SUM(view_product_statement.liftingPrice) + SUM(view_product_statement.productReturnPrice) + SUM(view_product_statement.slaesReturnPrice)) - (SUM(view_product_statement.liftingReturnPrice) + SUM(view_product_statement.productIssuePrice) + SUM(view_product_statement.salesPrice))) as opening'))
            ->orWhere(function($query) use($lastDate,$product){
                if (!empty($lastDate))
                {
                    $query->where('view_product_statement.date','<=', $lastDate);
                }

                if (@$product)
                {
                    $query->where('view_product_statement.productId',$product);
                }
            })
            ->first();

        $productStatements = DB::table('view_product_statement')
            ->select('view_product_statement.date as date','view_product_statement.productId as productId','view_product_statement.productName as productName', DB::raw('SUM(view_product_statement.liftingPrice) as liftingPrice'), DB::raw('SUM(view_product_statement.liftingReturnPrice) as liftingReturnPrice'), DB::raw('sum(view_product_statement.productIssuePrice) as productIssuePrice'),DB::raw('SUM(view_product_statement.productReturnPrice) as productReturnPrice'),DB::raw('SUM(view_product_statement.salesPrice) as salesPrice'),DB::raw('SUM(view_product_statement.slaesReturnPrice) as slaesReturnPrice'))
            ->orWhere(function($query) use($fromDate,$toDate,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_product_statement.date', array($fromDate,$toDate));
                }

                if (@$product)
                {
                    $query->where('view_product_statement.productId',$product);
                }
            })
            ->groupBy('view_product_statement.date')
            ->get();

        // echo $openingBalance->opening; exit();

    	return view('admin.productStatement.index')->with(compact('title','searchFormLink','printFormLink','print','products','product','fromDate','toDate','openingBalance','productStatements'));
    }

    public function print(Request $request)
    {
    	$title = "Product Statement Report";

    	$product = $request->product;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        $productName = Product::where('id',$product)->first();

        $openingBalance = DB::table('view_product_statement')
            ->select(DB::raw('((SUM(view_product_statement.liftingPrice) + SUM(view_product_statement.productReturnPrice) + SUM(view_product_statement.slaesReturnPrice)) - (SUM(view_product_statement.liftingReturnPrice) + SUM(view_product_statement.productIssuePrice) + SUM(view_product_statement.salesPrice))) as opening'))
            ->orWhere(function($query) use($lastDate,$product){
                if (!empty($lastDate))
                {
                    $query->where('view_product_statement.date','<=', $lastDate);
                }

                if (@$product)
                {
                    $query->where('view_product_statement.productId',$product);
                }
            })
            ->first();

        $productStatements = DB::table('view_product_statement')
            ->select('view_product_statement.date as date','view_product_statement.productId as productId','view_product_statement.productName as productName', DB::raw('SUM(view_product_statement.liftingPrice) as liftingPrice'), DB::raw('SUM(view_product_statement.liftingReturnPrice) as liftingReturnPrice'), DB::raw('sum(view_product_statement.productIssuePrice) as productIssuePrice'),DB::raw('SUM(view_product_statement.productReturnPrice) as productReturnPrice'),DB::raw('SUM(view_product_statement.salesPrice) as salesPrice'),DB::raw('SUM(view_product_statement.slaesReturnPrice) as slaesReturnPrice'))
            ->orWhere(function($query) use($fromDate,$toDate,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_product_statement.date', array($fromDate,$toDate));
                }

                if (@$product)
                {
                    $query->where('view_product_statement.productId',$product);
                }
            })
            ->groupBy('view_product_statement.date')
            ->get();

        $pdf = PDF::loadView('admin.productStatement.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'productName'=>$productName,'openingBalance'=>$openingBalance,'productStatements'=>$productStatements]);

        return $pdf->stream('product_statement_report_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
