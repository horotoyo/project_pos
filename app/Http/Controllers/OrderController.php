<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders         = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments       = Payment::all();
        $products       = Product::all();
        return view('admin.orders.create', compact('payments', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id'   => auth()->user()->id,
        ]);
        // dd($request->discount);

        // dd($request->email);

        if ($request->discount == null) {
            $dataOrder      = $request->only('table_number', 'payment_id', 'user_id', 'email', 'total');
            $order          = Order::create($dataOrder);
        } else {
            $dataOrder      = $request->only('table_number', 'payment_id', 'user_id', 'discount', 'email', 'total');
            $order          = Order::create($dataOrder);
        }

        $dataDetail     = $request->only('product_id', 'product_name', 'product_price', 'quantity', 'note', 'subtotal');
        $countDetail    = count($dataDetail['product_id']);

        for ($i=0; $i<$countDetail; $i++) { 
            $detail                 = new OrderDetail();
            $detail->order_id       = $order->id;
            $detail->product_name   = $dataDetail['product_name'][$i];
            $detail->product_price  = $dataDetail['product_price'][$i];
            $detail->quantity       = $dataDetail['quantity'][$i];
            $detail->note           = $dataDetail['note'][$i];
            $detail->subtotal       = $dataDetail['subtotal'][$i];
            $detail->save();
        }

        return redirect('/orders')->with('success', 'Success input data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order         = Order::find($id);
        return view('admin.orders.invoice', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order              = Order::find($id);
        $orderDetail        = OrderDetail::where('order_id', $id)->first();        
        $products           = Product::all();
        $payments           = Payment::all();
        return view('admin.orders.edit', compact('order', 'orderDetail', 'products', 'payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product            = Product::find($request->product_id);

        $request->merge([
            'total'         => $request->quantity*$product->price,
            'quantity'      => $request->quantity,
            'user_id'       => auth()->user()->id,
            'product_name'  => $product->name,
            'product_price' => $product->price,
        ]);

        $order              = $request->only('table_number', 'discount', 'total', 'payment_id', 'user_id');

        $orderData          = Order::find($id)->update($order);

        $orderDetail        = $request->only('product_id', 'product_name', 'product_price', 'quantity');        
        OrderDetail::where('order_id', $id)->update($orderDetail);
        
        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect('/orders');
    }

}
