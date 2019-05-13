<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Model\Category;
use App\Model\Product;
use App\Model\Order;
use App\Model\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
 
	public function redirectToProvider($provider)
	{
	    return Socialite::driver($provider)->redirect();
	}
	public function handleProviderCallback($provider)
	{
	    try {
	        $user = Socialite::driver($provider)->stateless()->user();
	    } catch (Exception $e) {
	        $user = Socialite::driver($provider)->stateless()->user();
	        return redirect('/login');
	    }
	    $authUser   = $this->findOrCreateUser($user, $provider);
	    Auth::login($authUser, true);
	    return redirect('/home');
	}
	public function findOrCreateUser($socialUser, $provider)
	{
	    $sosmed = User::where('provider_id', $socialUser->getId())
	                        ->where('provider', $provider)
	                        ->first();
	    // dd($socialUser->getAvatar());
	    if ($sosmed) {
	        return $sosmed;
	    }else{
	        $user   = User::where('email', $socialUser->getEmail())->first();
	        if (!$user) {
	            $user   = User::create([
	                'name'  		=> $socialUser->getName(),
	                'email'			=> $socialUser->getEmail(),
	                'provider_id'   => $socialUser->getId(),
	            	'provider' 		=> $provider,
	            	'avatar' 		=> $socialUser->getAvatar()
	            ]);
	        }
	        return $user;
	    }
	}   
}
