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

class LiftingReturnRecordController extends Controller
{
    public function index(Request $request)
    {
    	// dd($request->all());
    	$title = "Lifting Return History";
    	$searchFormLink = "liftingReturnRecord.index";
    	$printFormLink = "liftingReturnRecord.print";

        if ($request->storeOrShowroom)
        {
	        $storesOrShowrooms = explode(',',$request->storeOrShowroom);
	        $storeOrShowroomId = $storesOrShowrooms[0];
	        $storeOrShowroomType = $storesOrShowrooms[1];
        }
        else
        {
	        $storeOrShowroomId = "";
	        $storeOrShowroomType = "";        	
        }

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
    	$type = $request->type;
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

        $storesAndShowrooms = DB::table('view_store_and_showroom')
            ->orderBy('type','asc')
            ->orderBy('name','asc')
            ->get();

        $liftingReturnRecords = DB::table('view_lifting_return_record')
            ->select('view_lifting_return_record.*')
            ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product,$type,$storeOrShowroomType,$storeOrShowroomId){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_lifting_return_record.liftingReturnDate', array($fromDate,$toDate));
                }

                if ($vendor)
                {
                    $query->whereIn('view_lifting_return_record.vendorId',$vendor);
                }

                if ($category)
                {
                    $query->whereIn('view_lifting_return_record.categoryId',$category);
                }

                if ($category)
                {
                    $query->orWhereIn('view_lifting_return_record.parentId',$category);
                }

                if ($product)
                {
                    $query->whereIn('view_lifting_return_record.productId',$product);
                }

                if ($type)
                {
                    $query->where('view_lifting_return_record.storeOrShowroomType',$type);
                }

                if ($storeOrShowroomType && $storeOrShowroomId)
                {
                    $query->where('view_lifting_return_record.storeOrShowroomType',$storeOrShowroomType)
                    	->where('view_lifting_return_record.storeOrShowroomId',$storeOrShowroomId);
                }                
            })
            ->get();

    	return view('admin.liftingReturnRecord.index')->with(compact('title','searchFormLink','printFormLink','print','vendors','categories','products','storesAndShowrooms','vendor','category','product','type','storeOrShowroomId','storeOrShowroomType','fromDate','toDate','liftingReturnRecords'));
    }

    public function print(Request $request)
    {
    	$title = "Print Lifting Return History";

    	$storeOrShowroomType = $request->storeOrShowroomType;
    	$storeOrShowroomId = $request->storeOrShowroomId;

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
    	$type = $request->type;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));

        $liftingReturnRecords = DB::table('view_lifting_return_record')
            ->select('view_lifting_return_record.*')
            ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product,$type,$storeOrShowroomType,$storeOrShowroomId){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_lifting_return_record.liftingReturnDate', array($fromDate,$toDate));
                }

                if ($vendor)
                {
                    $query->whereIn('view_lifting_return_record.vendorId',$vendor);
                }

                if ($category)
                {
                    $query->whereIn('view_lifting_return_record.categoryId',$category);
                }

                if ($category)
                {
                    $query->orWhereIn('view_lifting_return_record.parentId',$category);
                }

                if ($product)
                {
                    $query->whereIn('view_lifting_return_record.productId',$product);
                }

                if ($type)
                {
                    $query->where('view_lifting_return_record.storeOrShowroomType',$type);
                }

                if ($storeOrShowroomType && $storeOrShowroomId)
                {
                    $query->where('view_lifting_return_record.storeOrShowroomType',$storeOrShowroomType)
                    	->where('view_lifting_return_record.storeOrShowroomId',$storeOrShowroomId);
                }                
            })
            ->get();

        $pdf = PDF::loadView('admin.liftingReturnRecord.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'liftingReturnRecords'=>$liftingReturnRecords]);

        return $pdf->stream('lifting_return_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
