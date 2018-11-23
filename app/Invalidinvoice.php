<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invalidinvoice extends Model
{
    //
	protected $dates = ['deleted_at'];
	
	public function salesinvoice(){
		return $this->belongsTo('App\Salesinvoice');
	}
}
