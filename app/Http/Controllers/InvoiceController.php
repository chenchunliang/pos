<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Invoices=Invoice::all()->sortByDesc('invoice_startmonth');//最新的在最上方
		return view('invoice.index',compact('Invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('invoice.create');
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
		$validated=$request->validate([
			'invoice_startmonth'=>'required|min:5',
			'invoice_endmonth'=>'required|min:5',
			'invoice_wordtrack'=>'required|min:2|regex:/(^([A-Z]+)(\d+)?$)/u',
			'invoice_startnumber'=>'required|min:8',
			'invoice_endnumber'=>'required|min:8',
			'invoice_currentnumber'=>'required|min:8',
		]);
		
		Invoice::create($validated);
		
		return redirect('invoice');
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
		$Invoice=Invoice::find($id);
		return view('invoice.edit',compact('Invoice'));
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
		$Invoice=Invoice::find($id);
		$validated=$request->validate([
			'invoice_startmonth'=>'required|min:5',
			'invoice_endmonth'=>'required|min:5',
			'invoice_wordtrack'=>'required|min:2|regex:/(^([A-Z]+)(\d+)?$)/u',
			'invoice_startnumber'=>'required|min:8',
			'invoice_endnumber'=>'required|min:8',
			'invoice_currentnumber'=>'required|min:8',
		]);
		$Invoice->update($validated);
		
		return redirect('invoice');
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
			Invoice::find($id)->delete();
			return redirect('invoice');
		}
		catch(\Exception $exception){
			return redirect('invoice')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
}
