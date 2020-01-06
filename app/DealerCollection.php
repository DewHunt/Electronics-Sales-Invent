<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCollection extends Model
{
    protected $table = "tbl_dealer_collections";

    protected $fillable = [
        'product_issue_id','dealer_id','payment_no','payment_date','money_receipt_no','money_receipt_type','payment_amount','remarks'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
