<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashCollection extends Model
{
    protected $table = "tbl_cash_collection";

    protected $fillable = [
		'invoice_id','collection_no','invoice_amount','previous_collection','collection_date','collection_amount','current_due','remarks'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
