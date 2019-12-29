<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerRequisitionProduct extends Model
{
    protected $table = "tbl_dealer_requisition_products";

    protected $fillable = [
        'requisition_id','product_id','product_name','model_no','price','qty','amount','approved_by','approved_qty','approved_amount','status'
	];

	protected $hidden = [
		'created_at','updated_at'
	];
}
