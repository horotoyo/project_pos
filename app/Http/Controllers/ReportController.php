<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\Product;
use App\Model\User;
use PDF;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;




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

    public function export(Request $request)
    {
        if ($request->type == null) {
            return redirect()->back()->with('success', 'Your download filter is wrong!');
        } elseif ($request->type == 0) {
            return $this->exportPdf($request);
        } else {
            return $this->exportExcel($request);
        }
    }

    public function exportPdf(Request $request)
    {   
        $month          = sprintf("%02d", $request->month);
        $sendDate		= $month."/".$request->year;
        $date           = $request->year."-".$month;
        $data           = Order::get();
        $orders         = Order::where([
                            ['created_at', 'like', "$date%"],
                            ['user_id', $request->user],
                        ])->get();

        $count = count($orders);

        if ($count > 0) {
            $pdf    = PDF::loadView('admin.reports.download-pdf', $data, compact('orders', 'sendDate'));
            $date   = date('d_m_Y_His');
            return $pdf->download('reports_'.$date.'.pdf');
        } else {
            return redirect()->back()->with('success', 'Data is not availabe! You cant download!');
        }

    }

    public function exportExcel(Request $request)
    {
        $month          = sprintf("%02d", $request->month);
        $sendDate       = $month."/".$request->year;
        $date           = $request->year."-".$month;
        $data           = Order::get();
        $orders         = Order::where([
                            ['created_at', 'like', "$date%"],
                            ['user_id', $request->user],
                        ])->get();

        $count = count($orders);
        
        if ($count > 0) {
        	$date = date('d_m_Y_His');
            return Excel::download(new OrdersExport, 'orders_'.$date.'.xlsx');
        } else {
            return redirect()->back()->with('success', 'Data is not availabe! You cant download!');
        }
    }
}