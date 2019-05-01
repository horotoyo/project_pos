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

use Illuminate\Support\Facades\DB;


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
        $y      = $request->get('year');
        $m      = $request->get('month');
        $u      = $request->get('user');
        
        $users  = User::all();
        $orders = new Order();

        if ($y) {
            $orders = $orders->whereYear('created_at', $y);
        }
        
        if ($m) {
            $orders = $orders->whereMonth('created_at', $m);
        }
        
        if ($u) {
            $orders = $orders->where('user_id', $u);
        }
      
        $orders = $orders->paginate(10);
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
        $y      = $request->year;
        $m      = $request->month;
        $u      = $request->user;
        
        $users  = User::all();
        $orders = new Order();

        if ($y) {
            $orders = $orders->whereYear('created_at', $y);
        }
        
        if ($m) {
            $orders = $orders->whereMonth('created_at', $m);
        }
        
        if ($u) {
            $orders = $orders->where('user_id', $u);
        }

        $orders = $orders->get();
        $pdf    = PDF::loadView('admin.reports.download-pdf', $orders, compact('orders'));
        $time   = date('d_m_Y_His');
        return $pdf->download('reports_'.$time.'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $y = $request->year;
        $m = $request->month;
        $u = $request->user;    
        
        $time = date('d_m_Y_His');
        return Excel::download(new OrdersExport($y, $m, $u), 'orders_'.$time.'.xlsx');
    }
}