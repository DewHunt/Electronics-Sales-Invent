<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CategorySetup;
use App\Product;

class ProductListController extends Controller
{
	public function index(Request $request)
	{
		$title = "Product List Preport";
		$searchFormLink = "productList.index";
		$printFormLink = "productList.print";

        $productCategory = $request->productCategory;
        // dd($productCategory); exit();
        $product = $request->product;
        // dd($product); exit();

        $categories = CategorySetup::orderBy('name','asc')->get();
        $products = Product::orderBy('name','asc')->get();

        // if ($productCategory == "" && $product == "")
        // {
        // 	$productLists = array();
        // }
        // else
        // {
	        $productLists = Product::select('tbl_categories.name as categoryName','tbl_products.name as productName','tbl_products.price as price','tbl_products.mrp_price as mrpPrice','tbl_products.haire_price as hairePrice')
	        	->join('tbl_categories','tbl_categories.id','=','tbl_products.category_id')
	            ->orWhere(function($query) use($productCategory,$product){
	                if (@$productCategory)
	                {
	                	foreach ($productCategory as $productCategoryInfo)
	                	{
	                    	$query->whereRaw('find_in_set(?,tbl_categories.id)',[$productCategoryInfo]);
	                	}
	                }
	                // if ($productCategory)
	                // {
	                //     $query->whereIn('tbl_categories.id',$productCategory);
	                // }

	                if ($product)
	                {
	                    $query->whereIn('tbl_products.id',$product);
	                }
	            })
	            ->orderBy('categoryName')
	            ->orderBy('productName')
	            ->paginate(5);
        // }

		return view('admin.productList.index')->with(compact('title','searchFormLink','printFormLink','productCategory','product','categories','products','productLists'));
	}
}
