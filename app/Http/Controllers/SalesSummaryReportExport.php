<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Session;

class SalesSummaryReportExport implements FromView,WithTitle
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
		
		$startinvoicenumber="";
		$endinvoicenumber="";
		if(count($Salesinvoices)>0){
			$startinvoicenumber=$Salesinvoices[0]->salesinvoice_invoicenumber;
			$endinvoicenumber=$Salesinvoices[count($Salesinvoices)-1]->salesinvoice_invoicenumber;
		}
		$productcollect=collect();
		foreach($Salesinvoices as $Salesinvoice){
			$productcollect=$productcollect->merge(collect(json_decode($Salesinvoice->salesinvoice_productarray)));
		}
			
		$ProductNameCollect=$productcollect->groupBy('ProductName');

		$productSummary=collect();
		$i=0;
		$totalMoney=0;
		//dd($ProductNameCollect);
		foreach($ProductNameCollect as $key=>$ProductName){
			$ProductQty=0;
			$ProductSumAmount=0;
			foreach($ProductName as $product){
				$ProductQty+=$product->ProductQty;
				$ProductSumAmount+=$product->ProductSumAmount;
			}
			
			$productSummary[$i]=collect(['ProductName'=>$key,'TaxType'=>$product->TaxType,'ProductQty'=>$ProductQty,'ProductSumAmount'=>$ProductSumAmount]);
			$totalMoney+=$ProductSumAmount;
			$i++;
		}//end foreach
		
		//dd($productSummary);

		return view('report.sales_summary_print',compact(
			'productSummary',
			'companyName',
			'companyPhone',
			'companyAddress',
			'print_date',
			'startdate',
			'enddate',
			'customer_group',
			'startinvoicenumber',
			'endinvoicenumber',
			'totalMoney'
		));
		
	}//end view
	
	public function title(): string
    {
        return '銷售匯總表';
    }
}