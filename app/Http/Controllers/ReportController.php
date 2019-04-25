<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\Product;
use App\Model\User;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $orders         = Order::all();
        $users          = User::all();
        return view('admin.reports.index', compact('orders', 'users'));
    }

    public function filter(Request $request)
    {
        $month          = sprintf("%02d", $request->month);
        $date           = $request->year."-".$month;
        $orders         = Order::where([
                            ['created_at', 'like', "$date%"],
                            ['user_id', $request->user],
                        ])->get();
        $users          = User::all();
        return view('admin.reports.index', compact('orders', 'users'));
    }

    public function exportPdf(Request $request)
    {   
        $month          = sprintf("%02d", $request->month);
        $date           = $request->year."-".$month;
        $data           = Order::get();
        $orders         = Order::where([
                            ['created_at', 'like', "$date%"],
                            ['user_id', $request->user],
                        ])->get();

        $count = count($orders);
        // dd($count);

        if ($count > 0) {
            // return view('admin.reports.download', compact('orders'));
            $pdf = PDF::loadView('admin.reports.download', $data, compact('orders'));
            
            $date = date('d_m_Y_His');
            return $pdf->download('reports_'.$date.'.pdf');
        } else {
            return redirect()->back()->with('success', 'Data is not availabe! You cant download!');
        }

    }
}