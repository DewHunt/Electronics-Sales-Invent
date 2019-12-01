<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VendorSetup;

class VendorSetupController extends Controller
{
    public function index()
    {
    	$title = "Vendor Setup";

    	$staffs = VendorSetup::orderBy('name','asc')->get();

    	return view('admin.vendorSetup.index')->with(compact('title','staffs'));
    }

    public function addVendor()
    {
    	$title = "Add Vendor";
    	$formLink = "vendorSetup.save";
    	$buttonName = "Save";

    	return view('admin.vendorSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function saveVendor(Request $request)
    {
        $this->validation($request);

        VendorSetup::create( [
        	'code' => $request->code,
            'name' => $request->vendorName,
            'contact_person' => $request->contactPerson,
            'contact' => $request->contact,           
            'email' => $request->email,
            'address' => $request->address,          
        ]);

        return redirect(route('vendorSetup.index'))->with('msg','Vendor Added Successfully');
    }

    public function editVendor($vendorId)
    {
    	$title = "Edit Vendor";
    	$formLink = "vendorSetup.update";
    	$buttonName = "Update";

    	$vendor = VendorSetup::where('id',$vendorId)->first();

    	return view('admin.vendorSetup.edit')->with(compact('title','formLink','buttonName','vendor'));
    }

    public function updateVendor(Request $request)
    {
        $this->validation($request);

        $vendorId = $request->vendorId;

        $vendor = VendorSetup::find($vendorId);

        $vendor->update( [
        	'code' => $request->code,
            'name' => $request->vendorName,
            'contact_person' => $request->contactPerson,
            'contact' => $request->contact,           
            'email' => $request->email,
            'address' => $request->address,           
        ]);

        return redirect(route('vendorSetup.index'))->with('msg','Vendor Updated Successfully');
    }

    public function deleteVendor(Request $request)
    {    	
        VendorSetup::where('id',$request->vendorId)->delete();
    }

    public function changeVendorStatus(Request $request)
    {
        $vendorId = $request->vendorId;

        $vendor = VendorSetup::find($vendorId);

        if ($vendor->status == 1)
        {
            $vendor->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $vendor->update( [               
                'status' => 1                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'code' => 'required',
            'vendorName' => 'required',
        ]);
    }
}
