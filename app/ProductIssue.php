<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductIssue extends Model
{
    protected $table = "tbl_product_issue";

    protected $fillable = [
        'requisition_id','dealer_id','issue_type','issue_no','date','total_qty','total_amount','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
