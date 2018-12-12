<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class testController extends BaseController
{
    function index(){
		
		
		
/*
		//printerConnet('',1);
	
	$ProductSumAmount=180;
	$ProductArrays=array(
	array("ProductCode"=>"00001","ProductName"=>"黑豆","ProductQty"=>"1","ProductSaleAmount"=>"171","ProductTaxAmount"=>"9","ProductAmount"=>"180","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TN"),
	array("ProductCode"=>"00001","ProductName"=>"黑豆2","ProductQty"=>"1","ProductSaleAmount"=>"171","ProductTaxAmount"=>"9","ProductAmount"=>"180","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TN"),
	array("ProductCode"=>"00001","ProductName"=>"黑豆3","ProductQty"=>"1","ProductSaleAmount"=>"171","ProductTaxAmount"=>"9","ProductAmount"=>"180","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TN"),
	array("ProductCode"=>"00001","ProductName"=>"黑豆蔭油","ProductQty"=>"1","ProductSaleAmount"=>"267","ProductTaxAmount"=>"13","ProductAmount"=>"280","ProductSumAmount"=>$ProductSumAmount,"TaxType"=>"TX"),
	);
	
	$ProductTotalTXSaleAmount=1000;
	$TotalTaxAmount=200;
	$ProductTotalTNSaleAmount=3000;
	$ProductTotalAmount=4000;
	
	$path= createInvoiceCode('AB11223344','1020523','9999','324','340','00000000',$ProductArrays);
	$barcode=$path['barcode'];
	$qr1=$path['qr1'];
	$qr2=$path['qr2'];
	*/
	                                                                                                             
	return view('qr',compact('barcode','qr1','qr2','ProductArrays','ProductTotalTXSaleAmount','TotalTaxAmount','ProductTotalTNSaleAmount','ProductTotalAmount'));
	}
	
	
}
