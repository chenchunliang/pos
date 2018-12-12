<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Customers=Customer::all();
		return view('customer.index',compact('Customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		
		$customerDistinct=Customer::select('customer_group')->distinct()->get();
		return view('customer.create',compact('customerDistinct'));
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
			'customer_name'=>'required',
			'customer_identifier'=>'nullable',
			'customer_remark'=>'nullable'
		]);
		
		Customer::create($validated);
		
		return redirect('customer');
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
		$Customer=Customer::find($id);
		$customerDistinct=Customer::select('customer_group')->distinct()->get();
		return view('customer.edit',compact('Customer','customerDistinct'));
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
		$Customer=Customer::find($id);
		$validated=$request->validate([
			'customer_name'=>'required',
			'customer_identifier'=>'nullable',
			'customer_remark'=>'nullable'
		]);
		$Customer->update($validated);
		
		return redirect('customer');
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
			Customer::find($id)->delete();
			return redirect('customer');
		}
		catch(\Exception $exception){
			return redirect('customer')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
}
