<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductIssueList extends Model
{
    protected $table = "tbl_product_issue_lists";

    protected $fillable = [
        'issue_id','product_id','model_no','serial_no','commission_rate','price','qty','amount','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
