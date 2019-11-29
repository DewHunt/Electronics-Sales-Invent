<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\StoreSetup;

class StoreSetupController extends Controller
{
    public function index()
    {
    	$title = "Store Setup";

    	$stores = StoreSetup::orderBy('name','asc')->get();

    	return view('admin.storeSetup.index')->with(compact('title','stores'));
    }

    public function addStore(Request $request)
    {
    	$title = "Add Store";
    	$formLink = "storeSetup.save";
    	$buttonName = "Save";

    	return view('admin.storeSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function saveStore(Request $request)
    {
        $this->validation($request);

        $types = implode(',', $request->type);

        StoreSetup::create( [
        	'code' => $request->code,
        	'type' => $types,
            'name' => $request->storeName,
            'address' => $request->address,
            'remarks' => $request->remarks,           
        ]);

        return redirect(route('storeSetup.index'))->with('msg','Store Added Successfully');
    }

    public function editStore($storeId)
    {
    	$title = "Edit Store";
    	$formLink = "storeSetup.update";
    	$buttonName = "Update";

    	$store = StoreSetup::where('id',$storeId)->first();

    	return view('admin.storeSetup.edit')->with(compact('title','formLink','buttonName','store'));
    }

    public function updateStore(Request $request)
    {
        $this->validation($request);

        $storeId = $request->storeId;
        $types = implode(',', $request->type);

        $store = StoreSetup::find($storeId);

        $store->update( [
        	'code' => $request->code,
        	'type' => $types,
            'name' => $request->storeName,
            'address' => $request->address,
            'remarks' => $request->remarks,           
        ]);

        return redirect(route('storeSetup.index'))->with('msg','Store Updated Successfully');
    }

    public function deleteStore(Request $request)
    {    	
        StoreSetup::where('id',$request->storeId)->delete();
    }

    public function changeStoreStatus(Request $request)
    {
    	echo "highlight_string(str)";
        // $storeId = $request->storeId;

        // $storeInfo = StoreSetup::where('id',$storeId)->first();

        // $store = StoreSetup::find($storeId);

        // if ($storeInfo->status == 1)
        // {
        //     $store->update( [               
        //         'status' => 0                
        //     ]);
        // }
        // else
        // {
        //     $store->update( [               
        //         'status' => 1                
        //     ]);
        // }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'code' => 'required',
            'storeName' => 'required|string',
            'type' => 'required'          
        ]);
    }
}
