<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    //
	
	protected $dates = ['deleted_at'];
	
	protected $fillable = [
		'parameter_code',
		'parameter_title',
		'parameter_value',
		'parameter_groups',
	];
	
}
