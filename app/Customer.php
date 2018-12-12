<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'customer_name',
		'customer_identifier',
		'customer_remark',
	];
	
	public function salesinvoice(){
		return $this->hasMany('App\Salesinvoice');
	}
}
