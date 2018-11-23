<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesinvoice extends Model
{
    //
	protected $dates = ['deleted_at'];
	
	public function customer(){
		return $this->belongsTo('App\Customer');
	}
	
	public function invalidinvoice(){
		return $this->hasMany('App\Invalidinvoice');
	}
}
