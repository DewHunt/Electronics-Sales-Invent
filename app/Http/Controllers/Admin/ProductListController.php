<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CategorySetup;
use App\Product;

use DB;
use PDF;
use MPDF;

class ProductListController extends Controller
{
	public function index(Request $request)
	{
		$title = "Product List Preport";
		$searchFormLink = "productList.index";
		$printFormLink = "productList.print";

        $productCategory = $request->productCategory;
        $product = $request->product;
        $print = $request->print;

        $categories = CategorySetup::orderBy('name','asc')->get();
        $products = Product::orderBy('name','asc')->get();

        if ($productCategory == "" && $product == "")
        {
        	$productLists = array();
        }
        else
        {
	        $productLists = Product::select('tbl_categories.name as categoryName','tbl_products.name as productName','tbl_products.price as price','tbl_products.mrp_price as mrpPrice','tbl_products.haire_price as hairePrice')
	        	->join('tbl_categories','tbl_categories.id','=','tbl_products.category_id')
	            ->orWhere(function($query) use($productCategory,$product){
	                if (@$productCategory)
	                {
	                	foreach ($productCategory as $productCategoryInfo)
	                	{
	                    	$query->orWhereRaw('find_in_set(?,tbl_products.category_id)',[$productCategoryInfo]);
	                	}
	                }

	                if ($product)
	                {
	                    $query->whereIn('tbl_products.id',$product);
	                }
	            })
	            ->orderBy('categoryName')
	            ->orderBy('productName')
	            ->get();
        }

		return view('admin.productList.index')->with(compact('title','searchFormLink','printFormLink','productCategory','product','print','categories','products','productLists'));
	}

	public function print(Request $request)
	{
		$title = "Print Product List Report";
		$searchFormLink = "productList.index";
		$printFormLink = "productList.print";

        $productCategory = $request->productCategory;
        $product = $request->product;

        if ($productCategory == "" && $product == "")
        {
        	$productLists = array();
        }
        else
        {
	        $productLists = Product::select('tbl_categories.name as categoryName','tbl_products.name as productName','tbl_products.price as price','tbl_products.mrp_price as mrpPrice','tbl_products.haire_price as hairePrice')
	        	->join('tbl_categories','tbl_categories.id','=','tbl_products.category_id')
	            ->orWhere(function($query) use($productCategory,$product){
	                if (@$productCategory)
	                {
	                	foreach ($productCategory as $productCategoryInfo)
	                	{
	                    	$query->orWhereRaw('find_in_set(?,tbl_products.category_id)',[$productCategoryInfo]);
	                	}
	                }

	                if ($product)
	                {
	                    $query->whereIn('tbl_products.id',$product);
	                }
	            })
	            ->orderBy('categoryName')
	            ->orderBy('productName')
	            ->get();
        }

        $pdf = PDF::loadView('admin.productList.print',['title'=>$title,'productLists'=>$productLists]);

        return $pdf->stream('product_lists.pdf');
	}
}
