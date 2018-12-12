<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'item_name',
		'item_specification',
		'item_barcode',
		'item_unitprice1',
		'item_unitprice2',
		'item_unitprice3',
		'item_unitprice4',
		'item_unitprice5',
		'item_unit',
		'item_taxtype',
		'item_image',
	];
	
	public function position(){
		return $this->hasMany('App\Position');
	}
}
