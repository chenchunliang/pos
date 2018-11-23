<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
	
	protected $primaryKey="items_id";
	protected $dates = ['deleted_at'];
}
