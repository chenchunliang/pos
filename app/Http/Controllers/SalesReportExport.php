<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use Session;

class SalesReportExport implements WithMultipleSheets
{
	use Exportable;
	
	public function sheets(): array
    {
        $sheets[0] = new SalesDetailReportExport();
		$sheets[1] = new SalesSummaryReportExport();
		$sheets[2] = new InvoiceDetailReportExport();
        return $sheets;
    }
}