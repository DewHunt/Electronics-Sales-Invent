<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CompanySetup;

class CompanySetupController extends Controller
{
    public function index()
    {
    	$title = "Company Setup";

    	$company = CompanySetup::first();
    	$companyCount = CompanySetup::count();

    	return view('admin.companySetup.index')->with(compact('title','company','companyCount'));
    }

    public function add()
    {
    	$title = "Add New Company";
        $formLink = "companySetup.save";
        $buttonName = "Save";

    	return view('admin.companySetup.add')->with(compact('title','formLink','buttonName'));
    }

    public function save(Request $request)
    {
        CompanySetup::create( [
            'prefix' => $request->prefix,            
            'name' => $request->companyName,            
            'trade_license' => $request->tradeLicense,            
            'vat' => $request->vat,            
            'tin' => $request->tin,
            'email' => $request->email,                   
            'website' => $request->webSite,                   
            'phone' => $request->phoneNumber,                   
            'fax' => $request->faxNumber,                   
            'address' => $request->address                   
        ]);

        return redirect(route('companySetup.index'))->with('msg','Company Successfuly Saved');
    }

    public function edit($id)
    {
    	$title = "Edit Company";
        $formLink = "companySetup.update";
        $buttonName = "Update";
    	$company = CompanySetup::where('id',$id)->first();

    	return view('admin.companySetup.edit')->with(compact('title','formLink','buttonName','company'));
    }

    public function update(Request $request)
    {
    	$companyId = $request->companyId;
    	$company = CompanySetup::find($companyId);

    	$company->update([
            'prefix' => $request->prefix,            
            'name' => $request->companyName,            
            'trade_license' => $request->tradeLicense,            
            'vat' => $request->vat,            
            'tin' => $request->tin,
            'email' => $request->email,                   
            'website' => $request->webSite,                   
            'phone' => $request->phoneNumber,                   
            'fax' => $request->faxNumber,                   
            'address' => $request->address
    	]);

        return redirect(route('companySetup.index'))->with('msg','Company Successfuly Updated');
    }
}
