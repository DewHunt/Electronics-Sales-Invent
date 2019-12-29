<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiftingReturnProduct extends Model
{
    protected $table = "tbl_lifting_return_products";

    protected $fillable = [
        'lifting_return_id','lifting_id','lifting_product_id','vendor_id','store_or_showroom_type','store_or_showroom_id','product_id','product_name','model_no','serial_no','color','qty','price','mrp_price','haire_price','status',
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
