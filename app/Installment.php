<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = "tbl_installment";

    protected $fillable = [
		'customer_product_id','customer_id','product_id','invoice_no','customer_name','installment_price','booking_amount','installment_qty','installment_amount','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
