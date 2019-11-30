<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleSetup extends Model
{
	protected $table = "tbl_vehicles";

    protected $fillable = [
    	'registration_no','type','capacity','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
