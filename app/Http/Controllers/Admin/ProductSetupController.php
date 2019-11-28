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

        $products = Product::select('tbl_products.*','tbl_categories.name as catName','tbl_product_images.image as image')
            ->join('tbl_categories','tbl_categories.id','=','tbl_products.category_id')
            ->join('tbl_product_images','tbl_product_images.product_id','=','tbl_products.id')
            ->orderBy('tbl_categories.name','asc')
            ->orderBy('tbl_products.name','asc')
            ->get();

    	return view('admin.productSetup.index')->with(compact('title','products'));
    }

    public function addProduct()
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

    public function editProduct($productId)
    {
    	$title = "Edit product";

    	$tab1 = "Basic Information";
    	$tab1Link = "productSetupBasicInfo.update";

    	$tab2 = "Advance Information";
    	$tab2Link = "productSetupAdvanceInfo.update";

    	$tab3 = "Image";
    	$tab3Link = "productSetupImage.save";

    	$tab4 = "SEO Information";
    	$tab4Link = "productSetupSeoInfo.update";

    	$buttonName = "Update";

    	$categories = CategorySetup::where('status',1)
    		->orderBy('name','asc')
    		->get();

    	$relatedProducts = Product::where('status',1)
    		->orderBy('name','asc')
    		->get();

    	$product = Product::where('id',$productId)->first();
    	$productAdvance = ProductAdvance::where('product_id',$productId)->first();
    	$productImages = ProductImage::where('product_id',$productId)->get();

    	return view('admin.productSetup.edit')->with(compact('title','tab1','tab1Link','tab2','tab2Link','tab3','tab3Link','tab4','tab4Link','buttonName','categories','relatedProducts','product','productAdvance','productImages','productId'));
    }

    public function saveProductBasicInfo(Request $request)
    {
        $categoryId = implode(',', $request->categories);

        $product = Product::create( [
        	'category_id' => $categoryId,
        	'name' => $request->productName,
        	'code' => $request->productCode,
        	'model_no' => $request->productModelNo,
        	'color' => $request->productColor,
        	'uom' => $request->productUom,
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

    public function saveProductImage(Request $request)
    {
    	$productId = $request->productId;

        if (isset($request->productImage))
        {
            $productImage = \App\HelperClass::UploadImage($request->productImage,'tbl_product_images','public/uploads/product_image/');
        }
        else
        {
            $productImage = "";
        }

        $image = ProductImage::create( [
        	'product_id' => $productId,
        	'image' => $productImage,         
        ]);

        $productImages = ProductImage::where('product_id',$productId)->get();
        $images = "";



        foreach($productImages as $productImage){
            $images .=
        	'
        	<div class="card card_image_'.$productImage->id.'" style="width: 200px; display: inline-block;" align="center">
        		<img class="card-img-top" src="'.url('/').'/'.$productImage->image.'" alt="Card image" style="width:150px; height: 150px;">
        		<div class="card-body">
        			<a href="javascript:void(0)" data-id="'.$productImage->id.'" data-token="'.csrf_token().'" class="btn btn-outline-danger" onclick="removeImage('.$productImage->id.')" style="width: 100%;">Delete</a>
        		</div>
        	</div>
        	';
        }

        if($request->ajax())
        {
            return response()->json([
                'images'=>$images
            ]);
        }
    	
    }

    public function deleteProductImage(Request $request)
    {
    	$image = ProductImage::find($request->imageId);

    	if($image->delete())
    	{
    		@unlink($image->image);
    		return response()->json(true);
    	}
    	else
    	{
    		return response()->json(false);
    	}
    }

    public function updateProductBasicInfo(Request $request)
    {
    	$productId = $request->productId;
        $product = Product::find($productId);

        $categoryId = implode(',', $request->categories);

        $product->update( [
        	'category_id' => $categoryId,
        	'name' => $request->productName,
        	'code' => $request->productCode,
        	'model_no' => $request->productModelNo,
        	'color' => $request->productColor,
        	'uom' => $request->productUom,
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

        return redirect(route('productSetup.edit',['productId'=>$productId]))->with('msg','Product Basic Information Updated Successfully')->withInput();    	
    }

    public function updateProductAdvanceInfo(Request $request)
    {
    	$msg = "";
    	$type = $request->type;

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

    	if ($type == "add")
    	{
    		$msg = "Product Advance Information Added Successfully";
    		return redirect(route('productSetup.add',['productId'=>$productId]))->with('msg',$msg)->withInput(); 
    	}
    	
    	if ($type == "update")
    	{
    		$msg = "Product Advance Information Updated Successfully";
    		return redirect(route('productSetup.edit',['productId'=>$productId]))->with('msg',$msg)->withInput();
    	}   	
    }

    public function updateProductSeoInfo(Request $request)
    {
    	$msg = "";
    	$type = $request->type;
    	$productId = $request->productId;
        $productSeo = Product::find($productId);

        $productSeo->update( [
        	'meta_title' => $request->metaTitle,
        	'meta_keyword' => $request->metaKeyword,
        	'meta_description' => $request->metaDescription,          
        ]);

    	if ($type == "add")
    	{
    		$msg = "Product SEO Information Added Successfully";
    		return redirect(route('productSetup.add',['productId'=>$productId]))->with('msg',$msg)->withInput();
    	}
    	
    	if ($type == "update")
    	{
    		$msg = "Product SEO Information Updated Successfully";
    		return redirect(route('productSetup.edit',['productId'=>$productId]))->with('msg',$msg)->withInput();
    	}
    	
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
