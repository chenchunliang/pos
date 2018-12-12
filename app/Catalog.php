<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
    //
	use SoftDeletes;
	
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
