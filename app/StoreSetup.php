<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreSetup extends Model
{
    protected $table = "tbl_stores";

    protected $fillable = [
    	'code','type','name','address','remarks'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
