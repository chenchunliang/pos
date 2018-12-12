<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$user_id=$request->session()->get('user_id');
		$user_password=$request->session()->get('user_password');
		
		//dd(url()->current());
 		
		$User = User::where('id',$user_id)
		->where('user_password',$user_password)
               ->take(1)
               ->first();
		
		//dd($User);
		if($User){
			$request->session()->put('user_id', $User->id);
			$request->session()->put('user_password',$User->user_password);
		}else{
            return redirect('/');
        }

        return $next($request);
    }
}
