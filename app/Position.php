<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    //
	
	protected $primaryKey="positions_id";
	protected $dates = ['deleted_at'];
}
