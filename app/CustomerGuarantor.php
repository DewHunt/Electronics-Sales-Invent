<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGuarantor extends Model
{
    protected $table = "tbl_customer_guarantor";

    protected $fillable = [
		'customer_id','product_id','gurantor_name','gurantor_phone_no','gurantor_age','guarantor_marital_status','guarantor_spouse_name','guarantor_father_name','guarantor_present_address','guarantor_permanent_address','guarantor_profession_name','guarantor_designation','guarantor_workplace_phone_no','guarantor_monthly_income','guarantor_work_place_address'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
