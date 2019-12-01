<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lifting extends Model
{
	protected $table = "tbl_liftings";

    protected $fillable = [
        'serial_no','vaouchar_no','vendor_id','purchase_by','submission_date','vouchar_date','total_qty','total_price','total_mrp_price','total_haire_price','discount','vat','net_amount'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
