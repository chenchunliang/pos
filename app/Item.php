<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'item_name',
		'item_specification',
		'item_barcode',
		'item_unit',
		'item_taxtype',
		'item_image',
	];
	
	public function position(){
		return $this->hasMany('App\Position');
	}
}
