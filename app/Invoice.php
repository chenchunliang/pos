<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    //
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'invoice_startmonth',
		'invoice_endmonth',
		'invoice_wordtrack',
		'invoice_startnumber',
		'invoice_endnumber',
		'invoice_currentnumber',
	];
}
