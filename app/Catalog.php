<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
    //
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'catalog_name',
		'catalog_orders',
		'catalog_display',
	];
	
	public function position(){
		return $this->hasMany('App\Position');
	}
}
