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

class LiftingRecordController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Lifting Record";
    	$searchFormLink = "liftingRecord.index";
    	$printFormLink = "liftingRecord.print";

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;

    	$vendors = VendorSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	$categories = CategorySetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	$products = Product::where('status','1')
    		->orderBy('name','asc')
    		->get();

        $liftingRecords = DB::table('view_lifting_record')
            ->select('view_lifting_record.*')
            ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_lifting_record.liftingDate', array($fromDate,$toDate));
                }

                if ($vendor)
                {
                    $query->whereIn('view_lifting_record.vendorId',$vendor);
                }

                if ($category)
                {
                    $query->whereIn('view_lifting_record.categoryId',$category);
                }

                if ($category)
                {
                    $query->orWhereIn('view_lifting_record.parentId',$category);
                }

                if ($product)
                {
                    $query->whereIn('view_lifting_record.productId',$product);
                }
            })
            ->get();

    	return view('admin.liftingRecord.index')->with(compact('title','searchFormLink','printFormLink','print','vendors','categories','products','vendor','category','product','fromDate','toDate','liftingRecords'));
    }

    public function print(Request $request)
    {
    	$title = "Print Lifting Record";

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $liftingRecords = DB::table('view_lifting_record')
            ->select('view_lifting_record.*')
            ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_lifting_record.liftingDate', array($fromDate,$toDate));
                }

                if ($vendor)
                {
                    $query->whereIn('view_lifting_record.vendorId',$vendor);
                }

                if ($category)
                {
                    $query->whereIn('view_lifting_record.categoryId',$category);
                }

                if ($category)
                {
                    $query->orWhereIn('view_lifting_record.parentId',$category);
                }

                if ($product)
                {
                    $query->whereIn('view_lifting_record.productId',$product);
                }
            })
            ->orderBy('view_lifting_record.liftingDate','asc')
            ->orderBy('view_lifting_record.vendorName','asc')
            ->get();

        $pdf = PDF::loadView('admin.liftingRecord.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'liftingRecords'=>$liftingRecords]);

        return $pdf->stream('lifting_record_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
