<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiftingProduct extends Model
{
	protected $table = "tbl_lifting_products";

    protected $fillable = [
        'lifting_id','product_id','serial_no','color','qty','price','mrp_price','haire_price'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
