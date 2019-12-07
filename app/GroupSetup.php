<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSetup extends Model
{
	protected $table = "tbl_groups";

	protected $fillable = [
		'name','team_leader','team_member','status'
	];

	protected $hidden = [
		'created_at','updated_at'
	];
}
