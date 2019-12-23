<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = "tbl_transfers";

    protected $fillable = [
    	'vendor_id','transfer_no','date','host_type','host_id','destination_type','destination_id','product_id','total_qty','status',
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
