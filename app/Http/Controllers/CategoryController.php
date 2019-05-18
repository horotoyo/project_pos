<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use DataTables;
use Form;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data['title']  = 'Category';    
        $data['ajax']   = route('categories.data');
        $data['create'] = route('categories.create');
        return view('admin.categories.index', $data);
    }

    public function data(Request $request)
    {
         
            $data = Category::select(['id', 'name', 'created_at']);
            return DataTables::of($data)
                ->editColumn('created_at', function ($index) {
                    return $index->created_at->format('d M Y');
                })
                ->addColumn('action', function ($index) {
                    $tag = Form::open(array("url" => route('categories.destroy',$index->id), "method" => "DELETE"));
                    $tag .= "<a href=".route('categories.edit', $index->id)." class='btn btn-primary btn-xs' style='margin-right:0.3vw'>Edit</a>";
                    $tag .= "<button type='submit' class='delete btn btn-danger btn-xs'>Delete</button>";
                    $tag .= Form::close();
                    return $tag;
                })
                ->rawColumns(['id', 'action'])
                ->make(true);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect('/categories');
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
        $category       = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
        Category::find($id)->update($request->all());
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('/categories');
    }
}
