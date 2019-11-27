<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "tbl_products";

    protected $fillable = [
    	'category_id','name','code','model_no','color','uom','price','mrp_price','haire_price','discount','warranty','reorder_level_qty','order_by','transport_point','status','youtube_link','tag_line','short_description','long_description','meta_title','meta_keyword','meta_description'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
