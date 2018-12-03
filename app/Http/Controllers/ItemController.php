<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Parameter;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Items=Item::all();
		$Parameters=Parameter::where('parameter_groups','價格')->get();
		$text=array('','一','二','三','四','五');
		return view('item.index',compact('Items','Parameters','text'));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$text=array('','一','二','三','四','五');
		$Parameters=Parameter::where('parameter_groups','價格')->get();
		return view('item.create',compact('Parameters','text'));
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
			'item_name'=>'required',
			'item_specification'=>'required',
			'item_barcode'=>'required',
			'item_unitprice1'=>'required',
			'item_unitprice2'=>'required',
			'item_unitprice3'=>'required',
			'item_unitprice4'=>'required',
			'item_unitprice5'=>'required',
			'item_unit'=>'required',
			'item_taxtype'=>'required|min:1|max:2',
			'item_image'=>'required',
		]);
		
		Item::create($validated);
		
		return redirect('item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //目前沒用到
		return $Item=Item::find($id);
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
		$text=array('','一','二','三','四','五');
		$Parameters=Parameter::where('parameter_groups','價格')->get();
		$Item=Item::find($id);
		return view('item.edit',compact('Item','Parameters','text'));
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
		$Item=Item::find($id);
		$validated=$request->validate([
			'item_name'=>'required',
			'item_specification'=>'required',
			'item_barcode'=>'required',
			'item_unitprice1'=>'required',
			'item_unitprice2'=>'required',
			'item_unitprice3'=>'required',
			'item_unitprice4'=>'required',
			'item_unitprice5'=>'required',
			'item_unit'=>'required',
			'item_taxtype'=>'required|min:1|max:2',
		]);
		
		if($request->item_image){
			$Item->item_image=$request->item_image;
		}
		
		$Item->update($validated);
		
		return redirect('item');
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
			Item::find($id)->delete();
			return redirect('item');
		}
		catch(\Exception $exception){
			return redirect('item')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
}
