<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaSetup extends Model
{
	protected $table = "tbl_area";

    protected $fillable = [
    	'code','name','incharge_name','address','contact','email','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
