<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Invalidinvoice;
use App\Salesinvoice;
use App\Parameter;

class InvalidinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Invalidinvoices = Invalidinvoice::all();
		return view('invalidinvoice.index',compact('Invalidinvoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$Salesinvoices=Salesinvoice::where('salesinvoice_invalidstate','0')->get()->sortByDesc('salesinvoice_invoicenumber');//最新的在最上方
		return view('invalidinvoice.create',compact('Salesinvoices'));
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
		$validator =Validator::make($request->all(), [
			'salesinvoice_id'=>'required',
			'invalidinvoice_invalidreason'=>'required',
		]);
		
		if ($validator ->fails()) {
			return redirect('invalidinvoice/create')->withErrors($validator)->withInput();
		}else{
			$Invalidinvoice=new Invalidinvoice;
			$Invalidinvoice->invalidinvoice_invaliddate = date('Y-m-d');
			$Invalidinvoice->invalidinvoice_invalidtime = date('H:i:s');
			$Invalidinvoice->invalidinvoice_invalidreason =$request->invalidinvoice_invalidreason;
			$Invalidinvoice->salesinvoice_id =$request->salesinvoice_id;
			$Invalidinvoice->save();
			
			$Salesinvoices=Salesinvoice::find($request->salesinvoice_id);
			$Salesinvoices->salesinvoice_invalidstate=1;
			$Salesinvoices->update();
					
			return redirect('invalidinvoice');		
    	}
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
        //
		$Invalidinvoice=Invalidinvoice::find($id);
		$Salesinvoice=Salesinvoice::find($Invalidinvoice->salesinvoice_id);
		return view('invalidinvoice.edit',compact('Invalidinvoice','Salesinvoice'));
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
        //
		$validator =Validator::make($request->all(), [
			'invalidinvoice_invalidreason'=>'required',
		]);
		
		if ($validator ->fails()) {
			return redirect('invalidinvoice/'.$id.'/edit')->withErrors($validator)->withInput();
		}else{
			$Invalidinvoice=Invalidinvoice::find($id);
			$Invalidinvoice->invalidinvoice_invalidreason = $request->invalidinvoice_invalidreason;
			$Invalidinvoice->update();
		}		
		return redirect('invalidinvoice');
    }
	
	
	public function uploadC0501(){//定時處理：工作排程器+wget
		
		$Salesinvoices=Salesinvoice::all()->where("salesinvoice_date",date("Y-m-d"))->where("salesinvoice_C0401state",1)->where("salesinvoice_invalidstate",1)->where("salesinvoice_C0501state",0);
		//dd($Salesinvoices->first()->invalidinvoice);
		
		$Parameters=Parameter::all();
		$Parameter_companyIdentifier=$Parameters->where('parameter_code','companyIdentifier')->first()->parameter_value;
		$uploadC0501Folder=$Parameters->where('parameter_code','uploadC0501Folder')->first()->parameter_value;
		
		foreach($Salesinvoices as $Salesinvoice){
			$others=array();
			$others['companyIdentifier']=$Parameter_companyIdentifier;
			$others['uploadC0501Folder']=$uploadC0501Folder;
			$rs=C0501JsonGenerator($Salesinvoice,$others);
			
			if($rs){
				$Salesinvoice->salesinvoice_C0501state=1;//有上傳成功 變成1
				$Salesinvoice->update();
			}//end if
		}//end foreach
	}//end function
	

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
			$Invalidinvoice=Invalidinvoice::find($id);
			
			$Salesinvoice=Salesinvoice::find($Invalidinvoice->salesinvoice_id);
			$Salesinvoice->salesinvoice_invalidstate=0;
			$Salesinvoice->update();

			$Invalidinvoice->delete();
			
			return redirect('invalidinvoice');
		}
		catch(\Exception $exception){
			return redirect('invalidinvoice')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
}
