<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    //
	
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'position_x',
		'position_y',
		'item_id',
		'catalog_id',
	];
	
	public function item(){
		return $this->belongsTo('App\Item');
	}
	
	public function catalog(){
		return $this->belongsTo('App\Catalog');
	}
		
}
