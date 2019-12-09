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
		$title = "Product List Preport";
		$searchFormLink = "outOfStock.index";
		$printFormLink = "outOfStock.print";

        $productCategory = $request->productCategory;
        $product = $request->product;
        $print = $request->print;

        $categories = CategorySetup::orderBy('name','asc')->get();
        $products = Product::orderBy('name','asc')->get();

		return view('admin.outOfStock.index')->with(compact('title','searchFormLink','printFormLink','productCategory','product','print','categories','products'));
	}
}
