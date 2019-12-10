<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\GroupSetup;
use App\GroupSalesTarget;
use App\GroupSalesTargetCategory;
use App\CategorySetup;

class GroupSalesTargetSetupController extends Controller
{
	public function index()
	{
		$title = "Group Slaes Target";

		$groupSalesTergets = GroupSalesTarget::select('tbl_groups_sales_target.*','tbl_groups.name as groupName')
			->join('tbl_groups','tbl_groups.id','=','tbl_groups_sales_target.group_id')
			->orderBy('tbl_groups_sales_target.year','asc')
			->orderBy('tbl_groups_sales_target.month','asc')
			->orderBy('tbl_groups.name','asc')
			->get();

		return view('admin.groupSalesTargetSetup.index')->with(compact('title','groupSalesTergets'));
	}

	public function add()
	{
		$title = "Add Group Slaes Target";
		$formLink = "groupSalesTargetSetup.save";
		$buttonName = "Save";

		$groups = GroupSetup::where('status','1')->orderBy('name','asc')->get();
		$categories = CategorySetup::where('status','1')
			->whereNull('parent')
			->orderBy('name','asc')
			->get();

		return view('admin.groupSalesTargetSetup.add')->with(compact('title','formLink','buttonName','groups','categories'));
	}

	public function save(Request $request)
	{
        $groupSalesTarget = GroupSalesTarget::create( [
        	'group_id' => $request->group,
            'year' => $request->year,
            'month' => $request->month,
            'total_target' => $request->totalTarget,          
        ]);

        $countCategory = count($request->categoryId);
        if($request->categoryId){
        	$postData = [];
        	for ($i=0; $i < $countCategory ; $i++) { 
        		$postData[] = [
        			'group_sales_target_id'=> $groupSalesTarget->id,
        			'category_id' => $request->categoryId[$i],
        			'target' => $request->targets[$i],
        		];
        	}                
        	GroupSalesTargetCategory::insert($postData);
        }

        return redirect(route('groupSalesTargetSetup.index'))->with('msg','Group Sales Target Added Successfully');
	}

	public function edit($groupSalesTargetId)
	{
		$title = "Edit Group Slaes Target";
		$formLink = "groupSalesTargetSetup.update";
		$buttonName = "Update";

		$groups = GroupSetup::where('status','1')->orderBy('name','asc')->get();
		$categories = CategorySetup::where('status','1')
			->whereNull('parent')
			->orderBy('name','asc')
			->get();

		$groupSalesTarget = GroupSalesTarget::where('id',$groupSalesTargetId)->first();
		$groupSalesTargetCategories = GroupSalesTargetCategory::where('group_sales_target_id',$groupSalesTargetId)->get();

		// dd($groupSalesTarget);

		return view('admin.groupSalesTargetSetup.edit')->with(compact('title','formLink','buttonName','groups','categories','groupSalesTarget','groupSalesTargetCategories'));
	}

	public function update(Request $request)
	{
		$groupSalesTargetId = $request->groupSalesTargetId;

		$groupSalesTarget = GroupSalesTarget::find($groupSalesTargetId);

        $groupSalesTarget->update( [
        	'group_id' => $request->group,
            'year' => $request->year,
            'month' => $request->month,
            'total_target' => $request->totalTarget,          
        ]);

        GroupSalesTargetCategory::where('group_sales_target_id',$groupSalesTargetId)->delete();

        $countCategory = count($request->categoryId);
        if($request->categoryId){
        	$postData = [];
        	for ($i=0; $i < $countCategory ; $i++) { 
        		$postData[] = [
        			'group_sales_target_id'=> $groupSalesTarget->id,
        			'category_id' => $request->categoryId[$i],
        			'target' => $request->targets[$i],
        		];
        	}                
        	GroupSalesTargetCategory::insert($postData);
        }

        return redirect(route('groupSalesTargetSetup.index'))->with('msg','Group Sales Target Updated Successfully');
	}

    public function delete(Request $request)
    {
    	$groupSalesTargetId = $request->groupSalesTargetId;
    	GroupSalesTarget::where('id',$groupSalesTargetId)->delete();
    	GroupSalesTargetCategory::where('group_sales_target_id',$groupSalesTargetId)->delete();
    }
}
