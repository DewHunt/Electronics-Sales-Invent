<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;
use App\CategorySetup;
use App\Product;

use DB;
use PDF;
use MPDF;

class StockStatusController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Stock Status Report";
    	$searchFormLink = "stockStatus.index";
    	$printFormLink = "stockStatus.print";

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	$categories = CategorySetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	$products = Product::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $openingBalance = DB::table('stock_valuation')
            ->select('stock_valuation.categoryId as categoryId', 'stock_valuation.categoryName as categoryName', 'stock_valuation.productId as productId', 'stock_valuation.productName as productName','stock_valuation.modelNo as modelNo','stock_valuation.color as color', DB::raw('(SUM(stock_valuation.liftingQty) - SUM(stock_valuation.liftingReturnQty)) - (SUM(stock_valuation.salesQty) - SUM(stock_valuation.salesReturnQty)) as opening'), DB::raw('0 as liftingQty'), DB::raw('0 as salesQty'), DB::raw('0 as price'))
            ->orWhere(function($query) use($lastDate,$category,$product,$vendor){
                if (!empty($lastDate))
                {
                    $query->where('stock_valuation.date','<=', $lastDate);
                }

                if (@$category)
                {
                    $query->whereIn('stock_valuation.categoryId',$category);
                }

                if (@$category)
                {
                    $query->orWhereIn('stock_valuation.categoryParent',$category);
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation.productId',$product);
                }

                if (@$vendor)
                {
                    $query->whereIn('stock_valuation.vendorId',$vendor);
                }
            })
            ->groupBy('stock_valuation.categoryId','stock_valuation.categoryName','stock_valuation.productId','stock_valuation.productName');

        $stockStatusReports = DB::table('stock_valuation')
            ->select('stock_valuation.categoryId as categoryId','stock_valuation.categoryName as categoryName','stock_valuation.productId as productId','stock_valuation.productName as productName','stock_valuation.modelNo as modelNo','stock_valuation.color as color', DB::raw('0 as opening'), DB::raw('SUM(stock_valuation.liftingQty) as liftingQty'), DB::raw('SUM(stock_valuation.salesQty) as salesQty'), DB::raw('sum(stock_valuation.liftingAmount) as price'))
            ->orWhere(function($query) use($fromDate,$toDate,$category,$product,$vendor){
                if (!empty($fromDate))
                {
                    $query->whereBetween('stock_valuation.date', array($fromDate,$toDate));
                }

                if (@$category)
                {
                    $query->whereIn('stock_valuation.categoryId',$category);
                }

                if (@$category)
                {
                    $query->orWhereIn('stock_valuation.categoryParent',$category);
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation.productId',$product);
                }

                if (@$vendor)
                {
                    $query->whereIn('stock_valuation.vendorId',$vendor);
                }
            })
            ->groupBy('stock_valuation.categoryId','stock_valuation.categoryName','stock_valuation.productId','stock_valuation.productName')
            ->unionAll($openingBalance)
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->get();

    	return view('admin.stockStatus.index')->with(compact('title','searchFormLink','printFormLink','print','vendors','categories','products','vendor','category','product','fromDate','toDate','stockStatusReports'));
    }

    public function print(Request $request)
    {
    	$title = "Stock Status Report";

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        $openingBalance = DB::table('stock_valuation')
            ->select('stock_valuation.categoryId as categoryId', 'stock_valuation.categoryName as categoryName', 'stock_valuation.productId as productId', 'stock_valuation.productName as productName','stock_valuation.modelNo as modelNo','stock_valuation.color as color', DB::raw('(SUM(stock_valuation.liftingQty) - SUM(stock_valuation.liftingReturnQty)) - (SUM(stock_valuation.salesQty) - SUM(stock_valuation.salesReturnQty)) as opening'), DB::raw('0 as liftingQty'), DB::raw('0 as salesQty'), DB::raw('0 as price'))
            ->orWhere(function($query) use($lastDate,$category,$product,$vendor){
                if (!empty($lastDate))
                {
                    $query->where('stock_valuation.date','<=', $lastDate);
                }

                if (@$category)
                {
                    $query->whereIn('stock_valuation.categoryId',$category);
                }

                if (@$category)
                {
                    $query->orWhereIn('stock_valuation.categoryParent',$category);
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation.productId',$product);
                }

                if (@$vendor)
                {
                    $query->whereIn('stock_valuation.vendorId',$vendor);
                }
            })
            ->groupBy('stock_valuation.categoryId','stock_valuation.categoryName','stock_valuation.productId','stock_valuation.productName');

        $stockStatusReports = DB::table('stock_valuation')
            ->select('stock_valuation.categoryId as categoryId','stock_valuation.categoryName as categoryName','stock_valuation.productId as productId','stock_valuation.productName as productName','stock_valuation.modelNo as modelNo','stock_valuation.color as color', DB::raw('0 as opening'), DB::raw('SUM(stock_valuation.liftingQty) as liftingQty'), DB::raw('SUM(stock_valuation.salesQty) as salesQty'), DB::raw('sum(stock_valuation.liftingAmount) as price'))
            ->orWhere(function($query) use($fromDate,$toDate,$category,$product,$vendor){
                if (!empty($fromDate))
                {
                    $query->whereBetween('stock_valuation.date', array($fromDate,$toDate));
                }

                if (@$category)
                {
                    $query->whereIn('stock_valuation.categoryId',$category);
                }

                if (@$category)
                {
                    $query->orWhereIn('stock_valuation.categoryParent',$category);
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation.productId',$product);
                }

                if (@$vendor)
                {
                    $query->whereIn('stock_valuation.vendorId',$vendor);
                }
            })
            ->groupBy('stock_valuation.categoryId','stock_valuation.categoryName','stock_valuation.productId','stock_valuation.productName')
            ->unionAll($openingBalance)
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->get();

        $pdf = PDF::loadView('admin.stockStatus.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'stockStatusReports'=>$stockStatusReports]);

        return $pdf->stream('stock_status_report_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
