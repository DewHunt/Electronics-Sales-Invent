<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\GroupSetup;
use App\StaffSetup;

class GroupSetupController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Group Setup";

    	$groups = GroupSetup::select('tbl_groups.*','tbl_staffs.name as teamLeaderName')
    		->join('tbl_staffs','tbl_staffs.id','=','tbl_groups.team_leader')
    		->orderBy('name','asc')
    		->get();

    	return view('admin.groupSetup.index')->with(compact('title','groups'));
    }

    public function add()
    {
    	$title = "Add New Showroom";
        $formLink = "groupSetup.save";
        $buttonName = "Save";

    	$staffs = StaffSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();

    	return view('admin.groupSetup.add')->with(compact('title','formLink','buttonName','staffs'));
    }

    public function save(Request $request)
    {
    	if ($request->teamMember)
    	{
    		$teamMember = implode(',',$request->teamMember);
    	}
    	else
    	{
    		$teamMember = "";
    	}

        GroupSetup::create( [
        	'name' => $request->name,
        	'team_leader' => $request->teamLeader,
        	'team_member' => $teamMember                  
        ]);

        return redirect(route('groupSetup.index'))->with('msg','Group Successfuly Saved');
    }

    public function edit($id)
    {
    	$title = "Edit Showroom";
        $formLink = "groupSetup.update";
        $buttonName = "Update";

    	$staffs = StaffSetup::where('status','1')
    		->orderBy('name','asc')
    		->get();
    	$group = GroupSetup::where('id',$id)->first();

    	return view('admin.groupSetup.edit')->with(compact('title','formLink','buttonName','staffs','group'));
    }

    public function update(Request $request)
    {
    	$groupId = $request->groupId;

    	if ($request->teamMember)
    	{
    		$teamMember = implode(',',$request->teamMember);
    	}
    	else
    	{
    		$teamMember = "";
    	}

    	$group = GroupSetup::find($groupId);

    	$group->update([
        	'name' => $request->name,
        	'team_leader' => $request->teamLeader,
        	'team_member' => $teamMember
    	]);

        return redirect(route('groupSetup.index'))->with('msg','Group Successfuly Updated');
    }

    public function getAllStaff(Request $request)
    {
    	$output = '';
    	$results = '';
    	$staffId = $request->staffId;

    	$teamMembers = StaffSetup::where('id','!=',$staffId)
    		->orderBy('name','asc')
    		->get();

    	if ($teamMembers)
    	{
    		$output .= '<select class="form-control chosen-select" data-placeholder="Select Team Members" id="teamMember" name="teamMember[]" multiple>';    		
    		foreach ($teamMembers as $teamMember)
    		{
    			$output .= '<option value="'.$teamMember->id.'">'.$teamMember->name.'</option>';
    		}
    		$output .= '</select>';    		
    	}
    	else
    	{
    		$output .= '<select class="form-control chosen-select" data-placeholder="Select Team Members" id="teamMember" name="teamMember[]" multiple>';
    		$output .= '</select>';
    	}  

    	echo $output;    	
    }

    public function delete(Request $request)
    {
    	GroupSetup::where('id',$request->groupId)->delete();
    }

    public function changeStatus(Request $request)
    {
        $groupId = $request->groupId;

        $group = GroupSetup::find($groupId);

        if ($group->status == 1)
        {
            $group->update( [               
                'status' => 0                
            ]);
        }
        else
        {
            $group->update( [               
                'status' => 1                
            ]);
        }
    }
}
