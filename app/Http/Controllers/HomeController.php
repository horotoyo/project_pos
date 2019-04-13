<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Product;
use App\Model\Order;
use App\Model\User;

class HomeController extends Controller
{
    public function index()
    {
    	$products		= Product::where('status', 1)->get();
    	$categories		= Category::all();
    	$orders			= Order::where('created_at', now())->get();
    	$users			= User::all();
    	return view('admin.home.index', compact('products', 'categories', 'orders', 'users'));
    }
}
