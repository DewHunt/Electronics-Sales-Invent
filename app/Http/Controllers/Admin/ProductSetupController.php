<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CategorySetup;
use App\Product;
use App\ProductAdvance;
use App\ProductImage;

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
    	$tab2Link = "productSetupAdvanceInfo.update";

    	$tab3 = "Image";
    	$tab3Link = "productSetupImage.save";

    	$tab4 = "SEO Information";
    	$tab4Link = "productSetupSeoInfo.update";

    	$buttonName = "Save";
    	$productId = "";

    	$categories = CategorySetup::where('status',1)
    		->orderBy('name','asc')
    		->get();

    	$relatedProducts = Product::where('status',1)
    		->orderBy('name','asc')
    		->get();

    	return view('admin.productSetup.add')->with(compact('title','tab1','tab1Link','tab2','tab2Link','tab3','tab3Link','tab4','tab4Link','buttonName','categories','relatedProducts','productId'));
    }

    public function saveProductBasicInfo(Request $request)
    {
    	// dd($request->all());

        $categoryId = implode(',', $request->categories);

        $product = Product::create( [
        	'category_id' => $categoryId,
        	'name' => $request->productName,
        	'code' => $request->productCode,
        	'model_no' => $request->productModelNo,
        	'color' => $request->productColor,
        	'uom' => $request->productColor,
        	'price' => $request->price,
        	'mrp_price' => $request->mrpPrice,
        	'haire_price' => $request->hairePrice,
        	'discount' => $request->discount,
        	'warranty' => $request->warranty,
        	'reorder_level_qty' => $request->reorderQty,
        	'order_by' => $request->orderBy,
        	'transport_point' => $request->transportPoint,
        	'status' => $request->status,
        	'youtube_link' => $request->youtubeLink,
        	'tag_line' => $request->tag,
        	'short_description' => $request->shortDescription,
        	'long_description' => $request->longDescription,
        	'meta_title' => $request->metaTitle,
        	'meta_keyword' => $request->metaKeyword,
        	'meta_description' => $request->metaDescription          
        ]);

        $productId = $product->id;

        $productAdvance = ProductAdvance::create([
        	'product_id' => $productId
        ]);

        return redirect(route('productSetup.add',['productId'=>$productId]))->with('msg','Product Basic Information Added Successfully')->withInput();
    }

    public function updateProductBasicInfo(Request $request)
    {
    	
    }

    public function updateProductAdvanceInfo(Request $request)
    {
    	// dd($request->all()); die();
    	$productId = $request->productId;
        $productAdvance = ProductAdvance::where('product_id',$productId)->first();

        $productSection = implode(',', $request->sections);

        $relatedProductId = implode(',', $request->relatedProduct);

        $productAdvance->update( [
        	'product_section' => $productSection,
        	'related_product_id' => $relatedProductId,
        	'pre_order_duration' => $request->preOrderDuration,
        	'shipping' => $request->shipping,
        	'hot_discount' => $request->hotDiscount,
        	'hot_discount_date' => $request->hotDate,
        	'special_discount' => $request->specialDiscount,
        	'special_discount_date' => $request->specialDate           
        ]);

        return redirect(route('productSetup.add',['productId'=>$productId]))->with('msg','Product Advance Information Added Successfully')->withInput();
    	
    }

    public function updateProductSeoInfo(Request $request)
    {
    	
    }

    public function saveProductImage(Request $request)
    {
    	
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
