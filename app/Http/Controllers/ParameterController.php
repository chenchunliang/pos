<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Parameter;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Parameters=Parameter::all()->sortBy('parameter_groups',1);
		$ParametersDistinct=Parameter::select('parameter_groups')->distinct()->get();
		//dd($ParametersDistinct);
		return view('parameter.index',compact('Parameters','ParametersDistinct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$ParametersDistinct=Parameter::select('parameter_groups')->distinct()->get();
		return view('parameter.create',compact('ParametersDistinct'));
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
			'parameter_code'=>'required',
			'parameter_title'=>'required',
			'parameter_value'=>'required',
			'parameter_groups'=>'required',
		]);
		
		Parameter::create($validated);
		
		return redirect('parameter');
		
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
		return $Parameters=Parameter::find($id);
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
		$Parameter=Parameter::find($id);
		$ParametersDistinct=Parameter::select('parameter_groups')->distinct()->get();
		return view('parameter.edit',compact('Parameter','ParametersDistinct'));
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
		$validated=$request->validate([
			'parameter_code'=>'required',
			'parameter_title'=>'required',
			'parameter_value'=>'required',
			'parameter_groups'=>'required',
		]);

		Parameter::find($id)->update($validated);
		
		return redirect('parameter');
		
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
			Parameter::find($id)->delete();
			return redirect('parameter');
		}
		catch(\Exception $exception){
			return redirect('parameter')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
}
