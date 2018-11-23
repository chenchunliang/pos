<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    //
	
	protected $primaryKey="invoices_id";
	protected $dates = ['deleted_at'];
}
