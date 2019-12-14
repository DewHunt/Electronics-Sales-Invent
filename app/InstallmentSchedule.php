<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallmentSchedule extends Model
{
    protected $table = "tbl_installment_schedule";

    protected $fillable = [
		'installment_id','invoice_no','installment_schedule_date','installment_schedule_amount','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
