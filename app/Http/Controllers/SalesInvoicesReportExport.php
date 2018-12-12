<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Session;

class SalesInvoicesReportExport implements FromView
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
		$customer_group=$data['customer_group'];
		
		//dd($Salesinvoices);
		return view('report.sales_print',compact(
			'Salesinvoices',
			'companyName',
			'companyPhone',
			'companyAddress',
			'print_date',
			'startdate',
			'enddate',
			'customer_group',
		));
		
	}
}