<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Model\Category;
use App\Model\Product;
use App\Model\Order;
use App\Model\User;

class SocialAuthController extends Controller
{
 
	public function redirectToProvider($provider)
	{
    	return Socialite::driver($provider)->redirect();
	}

	public function handleProviderCallback($provider)
	{
    	$user 		= Socialite::driver($provider)->user();
    	$authUser	= User::firstOrNew(['provider_id'=>$user->id]);
    	
    	// dd($user);

    	$authUser->name 		= $user->nickname;
    	$authUser->email 		= $user->email;
    	$authUser->provider		= $provider;
    	$authUser->provider_id	= $user->id;
    	$authUser->photo		= $user->avatar;

    	$authUser->save();

    	auth()->login($authUser);

    	// return redirect('admin/home/index');

    	$date 			= date('Y-m-d');
    	$products		= Product::where('status', 1)->get();
    	$categories		= Category::all();
    	$orders			= Order::select('created_at')->where('created_at', 'like', '%'.$date.'%')->count();
    	$users			= User::all();
    	return view('admin.home.index', compact('products', 'categories', 'orders', 'users'));

 	}   
}
