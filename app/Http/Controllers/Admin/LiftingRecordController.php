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
    	$title = "Lifting Report";
    	$searchFormLink = "liftingRecord.index";
    	$printFormLink = "liftingRecord.print";

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
        $btnSummary = $request->btnSummary;
        $btnRecord = $request->btnRecord;

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

        if ($request->btnSummary == "Summary")
        {
            $liftingSummaries = DB::table('view_lifting_record')
                ->select('view_lifting_record.productName','view_lifting_record.productModelNo',DB::raw('SUM(view_lifting_record.productQty) as totalLifting'),DB::raw('SUM(view_lifting_record.price) as totalLiftingPrice'))
                ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product,$type,$storeOrShowroomType,$storeOrShowroomId){
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

                    if ($type)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$type);
                    }

                    if ($storeOrShowroomType && $storeOrShowroomId)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$storeOrShowroomType)
                            ->where('view_lifting_record.storeOrShowroomId',$storeOrShowroomId);
                    }
                })
                ->groupBy('view_lifting_record.productId')
                ->orderBy('view_lifting_record.productName','asc')
                ->get();
        }
        else
        {
            $liftingSummaries = "";
        }

        if ($request->btnRecord == "Record")
        {
            $liftingRecords = DB::table('view_lifting_record')
                ->select('view_lifting_record.*')
                ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product,$type,$storeOrShowroomType,$storeOrShowroomId){
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

                    if ($type)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$type);
                    }

                    if ($storeOrShowroomType && $storeOrShowroomId)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$storeOrShowroomType)
                            ->where('view_lifting_record.storeOrShowroomId',$storeOrShowroomId);
                    }
                })
                ->orderBy('view_lifting_record.vendorName','asc')
                ->get();
        }
        else
        {
            $liftingRecords = "";
        }

    	return view('admin.liftingRecord.index')->with(compact('title','searchFormLink','printFormLink','print','btnSummary','btnRecord','vendors','categories','products','storesAndShowrooms','vendor','category','product','type','storeOrShowroomId','storeOrShowroomType','fromDate','toDate','liftingRecords','liftingSummaries'));
    }

    public function print(Request $request)
    {
    	$title = "Print Lifting Record";

        $storeOrShowroomId = $request->storeOrShowroomId;
        $storeOrShowroomType = $request->storeOrShowroomType;

    	$vendor = $request->vendor;
    	$category = $request->category;
    	$product = $request->product;
        $type = $request->type;
    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $btnPrintSummary = $request->btnPrintSummary;
        $btnPrintRecord = $request->btnPrintRecord;

        $vendorName = VendorSetup::where('id',$vendor)->first();

        if ($request->btnPrintSummary == "Print Summary")
        {
            $liftingSummaries = DB::table('view_lifting_record')
                ->select('view_lifting_record.productName','view_lifting_record.productModelNo',DB::raw('SUM(view_lifting_record.productQty) as totalLifting'),DB::raw('SUM(view_lifting_record.price) as totalLiftingPrice'))
                ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product,$type,$storeOrShowroomType,$storeOrShowroomId){
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

                    if ($type)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$type);
                    }

                    if ($storeOrShowroomType && $storeOrShowroomId)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$storeOrShowroomType)
                            ->where('view_lifting_record.storeOrShowroomId',$storeOrShowroomId);
                    }
                })
                ->groupBy('view_lifting_record.productId')
                ->orderBy('view_lifting_record.productName','asc')
                ->get();
        }
        else
        {
            $liftingSummaries = "";
        }

        if ($request->btnPrintRecord == "Print Record")
        {
            $liftingRecords = DB::table('view_lifting_record')
                ->select('view_lifting_record.*')
                ->orWhere(function($query) use($fromDate,$toDate,$vendor,$category,$product,$type,$storeOrShowroomType,$storeOrShowroomId){
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

                    if ($type)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$type);
                    }

                    if ($storeOrShowroomType && $storeOrShowroomId)
                    {
                        $query->where('view_lifting_record.storeOrShowroomType',$storeOrShowroomType)
                            ->where('view_lifting_record.storeOrShowroomId',$storeOrShowroomId);
                    }
                })
                ->orderBy('view_lifting_record.vendorName','asc')
                ->get();
        }
        else
        {
            $liftingRecords = "";
        }

        $pdf = PDF::loadView('admin.liftingRecord.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'btnPrintSummary'=>$btnPrintSummary,'btnPrintRecord'=>$btnPrintRecord,'vendorName'=>$vendorName,'liftingRecords'=>$liftingRecords,'liftingSummaries'=>$liftingSummaries]);

        return $pdf->stream('lifting_record_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
