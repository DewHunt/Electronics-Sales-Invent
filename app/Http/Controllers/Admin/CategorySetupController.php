<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\CategorySetup;

class CategorySetupController extends Controller
{
    public function index()
    {
    	$title = "Category Setup";

        $nullCategories = CategorySetup::select('tbl_categories.*','parent as parentName')
            ->whereNull('parent');

        $categories = DB::table('tbl_categories as tab1')
            ->select('tab1.*','tab2.name as parentName')
            ->join('tbl_categories as tab2','tab2.id','=','tab1.parent')
            ->union($nullCategories)
            ->orderBy('parentName','asc')
            ->orderBy('name','asc')
            ->get();

    	return view('admin.categorySetup.index')->with(compact('title','categories'));
    }

    public function addCategory()
    {
    	$title = "Add Category";
    	$formLink = "categorySetup.save";
    	$buttonName = "Save";
    	$categories = CategorySetup::where('status',1)
    		->orderBy('name','asc')->get();

    	return view('admin.categorySetup.add')->with(compact('title','formLink','buttonName','categories'));
    }

    public function saveCategory(Request $request)
    {
    	// dd($request->all());

        $this->validation($request);

        $this->validate(request(), [
            'categoryImage' => 'image|mimes:jpeg,png,jpg,gif,svg',       
            'categoryCoverImage' => 'image'       
        ]);

        if (isset($request->categoryImage))
        {
            $categoryImage = \App\HelperClass::UploadImage($request->categoryImage,'tbl_categories','public/uploads/category_image/');
        }
        else
        {
            $categoryImage = "";
        }

        if (isset($request->categoryCoverImage))
        {
            $categoryCoverImage = \App\HelperClass::UploadImage($request->categoryCoverImage,'tbl_categories','public/uploads/category_image/');
        }
        else
        {
            $categoryCoverImage = "";
        }

        $category = CategorySetup::create( [     
            'name' => $request->categoryName,
            'image' => $categoryImage,              
            'cover_image' => $categoryCoverImage,              
            'status' => $request->categoryStatus, 
            'parent' => $request->parent,
            'show_in_home_page' => $request->showInHomepage,
            'meta_title' => $request->metaTitle,            
            'meta_keyword' => $request->metaKeyword,            
            'meta_description' => $request->metaDescription,            
            'order_by' => $request->orderBy,           
        ]);

        return redirect(route('categorySetup.index'))->with('msg','Category Added Successfully');
    }

    public function editCategory($id)
    {
    	$title = "Edit Category";
    	$formLink = "categorySetup.update";
    	$buttonName = "Update";
    	$categories = CategorySetup::orderBy('name','asc')->get();

    	$category = CategorySetup::where('id',$id)->first();

    	return view('admin.categorySetup.edit')->with(compact('title','formLink','buttonName','categories','category'));
    }

    public function updateCategory(Request $request)
    {
    	// echo $request->categoryId; exit();
        $this->validation($request);

        $this->validate(request(), [
            'categoryImage' => 'image|mimes:jpeg,png,jpg,gif,svg',       
            'categoryCoverImage' => 'image'       
        ]);

        if (isset($request->categoryImage))
        {
            $categoryImage = \App\HelperClass::UploadImage($request->categoryImage,'tbl_categories','public/uploads/category_image/');
        }
        else
        {
            $categoryImage = $request->previousCategoryImage;
        }

        if (isset($request->categoryCoverImage))
        {
            $categoryCoverImage = \App\HelperClass::UploadImage($request->categoryCoverImage,'tbl_categories','public/uploads/category_image/');
        }
        else
        {
            $categoryCoverImage = $request->previousCategoryCoverImage;
        }

        $category = CategorySetup::find($request->categoryId);

        $category->update( [     
            'name' => $request->categoryName,
            'image' => $categoryImage,              
            'cover_image' => $categoryCoverImage,              
            'status' => $request->categoryStatus, 
            'parent' => $request->parent,
            'show_in_home_page' => $request->showInHomepage,
            'meta_title' => $request->metaTitle,            
            'meta_keyword' => $request->metaKeyword,            
            'meta_description' => $request->metaDescription,            
            'order_by' => $request->orderBy,           
        ]);

        return redirect(route('categorySetup.index'))->with('msg','Category Updated Successfully');
    }

    public function deleteCategory(Request $request)
    {    	
        CategorySetup::where('id',$request->categoryId)->delete();
    }

    public function changeCategoryStatus(Request $request)
    {
        $categoryId = $request->categoryId;

        $category = CategorySetup::find($categoryId);

        if ($category->status == 0)
        {
            $category->update( [               
                'status' => 1,                
            ]);
        }
        else
        {
            $category->update( [               
                'status' => 0,                
            ]);
        }
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
            'categoryName' => 'required|string'            
        ]);
    }
}
