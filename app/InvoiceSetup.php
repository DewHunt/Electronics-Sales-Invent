<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetup extends Model
{
    protected $table = "tbl_invoice";

    protected $fillable = [
        'invoice_no','customer_id','customer_product_id','product_id','qty','customer_product_price','customer_product_model','customer_product_color','customer_product_waranty','customer_product_usage_address','customer_product_purchase_date','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
