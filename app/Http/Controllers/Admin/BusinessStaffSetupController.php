<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BusinessStaffSetup;

class BusinessStaffSetupController extends Controller
{
    public function index()
    {
    	$title = "Business Staff Setup";

    	$businessStaffs = BusinessStaffSetup::orderBy('name','asc')->get();

    	return view('admin.businessStaffSetup.index')->with(compact('title','businessStaffs'));
    }

    public function addBusinessStaff()
    {
    	$title = "Add Business Staff";
    	$formLink = "businessStaffSetup.save";
    	$buttonName = "Save";

    	return view('admin.businessStaffSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function saveBusinessStaff(Request $request)
    {
        $this->validation($request);

    	$joiningDate = Date('Y-m-d',strtotime($request->joiningDate));

        BusinessStaffSetup::create( [
        	'code' => $request->code,
            'name' => $request->staffName,
            'contact' => $request->contact,
            'address' => $request->address,           
            'email' => $request->email,           
            'national_id' => $request->nationalId,           
            'joining_date' => $joiningDate,           
        ]);

        return redirect(route('businessStaffSetup.index'))->with('msg','Staff Added Successfully');
    }

    public function editBusinessStaff($businessStaffId)
    {
    	$title = "Edit Business Staff";
    	$formLink = "businessStaffSetup.update";
    	$buttonName = "Update";

    	$businessStaff = BusinessStaffSetup::where('id',$businessStaffId)->first();

    	return view('admin.businessStaffSetup.edit')->with(compact('title','formLink','buttonName','businessStaff'));
    }

    public function updateBusinessStaff(Request $request)
    {
        $this->validation($request);

    	$joiningDate = Date('Y-m-d',strtotime($request->joiningDate));
        $businessStaffId = $request->businessStaffId;

        $businessStaff = BusinessStaffSetup::find($businessStaffId);

        $businessStaff->update( [
        	'code' => $request->code,
            'name' => $request->staffName,
            'contact' => $request->contact,
            'address' => $request->address,           
            'email' => $request->email,           
            'national_id' => $request->nationalId,           
            'joining_date' => $joiningDate,           
        ]);

        return redirect(route('businessStaffSetup.index'))->with('msg','Staff Updated Successfully');
    }

    public function deleteBusinessStaff(Request $request)
    {    	
        BusinessStaffSetup::where('id',$request->businessStaffId)->delete();
    }

    public function changeBusinessStaffStatus(Request $request)
    {
        $businessStaffId = $request->businessStaffId;

        $businessStaff = BusinessStaffSetup::find($businessStaffId);

        if ($businessStaff->status == 1)
        {
            $businessStaff->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $businessStaff->update( [               
                'status' => 1                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'code' => 'required',
            'staffName' => 'required',
        ]);
    }
}
