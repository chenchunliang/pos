<?php

use Illuminate\Database\Seeder;
use App\Invoice;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		
		$invoice = new Invoice;
		
		$invoice->invoice_startmonth ="201811";
		$invoice->invoice_endmonth ="201812";
		$invoice->invoice_wordtrack ="AA";
		$invoice->invoice_startnumber="11111100";
		$invoice->invoice_endnumber ="11111199";
		$invoice->invoice_currentnumber="11111100";

        $invoice->save();
    }
}
