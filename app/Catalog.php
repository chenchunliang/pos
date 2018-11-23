<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
    //
	protected $dates = ['deleted_at'];
	
	public function position(){
		return $this->hasMany('App\Position');
	}
}
