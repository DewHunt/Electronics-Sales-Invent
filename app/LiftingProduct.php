<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiftingProduct extends Model
{
	protected $table = "tbl_lifting_products";

    protected $fillable = [
        'lifting_id','vendor_id','product_id','store_or_showroom_type','store_or_showroom_id','serial_no','color','qty','price','mrp_price','haire_price','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
