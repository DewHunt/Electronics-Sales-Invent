<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSetup extends Model
{
    protected $table = "tbl_products";

    protected $fillable = [];

	protected $hidden = [
		'created_at','updated_at'
	];
}
