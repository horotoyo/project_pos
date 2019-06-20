<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\Product;
use App\Model\User;
use DataTables;
use Form;
use Storage;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajax       = route('orders.data');
        $orders     = Order::all();
        $products   = Product::all();
        $users      = User::all();
        $payments   = Payment::all();
        return view('admin.orders.index', compact('ajax', 'orders', 'products', 'users', 'payments'));
    }

    public function data(Request $request)
    {
        $order = Order::all();
        return DataTables::of($order)
            ->editColumn('payment_id', function ($index) {
                return isset($index->payment->name) ? $index->payment->name : '-';
            })
            ->editColumn('created_at', function ($index) {
                    return $index->created_at->format('d M Y');
            })
            ->editColumn('total', function ($index) {
                return 'Rp '.number_format($index->total, 0, ",", ".");
            })
            ->addColumn('action', function ($index) {
                $tag = Form::open(array("url" => route('orders.destroy',$index->id), "method" => "DELETE"));
                // $tag .= "<a href=".route('orders.edit', $index->id)." class='btn btn-primary btn-xs' style='margin-right:0.3vw'>Edit</a>";
                $tag .= "<button type='button' class='btn btn-default btn-xs detaildata' onclick='detail(".$index->id.")'  data-toggle='modal' data-target='#modal-baru' style='margin-right:0.3vw'>Detail</button>";
                $tag .= "<button type='submit' class='deletedata btn btn-danger btn-xs'>Delete</button>";
                $tag .= Form::close();
                return $tag;
            })
            ->rawColumns(['id', 'action'])
            ->setRowAttr([
                'id'    => function($index){
                        return $index->id;
                },
                'class' => function(){
                        return 'yajraraw';
                }
            ])
            ->make(true);
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
        $order  = Order::find($id);
        $detail = OrderDetail::where('order_id', $id)->get();
        $data   = [
            'order'     => $order,
            'detail'    => $detail
        ];
        return response()->json($data);
    }

    public function print($id)
    {
        $order  = Order::find($id);
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
        $tb = Order::findOrFail($id);
        $tb->delete();
        return redirect('/orders')->with('success', 'Anda telah berhasil menghapus data!');
        // return response()->json(['msg' => true,'success' => trans('message.delete')]);
        // $tb = Order::findOrFail($id);
        // $tb->delete();
        // return response()->json(['msg' => true,'success' => trans('message.delete')]);

    }

}
