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

        $stockValuationReports = array();

        $stockValuationReports = DB::table('stock_valuation')
            ->select('stock_valuation.categoryId as categoryId','stock_valuation.categoryName as categoryName','stock_valuation.productId as productId','stock_valuation.productName as productName', 'stock_valuation.modelNo as modelNo', 'stock_valuation.color as color', DB::raw('SUM(stock_valuation.salesAmount) as salesPrice'), DB::raw('SUM(stock_valuation.liftingAmount) as price'), DB::raw('(SUM(stock_valuation.liftingQty) - SUM(stock_valuation.salesQty)) as stockQty'))
            ->orWhere(function($query) use($productCategory,$product){
                if (@$productCategory)
                {
                    $query->whereIn('stock_valuation.categoryId',$productCategory);
                }

                if (@$productCategory)
                {
                    $query->orWhereIn('stock_valuation.categoryParent',$productCategory);
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation.productId',$product);
                }
            })
            ->groupBy('stock_valuation.categoryId','stock_valuation.categoryName','stock_valuation.productId','stock_valuation.productName')
            ->orderBy('productName','asc')
            ->get();

		return view('admin.stockValuation.index')->with(compact('title','searchFormLink','printFormLink','productCategory','product','print','categories','products','stockValuationReports'));
	}

	public function print(Request $request)
	{
		$title = "Print Stock Valuation Report";

        $productCategory = $request->productCategory;
        $product = $request->product;

        $stockValuationReports = array();

        $stockValuationReports = DB::table('stock_valuation')
            ->select('stock_valuation.categoryId as categoryId','stock_valuation.categoryName as categoryName','stock_valuation.productId as productId','stock_valuation.productName as productName', 'stock_valuation.modelNo as modelNo', 'stock_valuation.color as color', DB::raw('SUM(stock_valuation.salesAmount) as salesPrice'), DB::raw('SUM(stock_valuation.liftingAmount) as price'), DB::raw('(SUM(stock_valuation.liftingQty) - SUM(stock_valuation.salesQty)) as stockQty'))
            ->orWhere(function($query) use($productCategory,$product){
                if (@$productCategory)
                {
                    $query->whereIn('stock_valuation.categoryId',$productCategory);
                }

                if (@$productCategory)
                {
                    $query->orWhereIn('stock_valuation.categoryParent',$productCategory);
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation.productId',$product);
                }
            })
            ->groupBy('stock_valuation.categoryId','stock_valuation.categoryName','stock_valuation.productId','stock_valuation.productName')
            ->orderBy('productName','asc')
            ->get();

        $pdf = PDF::loadView('admin.stockValuation.print',['title'=>$title,'stockValuationReports'=>$stockValuationReports]);

        return $pdf->stream('stock_valuation.pdf');
	}
}
