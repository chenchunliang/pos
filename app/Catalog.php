<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
    //
	
	
	protected $primaryKey="catalogs_id";
	protected $dates = ['deleted_at'];
	
}
