<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Model\User;
use App\Model\Product;
use App\Model\Order;
use App\Model\Category;

class SendMailController extends Controller
{
    public function sendMail($id)
    {
    	$orders 	= Order::find($id);
    	// dd($orders);
		Mail::to($orders)->send(new OrderShipped($id));
		return redirect('/orders')->with('success', 'Email telah dikirim');
    }
}
