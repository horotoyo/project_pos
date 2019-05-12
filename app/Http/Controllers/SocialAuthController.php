<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
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
    	$user 		= Socialite::driver($provider)->stateless()->user();
    	$authUser	= User::firstOrNew(['provider_id'=>$user->id]);
    	

    	$authUser->name 		= $user->nickname;
    	$authUser->email 		= $user->email;
    	$authUser->provider		= $provider;
    	$authUser->provider_id	= $user->id;
    	$authUser->avatar		= $user->avatar;

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
