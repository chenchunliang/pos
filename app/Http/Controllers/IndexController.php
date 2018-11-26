<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('index');
    }

	//登入
    public function login(Request $request)
    {
        //
		$User = User::where('user_account',$request->account)
		->where('user_password',md5($request->password))
               ->take(1)
               ->first();
		
		
		
		//dd($User);
		if($User){
			$request->session()->put('user_id', $User->id);
			$request->session()->put('user_password',$User->user_password);
			
			//$previous_route=$request->session()->get('previous_route');
			//dd($previous_route);
			
			/*if ($previous_route) {
				return redirect($previous_route);
			}else{
				return redirect('admin/menu');
			}*/
			
			return redirect('menu');
		}else{
			$request->session()->forget('user_id');
			$request->session()->forget('user_password');
			//$request->session()->forget('previous_route');
			Session::flash('login_err_message', '輸入錯誤!'); 
			return redirect('index');
    	}
    }
	public function menu(){
		return view('menu');
	}
}
