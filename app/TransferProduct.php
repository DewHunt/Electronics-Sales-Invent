<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferProduct extends Model
{
    protected $table = "tbl_transfer_products";

    protected $fillable = [
        'transfer_id','vendor_id','lifting_product_id','product_id','name','model_no','serial_no','color','qty','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
