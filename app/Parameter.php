<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    //
	
	protected $primaryKey="parameters_id";
	protected $dates = ['deleted_at'];
}
