<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesinvoice extends Model
{
    //
	
	protected $primaryKey="salesinvoices_id";
	protected $dates = ['deleted_at'];
}
