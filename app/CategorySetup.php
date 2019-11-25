<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorySetup extends Model
{
    protected $table = "tbl_categories";

    protected $fillable = [
    	'name','cover_image','image','status','parent','show_in_home_page','meta_title','meta_keyword','meta_description','order_by'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
