<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\StaffSetup;

class StaffSetupController extends Controller
{
    public function index()
    {
    	$title = "Staff Setup";

    	$staffs = StaffSetup::orderBy('name','asc')->get();

    	return view('admin.staffSetup.index')->with(compact('title','staffs'));
    }

    public function add()
    {
    	$title = "Add Staff";
    	$formLink = "staffSetup.save";
    	$buttonName = "Save";

    	return view('admin.staffSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function save(Request $request)
    {
        $this->validation($request);

    	$joiningDate = Date('Y-m-d',strtotime($request->joiningDate));

        StaffSetup::create( [
        	'code' => $request->code,
            'name' => $request->staffName,
            'contact' => $request->contact,
            'address' => $request->address,           
            'email' => $request->email,           
            'national_id' => $request->nationalId,           
            'joining_date' => $joiningDate,           
        ]);

        return redirect(route('staffSetup.index'))->with('msg','Staff Added Successfully');
    }

    public function edit($staffId)
    {
    	$title = "Edit Staff";
    	$formLink = "staffSetup.update";
    	$buttonName = "Update";

    	$staff = StaffSetup::where('id',$staffId)->first();

    	return view('admin.staffSetup.edit')->with(compact('title','formLink','buttonName','staff'));
    }

    public function update(Request $request)
    {
        $this->validation($request);

    	$joiningDate = Date('Y-m-d',strtotime($request->joiningDate));
        $staffId = $request->staffId;

        $staff = StaffSetup::find($staffId);

        $staff->update( [
        	'code' => $request->code,
            'name' => $request->staffName,
            'contact' => $request->contact,
            'address' => $request->address,           
            'email' => $request->email,           
            'national_id' => $request->nationalId,           
            'joining_date' => $joiningDate,           
        ]);

        return redirect(route('staffSetup.index'))->with('msg','Staff Updated Successfully');
    }

    public function delete(Request $request)
    {    	
        StaffSetup::where('id',$request->staffId)->delete();
    }

    public function changeStatus(Request $request)
    {
        $staffId = $request->staffId;

        $staff = StaffSetup::find($staffId);

        if ($staff->status == 1)
        {
            $staff->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $staff->update( [               
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
