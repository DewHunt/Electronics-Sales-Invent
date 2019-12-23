<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerSetup extends Model
{
    protected $table = "tbl_dealers";

    protected $fillable = [
        'district_id','upazila_id','territory_id','type','code','name','contact_person','mobile','email','address','credit_limit','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
