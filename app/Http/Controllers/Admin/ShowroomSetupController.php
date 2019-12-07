<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ShowroomSetup;

class ShowroomSetupController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Showroom Setup";
    	$showrooms = ShowroomSetup::orderBy('name','asc')->get();

    	return view('admin.showroomSetup.index')->with(compact('title','showrooms'));
    }

    public function add()
    {
    	$title = "Add New Showroom";
        $formLink = "showroomSetup.save";
        $buttonName = "Save";

    	return view('admin.showroomSetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function save(Request $request)
    {
        $showRoom = ShowroomSetup::create( [
            'prefix' => $request->prefix,            
            'name' => $request->showroomName,            
            'trade_license' => $request->tradeLicense,            
            'vat' => $request->vat,            
            'tin' => $request->tin,            
            'contact_person' => $request->contactPerson,
            'email' => $request->email,                   
            'website' => $request->webSite,                   
            'phone' => $request->phoneNumber,                   
            'fax' => $request->faxNumber,                   
            'address' => $request->address                   
        ]);

        return redirect(route('showroomSetup.index'))->with('msg','Showroom Successfuly Saved');
    }

    public function edit($id)
    {
    	$title = "Edit Showroom";
        $formLink = "showroomSetup.update";
        $buttonName = "Update";
    	$showroom = ShowroomSetup::where('id',$id)->first();

    	return view('admin.showroomSetup.edit')->with(compact('title','formLink','buttonName','showroom'));
    }

    public function update(Request $request)
    {
    	$showroomId = $request->showroomId;
    	$showroom = ShowroomSetup::find($showroomId);

    	$showroom->update([
            'prefix' => $request->prefix,            
            'name' => $request->showroomName,            
            'trade_license' => $request->tradeLicense,            
            'vat' => $request->vat,            
            'tin' => $request->tin,            
            'contact_person' => $request->contactPerson,
            'email' => $request->email,                   
            'website' => $request->webSite,                   
            'phone' => $request->phoneNumber,                   
            'fax' => $request->faxNumber,                   
            'address' => $request->address
    	]);

        return redirect(route('showroomSetup.index'))->with('msg','Showroom Successfuly Updated');
    }

    public function delete(Request $request)
    {
    	ShowroomSetup::where('id',$request->showroomId)->delete();
    }

    public function changeStatus(Request $request)
    {
        $showroomId = $request->showroomId;

        $showroom = ShowroomSetup::find($showroomId);

        if ($showroom->status == 1)
        {
            $showroom->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $showroom->update( [               
                'status' => 1                
            ]);
        }
    }
}
