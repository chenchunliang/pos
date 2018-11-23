<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invalidinvoice extends Model
{
    //
	
	protected $primaryKey="invalidinvoices_id";
	protected $dates = ['deleted_at'];
}
