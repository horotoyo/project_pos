<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Product;
use DataTables;
use Form;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['ajax']   = route('products.data');
        $data['create'] = route('products.create');
        return view('admin.products.index', $data);
    }

    public function data(Request $request)
    {
         
            $data = Product::select([
                'id', 'category_id', 'name', 
                'price', 'status'
            ]);
            return DataTables::of($data)
                ->editColumn('category_id', function ($index) {
                    return isset($index->category->name) ? $index->category->name : '-';
                })
                ->editColumn('status', function ($index) {
                    if($index->status == 0) {
                        return '<span class="label label-warning">Not-available</span>';
                    } elseif ($index->status == 1) {
                        return '<span class="label label-success">Available</span>';
                    }
                })
                ->editColumn('price', function ($index) {
                    return 'Rp '.number_format($index->price, 0, ",", ".");
                })
                ->addColumn('action', function ($index) {
                    $tag = Form::open(array("url" => route('products.destroy',$index->id), "method" => "DELETE"));
                    $tag .= "<a href=".route('products.edit', $index->id)." class='btn btn-primary btn-xs' style='margin-right:0.3vw'>Edit</a>";
                    $tag .= "<button type='submit' class='delete btn btn-danger btn-xs'>Delete</button>";
                    $tag .= Form::close();
                    return $tag;
                })
                ->rawColumns(['id', 'status', 'action'])
                ->make(true);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories		= Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product       = Product::find($id);
    	$categories		= Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
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
        Product::find($id)->update($request->all());
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect('/products');
    }
}
