<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CategorySetup;
use App\Product;

use DB;
use PDF;
use MPDF;

class OutOfStockController extends Controller
{
	public function index(Request $request)
	{
		$title = "Out Of Stock";
		$searchFormLink = "outOfStock.index";
		$printFormLink = "outOfStock.print";

        $productCategory = $request->productCategory;
        $product = $request->product;
        $print = $request->print;

        $categories = CategorySetup::orderBy('name','asc')->get();
        $products = Product::orderBy('name','asc')->get();

        if ($productCategory == "" && $product == "")
        {
        	$stockOutReports = array();
        }
        else
        {
	        $stockOutReports = DB::table('view_stock_valuation')
	            ->select('view_stock_valuation.categoryId as categoryId','view_stock_valuation.categoryName as categoryName','view_stock_valuation.productId as productId','view_stock_valuation.productName as productName','view_stock_valuation.modelNo as modelNo','view_stock_valuation.color as color','view_stock_valuation.reorderQty as reorderQty', DB::raw('(SUM(view_stock_valuation.liftingQty) - SUM(view_stock_valuation.salesQty)) as remainingQty'))
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
	            ->orderBy('categoryId','asc')
	            ->orderBy('productId','asc')
	            ->get();
        }

		return view('admin.outOfStock.index')->with(compact('title','searchFormLink','printFormLink','productCategory','product','print','categories','products','stockOutReports'));
	}

	public function print(Request $request)
	{
		$title = "Print Out Of Stock";

        $productCategory = $request->productCategory;
        $product = $request->product;

        $stockOutReports = DB::table('view_stock_valuation')
            ->select('view_stock_valuation.categoryId as categoryId','view_stock_valuation.categoryName as categoryName','view_stock_valuation.productId as productId','view_stock_valuation.productName as productName','view_stock_valuation.modelNo as modelNo','view_stock_valuation.color as color','view_stock_valuation.reorderQty as reorderQty', DB::raw('(SUM(view_stock_valuation.liftingQty) - SUM(view_stock_valuation.salesQty)) as remainingQty'))
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
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->get();

        $pdf = PDF::loadView('admin.outOfStock.print',['title'=>$title,'stockOutReports'=>$stockOutReports]);

        return $pdf->stream('out_of_stock.pdf');
	}
}
