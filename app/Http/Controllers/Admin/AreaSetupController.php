<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\AreaSetup;

class AreaSetupController extends Controller
{
    public function index()
    {
    	$title = "Area Setup";

    	$allArea = AreaSetup::orderBy('name','asc')->get();

    	return view('admin.areaSetup.index')->with(compact('title','allArea'));
    }

    public function addArea()
    {
    	$title = "Add Area";
    	$formLink = "areaSetup.save";
    	$buttonName = "Save";

    	return view('admin.areaSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function saveArea(Request $request)
    {
        $this->validation($request);

        AreaSetup::create( [
        	'code' => $request->code,
            'name' => $request->areaName,
            'incharge_name' => $request->inchargeName,
            'address' => $request->address,
            'contact' => $request->contact,           
            'email' => $request->email         
        ]);

        return redirect(route('areaSetup.index'))->with('msg','Area Added Successfully');
    }

    public function editArea($areaId)
    {
    	$title = "Edit Bank";
    	$formLink = "areaSetup.update";
    	$buttonName = "Update";

    	$area = AreaSetup::where('id',$areaId)->first();

    	return view('admin.areaSetup.edit')->with(compact('title','formLink','buttonName','area'));
    }

    public function updateArea(Request $request)
    {
        $this->validation($request);

        $areaId = $request->areaId;

        $area = AreaSetup::find($areaId);

        $area->update( [
        	'code' => $request->code,
            'name' => $request->areaName,
            'incharge_name' => $request->inchargeName,
            'address' => $request->address,
            'contact' => $request->contact,           
            'email' => $request->email         
        ]);

        return redirect(route('areaSetup.index'))->with('msg','Area Updated Successfully');
    }

    public function deleteArea(Request $request)
    {    	
        AreaSetup::where('id',$request->areaId)->delete();
    }

    public function changeAreaStatus(Request $request)
    {
        $areaId = $request->areaId;

        $area = AreaSetup::find($areaId);

        if ($area->status == 1)
        {
            $area->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $area->update( [               
                'status' => 1                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'code' => 'required',
            'areaName' => 'required',
        ]);
    }
}
