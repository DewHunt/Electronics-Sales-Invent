<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerRequisition extends Model
{
    protected $table = "tbl_dealer_requisitions";

    protected $fillable = [
    	'dealer_id','requisition_no','date','product_id','total_qty','total_amount','approved_by','total_approve_qty','total_approve_amount','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
