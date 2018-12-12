<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Session;

class InvoiceDetailReportExport implements FromView,WithTitle
{
	use Exportable;
	
	public function view(): View
    {		
		$data = Session::get('data');
		
		$Salesinvoices=$data['Salesinvoices'];
		$companyName=$data['companyName'];
		$companyPhone=$data['companyPhone'];
		$companyAddress=$data['companyAddress'];
		$print_date=$data['print_date'];
		$startdate=$data['startdate'];
		$enddate=$data['enddate'];
		$customer_group=$data['customer_group']=="%"?'全部客戶':$$data['customer_group'];
		//dd($Salesinvoices);
		$TaxTypeArray=array();
		$i=0;
		$total_tnsalesamount=0;
		$total_txsalesamount=0;
		$total_taxamount=0;
		$total_totalamount=0;
		
		foreach($Salesinvoices as $Salesinvoice){
			$productarray=json_decode($Salesinvoice->salesinvoice_productarray);
			$TaxType=""; $TN=0; $TX=0;
			foreach($productarray as $product){
				switch($product->TaxType){
					case "TN": $TN++; break;
					case "TX": $TX++; break;
				}//end switch
			}//end foreach
			
			if($TN==0 && $TX>0){
				$TaxType="應稅";
			}else if($TN>0 && $TX==0){
				$TaxType="免稅";
			}else {
				$TaxType="混稅";
			}//end if
			
			$TaxTypeArray[$i]=$TaxType;
		
			$i++;
		
			$total_tnsalesamount+=$Salesinvoice->salesinvoice_tnsalesamount;
			$total_txsalesamount+=$Salesinvoice->salesinvoice_txsalesamount;
			$total_taxamount+=$Salesinvoice->salesinvoice_taxamount;
			$total_totalamount+=$Salesinvoice->salesinvoice_totalamount;
			
		}//end foreach
		
		//dd($TaxTypeArray);
		
		return view('report.invoice_detail_print',compact(
			'Salesinvoices',
			'companyName',
			'companyPhone',
			'companyAddress',
			'print_date',
			'startdate',
			'enddate',
			'customer_group',
			'TaxTypeArray',
			'total_tnsalesamount',
			'total_txsalesamount',
			'total_taxamount',
			'total_totalamount'
		));
		
	}//end view
	
	public function title(): string
    {
        return '發票明細表';
    }
}