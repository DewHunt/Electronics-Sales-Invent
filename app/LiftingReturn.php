<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiftingReturn extends Model
{
    protected $table = "tbl_lifting_returns";

    protected $fillable = [
        'lifting_id','vendor_id','store_or_showroom_type','store_or_showroom_id','product_id','serial_no','date','total_qty','total_mrp_price','total_haire_price','remarks','status',
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
