<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    //
	
	protected $dates = ['deleted_at'];
	
	
	public function item(){
		return $this->belongsTo('App\Item');
	}
	
	public function catalog(){
		return $this->belongsTo('App\Catalog');
	}
		
}
