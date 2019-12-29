<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use PDF;
use MPDF;

class TransferReportController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Transfer History";
    	$searchFormLink = "transferReport.index";
    	$printFormLink = "transferReport.print";

        if ($request->host)
        {
	    	$host = explode(',',$request->host);
	    	$hostId = $host[0];
	    	$hostType = $host[1];
        }
        else
        {
            $hostId = "";
            $hostType = "";          
        }

        if ($request->destination)
        {
	    	$destination = explode(',',$request->destination);
	    	$destinationId = $destination[0];
	    	$destinationType = $destination[1];
        }
        else
        {
            $destinationId = "";
            $destinationType = "";          
        }

    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
        $print = $request->print;        

    	$storeAndShowrooms = DB::table('view_store_and_showroom')->get();

        $transferReports = DB::table('view_transport_record')
            ->select('view_transport_record.*')
            ->orWhere(function($query) use($fromDate,$toDate,$hostType,$hostId,$destinationType,$destinationId){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_transport_record.date', array($fromDate,$toDate));
                }

                if ($hostType && $hostId)
                {
                    $query->where('view_transport_record.hostType',$hostType)
                        ->where('view_transport_record.hostId',$hostId);
                }

                if ($destinationType && $destinationId)
                {
                    $query->where('view_transport_record.destinationType',$destinationType)
                        ->where('view_transport_record.destinationId',$destinationId);
                }
            })
            ->orderBy('view_transport_record.hostId')
            // ->orderBy('view_transport_record.destinationId')
            ->get();

    	return view('admin.transferReport.index')->with(compact('title','searchFormLink','printFormLink','print','storeAndShowrooms','hostId','hostType','destinationId','destinationType','fromDate','toDate','transferReports'));
    }

    public function print(Request $request)
    {
    	$title = "Print Transfer History";

    	$fromDate = date('Y-m-d',strtotime($request->fromDate));
    	$toDate = date('Y-m-d',strtotime($request->toDate));
    	$hostType = $request->hostType;
    	$hostId = $request->hostId;
    	$destinationType = $request->destinationType;
    	$destinationId = $request->destinationId;
        $print = $request->print;

        $transferReports = DB::table('view_transport_record')
            ->select('view_transport_record.*')
            ->orWhere(function($query) use($fromDate,$toDate,$hostType,$hostId,$destinationType,$destinationId){
                if (!empty($fromDate))
                {
                    $query->whereBetween('view_transport_record.date', array($fromDate,$toDate));
                }

                if ($hostType && $hostId)
                {
                    $query->where('view_transport_record.hostType',$hostType)
                        ->where('view_transport_record.hostId',$hostId);
                }

                if ($destinationType && $destinationId)
                {
                    $query->where('view_transport_record.destinationType',$destinationType)
                        ->where('view_transport_record.destinationId',$destinationId);
                }
            })
            ->orderBy('view_transport_record.hostId')
            // ->orderBy('view_transport_record.destinationId')
            ->get();

        $pdf = PDF::loadView('admin.transferReport.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'transferReports'=>$transferReports]);

        return $pdf->stream('transfer_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
