<?php

use Illuminate\Database\Seeder;
use App\Invalidinvoice;

class InvalidinvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$invalidinvoice = new Invalidinvoice;
		
		$invalidinvoice->invalidinvoice_invaliddate =date("Y-m-d");
		$invalidinvoice->invalidinvoice_invalidtime =date("H:i:s");
		$invalidinvoice->invalidinvoice_invalidreason =str_random(10);
		$invalidinvoice->salesinvoice_id=1;
		
        $invalidinvoice->save();
    }
}
