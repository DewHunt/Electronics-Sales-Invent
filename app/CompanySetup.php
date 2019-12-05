<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySetup extends Model
{
    protected $table = "tbl_company";

    protected $fillable = [
		'prefix','name','email','phone','fax','website','vat','tin','trade_license','address'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
