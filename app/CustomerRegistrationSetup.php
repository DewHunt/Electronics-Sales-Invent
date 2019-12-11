<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerRegistrationSetup extends Model
{
    protected $table = "tbl_customers";

    protected $fillable = [
		'code','name','nick_name','age','phone_no','marital_status','spouse_name','fathers_name','mothers_name','gender','current_residence','residence_duration','total_family_member','present_address','permanent_address','profession_name','profession_duration','total_earning_member','designation','monthly_income','work_place_address','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
