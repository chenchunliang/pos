<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesinvoice extends Model
{
    //
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'salesinvoice_invoicenumber',
		'salesinvoice_date',
		'salesinvoice_time',
		'salesinvoice_identifier',
		'salesinvoice_randomnumber',
		'salesinvoice_productarray',
		'salesinvoice_tnsalesamount',
		'salesinvoice_txsalesamount',
		'salesinvoice_totalamount',
		'salesinvoice_printstate',
		'salesinvoice_invalidstate',
		'salesinvoice_C0401state',
		'salesinvoice_C0501state',
		'salesinvoice_remark',
		'customer_id',
	];
	
	public function customer(){
		return $this->belongsTo('App\Customer');
	}
	
	public function invalidinvoice(){
		return $this->hasMany('App\Invalidinvoice');
	}
}
