<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CategorySetup;
use App\Product;

use DB;
use PDF;
use MPDF;

class StockValuationController extends Controller
{
	public function index(Request $request)
	{
		$title = "Stock Valuation Report";
		$searchFormLink = "stockValuation.index";
		$printFormLink = "stockValuation.print";

        $productCategory = $request->productCategory;
        $product = $request->product;
        $print = $request->print;

        $categories = CategorySetup::orderBy('name','asc')->get();
        $products = Product::orderBy('name','asc')->get();

        if ($productCategory == "" && $product == "")
        {
            $stockValuationReports = array();
        }
        else
        {
            $stockValuationReports = DB::table('view_stock_valuation')
                ->select('view_stock_valuation.categoryId as categoryId','view_stock_valuation.categoryName as categoryName','view_stock_valuation.productId as productId','view_stock_valuation.productName as productName', 'view_stock_valuation.modelNo as modelNo', 'view_stock_valuation.color as color', DB::raw('SUM(view_stock_valuation.salesAmount) as salesPrice'), DB::raw('SUM(view_stock_valuation.liftingAmount) as price'), DB::raw('(SUM(view_stock_valuation.liftingQty) - SUM(view_stock_valuation.salesQty)) as stockQty'))
                ->orWhere(function($query) use($productCategory,$product){
                    if (@$productCategory)
                    {
                        $query->whereIn('view_stock_valuation.categoryId',$productCategory);
                    }

                    if (@$productCategory)
                    {
                        $query->orWhereIn('view_stock_valuation.categoryParent',$productCategory);
                    }

                    if (@$product)
                    {
                        $query->whereIn('view_stock_valuation.productId',$product);
                    }
                })
                ->groupBy('view_stock_valuation.categoryId','view_stock_valuation.categoryName','view_stock_valuation.productId','view_stock_valuation.productName')
                ->orderBy('productName','asc')
                ->get();
        }

		return view('admin.stockValuation.index')->with(compact('title','searchFormLink','printFormLink','productCategory','product','print','categories','products','stockValuationReports'));
	}

	public function print(Request $request)
	{
		$title = "Print Stock Valuation Report";

        $productCategory = $request->productCategory;
        $product = $request->product;

        if ($productCategory == "" && $product == "")
        {
            $stockValuationReports = array();
        }
        else
        {
            $stockValuationReports = DB::table('view_stock_valuation')
                ->select('view_stock_valuation.categoryId as categoryId','view_stock_valuation.categoryName as categoryName','view_stock_valuation.productId as productId','view_stock_valuation.productName as productName', 'view_stock_valuation.modelNo as modelNo', 'view_stock_valuation.color as color', DB::raw('SUM(view_stock_valuation.salesAmount) as salesPrice'), DB::raw('SUM(view_stock_valuation.liftingAmount) as price'), DB::raw('(SUM(view_stock_valuation.liftingQty) - SUM(view_stock_valuation.salesQty)) as stockQty'))
                ->orWhere(function($query) use($productCategory,$product){
                    if (@$productCategory)
                    {
                        $query->whereIn('view_stock_valuation.categoryId',$productCategory);
                    }

                    if (@$productCategory)
                    {
                        $query->orWhereIn('view_stock_valuation.categoryParent',$productCategory);
                    }

                    if (@$product)
                    {
                        $query->whereIn('view_stock_valuation.productId',$product);
                    }
                })
                ->groupBy('view_stock_valuation.categoryId','view_stock_valuation.categoryName','view_stock_valuation.productId','view_stock_valuation.productName')
                ->orderBy('productName','asc')
                ->get();
        }

        $pdf = PDF::loadView('admin.stockValuation.print',['title'=>$title,'stockValuationReports'=>$stockValuationReports]);

        return $pdf->stream('view_stock_valuation.pdf');
	}
}
