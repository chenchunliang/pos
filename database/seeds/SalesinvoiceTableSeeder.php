<?php

use Illuminate\Database\Seeder;
use App\Salesinvoice;

class SalesinvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$ProductSumAmount=100;
		$ProductArrays=array(
	array("ProductCode"=>"00001","ProductName"=>"黑豆","ProductQty"=>"1","ProductSaleAmount"=>"171","ProductTaxAmount"=>"9","ProductAmount"=>"180","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TN"),
	array("ProductCode"=>"00001","ProductName"=>"黑豆2","ProductQty"=>"1","ProductSaleAmount"=>"171","ProductTaxAmount"=>"9","ProductAmount"=>"180","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TN"),
	array("ProductCode"=>"00001","ProductName"=>"黑豆3","ProductQty"=>"1","ProductSaleAmount"=>"171","ProductTaxAmount"=>"9","ProductAmount"=>"180","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TN"),
	array("ProductCode"=>"00001","ProductName"=>"黑豆蔭油","ProductQty"=>"1","ProductSaleAmount"=>"267","ProductTaxAmount"=>"13","ProductAmount"=>"280","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TX"),
	);
	
	
		$salesinvoice = new Salesinvoice;
		
		$salesinvoice->salesinvoice_invoicenumber="AA11111100";
		$salesinvoice->salesinvoice_date =date("Y-m-d");
		$salesinvoice->salesinvoice_time =date("H:i:s");
		$salesinvoice->salesinvoice_identifier="55891836";
		$salesinvoice->salesinvoice_randomnumber =rand(1000,9999);
		$salesinvoice->salesinvoice_productarray=json_encode($ProductArrays);
		$salesinvoice->salesinvoice_tnsalesamount =1;
		$salesinvoice->salesinvoice_txsalesamount =1;
		$salesinvoice->salesinvoice_taxamount =1;
		$salesinvoice->salesinvoice_totalamount =1;
		$salesinvoice->salesinvoice_printstate=1;
		$salesinvoice->salesinvoice_invalidstate =1;
		$salesinvoice->salesinvoice_C0401state =1;
		$salesinvoice->salesinvoice_C0501state =1;
		$salesinvoice->salesinvoice_remark ="";
		$salesinvoice->customer_id =1;
		
        $salesinvoice->save();
    }
}
