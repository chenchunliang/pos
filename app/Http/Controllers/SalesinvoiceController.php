<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesinvoice;
use App\Customer;
use App\Item;
use App\Parameter;
use App\Catalog;
use App\Invoice;
use App\Position;

class SalesinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Salesinvoices=Salesinvoice::all()->sortByDesc('salesinvoice_invoicenumber');//最新的在最上方
		return view('salesinvoice.index',compact('Salesinvoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        //sales=create 櫃台開發票
		$Customers=Customer::all();
		$Items=Item::all();
		$Parameters=Parameter::all();
		$Parameter_tax=Parameter::where('parameter_code','tax')->first();
		$Catalogs=Catalog::where('catalog_display',1)->orderBy('catalog_orders')->get();
		
		$thisYear=date('Y')-1911;
		$thisMonth=date('m');
		
		if($thisMonth%2==0){//偶數月 看endmonoth
			$Invoice=Invoice::where('invoice_endmonth',$thisYear.$thisMonth)->get()->sortBy('invoice_startmonth');
		}else{//奇數月 看endmonoth
			$Invoice=Invoice::where('invoice_startmonth',$thisYear.$thisMonth)->get()->sortBy('invoice_startmonth');	
		}
		$Invoice=$Invoice->filter(function($invoice){//目前號碼不等於發票末碼 才可以取出資料
			return ($invoice->invoice_endnumber>$invoice->invoice_currentnumber)?$invoice:'';
		});
		$Invoice=$Invoice->first();
		
		//dd($Invoice);
		return view('salesinvoice.sales',compact('Customers','Items','Parameters','Parameter_tax','Catalogs','Invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$invoices_id=$request->invoices_id;
		
		$Salesinvoice=new Salesinvoice;
		$Salesinvoice->salesinvoice_invoicenumber=$request->salesinvoice_invoicenumber;
		$Salesinvoice->salesinvoice_date=date("Y-m-d");
		$Salesinvoice->salesinvoice_time=date("H:i:s");
		$Salesinvoice->salesinvoice_identifier=$request->salesinvoice_identifier;
		$Salesinvoice->salesinvoice_randomnumber=rand(1000,9999);
		$Salesinvoice->salesinvoice_productarray=json_encode(json_decode($request->salesinvoice_productarray));
		$Salesinvoice->salesinvoice_tnsalesamount=$request->salesinvoice_tnsalesamount;
		$Salesinvoice->salesinvoice_txsalesamount=$request->salesinvoice_txsalesamount;
		$Salesinvoice->salesinvoice_taxamount=$request->salesinvoice_taxamount;
		$Salesinvoice->salesinvoice_totalamount=$request->salesinvoice_totalamount;
		$Salesinvoice->salesinvoice_printstate=1;
		$Salesinvoice->customer_id=$request->customer_id;
		$result=$Salesinvoice->save();
		
		$Nextinvoicenumber="";//下一發票號碼
		$Nextinvoiceid="";//下一發票id
		
		if($result){//儲存成功
			$Invoice=Invoice::find($invoices_id);
			$salesinvoice_invoicenumber=substr($request->salesinvoice_invoicenumber,2,8);
			$Invoice->invoice_currentnumber=$salesinvoice_invoicenumber;
			
			if(intval($Invoice->invoice_endnumber)>intval($salesinvoice_invoicenumber)){//目前發票還沒用完
				$Nextinvoicenumber=intval($salesinvoice_invoicenumber)+1;
				$Nextinvoicenumber=$Invoice->invoice_wordtrack.str_pad($Nextinvoicenumber,8,'0',STR_PAD_LEFT);
				$Nextinvoiceid=$Invoice->id;
			}else{//目前發票已用完  下一字軌發票 or 提示無發票了
				$thisYear=date('Y')-1911;
				$thisMonth=date('m');
				
				if($thisMonth%2==0){//偶數月 看endmonoth
					$Invoice2=Invoice::where('invoice_endmonth',$thisYear.$thisMonth)->get()->sortBy('invoice_startmonth');
				}else{//奇數月 看endmonoth
					$Invoice2=Invoice::where('invoice_startmonth',$thisYear.$thisMonth)->get()->sortBy('invoice_startmonth');
				}
				$Invoice2=$Invoice2->filter(function($invoice2){//目前號碼不等於發票末碼 才可以取出資料
					return ($invoice2->invoice_endnumber>$invoice2->invoice_currentnumber)?$invoice2:'';
				});
				$Invoice2=$Invoice2->first();
				
				if($Invoice2){
					$Nextinvoicenumber=$Invoice2->invoice_wordtrack.(str_pad($Invoice2->invoice_currentnumber+1,8,'0',STR_PAD_LEFT));
					$Nextinvoiceid=$Invoice2->id;
					
				}else{
					$Nextinvoicenumber='★☆★☆發票號碼用罄☆★☆★';
				}
				
				
			}
			$Invoice->update();
		}
		
		$json=array(
			"result"=>$result,
			"Nextinvoiceid"=>$Nextinvoiceid,
			"Nextinvoicenumber"=>$Nextinvoicenumber
		);
		return json_encode($json);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //銷貨發票管理 編輯頁
		$Customers=Customer::all();
		$Salesinvoice=Salesinvoice::find($id);
		$Items=Item::all()->sortBy('item_barcode');
		$Parameters=Parameter::where('parameter_groups','價格')->get();
		$Parameter_tax=Parameter::where('parameter_code','tax')->first();
		return view('salesinvoice.edit',compact('Customers','Salesinvoice','Items','Parameters','Parameter_tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$taxrate=(Parameter::where('parameter_code','tax')->first()->parameter_value)+1;
		$Salesinvoice=Salesinvoice::find($id);
        //更新銷貨發票
		$validated=$request->validate([
			'customer_id'=>'required',
			'salesinvoice_identifier'=>'required',
			'salesinvoice_remark'=>'nullable',
		]);
		
		$Salesinvoice->salesinvoice_printstate=$request->salesinvoice_printstate?1:0;
		$Salesinvoice->salesinvoice_invalidstate=$request->salesinvoice_invalidstate?1:0;
		$Salesinvoice->salesinvoice_C0401state=$request->salesinvoice_C0401state?1:0;
		$Salesinvoice->salesinvoice_C0501state=$request->salesinvoice_C0501state?1:0;

		$salesinvoice_productarray=array();
		
		//商品資訊
		$ProductCodeArray=$request->ProductCode;
		$ProductNameArray=$request->ProductName;
		$ProductQtyArray=$request->ProductQty;
		$ProductAmountArray=$request->ProductAmount;
		$TaxTypeArray=$request->TaxType;
		
		$salesinvoice_tnsalesamount=0;
		$txamount=0;
		$salesinvoice_txsalesamount=0;
		$salesinvoice_taxamount=0;
		$salesinvoice_totalamount=0;
		
		
		$i=0;
		foreach($ProductCodeArray as $ProductCode){
			array_push($salesinvoice_productarray,
				array(
					"ProductCode"=>$ProductCode,
					"ProductName"=>$ProductNameArray[$i],
					"ProductQty"=>$ProductQtyArray[$i],
					"ProductAmount"=>$ProductAmountArray[$i],
					"TaxType"=>$TaxTypeArray[$i],
				)
			);
			
			
			if($TaxTypeArray[$i]=="TN"){//免稅
				$salesinvoice_tnsalesamount+=$ProductQtyArray[$i]*$ProductAmountArray[$i];
			}else if($TaxTypeArray[$i]=="TX"){//應稅
				$txamount+=$ProductQtyArray[$i]*$ProductAmountArray[$i];//應稅總金額
			}
			
			$salesinvoice_txsalesamount=round($txamount/$taxrate);
			$salesinvoice_taxamount=$txamount-$salesinvoice_txsalesamount;
			$salesinvoice_totalamount=$salesinvoice_tnsalesamount+$txamount;
			
			$i++;
			
		}//end foreach
			
		//dd($salesinvoice_tnsalesamount.' '.$salesinvoice_txsalesamount.' '.$salesinvoice_taxamount.' '.$salesinvoice_totalamount);

		$Salesinvoice->salesinvoice_productarray=json_encode($salesinvoice_productarray);
		$Salesinvoice->salesinvoice_tnsalesamount=$salesinvoice_tnsalesamount;
		$Salesinvoice->salesinvoice_txsalesamount=$salesinvoice_txsalesamount;
		$Salesinvoice->salesinvoice_taxamount=$salesinvoice_taxamount;
		$Salesinvoice->salesinvoice_totalamount=$salesinvoice_totalamount;
		
		$Salesinvoice->update($validated);
		
		return redirect('salesinvoice');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		try {
			Salesinvoice::find($id)->delete();
			return redirect('salesinvoice');
		}
		catch(\Exception $exception){
			return redirect('salesinvoice')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
	
	//Ajax
	public function display_detail($id)
    {
        //
		$Salesinvoice=Salesinvoice::find($id);
		return view('salesinvoice.display_detail',compact('Salesinvoice'));
    }
}
