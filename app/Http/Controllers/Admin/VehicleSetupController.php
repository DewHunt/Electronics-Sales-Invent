<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VehicleSetup;

class VehicleSetupController extends Controller
{
    public function index()
    {
    	$title = "Vehicle Setup";

    	$vehicles = VehicleSetup::orderBy('type','asc')->get();

    	return view('admin.vehicleSetup.index')->with(compact('title','vehicles'));
    }

    public function addVehicle()
    {
    	$title = "Add Vehicle";
    	$formLink = "vehicleSetup.save";
    	$buttonName = "Save";

    	return view('admin.vehicleSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function saveVehicle(Request $request)
    {
        $this->validation($request);

        VehicleSetup::create( [
        	'registration_no' => $request->registrationNo,
            'type' => $request->type,
            'capacity' => $request->capacity,         
        ]);

        return redirect(route('vehicleSetup.index'))->with('msg','Vehicle Added Successfully');
    }

    public function editVehicle($vehicleId)
    {
    	$title = "Edit Vehicle";
    	$formLink = "vehicleSetup.update";
    	$buttonName = "Update";

    	$vehicle = VehicleSetup::where('id',$vehicleId)->first();

    	return view('admin.vehicleSetup.edit')->with(compact('title','formLink','buttonName','vehicle'));
    }

    public function updateVehicle(Request $request)
    {
        $this->validation($request);

        $vehicleId = $request->vehicleId;

        $vehicle = VehicleSetup::find($vehicleId);

        $vehicle->update( [
        	'registration_no' => $request->registrationNo,
            'type' => $request->type,
            'capacity' => $request->capacity,         
        ]);

        return redirect(route('vehicleSetup.index'))->with('msg','Vehicle Updated Successfully');
    }

    public function deleteVehicle(Request $request)
    {    	
        VehicleSetup::where('id',$request->vehicleId)->delete();
    }

    public function changeVehicleStatus(Request $request)
    {
        $vehicleId = $request->vehicleId;
        
        $vehicle = VehicleSetup::find($vehicleId);

        if ($vehicle->status == 1)
        {
            $vehicle->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $vehicle->update( [               
                'status' => 1                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'registrationNo' => 'required',
        ]);
    }
}
