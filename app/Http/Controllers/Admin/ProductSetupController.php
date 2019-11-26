<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CategorySetup;

class ProductSetupController extends Controller
{
    public function index()
    {
    	$title = "Product Setup";

    	return view('admin.productSetup.index')->with(compact('title'));
    }

    public function addproduct()
    {
    	$title = "Add product";

    	$tab1 = "Basic Information";
    	$tab1Link = "productSetupBasicInfo.save";

    	$tab2 = "Advance Information";
    	$tab2Link = "productSetupAdvanceInfo.save";

    	$tab3 = "Image";
    	$tab3Link = "productSetupImage.update";

    	$tab4 = "SEO Information";
    	$tab4Link = "productSetupSeoInfo.save";

    	$tab5 = "Others Information";
    	$tab5Link = "productSetupOthersInfo.save";

    	$buttonName = "Save";

    	$categories = CategorySetup::where('status',1)
    		->orderBy('name','asc')
    		->get();

    	return view('admin.productSetup.add')->with(compact('title','tab1','tab1Link','tab2','tab2Link','tab3','tab3Link','tab4','tab4Link','tab5','tab5Link','buttonName','categories'));
    }

    public function deleteProduct(Request $request)
    {    	
        // CategorySetup::where('id',$request->categoryId)->delete();
    }

    public function changeProductStatus(Request $request)
    {
        // $categoryId = $request->categoryId;

        // $categoryInfo = CategorySetup::where('id',$categoryId)->first();

        // $category = CategorySetup::find($categoryId);

        // if ($categoryInfo->status == 0)
        // {
        //     $category->update( [               
        //         'status' => 1,                
        //     ]);
        // }
        // else
        // {
        //     $category->update( [               
        //         'status' => 0,                
        //     ]);
        // }
    }
}
