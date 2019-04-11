<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function __construct()
    // {
    // 	$this->middleware('guest')->except('logout');
    // }

    public function loginForm()
    {
    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	$credentials 	= $request->only('email', 'password');
    	$check 			= Auth::attempt($credentials, $request->remember);
    	if ($check) {
    		return redirect()->intended('/home');
    	} else {
    		return redirect()->back()->with('success', 'Anda Belum Login!!!');
    	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/login');
    }
}
