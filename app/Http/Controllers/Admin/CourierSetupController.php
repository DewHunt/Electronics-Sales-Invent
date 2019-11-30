<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CourierSetup;

class CourierSetupController extends Controller
{
    public function index()
    {
    	$title = "Courier Setup";

    	$couriers = CourierSetup::orderBy('name','asc')->get();

    	return view('admin.courierSetup.index')->with(compact('title','couriers'));
    }

    public function addCourier()
    {
    	$title = "Add Courier";
    	$formLink = "courierSetup.save";
    	$buttonName = "Save";

    	return view('admin.courierSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function saveCourier(Request $request)
    {
        $this->validation($request);

        CourierSetup::create( [
        	'code' => $request->code,
            'name' => $request->courierName,
            'phone' => $request->phone,
            'address' => $request->address,           
        ]);

        return redirect(route('courierSetup.index'))->with('msg','Courier Added Successfully');
    }

    public function editCourier($courierId)
    {
    	$title = "Edit Courier";
    	$formLink = "courierSetup.update";
    	$buttonName = "Update";

    	$courier = CourierSetup::where('id',$courierId)->first();

    	return view('admin.courierSetup.edit')->with(compact('title','formLink','buttonName','courier'));
    }

    public function updateCourier(Request $request)
    {
        $this->validation($request);

        $courierId = $request->courierId;

        $courier = CourierSetup::find($courierId);

        $courier->update( [
        	'code' => $request->code,
            'name' => $request->courierName,
            'phone' => $request->phone,
            'address' => $request->address,          
        ]);

        return redirect(route('courierSetup.index'))->with('msg','Courier Updated Successfully');
    }

    public function deleteCourier(Request $request)
    {    	
        CourierSetup::where('id',$request->courierId)->delete();
    }

    public function changeCourierStatus(Request $request)
    {
        $courierId = $request->courierId;
        
        $courier = CourierSetup::find($courierId);

        if ($courier->status == 1)
        {
            $courier->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $courier->update( [               
                'status' => 1                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'code' => 'required',
            'courierName' => 'required',
        ]);
    }
}
