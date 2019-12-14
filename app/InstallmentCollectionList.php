<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallmentCollectionList extends Model
{
    protected $table = "tbl_installment_collection_list";

    protected $fillable = [
		'installment_id','installment_schedule_id','installment_collection_id','invoice_no','installment_schedule_date','installment_schedule_amount','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}

