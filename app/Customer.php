<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
	protected $dates = ['deleted_at'];
	
	public function salesinvoice(){
		return $this->hasMany('App\Salesinvoice');
	}
}
