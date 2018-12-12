<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesinvoice;
use App\Customer;
use App\Item;
use App\Invoice;
use App\Parameter;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{

    public function sales()//銷售狀況查詢view
    {
		//日結
		$today=date("Y-m-d");
		
		//週結 上周五~這週五
		$week=get_thisweek($today);
		$weekStart=get_before_day($week[0],3);//上周五
		$weekEnd=get_before_day($week[1],2);//這週五
		
		//月結 每月1號~最後1號
		$monthStart=date("Y-m")."-01";
		$monthEnd=lastDateOfMonth($monthStart);


		$customerDistinct=Customer::select('customer_group')->distinct()->get();

		return view('report.sales',compact('Customers','today','weekStart','weekEnd','monthStart','monthEnd','customerDistinct'));
    }

    public function sales_print(Request $request)
    { 
		$Salesinvoices=Salesinvoice::
			where('salesinvoice_date','>=',$request->sd)
			->where('salesinvoice_date','<=',$request->ed);
		$invoiceTitle="";
		if($request->i=="C0401"){//交易發票
		
			$Salesinvoices->where("salesinvoice_invalidstate",0)
			->where('salesinvoice_isdownload',intval($request->isdownload));
			
			$invoiceTitle="交易發票";
		}else if($request->i=="C0501"){//作廢發票
			$Salesinvoices->where("salesinvoice_invalidstate",1);
			$invoiceTitle="作廢發票";
		}//end if
		
		//客戶群組篩選
		$customer_group=$request->cg;
		if($customer_group && $customer_group!="%"){
			$customer_group_array=array();
			$customerg=Customer::select('id')->where('customer_group','like',$customer_group)->get();
			foreach($customerg as $customer){
				array_push($customer_group_array,$customer->id);			
			}	//end foreach	
			$Salesinvoices = $Salesinvoices->whereIn('customer_id', $customer_group_array);
		}//end if

		$data=array();
		$today=date("Y-m-d");
			
		$Parameters=Parameter::all();
		$data['companyName']=$Parameters->where('parameter_code','companyName')->first()->parameter_value;
		$data['companyPhone']=$Parameters->where('parameter_code','companyPhone')->first()->parameter_value;
		$data['companyAddress']=$Parameters->where('parameter_code','companyAddress')->first()->parameter_value;
		$data['print_date']=$today;
		$data['startdate']=$request->sd;
		$data['enddate']=$request->ed;
		$data['customer_group']=$request->cg;
		$data['Salesinvoices']=$Salesinvoices->get();
	
		Session::put('data',$data);

			foreach($Salesinvoices->get() as $Salesinvoice){//匯總表才要把它變成已下載
				$Salesinvoice->salesinvoice_isdownload=1;
				$Salesinvoice->update();
			}//end foreach
		
			return (new SalesReportExport)->download($today.'-銷售報表 ('.$invoiceTitle.').xlsx');
			
    }//end function



}
