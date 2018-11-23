<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
	
	protected $primaryKey="customers_id";
	protected $dates = ['deleted_at'];
}
