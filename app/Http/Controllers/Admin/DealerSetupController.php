<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DealerSetup;
use App\TerritorySetup;
use App\District;
use App\Upazila;

class DealerSetupController extends Controller
{
    public function index()
    {
    	$title = "Dealer Setup";

    	$dealers = DealerSetup::select('tbl_dealers.*','tbl_districts.name as districtName','tbl_districts.bangla_name as districtBanglaName','tbl_upazilas.name as upazilaName','tbl_upazilas.bangla_name as upazilaBanglaName','tbl_territories.name as territoryName')
    		->leftJoin('tbl_districts','tbl_districts.id','=','tbl_dealers.district_id')
    		->leftJoin('tbl_upazilas','tbl_upazilas.id','=','tbl_dealers.upazila_id')
    		->leftJoin('tbl_territories','tbl_territories.id','=','tbl_dealers.territory_id')
    		->orderBy('tbl_districts.name','asc')
    		->orderBy('tbl_upazilas.name','asc')
    		->orderBy('tbl_dealers.name','asc')
    		->get();

    	return view('admin.dealerSetup.index')->with(compact('title','dealers'));
    }

    public function add()
    {
    	$title = "Add Dealer";
    	$formLink = "dealerSetup.save";
    	$buttonName = "Save";

    	$territories = TerritorySetup::where('status','1')->orderBy('name','asc')->get();
    	$districts = District::where('status','1')->orderBy('name','asc')->get();

    	return view('admin.dealerSetup.add')->with(compact('title','formLink','buttonName','territories','districts'));
    }

    public function save(Request $request)
    {
        $this->validation($request);

        DealerSetup::create( [
        	'district_id' => $request->districtId,
        	'upazila_id' => $request->upazilaId,
            'territory_id' => $request->territoryId,
            'type' => $request->dealerType,
            'code' => $request->code,
            'name' => $request->dealerName,
            'contact_person' => $request->contactPerson,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'credit_limit' => $request->creditLimit,      
        ]);

        return redirect(route('dealerSetup.index'))->with('msg','Dealer Added Successfully');
    }

    public function edit($dealerId)
    {
    	$title = "Edit Dealer";
    	$formLink = "dealerSetup.update";
    	$buttonName = "Update";

    	$dealer = DealerSetup::where('id',$dealerId)->first();

    	$territories = TerritorySetup::where('status','1')->orderBy('name','asc')->get();
    	$districts = District::where('status','1')->orderBy('name','asc')->get();
    	$upazilas = Upazila::where('district_id',$dealer->district_id)->where('status','1')->orderBy('name','asc')->get();

    	return view('admin.dealerSetup.edit')->with(compact('title','formLink','buttonName','territories','districts','upazilas','dealer'));
    }

    public function update(Request $request)
    {
    	// dd($request->all());
        $this->validation($request);

        $dealerId = $request->dealerId;

        $dealer = DealerSetup::find($dealerId);

        $dealer->update( [
        	'district_id' => $request->districtId,
        	'upazila_id' => $request->upazilaId,
            'territory_id' => $request->territoryId,
            'type' => $request->dealerType,
            'code' => $request->code,
            'name' => $request->dealerName,
            'contact_person' => $request->contactPerson,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'credit_limit' => $request->creditLimit,      
        ]);

        return redirect(route('dealerSetup.index'))->with('msg','Dealer Updated Successfully');
    }

    public function getAllUpazilaByDistrict(Request $request)
    {
        $output = '';

        $upazilas = Upazila::where('district_id',$request->districtId)->where('status','1')->get();

        if ($upazilas)
        {
            $output .= '<select class="form-control chosen-select" name="upazilaId" id="upazilaId">';
            $output .= '<option value="">Select Upazila</option>';          
            foreach ($upazilas as $upazila)
            {
                $output .= '<option value="'.$upazila->id.'">'.$upazila->name.' / '.$upazila->bangla_name.'</option>';
            }
            $output .= '</select>';         
        }
        else
        {
            $output .= '<select class="form-control chosen-select" name="upazilaId" id="upazilaId">';
            $output .= '<option value="">Select Upazila</option>';
            $output .= '</select>';
        }  

        echo $output;
    }

    public function delete(Request $request)
    {    	
        DealerSetup::where('id',$request->dealerId)->delete();
    }

    public function changeStatus(Request $request)
    {
        $dealer = DealerSetup::find($request->dealerId);

        if ($dealer->status == 1)
        {
            $dealer->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $dealer->update( [               
                'status' => 1                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
        	'dealerName' =>'required',
        ]);
    }
}
