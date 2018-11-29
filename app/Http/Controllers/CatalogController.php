<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Catalog;
use App\Item;
use App\Position;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$Catalogs = Catalog::all();
		return view("catalog.index",compact("Catalogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$Items=Item::all();
		return view('catalog.create',compact('Items'));
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//dd($request->position);
        //
		$validator =Validator::make($request->all(), [
			'catalog_name'=>'required',
			'catalog_orders'=>'required',
		]);
		
		if ($validator ->fails()) {
			return redirect('catalog/create')->withErrors($validator)->withInput();
		}else{
			$catalog = new Catalog;
			$catalog->catalog_name = $request->catalog_name;
			$catalog->catalog_orders = $request->catalog_orders;
			$catalog->catalog_display = empty($request->catalog_display)?0:1;
			$catalog->save();
			
			$catalog_id=$catalog->id;
			
			for($i=1;$i<=8;$i++){
				for($j=1;$j<=5;$j++){
					if($request->position[$i][$j]){
						$position = new Position;
						$position->position_x = $j;
						$position->position_y = $i;
						$position->item_id =$request->position[$i][$j];
						$position->catalog_id = $catalog_id;
						$position->save();
					}
				}
			}
		}
		return redirect('catalog');
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
		return $Catalog=Catalog::find($id);
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
		$Catalog=Catalog::find($id);
		$Items=Item::all();
		$positionArray=$Catalog->position;		
		
		return view('catalog.edit',compact('Catalog','Items','positionArray'));
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
			'catalog_name'=>'required',
			'catalog_orders'=>'required',
		]);
		
		if ($validator ->fails()) {
			return redirect('catalog/'.$id.'/edit')->withErrors($validator)->withInput();
		}else{
			$catalog=Catalog::find($id);
			$catalog->catalog_name = $request->catalog_name;
			$catalog->catalog_orders = $request->catalog_orders;
			$catalog->catalog_display = empty($request->catalog_display)?0:1;
			$catalog->update();
			
			$catalog_id=$id;
			
			for($i=1;$i<=8;$i++){
				for($j=1;$j<=5;$j++){
					if($request->position_id[$i][$j] && $request->position[$i][$j]){//update
						$position=Position::find($request->position_id[$i][$j]);
						$position->position_x = $j;
						$position->position_y = $i;
						$position->item_id =$request->position[$i][$j];
						$position->catalog_id = $catalog_id;
						$position->update();
					}else if(empty($request->position_id[$i][$j]) && $request->position[$i][$j]){//insert
						$position = new Position;
						$position->position_x = $j;
						$position->position_y = $i;
						$position->item_id =$request->position[$i][$j];
						$position->catalog_id = $catalog_id;
						$position->save();
					}else if($request->position_id[$i][$j] && empty($request->position[$i][$j])){//delete
						$position=Position::find($request->position_id[$i][$j]);
						//dd($request->position_id[$i][$j]);
						
						$position->delete();
					}
				}
			}
		}
		return redirect('catalog');
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
			$Catalog=Catalog::find($id);
			$positionArray=$Catalog->position;
			foreach($positionArray as $position){
				//dd($position->id);
				Position::find($position->id)->delete();
			}
			
			$Catalog->delete();
			
			return redirect('catalog');
		}
		catch(\Exception $exception){
			return redirect('catalog')->withErrors(['delete_error'=>'此資料已存在其他表單中，不可刪除!']);
		}
    }
}
