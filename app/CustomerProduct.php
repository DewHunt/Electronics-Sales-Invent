<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    protected $table = "tbl_customer_products";

    protected $fillable = [
		'customer_id','product_id','product_model','cash_price','showroom_id','qty','warranty','purchase_date','purchase_type','deposite','installment_price','total_installment','monthly_installment_amount','product_usage_address','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
