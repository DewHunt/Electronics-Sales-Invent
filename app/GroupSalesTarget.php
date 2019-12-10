<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSalesTarget extends Model
{
	protected $table = "tbl_groups_sales_target";

    protected $fillable = [
    	'group_id','year','month','total_target'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
