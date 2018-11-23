<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invalidinvoice extends Model
{
    //
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'invalidinvoice_invaliddate',
		'invalidinvoice_invalidtime',
		'invalidinvoice_invalidreason',
		'salesinvoice_id',
	];
	
	public function salesinvoice(){
		return $this->belongsTo('App\Salesinvoice');
	}
}
