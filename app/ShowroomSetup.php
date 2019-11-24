<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowroomSetup extends Model
{
	protected $table = "tbl_showroom";

	protected $fillable = [
		'prefix','name','contact_person','email','phone','fax','website','vat','tin','trade_license','address'
	];

	protected $hidden = [
		'created_at','updated_at'
	];
}
