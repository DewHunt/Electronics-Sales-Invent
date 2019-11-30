<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerritorySetup extends Model
{
	protected $table = "tbl_territories";

    protected $fillable = [
    	'area_id','code','name','incharge_name','address','contact','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
