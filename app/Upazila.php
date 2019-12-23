<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $table = "tbl_upazilas";

    protected $fillable = [
        'district_id','name','bangla_name','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
